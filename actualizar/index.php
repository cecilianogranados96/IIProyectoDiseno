<html>
<head>
    <link href="lib/uploadfile.css" rel="stylesheet">
    <script src="lib/jquery.min.js"></script>
    <script src="lib/jquery.uploadfile.min.js"></script>
    <link href="lib/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br><br>
        <center>
            <h1> Actualizacion de base de datos</h1>
        </center>
        <div id="importacion">
        <br><br><br>
        <h2>PASO 1: Subir el archivo</h2>
        <center>
            <div id="fileuploader">Subir</div>
            <script>
                $(document).ready(function() {
                    $('#datos').hide(); 
                    $("#fileuploader").uploadFile({
                        url: "upload.php",
                        fileName: "myfile"
                    });
                });
            </script>
        </center>
        <br><br>
        <h2>PASO 2: Ejecutar</h2>
        <center><button type="button" id="leer" class="btn btn-lg btn-success">INICIAR PROCESO</button></center>
        </div>
        <script>
            
            $('#leer').click(function() {
                $('#importacion').hide(); 
                $('#datos').show(); 
                $("#datos").append("Iniciando carga de DATOS........ Espere <br> ");
                $.post('leer.php', function(data){
                    $("#datos").append(data);
                    $("#datos").append("Iniciando carga de datos en ARCHIVO........ Espere<br> ");
                    $.post('Importacion.php', function(data){
                        $("#datos").append(data);
                        $("#datos").append("Iniciando carga de CATALOGO........ Espere<br>");
                        $.post('archivo_leer.php', function(data){
                            $("#datos").append(data);
                            $.post('eliminar.php', function(data){
                                 $("#datos").append(data);
                            });  
                        }); 
                    });
                });
            });
        </script>
        <center>
        <br><br>
        <div class="jumbotron" id="datos"></div>
        </center>     
    </div>
</body>
</html>
