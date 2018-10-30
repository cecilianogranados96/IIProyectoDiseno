<?php



include "conexion.php";





$filename = 'sql.sql';

// Connect to MySQL server


$connection = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);


$templine = '';
$fp = fopen($filename, 'r');
while (($line = fgets($fp)) !== false) {
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;
	$templine .= $line;
	if (substr(trim($line), -1, 1) == ';') {
		if(!mysqli_query($connection, $templine)){
			print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($connection) . '<br /><br />');
		}
		$templine = '';
	}
}
mysqli_close($connection);
fclose($fp);


echo "<b>EXITO CARGA COMPLETA EN CATALOGO!<b> <br><hr><br>";
