<?php include "../config.php"; ?>
<html>
<head>
    <title>Reporte de Accidentes</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="../assets/css/filtros.css" rel="stylesheet" >
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body{
            background-color: #e3e3e3;
        }
        </style>
</head>
<body>
            <button title="Seleccionar" type="button" class="text-left btn btn-default"><strong>PROVINCIA:</strong><br>
                <select class="filter-me" id="provincia" name="provincia" onchange="provincia(this.value);" multiple >
                <?php 
                    $sth = mysqli_query($link,"SELECT * from provincia"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['id_provincia'])."'>".utf8_encode($r['provincia'])."</option>";
                    } 
                ?>
                </select>
            </button>
            
            <button  type="button" class="text-left btn btn-default"><strong>CANTON:</strong><br>
                <select class="form-control"  id="cantones" name="cantones" onchange="canton(this.value);" disabled>
                    <option value="">Todos</option>
                </select>
            </button>
            
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>DISTRITO:</strong><br>
                <select class="form-control"  id="distritos" name="distritos" onchange="distrito(this.value);" disabled>
                    <option value="">Todos</option>
                </select>
            </button>
                
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>AÑOS:</strong> <br>
                <select class="filter-me" id="ano" name="ano" onchange="ano(this.value);" multiple >
                <?php 
                    $sth = mysqli_query($link,"SELECT DISTINCT(ano) as ano FROM `accidente`"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['ano'])."'>".utf8_encode($r['ano'])."</option>";
                    } 
                ?>
                </select>
            </button>
            
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>SEXO:</strong> <br>
                <select class="filter-me" id="sexo" name="sexo" onchange="sexo(this.value);">
                    <option value="0">Masculino</option>
                    <option value="1">Femenino</option>
                </select>
            </button>
            
            
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>LESIÓN:</strong> <br>
                <select class="filter-me" id="lesion"  onchange="lesion(this.value);" multiple>
                    <?php 
                    $sth = mysqli_query($link,"SELECT * from lesion"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['id_lesion'])."'>".utf8_encode($r['lesion'])."</option>";
                    } 
                    ?>
                </select>
            </button>
        
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>EDAD:</strong> <br>
                <select class="filter-me" id="edad" name="edad"  onchange="edad(this.value);" multiple> 
                    <option value="BETWEEN 0 and 4">0 a 4 años</option>
                    <option value="BETWEEN 10 and 14">10 a 14 años</option>
                    <option value="BETWEEN 15 and 19">15 a 19 años</option>
                    <option value="BETWEEN 20 and 20">20 a 24 años</option>
                    <option value="BETWEEN 25 and 29">25 a 29 años</option>
                    <option value="BETWEEN 30 and 34">30 a 34 años</option>
                    <option value="BETWEEN 35 and 39">35 a 39 años</option>
                    <option value="BETWEEN 40 and 44">40 a 44 años</option>
                    <option value="BETWEEN 45 and 49">45 a 49 años</option>
                    <option value="BETWEEN 50 and 54">50 a 54 años</option>
                    <option value="BETWEEN 55 and 59">55 a 59 años</option>
                    <option value="BETWEEN 60 and 64">60 a 64 años</option>
                    <option value="BETWEEN 65 and 69">65 a 69 años</option>
                    <option value="BETWEEN 70 and 74">70 a 74 años</option>
                    <option value="> 75">75 ó más</option>
                    <option value=" = -1">Desconocida</option>
                </select>
            </button>
           
     </div>
    
    <script>
    var Base = function(base) {
        this.base = base;
    }
    var Filtro = function(user, tabla, id) {
        this.tabla = tabla;
        this.id = id;
        log.add( this.tabla + " = " + this.id+ " OR ");
    }

    var log = (function() {
        var log = "";
        return {
            add: function(msg) { log += msg + ""; },
            show: function() { return log; log = ""; }
        }
    })();
        
    var sql = new Base("base");
            
    function provincia(provincias, sql1 = sql){
        var arreglo = $("#provincia").val(); 
        if ($("#provincia").val() != null){
            if (arreglo.length == 1) {
                var filtro = new Filtro(sql1, "accidente.provincia", provincias);
                $.post("cantones.php", {provincia: provincias}, function(result){
                    $("#cantones").removeAttr("disabled");
                    $("#distritos").removeAttr("disabled");
                    $("#cantones").html(result);
                });
            }else{
                arreglo.forEach(function(element) {
                    var filtro = new Filtro(sql1, "accidente.provincia", element);
                });
                $("#cantones").prop('disabled', 'disabled');
                $("#distritos").prop('disabled', 'disabled');
            }
        }
        actualizar();
    }
           
    function canton(valcanton, sql1 = sql){
        var filtro = new Filtro(sql1, "canton", valcanton);
        $.post("distritos.php", {canton: valcanton}, function(result){
            $("#distritos").html(result);
        });   
        actualizar();
    }
    function distrito(valdistrito, sql1 = sql){
        var filtro = new Filtro(sql1, "distrito", valdistrito);        
        actualizar();
    }
    function ano(valano, sql1 = sql){
        var valores = $("#ano").val();
        if (valores.length == 1) {
            var filtro = new Filtro(sql1, "ano", valano);
        }else{
           valores.forEach(function(element) {
               var filtro = new Filtro(sql1, "ano", element);
            });
        }
        actualizar();
    }
    function lesion(vallesion, sql1 = sql){
        var valores = $("#lesion").val();
            if (valores.length == 1) {
                var filtro = new Filtro(sql1, "lesion", vallesion);
            }else{
               valores.forEach(function(element) {
                   var filtro = new Filtro(sql1, "lesion", element);
                });
            }
        
        actualizar();
    }
    function edad(valedad, sql1 = sql){
        var valores = $("#edad").val();
            if (valores.length == 1) {
                var filtro = new Filtro(sql1, "edad", valano);
            }else{
               valores.forEach(function(element) {
                   var filtro = new Filtro(sql1, "edad", element);
                });
            }
        actualizar();
    }   
    function sexo(valsexo, sql1 = sql){
        var filtro = new Filtro(sql1, "sexo", valsexo);    
        actualizar();
    }
        
    function actualizar(){   
        where = log.show().substr(0, (log.show().length)-4);
        console.log(where);
        var datos = $.post("consultar.php", {where: "where "+where}, function(result){
            console.log(result);
            datos_c =  JSON.parse(result);
            drawMarkersMap(datos_c);
        });
    }
        
     google.charts.load('current', {
       'packages': ['geochart'],
       'mapsApiKey': 'AIzaSyCum0ulO0WQmf1cNz7C9CDjsBgdkBqecuQ'
     });
     google.charts.setOnLoadCallback(drawMarkersMap);
      var inicial = [['City', 'Accidentes']];
      $.post("consultar.php", {where: ""}, function(result){
            console.log(result);
            datos_c =  JSON.parse(result);
            drawMarkersMap(datos_c);
        });
        
        
      function drawMarkersMap(datos  = inicial) {
        var data = google.visualization.arrayToDataTable(datos);
        var options = {
            region: 'CR',
            displayMode: 'markers',
            colorAxis: {colors: ['green', 'blue']}
        };
        var chart = new google.visualization.GeoChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    };
    </script>     
    <script src="../assets/js/filtros.js"></script>
    <div id="chart_div1" style="width: 100%; height: 100%;"></div>
    
    </body>
</html>
