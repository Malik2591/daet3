<?php
	if(isset($_SESSION['usuario'],$_SESSION['rol'])){
		switch($_SESSION['rol']){
			case '21232f297a57a5a743894a0e4a801fc3': //admin
				break;
			case '5f82c4cc00aa13b4d16458481c75d39a': //servicios
					header("Location: ../servicios/gestion_de_alumnos.php");
				break;
			case '936400f151ba2146a86cfcc342279f57': //caja
				break;
			case 'a52f4792fa995672868b2a15e2d9ffe0': //biblio
				break;
			case 'c6865cf98b133f1f3de596a4a2894630': //alumno
					header("Location: ../alumnos/datos_personales.php");
				break;
			case '793741d54b00253006453742ad4ed534': //profesor
				break;
			default:
				break;
		}
	}
?>
