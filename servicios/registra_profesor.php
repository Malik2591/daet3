<?php
	
	include("conexion.php");
include("header.html");
include("control.php");
	
	
	if(isset($_POST['nombre'])){
		$usuario = '';
		$password = '';//md5(trim($_POST['password']));
		$rol = '5';
		$prefijo =utf8_decode($_POST['prefijo']);
		$nombre = utf8_decode($_POST['nombre']);
		$apellidos = utf8_encode($_POST['apellido_p'].' '.$_POST['apellido_m']);
		$casa=$_POST['casa'];
		$movil1=$_POST['movil1'];
		$movil2=$_POST['movil2'];
		$oficina=$_POST['oficina'];
		$mail=$_POST['mail'];
		$cargo=utf8_decode($_POST['cargo']);
		
		$usuario = utf8_decode(substr($nombre,0,2).'_'.$_POST['apellido_p'].'01');
		$tmpPass = substr($nombre,0,1).'_'.$_POST['apellido_p'].'_'.rand(1000,9999);
		$password = md5($tmpPass);		
		
		//inserta informacion en Usuario
		$query = "INSERT INTO `univesn6_sgat`.`Usuario` (`id_usr` ,`pass_usr` ,`Rol_id_rol` ,`fecha` ,`nacionalidad` ,`movil` ,`casa` ,`email_usr` ,`Direccion_id_dir_usr`) VALUES ('$usuario', '$password', '$rol', NULL , NULL , NULL , NULL , NULL , NULL)";
		mysql_query($query,$link);
		//$resultado1 = mysql_query($query,$link);
		
		//Inserta información en Profesor
		$query = "INSERT INTO Profesor (rfc_pro,pre_pro,nom_pro,ape_pro,cargo,numero_cel,numero_cel2,numero_casa,numero_oficina,numero_email) VALUES ('$usuario', '$prefijo' ,'$nombre', '$apellidos','$cargo','$movil1','movil2','$casa','$oficina','$mail')";
		mysql_query($query,$link);
		//$resultado2 = mysql_query($query,$link);
		
		echo mysql_error().'<br />';
		
		/*	$fp = fopen('usuarios_profesor.txt','a');
			fwrite($fp, "$prefijo $nombre $apellidos \t | $usuario \t | $tmpPass" . PHP_EOL);
			fclose($fp);
		echo "Nombre: $prefijo $nombre $apellidos<br />Usuario: $usuario<br />Password: $tmpPass<br /><br />Nueva alta:<br />";
	*/

?>
<div class="panel-body">
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Felicidades!!</h4>
</div>
<div class="modal-body"> El Profesor <?PHP echo  $nombre." ".$apellidos; ?> a sido registrado con exito </div>
<div class="modal-footer"> <a href="profesor.php" class="btn btn-info" data-dismiss="modal">Regresar a registro.</a> </div>


<?PHP	}
	else{
		header('Location: profesor.php');
		}
		include("footer.html");
?>