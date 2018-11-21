<html>

<head>
    <title>Reporte de Accidentes</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="../../assets/css/filtros.css" rel="stylesheet">
    <script src="../../assets/js/filtros.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background-color: #e3e3e3;
        }

    </style>
</head>

<body onload="provincia()">
    <center>
        <h2>
            <div id="titulo" style="    margin-left: -20%;">Comportamiento por año</div>
        </h2>
    </center>
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
    <script src="../../controller/grafico2.js"></script>
</body>

</html>
