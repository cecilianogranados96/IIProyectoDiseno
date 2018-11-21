<?php 
include "../config.php";




 if ($_POST['campo'] == "provincia")
    $consulta = "SELECT COUNT(*) as total, provincia.provincia as campo FROM `accidente`,provincia Where accidente.ano = ".$_POST['ano']." and provincia.id_provincia = accidente.provincia GROUP by accidente.provincia";

 if ($_POST['campo'] == "lesion")
    $consulta = "SELECT COUNT(*) as total,lesion.lesion as campo  FROM `accidente`,lesion Where accidente.ano = ".$_POST['ano']." and lesion.id_lesion = accidente.cod_lesion GROUP by accidente.cod_lesion";

if ($_POST['campo'] == "sexo")
    $consulta = "SELECT COUNT(*) as total,if(cod_sexo = 0,'Hombre','Mujer' ) as campo  FROM `accidente` Where ano = ".$_POST['ano']." GROUP by accidente.cod_sexo";


 if ($_POST['campo'] == "distrito")
    $consulta = "SELECT COUNT(*) as total, CONCAT(provincia.provincia, '->', canton.canton , '->', distrito.distrito) as campo  FROM `accidente`,distrito,canton,provincia Where accidente.ano = ".$_POST['ano']." and distrito.id_distrito = accidente.distrito  and canton.id_canton = accidente.canton and provincia.id_provincia = accidente.provincia GROUP by accidente.distrito  ORDER BY `total`  DESC LIMIT 10";


 if ($_POST['campo'] == "canton")
    $consulta = "SELECT COUNT(*) as total, CONCAT(provincia.provincia, '->', canton.canton ) as campo  FROM `accidente`,canton,provincia Where accidente.ano = ".$_POST['ano']."  and canton.id_canton = accidente.canton AND provincia.id_provincia = accidente.provincia GROUP by accidente.canton  ORDER BY `total`  DESC LIMIT 10";


 if ($_POST['campo'] == "edad")
    $consulta = 'SELECT
case  
   				  when 	edad BETWEEN 0 and 5 then "0 a 4 "
                  when 	edad BETWEEN 5 and 10 then "5 a 9 "
                  when 	edad BETWEEN 10 and 15 then "10 a 14 "
                  when 	edad BETWEEN 15 and 20 then "15 a 19 "
                  when  edad BETWEEN 20 and 25 then "20 a 24 "
                  when  edad BETWEEN 25 and 30 then "25 a 29 "
                  when  edad BETWEEN 30 and 35 then "30 a 34 "
                  when 	edad BETWEEN 35 and 40 then "35 a 39 "
                  when  edad BETWEEN 40 and 45 then "40 a 44 "
                  when  edad BETWEEN 45 and 50 then "45 a 49 "
                  when  edad BETWEEN 50 and 55 then "50 a 54 "
                  when  edad BETWEEN 55 and 60 then "55 a 59 "
                  when  edad BETWEEN 60 and 65 then "60 a 64 "
                  when  edad BETWEEN 65 and 70 then "65 a 69 "
                  when  edad BETWEEN 70 and 75 then "70 a 74 "
                  when  edad > 75 then "Mayor de 75"
                  when  edad  < 0 then "Sin reportar"
end campo,
	COUNT(*) total
    FROM accidente
    where 
    ano = '.$_POST['ano'].'
    GROUP BY campo ORDER BY `total`  DESC';

mysql_query("SET NAMES 'utf8'");
$b = array(array($_POST['campo'],"Total"));
$sth = mysqli_query($link,$consulta); 
while($r = mysqli_fetch_assoc($sth)) {
    array_push($b,array(utf8_encode($r['campo']), (int)$r['total']));               
}

echo json_encode($b);

?> 