<?php


include "conexion.php";


$borrado_general = "
TRUNCATE `category`; \n
TRUNCATE `category_description`; \n 
TRUNCATE `category_path`; \n
TRUNCATE `category_to_layout`; \n
TRUNCATE `category_to_store`; \n
TRUNCATE `product`; \n
TRUNCATE `product_description`; \n
TRUNCATE `product_to_category`; \n
TRUNCATE `product_to_layout`; \n
TRUNCATE `product_to_store`; \n";
//print_r($borrado_general);

//mysql_query($borrado_general) or die('Consulta fallida: ' . mysql_error());


$sql = "";
$query = 'SELECT DISTINCT(FAM_DESCRIPCION_FAMILIA) as nombre from DATOS ORDER BY `nombre` ASC';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
   /*
    if (str_replace('0', '', $line['codigo']) == ''){
        $codigo = 1 ;
    }else{
        $codigo =  preg_replace('/^0+/', '', $line['codigo']) +1 ;
    }
    */
    
    
    $sql .=  "INSERT INTO `category`(`category_id`) VALUES ('".$codigo."'); \n";
    
    $sql .= "INSERT INTO `category_description`(`category_id`, `language_id`, `name`, `meta_title`) VALUES (".$codigo.",1,'".$line['nombre']."','".$line['nombre']."'); \n";
    
    $sql .= "INSERT INTO `category_path`(`category_id`, `path_id`, `level`) VALUES (".$codigo.",".$codigo.",0); \n";
    
    $sql .= "INSERT INTO `category_to_layout`(`category_id`, `store_id`, `layout_id`) VALUES (".$codigo.",0,0); \n";

    $sql .= "INSERT INTO `category_to_store`(`category_id`, `store_id`) VALUES (".$codigo.",0); \n";  
    
    $codigo++;
}


$query = 'SELECT DISTINCT(`DEPART`) as codigo, `DEP_NOMBREDEP` as nombre,`FAM_CODIGOFAMILIA` as familia from DATOS ORDER by DEPART';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (str_replace('0', '', $line['codigo']) == ''){
        $codigo = 100 ;
    }else{
        $codigo =  preg_replace('/^0+/', '', $line['codigo']) +100 ;
    }
    
    if (str_replace('0', '', $line['familia']) == ''){
        $familia = 1 ;
    }else{
        $familia =  preg_replace('/^0+/', '', $line['familia']) +1 ;
    }
    
    $sql .=  "INSERT INTO `category`(`category_id`,`parent_id`,`top`) VALUES ('".$codigo."','".$familia."',0); \n";
    
    $sql .=  "INSERT INTO `category_description`(`category_id`, `language_id`, `name`, `meta_title`) VALUES (".$codigo.",1,'".$line['nombre']."','".$line['nombre']."'); \n";
    
    $sql .= "INSERT INTO `category_path`(`category_id`, `path_id`, `level`) VALUES (".$codigo.",".$familia.",0); \n";
    
    $sql .= "INSERT INTO `category_path`(`category_id`, `path_id`, `level`) VALUES (".$codigo.",".$codigo.",1); \n";
    
    $sql .= "INSERT INTO `category_to_layout`(`category_id`, `store_id`, `layout_id`) VALUES (".$codigo.",0,0); \n";
    
    $sql .= "INSERT INTO `category_to_store`(`category_id`, `store_id`) VALUES (".$codigo.",0); \n"; 
    
}




$query = 'SELECT `DEPART` as codigo, `CODIGO_COM` as modelo, `NOMBRE` as nombre, `PRECIO_MAY` as precio, `CANT_ACT` as cantidad FROM DATOS ';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
$id = 0;
$order   = array("", "'","","");
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (str_replace('0', '', $line['codigo']) == ''){
        $codigo = 100 ;
    }else{
        $codigo =  preg_replace('/^0+/', '', $line['codigo']) +100 ;
    }
    $modelo = $line['modelo'];
    
    $nombre = utf8_encode(str_replace($order, " ", $line['nombre']));
    $precio = $line['precio'];
    $cantidad = $line['cantidad'];
    $id = $id + 1;
    
    $sql .= "INSERT INTO `product`( `product_id`, `model`, `quantity`, `image`, `price`) VALUES ('".$id."', '".$modelo."','".$cantidad."','catalog/productos/".$modelo.".jpg','".$precio."'); \n";
    
    $sql .= "INSERT INTO `product_description`(`product_id`, `name`, `description`, `meta_title`) VALUES ('".$id."','".$nombre."','".$nombre."','".$nombre."'); \n";
    
    $sql .= "INSERT INTO `product_to_category`(`product_id`, `category_id`) VALUES ('".$id."','".$codigo."'); \n";
    
    $sql .= "INSERT INTO `product_to_layout`(`product_id`, `store_id`, `layout_id`) VALUES ('".$id."',0,0); \n";
    
    $sql .= "INSERT INTO `product_to_store`(`product_id`, `store_id`) VALUES ('".$id."',0); \n";  
}


//mysql_query($sql) or die('Consulta fallida: ' . mysql_error());



$file = fopen("sql.sql", "w");
fwrite($file, $borrado_general.$sql.PHP_EOL);
fclose($file);


//mysql_query($borrado_general.$sql.PHP_EOL) or die('Consulta fallida: ' . mysql_error());


echo "<b>EXITO CARGA COMPLETA EN ARCHIVO!<b> <br><hr><br>";
?>