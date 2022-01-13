<?php
	session_start();
	include("conexion.php");
	$link = mysql_connect($server,$dbuser,$dbpass);
	@mysql_select_db($database) or die( "No se puede seleccionar la base de datos");
	$usuario = $_POST['usuario'];
	$password = md5(trim($_POST['password']));
	
	$query = sprintf("SELECT Usuario.id_usr, Usuario.pass_usr, Rol.hash_rol FROM Usuario INNER JOIN Rol on Usuario.Rol_id_rol=Rol.id_rol WHERE Usuario.id_usr='%s' AND Usuario.pass_usr = '%s'", mysql_real_escape_string($usuario),mysql_real_escape_string($password));
 
	$result = mysql_query($query,$link);
	$num = mysql_num_rows($result);
	
	if($num===1){
		$array = mysql_fetch_array($result);
		$_SESSION['usuario'] = $array['id_usr'];
		$_SESSION['nombre'] = '';
		$_SESSION['id_grp'] = '';
		$_SESSION['rol'] = $array['hash_rol'];
		
		switch($_SESSION['rol']){
			case '21232f297a57a5a743894a0e4a801fc3': //admin
				break;
			case '5f82c4cc00aa13b4d16458481c75d39a':{ //servicios
				header("Location: ../servicios/index.php");
				break;
			}
			case '936400f151ba2146a86cfcc342279f57': //caja
				header("Location: ../caja/index.php");
				break;
			case 'a52f4792fa995672868b2a15e2d9ffe0': //biblio
				header("Location: ../biblioteca/index.html");
				break;
			case 'c6865cf98b133f1f3de596a4a2894630':{ //alumno
					$query = sprintf("SELECT * FROM Alumno INNER JOIN Alumno_has_Grupo On Alumno_has_Grupo.Alumno_rfc_alm=Alumno.rfc_alm WHERE Alumno.rfc_alm='%s'", mysql_real_escape_string($usuario));
					$result = mysql_query($query,$link);
					$arrayNom =  mysql_fetch_array($result);
					
					$_SESSION['id_grp'] = $arrayNom['Grupo_id_grp'];
					$_SESSION['nombre'] = utf8_encode($arrayNom['nom_alm'].' '.$arrayNom['ape_alm']);
					
					header("Location: ../alumnos/index.php");
					break;
				}
			case '793741d54b00253006453742ad4ed534': //profesor
				break;
			default:
				//header("Location: index.php");
		}
		
		mysql_close($link);
	}
	else{
		mysql_close($link);
		header("Location: index.php?error=1");
		exit;
	}
?>
