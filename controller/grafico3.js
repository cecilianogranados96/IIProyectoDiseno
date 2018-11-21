class Observable {
  constructor() {
    this.observers = [];
  }
  subscribe(f) {
    this.observers.push(f);
  }
  unsubscribe(f) {
    this.observers = this.observers.filter(subscriber => subscriber !== f);
  }
  notify() {
    console.log(this.observers);
  }
}


const headingsObserver = new Observable();

$("#Pp1").hide();
$("#Pp2").hide();
$("#Pp3").hide();
$("#Pp4").hide();
    
    
function sus(objeto,oculta,muestra){
    headingsObserver.subscribe(objeto);
    headingsObserver.notify();
    $("#"+oculta).show();
    $("#"+muestra).hide();
}
function des(objeto,oculta,muestra){
    headingsObserver.unsubscribe(objeto);
    headingsObserver.notify();
    $("#"+oculta).show();
    $("#"+muestra).hide();
}

    var Pintar = function(campo = 'provincia') {
        datos = actualizar(campo,$("#ano option:selected").text());
        headingsObserver.observers.forEach(function(key) {
            drawChart(datos,key)
        });
    }
    function provincia(){
        var filtro = new Pintar("provincia");
    }
    function canton(){
        var filtro = new Pintar("canton");
    }
    function distrito(){
        var filtro = new Pintar("distrito");
    }
    function edad(){
        var filtro = new Pintar("edad");
    } 
    function lesion(){
        var filtro = new Pintar("lesion");
    } 
    function sexo(){
        var filtro = new Pintar("sexo");    
    }
    function actualizar(campo1,ano1){
        return $.ajax({
            type: 'POST',
            url: "../../model/grafico3/consultar.php",
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
    google.charts.setOnLoadCallback(inicializar);
    var inicial = [['Campo', 'Total'],['Seleciona un campo', 100]];        
    function drawChart(datos1 = inicial,id = 'piechart1') {
        var data = google.visualization.arrayToDataTable(datos1);
        var options = {
            title: $("#ano option:selected").text(),
            is3D: true,
            backgroundColor:'#e3e3e3', 
            titleTextStyle: {
                fontSize: 30}
        };
        var chart = new google.visualization.PieChart(document.getElementById(id));
        chart.draw(data, options);
    }
    function inicializar(){
        drawChart(inicial,'piechart1');
        drawChart(inicial,'piechart2');
        drawChart(inicial,'piechart3');
        drawChart(inicial,'piechart4');
    }
