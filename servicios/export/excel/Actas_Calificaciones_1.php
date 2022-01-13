<?php
	session_start();
	include("conexion.php");
	include("control.php");
	
	/** Error reporting */
	error_reporting(E_ALL);
	
	if(isset($_GET['id_grp'])){
		date_default_timezone_set('Europe/London');

		/** PHPExcel */
		require_once 'PHPExcel.php';

		$idGrupo = $_GET['id_grp'];
		$materia = '';
		$profesor = '';
		if(isset($_GET['materia'])){
			utf8_decode($materia = $_GET['materia']);
		}
		if(isset($_GET['profesor'])){
			utf8_decode($profesor = $_GET['profesor']);
		}
			
		$query = "SELECT * FROM Grupo INNER JOIN Carrera ON Carrera.id_carrera=Grupo.Carrera_id_carrera WHERE id_grp=$idGrupo";
		$resultado = mysql_query($query,$link);
		$arrayGrp = mysql_fetch_assoc($resultado);
		$claveGrp = $arrayGrp['clave_grp'];
		$desGrp = $arrayGrp['des_grp'];
		$perGrp = $arrayGrp['per_grp'];
		$turnoGrp = $arrayGrp['turno_grp'];
		$desCarrera = $arrayGrp['nom_carrera'];
		$acuerdo = $arrayGrp['rvoe_carrera'];
		$fecha = utf8_decode($arrayGrp['fecha_acuerdo']);
		
		$query = "SELECT * FROM Alumno INNER JOIN Alumno_has_Grupo ON Alumno_has_Grupo.Alumno_rfc_alm=Alumno.rfc_alm WHERE Alumno_has_Grupo.Grupo_id_grp=$idGrupo";
		$resultado = mysql_query($query,$link);
		$i1 = 19;
		$i2 = 1;
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load("Plantilla_Actas_Calificaciones1.xls");
		
		// Set properties
		/*$objPHPExcel->getProperties()->setCreator("SGAT")
									 ->setLastModifiedBy("SGAT")
									 ->setTitle("Lista de asistencias $claveGrupo")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Lista de asistencias generada con SGAT")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Asistencias");
		*/
		
		$objPHPExcel->setActiveSheetIndex(0);
		$matricula = '';
		$nombre = '';
		
		$objPHPExcel->getActiveSheet()->setCellValue('B6',$desCarrera);
		$objPHPExcel->getActiveSheet()->setCellValue('F14','PERIODO: '.$perGrp.'° Semestre');
		$objPHPExcel->getActiveSheet()->setCellValue('A12','MATERIA: '.$materia);
		$objPHPExcel->getActiveSheet()->setCellValue('A14','PROFESOR: '.$profesor);
		$objPHPExcel->getActiveSheet()->setCellValue('B7','ACUERDO S.E.P. No. '.$acuerdo);
		$objPHPExcel->getActiveSheet()->setCellValue('B8',$fecha);
		
		while($alumno = mysql_fetch_assoc($resultado)){
			$nombre = utf8_encode($alumno['ape_alm'].' '.$alumno['nom_alm']);
			$matricula = $alumno['rfc_alm'];
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$i1, $matricula);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i1, $nombre);;
			
			/*
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i1, $i2)
						->setCellValue('A'.$i1, $matricula)
						->setCellValue('B'.$i1, $nombre);
			*/
			$i1=$i1+1;
			//$i2=$i2+1;
		}
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($claveGrp);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		
		/*$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);*/

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename=Acta_Calificaciones_grupo_$claveGrp.xls");
		header("Cache-Control: max-age=0");

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
	}
	exit;
?>