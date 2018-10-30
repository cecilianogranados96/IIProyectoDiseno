<?php 


$directorio = "uploads/";
$gestor_dir = opendir($directorio);

while (false !== ($nombre_fichero = readdir($gestor_dir))) {
    if ($nombre_fichero != "." and $nombre_fichero != ".." and $nombre_fichero != ".DS_Store")
    $archivo = $nombre_fichero;
}


$archivo = "uploads/".$archivo;


unlink($archivo);
unlink("sql.sql");


echo "<b>PROCESO FINALIZADO CON EXITO!<b> <br><hr><br> 
<center><a href='index.php' class='btn btn-lg btn-warning'>REINICIAR PROCESO</a></center>
";
?>