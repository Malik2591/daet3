<?php
	session_start();
	include("conexion.php");
	include("control.php");
	
	/** Error reporting */
	error_reporting(E_ALL);
	
	if(isset($_GET['boleta'])){
		if(isset($_GET['idGrupo'])){

		date_default_timezone_set('Europe/London');

		/** PHPExcel */
		require_once 'PHPExcel.php';


		$boleta=$_GET['boleta'];
		$idGrupo=$_GET['idGrupo'];
		$query = "SELECT * FROM Alumno WHERE rfc_alm='$boleta'";
		$resultado = mysql_query($query,$link);
		$arrayAlm = mysql_fetch_assoc($resultado);

		$nom_alm=utf8_encode($arrayAlm['ape_alm']." ".$arrayAlm['nom_alm']);

		$query = "SELECT * FROM Grupo INNER JOIN Carrera ON Carrera.id_carrera=Grupo.Carrera_id_carrera WHERE id_grp=$idGrupo";
		$resultado = mysql_query($query,$link);
		$arrayGrp = mysql_fetch_assoc($resultado);

		$desCarrera = $arrayGrp['nom_carrera'];
		$acuerdo = $arrayGrp['rvoe_carrera'];
		$perGrp = $arrayGrp['per_grp'];
		$fecha = utf8_decode($arrayGrp['fecha_acuerdo']);


		$query = "SELECT * FROM Historial INNER JOIN Historial_has_Modulo ON Historial_has_Modulo.Historial_id_hist=Historial.id_hist INNER JOIN Modulo ON Modulo.id_mod=Historial_has_Modulo.Modulo_id_mod WHERE Alumno_rfc_alm='$boleta' AND Modulo.per_mod='$perGrp'";
		$resultado = mysql_query($query,$link);


		$i1 = 14;
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load("Plantilla_Boleta.xls");
		
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A6',$desCarrera);
		$objPHPExcel->getActiveSheet()->setCellValue('E10',$perGrp.'° Semestre');
		$objPHPExcel->getActiveSheet()->setCellValue('A7','ACUERDO No. '.$acuerdo.'/'.$fecha);
		$objPHPExcel->getActiveSheet()->setCellValue('A10',$nom_alm);
		$objPHPExcel->getActiveSheet()->setCellValue('C10',$boleta);
		
		$cal=0;
		$num_mat=1;

		$arrcal=array(
		'6' => 'SEIS',
		'7' => 'SIETE',
		'8' => 'OCHO',
		'9' => 'NUEVE',
		'10' => 'DIEZ');

		while($fila = mysql_fetch_assoc($resultado)){
			$calificacion = $fila['calificacion'];

			$asignatura = utf8_encode($fila['nom_mod']);
			$idmod = $fila['Modulo_id_mod'];

			$query1 = "SELECT * FROM Modulo WHERE id_mod='".$idmod."'";
			$resultado1 = mysql_query($query1,$link);

			$arrmod = mysql_fetch_assoc($resultado1);

			$idmod = $arrmod['id_mod'];
			$clave = utf8_encode($arrmod['clave_sep']);
			$seriacion = utf8_encode($arrmod['seriacion']);

			$objPHPExcel->getActiveSheet()->setCellValue('B'.$i1, $asignatura);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$i1, $clave);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$i1, $seriacion);
			//$objPHPExcel->getActiveSheet()->setCellValue('C'.$i1, $idmod);

			if($calificacion===null){

				$calificacion='NP';
				
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i1, $calificacion);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i1, 'No Presento');

				$cal=$cal+0;

			}else{

				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i1, $calificacion);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i1, $arrcal[utf8_encode($calificacion)]);

				$cal=$cal+$calificacion;
				
			}

			$num_mat=$num_mat+1;
			$i1=$i1+1;

		}

		$num_mat=$num_mat-1;
		$cal=$cal/$num_mat;
		$objPHPExcel->getActiveSheet()->setCellValue('F22', $cal);
		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle($boleta);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		
		/*$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);*/

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename=Boleta_$boleta.xls");
		header("Cache-Control: max-age=0");

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
	}
	}
	exit;
?>