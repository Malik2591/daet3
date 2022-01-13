<?php 
$server="localhost"; 
$username="univesn6_sgat"; 
$password="Tepantlato*"; 
$dataBase="univesn6_contador";

$link=mysql_connect($server, $username, $password) 
      or die("Problemas en la conexión: ".mysql_error());

$db=mysql_select_db($dataBase, $link) 
        or die("Problemas al seleccionar la base de datos: ".mysql_error()); 
?>