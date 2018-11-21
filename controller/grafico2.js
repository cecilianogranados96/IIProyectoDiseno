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
            url: "../../model/grafico2/consultar.php",
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