<?php include "../config.php"; ?>
<html>
<head>
    <title>Reporte de Accidentes</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="../assets/css/filtros.css" rel="stylesheet" >
    <script src="../assets/js/filtros.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body{
            background-color: #e3e3e3;
        }
        </style>
</head>
<body onload="provincia()">
    <center><h2><div id="titulo" style="    margin-left: -20%;">Comportamiento por año</div></h2></center>
        <table style="width: 30%;margin-top: 1%;margin-left: 2%;">
        <tr>
            <td>
                 <a href="#" onclick="provincia();" class="btn btn-primary">Provincia</a>
            </td>
            <td>
                 <a href="#" onclick="canton();" class="btn btn-primary">Canton</a>
            </td>
            <td>
                 <a href="#" onclick="distrito();" class="btn btn-primary">Distrito</a>
            </td>
              <td>
                <a href="#" onclick="sexo();" class="btn btn-primary">Sexo</a>
            </td>
            <td>
                <a href="#" onclick="lesion();" class="btn btn-primary">Lesion</a>
            </td>
            <td>
                <a href="#" onclick="edad();" class="btn btn-primary">Edad</a>
            </td>
        </tr>
        </table>
    

    <table class="table">
        <tr>
            <td>
                <center>
                    <div id="piechart1" style="width: 500px; height:250px;"></div>
                </center>
            </td>
              <td>
                  <center>
                        <div id="piechart2" style="width: 500px; height:250px;"></div>
                  </center>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                        <div id="piechart3" style="width: 500px; height:250px;"></div>
                </center>
            </td>
        </tr>
    </table>

    <script>
    var Base = function(base) {
        this.base = base;
    }
    
    var sql = new Base("accidentes"); 
        var datos1;
        var datos2;
        var datos3
    
    var Pintar = function(sql,campo = 'provincia') {
        datos1 = actualizar(campo,2012);
        datos2 = actualizar(campo,2013);
        datos3 = actualizar(campo,2014);
        drawChart(datos1,datos2,datos3);
    }
    
    function provincia(sql1 = sql){
        var filtro = new Pintar(sql1, "provincia");
    }
    function canton(sql1 = sql){
        var filtro = new Pintar(sql1, "canton");
    }
    function distrito(sql1 = sql){
        var filtro = new Pintar(sql1, "distrito");
    }
    function edad(sql1 = sql){
        var filtro = new Pintar(sql1, "edad");
    } 
    function lesion(sql1 = sql){
        var filtro = new Pintar(sql1, "lesion");
    } 
    function sexo(sql1 = sql){
        var filtro = new Pintar(sql1, "sexo");    
    }
    function actualizar(campo1,ano1){
        return $.ajax({
            type: 'POST',
            url: "consultar.php",
            async: false,
            dataType: 'json',
            data: { campo: campo1, ano: ano1 },
            done: function(results) {
                JSON.parse(results);
                return results;
            }
        }).responseJSON; 
    }
        
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    var inicial = [['Campo', 'Total'],['Seleciona un campo', 100]];        
    function drawChart(datos1 = inicial,datos2 = inicial,datos3 = inicial) {
        console.log(datos1);
        var data1 = google.visualization.arrayToDataTable(datos1);
        var data2 = google.visualization.arrayToDataTable(datos2);
        var data3 = google.visualization.arrayToDataTable(datos3);
        var options1 = {title: '2012',is3D: true,backgroundColor:'#e3e3e3', titleTextStyle: {fontSize: 30}};
        var options2 = {title: '2013',is3D: true,backgroundColor:'#e3e3e3', titleTextStyle: {fontSize: 30}};
        var options3 = {title: '2014',is3D: true,backgroundColor:'#e3e3e3', titleTextStyle: {fontSize: 30}};
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart1.draw(data1, options1);
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);
        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart3.draw(data3, options3);
    }
    </script>
    </body>
</html>
