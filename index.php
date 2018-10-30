<html>
<head>
    <title>Reporte de Accidentes</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="assets/css/filtros.css" rel="stylesheet" >
    <script src="assets/js/filtros.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
      <div class="container">
 <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    

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
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        "mapsApiKey": "AIzaSyCum0ulO0WQmf1cNz7C9CDjsBgdkBqecuQ"
    });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],          
            <?php 
                $host = "35.232.101.189";
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
                $host = "35.232.101.189";
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
    </div>
</body>

</html>
