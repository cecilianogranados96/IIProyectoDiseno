<?php
include "conexion.php";
ini_set('memory_limit', '9024M'); 

ini_set('max_execution_time', 900);


$borrado = mysql_query("TRUNCATE DATOS;") or die('Consulta fallida: ' . mysql_error());

require_once 'PHPExcel/Classes/PHPExcel.php';


$directorio = "uploads/";
$gestor_dir = opendir($directorio);

while (false !== ($nombre_fichero = readdir($gestor_dir))) {
    if ($nombre_fichero != "." and $nombre_fichero != ".." and $nombre_fichero != ".DS_Store")
    $archivo = $nombre_fichero;
}


$archivo = "uploads/".$archivo;


$eliminar = array('"', "'","-","");



$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
$SQL = "";
//$highestRow
for ($row = 2; $row <= $highestRow; $row++){ 
    $SQL = "
    
    INSERT INTO `datos`(`cod_prov`, `provincia`, `canton`, `distrito`, `dia`, `mes`, `ano`, `cod_rol`, `rol`, `cod_lesion`, `lesion`, `edad`, `cod_sexo`, `sexo`) VALUES (
    
   
    '".$sheet->getCell("B".$row)->getValue()."',
    '".$sheet->getCell("C".$row)->getValue()."',
    '".$sheet->getCell("D".$row)->getValue()."',
    '".$sheet->getCell("E".$row)->getValue()."',
    '".$sheet->getCell("F".$row)->getValue()."',
    '".$sheet->getCell("G".$row)->getValue()."',
    '".$sheet->getCell("H".$row)->getValue()."',
    '".$sheet->getCell("I".$row)->getValue()."',
    '".$sheet->getCell("J".$row)->getValue()."',
    '".$sheet->getCell("K".$row)->getValue()."',
    '".$sheet->getCell("L".$row)->getValue()."',
    '".$sheet->getCell("M".$row)->getValue()."',
    '".$sheet->getCell("O".$row)->getValue()."',
    '".$sheet->getCell("P".$row)->getValue()."'
    );";   
    mysql_query($SQL) or die('Consulta fallida: ' . mysql_error());      
    
}


echo "<b>EXITO CARGA COMPLETA EN DATOS!<b> <br><hr><br>";
?>