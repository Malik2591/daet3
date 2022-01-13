<?php
	$server = 'localhost';
	$database = 'univesn6_sgat';
	$dbuser = 'univesn6_sgat';
	$dbpass = 'Tepantlato*';
		$link = mysql_connect($server,$dbuser,$dbpass);
	@mysql_select_db($database) or die( "No se puede seleccionar la base de datos");
?>