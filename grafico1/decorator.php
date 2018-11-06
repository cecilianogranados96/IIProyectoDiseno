<?php
interface iWhere
{
	public function getWere();
}

class Where implements iWhere
{
	protected $_baseWhere = "SELECT * FROM ";
	public function getWere()
	{
		return $this->_baseWhere;
	}
}

abstract class WhereDecorator implements iWhere
{
	protected $_where = "";
    protected $_filtro = "";
    protected $_id = "";
	public function __construct(iWhere $Where,$Id,$Filtro)
	{
		$this->_where = $Where;
        $this->_filtro = $Filtro;
        $this->_id = $Id;
	}
}

class base extends Where
{
	public function __construct($base)
	{
		$this->_baseWhere .= $base." WHERE ";
	}
}

class filtro extends WhereDecorator
{
	public function getWere()
	{        
		return $this->_where->getWere()."Filtro1 = '".$this->_id."' and ";
	}    
}

$sql = new base("BASE");
$sql = new filtro($sql,"F1","111");
$sql = new filtro($sql,"F2","222");
echo $sql->getWere();
?>

<script>
var Base = function(base) {
    this.base = base;
    log.add("Select * from " + this.base + " WHERE ");
}

var Filtro = function(user, tabla, id) {
    this.tabla = tabla;
    this.id = id;
    log.add( this.tabla + " = " + this.id+ " and ");
}

var log = (function() {
    var log = "";
    return {
        add: function(msg) { log += msg + ""; },
        show: function() { console.log(log); log = ""; }
    }
})();
 
function run() {
 
    var sql = new Base("base");
    var filtro = new Filtro(sql, "filtro1", "1");
    var filtro = new Filtro(sql, "filtro2", "1");
    log.show();

}
    run();
    </script>


<script>
function Click() {
    this.handlers = [];
}
Click.prototype = {
    subscribe: function(fn) {
        this.handlers.push(fn);
    },
    unsubscribe: function(fn) {
        this.handlers = this.handlers.filter(
            function(item) {
                if (item !== fn) {
                    return item;
                }
            }
        );
    }, 
    fire: function(o, thisObj) {
        var scope = thisObj || window;
        this.handlers.forEach(function(item) {
            item.call(scope, o);
        });
    },
    view: function() {
        this.handlers.forEach(function(item) {
            console.log(item);
        });
        }
}
var log = (function() {
    var log = "";
    return {
        add: function(msg) { log += msg + "\n"; },
        show: function() { console.log(log); log = ""; }
    }
})();
 
    var clickHandler = function(item) { 
        log.add(item); 
    };
 
    var click = new Click();
 
    click.subscribe(clickHandler);
    
    click.fire('event #1');
    click.fire('event #2');
    click.fire('event #3');


    log.show();

    
    </script>



<!--
    <script type="text/javascript">
      google.charts.load("current", {
        "packages":["map"],
        "mapsApiKey": "AIzaSyCum0ulO0WQmf1cNz7C9CDjsBgdkBqecuQ"
      });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],          
            <?php 
                /*$consulta = "SELECT * from distrito ";
                $sth = mysqli_query($link,$consulta); 
                while($r = mysqli_fetch_assoc($sth)) {
                   echo "[".$r['lat'].", ".$r['lng'].", '".utf8_encode($r['distrito'])."'], \n";
                }*/ 
            ?>            
            [09.5201, -84.0540, 'ASERRI']
        ]);
        var map = new google.visualization.Map(document.getElementById('chart_div'));
        map.draw(data, {
          showTooltip: true,
          showInfoWindow: true,
          zoomLevel: 8
        });
      }
    </script>
>--!>




