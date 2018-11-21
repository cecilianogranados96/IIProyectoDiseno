<?php include "../../config.php"; ?>
<html>
<head>
    <title>Reporte de Accidentes</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href="../../assets/css/filtros.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background-color: #e3e3e3;
        }

    </style>
</head>

<body>
    <button title="Seleccionar" type="button" class="text-left btn btn-default"><strong>PROVINCIA:</strong><br>
                <select class="filter-me" id="provincia" name="provincia" onchange="provincia(this.value);" multiple >
                <?php 
                    $sth = mysqli_query($link,"SELECT * from provincia"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['id_provincia'])."'>".utf8_encode($r['provincia'])."</option>";
                    } 
                ?>
                </select>
            </button>

    <button type="button" class="text-left btn btn-default"><strong>CANTON:</strong><br>
                <select class="form-control"  id="cantones" name="cantones" onchange="canton(this.value);" disabled>
                    <option value="">Todos</option>
                </select>
            </button>

    <button title="None selected" type="button" class="text-left btn btn-default"><strong>DISTRITO:</strong><br>
                <select class="form-control"  id="distritos" name="distritos" onchange="distrito(this.value);" disabled>
                    <option value="">Todos</option>
                </select>
            </button>

    <button title="None selected" type="button" class="text-left btn btn-default"><strong>AÑOS:</strong> <br>
                <select class="filter-me" id="ano" name="ano" onchange="ano(this.value);" multiple >
                <?php 
                    $sth = mysqli_query($link,"SELECT DISTINCT(ano) as ano FROM `accidente`"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['ano'])."'>".utf8_encode($r['ano'])."</option>";
                    } 
                ?>
                </select>
            </button>

    <button title="None selected" type="button" class="text-left btn btn-default"><strong>SEXO:</strong> <br>
                <select class="filter-me" id="sexo" name="sexo" onchange="sexo(this.value);">
                    <option value="0">Masculino</option>
                    <option value="1">Femenino</option>
                </select>
            </button>


    <button title="None selected" type="button" class="text-left btn btn-default"><strong>LESIÓN:</strong> <br>
                <select class="filter-me" id="lesion"  onchange="lesion(this.value);" multiple>
                    <?php 
                    $sth = mysqli_query($link,"SELECT * from lesion"); 
                    while($r = mysqli_fetch_assoc($sth)) {
                       echo "<option value='".utf8_encode($r['id_lesion'])."'>".utf8_encode($r['lesion'])."</option>";
                    } 
                    ?>
                </select>
            </button>

    <button title="None selected" type="button" class="text-left btn btn-default"><strong>EDAD:</strong> <br>
                <select class="filter-me" id="edad" name="edad"  onchange="edad(this.value);" multiple> 
                    <option value="BETWEEN 0 and 4">0 a 4 años</option>
                    <option value="BETWEEN 5 and 9">0 a 4 años</option>
                    <option value="BETWEEN 10 and 14">10 a 14 años</option>
                    <option value="BETWEEN 15 and 19">15 a 19 años</option>
                    <option value="BETWEEN 20 and 24">20 a 24 años</option>
                    <option value="BETWEEN 25 and 29">25 a 29 años</option>
                    <option value="BETWEEN 30 and 34">30 a 34 años</option>
                    <option value="BETWEEN 35 and 39">35 a 39 años</option>
                    <option value="BETWEEN 40 and 44">40 a 44 años</option>
                    <option value="BETWEEN 45 and 49">45 a 49 años</option>
                    <option value="BETWEEN 50 and 54">50 a 54 años</option>
                    <option value="BETWEEN 55 and 59">55 a 59 años</option>
                    <option value="BETWEEN 60 and 64">60 a 64 años</option>
                    <option value="BETWEEN 65 and 69">65 a 69 años</option>
                    <option value="BETWEEN 70 and 74">70 a 74 años</option>
                    <option value="> 75">75 ó más</option>
                    <option value=" = -1">Desconocida</option>
                </select>
            </button>

    </div>

    <script src="../../controller/grafico1.js"></script>
    <script src="../../assets/js/filtros.js"></script>
    <div id="chart_div1" style="width: 100%; height: 100%;"></div>

</body>

</html>
