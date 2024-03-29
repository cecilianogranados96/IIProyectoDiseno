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
            <div id="titulo" style="margin-left: -20%;">Reporte Comparativo por año</div>
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
            <td>

                <select id="ano" name="ano" class="form-control input-md" style="width: 80px;">
                    <option value="2012" selected>2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                </select>
            </td>
        </tr>
    </table>

    <table class="table">
        <tr>
            <td>
                <center>
                    <button onclick="sus('piechart1','Pp1','Ap1')" id="Ap1" class="btn btn-success">Incluir</button>
                    <button onclick="des('piechart1','Ap1','Pp1')" id="Pp1" class="btn btn-danger">Parar</button>
                    <p class="js-p1"></p>
                    <div id="piechart1" style="width: 500px; height:250px;"></div>
                </center>
            </td>
            <td>
                <center>
                    <button onclick="sus('piechart2','Pp2','Ap2')" id="Ap2" class="btn btn-success">Incluir</button>
                    <button onclick="des('piechart2','Ap2','Pp2')" id="Pp2" class="btn btn-danger">Parar</button>
                    <div id="piechart2" style="width: 500px; height:250px;"></div>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <button onclick="sus('piechart3','Pp3','Ap3')" id="Ap3" class="btn btn-success">Incluir</button>
                    <button onclick="des('piechart3','Ap3','Pp3')" id="Pp3" class="btn btn-danger">Parar</button>

                    <div id="piechart3" style="width: 500px; height:250px;"></div>
                </center>
            </td>
            <td>
                <center>
                    <button onclick="sus('piechart4','Pp4','Ap4')" id="Ap4" class="btn btn-success">Incluir</button>
                    <button onclick="des('piechart4','Ap4','Pp4')" id="Pp4" class="btn btn-danger">Parar</button>
                    <div id="piechart4" style="width: 500px; height:250px;"></div>
                </center>
            </td>
        </tr>
    </table>
    <script src="../../controller/grafico3.js"></script>
</body>

</html>
