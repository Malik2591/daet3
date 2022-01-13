<?php
include("header.html");
include("conexion.php");
		$cuenta=utf8_decode($_POST["cuenta"]);
    	$boleta = $cuenta;
		$nombre = $cuenta;		
		$query = "SELECT * FROM Alumno INNER JOIN Grupo ON Grupo.id_grp=Alumno.Grupo_actual WHERE Alumno.rfc_alm='$boleta' OR Alumno.nom_alm LIKE '$nombre' OR Alumno.ape_alm LIKE '$nombre'";
		$resultado = mysql_query($query,$link);
		$num = mysql_num_rows($resultado);
		echo $num;
		

?>
 <?php
include("footer.html");
?>