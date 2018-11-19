<?php 
include "../config.php";
$b = array(array("City","Accidentes"));
$group_by = "";
$campos = "";

$where = explode(",", $_POST['where']);
$where = array_unique($where);
sort($where);

//print_r($where);
//echo "\n\n";

$consulta = "";
$anterior = "";

$group = array();


foreach ($where as $clave => $valor){
    if ($valor != ""){
        $anterior = explode(" ", $where[$clave-1]);
        $actual = explode(" ", $valor);        
        if ($actual[0] == $anterior[0] ){
            $consulta .= " OR ".$valor;
        }else{
            $consulta .= " AND ".$valor;
        }
        array_push($group,$actual[0]);   
    }
}


$group = implode(",", $group); 
if (strpos($_POST['where'], "accidente.provincia")){
    $group_by = "GROUP BY provincia";
    $campos = "COUNT(*) as total,provincia as id";
}
if (strpos($_POST['where'], "canton")){
    if (substr_count($_POST['where'], 'canton') != 1 ){
        $group_by = "group by canton";
        $campos = "COUNT(*) as total,canton as id";
    }else{
        $group_by = "";
        $campos = "COUNT(*) as total,canton as id";
    }
}

if (strpos($_POST['where'], "distrito")){
    $campos = "COUNT(*) as total,distrito as id";
    if (substr_count($_POST['where'], 'canton') != 1 ){
        $group_by = "group by distrito";
    }else{
        $group_by = "";
    }
}else{
    $group_by = "GROUP BY provincia";
    $campos = "COUNT(*) as total,provincia as id";
}



$consulta = "SELECT $campos FROM accidente WHERE ".substr($consulta,4)." GROUP BY $group";
$sth = mysqli_query($link,$consulta); 
while($r = mysqli_fetch_assoc($sth)) {
    if ($r['total'] != 0){
        if (strpos($_POST['where'], "accidente.provincia")){
            $provincia = mysqli_query($link,"SELECT * FROM provincia where id_provincia = ".$r['id'].""); 
            $provincia = mysqli_fetch_assoc($provincia);
            $city = $provincia['provincia'];
        }
        if (strpos($_POST['where'], "canton")){
            $canton = mysqli_query($link,"SELECT * FROM canton where id_canton = ".$r['id'].""); 
            $canton = mysqli_fetch_assoc($canton);
            $city = $canton['canton'];
        }

        if (strpos($_POST['where'], "distrito")){

            $distrito = mysqli_query($link,"SELECT * FROM distrito where id_distrito = ".$r['id'].""); 
            $distrito = mysqli_fetch_assoc($distrito);
            $city = $distrito['distrito'];
        }else{
            $provincia = mysqli_query($link,"SELECT * FROM provincia where id_provincia = ".$r['id'].""); 
            $provincia = mysqli_fetch_assoc($provincia);
            $city = $provincia['provincia'];
        }

        array_push($b,array(utf8_encode($city), (int)$r['total']));   
    }
}

echo json_encode($b);

?> 