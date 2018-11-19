<?php 
include "../config.php";
$b = array(array("City","Accidentes"));
$consulta = "SELECT COUNT(accidente.provincia) as total,provincia FROM accidente ".$_POST['where']." GROUP BY provincia";
$sth = mysqli_query($link,$consulta); 
while($r = mysqli_fetch_assoc($sth)) {
    $provincia = mysqli_query($link,"SELECT * FROM provincia where id_provincia = ".$r['provincia'].""); 
    $provincia = mysqli_fetch_assoc($provincia);    
    array_push($b,array(utf8_encode($provincia['provincia']), (int)$r['total']));               
}

echo json_encode($b);

?> 