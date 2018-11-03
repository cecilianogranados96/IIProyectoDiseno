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

<body>
 
    

        <div class="row">



            <button title="None selected" type="button" class="text-left btn btn-default"><strong>AGE RANGE:</strong> <br />None selected <b class="caret"></b></button>
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>PROVIDER:</strong> <br /> None selected <b class="caret"></b></button>
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>RETAIL MODEL:</strong> <br /> None selected <b class="caret"></b></button>
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>SUBSCRIPTION:</strong> <br /> None selected <b class="caret"></b></button>
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>GENRE:</strong> <br /> None selected <b class="caret"></b></button>
            <button title="None selected" type="button" class="text-left btn btn-default"><strong>PRICE:</strong> <br /> None selected <b class="caret"></b></button>
            <select class="filter-me" id="select-2" multiple="multiple">
			<option value="cheese">Cheese</option>
			<option value="tomatoes">Tomatoes</option>
			<option value="mozarella">Mozzarella</option>
			<option value="mushrooms">Mushrooms</option>
			<option value="pepperoni">Pepperoni</option>
			<option value="onions">Onions</option>
		</select>
            <select class="filter-me" id="select-3" multiple="multiple">
			<option value="cheese">Cheese</option>
			<option value="tomatoes">Tomatoes</option>
			<option value="mozarella">Mozzarella</option>
			<option value="mushrooms">Mushrooms</option>
			<option value="pepperoni">Pepperoni</option>
			<option value="onions">Onions</option>
		</select>

            <br />
       

            <div id="chart_div" style="width: 100%; height: 100%;"></div>

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
                $host = "35.230.49.154";
                $contrasena ="diseno123*";
                $usuario = "admin_diseno";
                $base ="admin_diseno";
                $link = new mysqli("$host", "$usuario", "$contrasena", "$base");
                $consulta = "SELECT * from distrito ";
                $sth = mysqli_query($link,$consulta); 
                while($r = mysqli_fetch_assoc($sth)) {
                   echo "[".$r['lat'].", ".$r['lng'].", '".utf8_encode($r['distrito'])."'], \n";
                } ?>
            
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
            
            
            <script type='text/javascript'>
     google.charts.load('current', {
       'packages': ['geochart'],
       // Note: you will need to get a mapsApiKey for your project.
       // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       'mapsApiKey': 'AIzaSyCum0ulO0WQmf1cNz7C9CDjsBgdkBqecuQ'
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
          
          var data = google.visualization.arrayToDataTable([
         ['City',   'Population', 'Area'],     
            <?php 
                $host = "35.230.49.154";
                $contrasena ="diseno123*";
                $usuario = "admin_diseno";
                $base ="admin_diseno";
                $link = new mysqli("$host", "$usuario", "$contrasena", "$base");
                $consulta = "SELECT * from distrito ";
                $sth = mysqli_query($link,$consulta); 
                while($r = mysqli_fetch_assoc($sth)) {
                   echo "['".utf8_encode($r['distrito'])."',".rand(0,20).",".rand(30,80)."], \n";
                } ?>
            
                ['ASERRI',4,80]
        ]);
          
          
          

      var options = {
        region: 'CR',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div1'));
      chart.draw(data, options);
    };
    </script>
            
            
            

   
    </div>
</body>

</html>
