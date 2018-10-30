<?php 

$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'diseno';

$link = mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('No se pudo conectar: ' . mysql_error());
mysql_select_db($mysql_database) or die('No se pudo seleccionar la base de datos');


?>