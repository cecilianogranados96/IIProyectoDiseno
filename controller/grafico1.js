    var Base = function(base) {
        this.base = base;
    }
    var where = '';
    var Filtro = function(user, tabla, id) {
        this.tabla = tabla;
        this.id = id;
        where += this.tabla + this.id+ ",";
    }     
    var sql = new Base("base");
    function provincia(provincias, sql1 = sql){
        var arreglo = $("#provincia").val(); 
        if ($("#provincia").val() != null){
            if (arreglo.length == 1) {
                var filtro = new Filtro(sql1, "accidente.provincia =", provincias);
                $.post("../../model/grafico1/cantones.php", {provincia: provincias}, function(result){
                    $("#cantones").removeAttr("disabled");
                    $("#distritos").removeAttr("disabled");
                    $("#cantones").html(result);
                });
            }else{
                arreglo.forEach(function(element) {
                    var filtro = new Filtro(sql1, "accidente.provincia =", element);
                });
                $("#cantones").prop('disabled', 'disabled');
                $("#distritos").prop('disabled', 'disabled');
            }
        }
        actualizar();
    }
    function canton(valcanton, sql1 = sql){
        var filtro = new Filtro(sql1, "canton =", valcanton);
        $.post("../../model/grafico1/distritos.php", {canton: valcanton}, function(result){
            $("#distritos").html(result);
        });   
        actualizar();
    }
    function distrito(valdistrito, sql1 = sql){
        var filtro = new Filtro(sql1, "distrito =", valdistrito);        
        actualizar();
    }
    function ano(valano, sql1 = sql){
        var valores = $("#ano").val();
        if (valores.length == 1) {
            var filtro = new Filtro(sql1, "ano =", valano);
        }else{
           valores.forEach(function(element) {
               var filtro = new Filtro(sql1, "ano =", element);
            });
        }
        actualizar();
    }
    function lesion(vallesion, sql1 = sql){
        var valores = $("#lesion").val();
            if (valores.length == 1) {
                var filtro = new Filtro(sql1, "cod_lesion =", vallesion);
            }else{
               valores.forEach(function(element) {
                   var filtro = new Filtro(sql1, "cod_lesion =", element);
                });
            }
        
        actualizar();
    }
    function edad(valedad, sql1 = sql){
        var valores = $("#edad").val();
            if (valores.length == 1) {
                var filtro = new Filtro(sql1, "edad ", valedad);
            }else{
               valores.forEach(function(element) {
                   var filtro = new Filtro(sql1, "edad ", element);
                });
            }
        actualizar();
    }  
    function sexo(valsexo, sql1 = sql){
        var filtro = new Filtro(sql1, "cod_sexo =", valsexo);    
        actualizar();
    }      
    function actualizar(){  
    
        var datos = $.post("../../model/grafico1/consultar.php", {where: where}, function(result){
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
      $.post("../../model/grafico1/consultar.php", {where: ""}, function(result){
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