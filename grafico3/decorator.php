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
a
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
// input devices
 
var Gestures = function (output) {
    this.output = output;
 
    this.tap = function () { this.output.click(); }
    this.swipe = function () { this.output.move(); }
    this.pan = function () { this.output.drag(); }
    this.pinch = function () { this.output.zoom(); }
};
 
var Mouse = function (output) {
    this.output = output;
 
    this.click = function () { this.output.click(); }
    this.move = function () { this.output.move(); }
    this.down = function () { this.output.drag(); }
    this.wheel = function () { this.output.zoom(); }
};
// output devices
var Screen = function () {
    this.click = function () { log.add("Screen select"); }
    this.move = function () { log.add("Screen move"); }
    this.drag = function () { log.add("Screen drag"); }
    this.zoom = function () { log.add("Screen zoom in"); }
};
 
var Audio = function () {
    this.click = function () { log.add("Sound oink"); }
    this.move = function () { log.add("Sound waves"); }
    this.drag = function () { log.add("Sound screetch"); }
    this.zoom = function () { log.add("Sound volume up"); }
};

// logging helper
var log = (function () {
    var log = "";
 
    return {
        add: function (msg) { log += msg + "\n"; },
        show: function () { console.log(log);  }
    }
})();
 
    var screen = new Screen();
    var audio = new Audio();
    var hand = new Gestures(screen);
    var mouse = new Mouse(audio);
 
    hand.tap();
    hand.swipe();
    hand.pinch();
    mouse.click();
    mouse.move();
    mouse.wheel();
 
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




