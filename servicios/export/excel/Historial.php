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
			$idCarrera = $arrayGrp['id_carrera'];
			$perGrp = $arrayGrp['per_grp'];
			$acuerdo = $arrayGrp['rvoe_carrera'];
			$fecha = utf8_decode($arrayGrp['fecha_acuerdo']);

			$query = "SELECT * FROM Historial INNER JOIN Historial_has_Modulo ON Historial_has_Modulo.Historial_id_hist=Historial.id_hist INNER JOIN Modulo ON Modulo.id_mod=Historial_has_Modulo.Modulo_id_mod WHERE Historial.Alumno_rfc_alm='$boleta' AND Modulo.per_mod<='$perGrp' ORDER BY Modulo.clave_sep ASC";
			$resultado = mysql_query($query,$link);


			$objPHPExcel = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader('Excel5');

			$ia = 0;
			$i0 = 0;
			$i1 = 0;
			$i2 = 0;
			$i3 = 0;
			$i4 = 0;
			$i5 = 0;
			$i6 = 0;
			$i7 = 0;
			$i8 = 0;

			if($idCarrera==1){

				$objPHPExcel = $objReader->load("Plantilla_Historial_Licenciatura.xls");
		
				$objPHPExcel->setActiveSheetIndex(0);
		
				//$objPHPExcel->getActiveSheet()->setCellValue('A6',$desCarrera);
				//$objPHPExcel->getActiveSheet()->setCellValue('E10',$perGrp.'° Semestre');
				$objPHPExcel->getActiveSheet()->setCellValue('C2',$nom_alm);
				$objPHPExcel->getActiveSheet()->setCellValue('F4',$boleta);
				
				while($fila = mysql_fetch_assoc($resultado)){
					$calificacion = $fila['calificacion'];
					 if ($calificacion === null) {
                    $calificacion = '-';
					
                }else{
					if ($calificacion<8){
						$calificacion = 'NA';
					} 
					}

					$asignatura = utf8_encode($fila['nom_mod']);
					$clave = utf8_encode($fila['clave_sep']);
					//$seriacion =utf8_encode($fila['seriacion']);
					$sem = $fila['per_mod'];
					if($sem==1){

						$i0 = 11;

						$ia = $i0+$i1;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i1=$i1+1;

					}elseif($sem==2){

						$i0 = 19;

						$ia = $i0+$i2;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i2=$i2+1;

					}elseif($sem==3){

						$i0 = 27;

						$ia = $i0+$i3;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i3=$i3+1;

					}elseif($sem==4){

						$i0 = 35;

						$ia = $i0+$i4;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i4=$i4+1;

					}elseif($sem==5){

						$i0 = 43;

						$ia = $i0+$i5;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i5=$i5+1;

					}elseif($sem==6){

						$i0 = 51;

						$ia = $i0+$i6;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i6=$i6+1;

					}elseif($sem==7){

						$i0 = 59;

						$ia = $i0+$i7;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i7=$i7+1;

					}elseif($sem==8){

						$i0 = 67;

						$ia = $i0+$i8;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i8=$i8+1;

					}
				}
			}
			else{
				if($idCarrera==12){
					
				$objPHPExcel = $objReader->load("Plantilla_Historial_Licenciatura_2011.xls");
		
				$objPHPExcel->setActiveSheetIndex(0);
		
				//$objPHPExcel->getActiveSheet()->setCellValue('A6',$desCarrera);
				//$objPHPExcel->getActiveSheet()->setCellValue('E10',$perGrp.'° Semestre');
				$objPHPExcel->getActiveSheet()->setCellValue('C2',$nom_alm);
				$objPHPExcel->getActiveSheet()->setCellValue('F4',$boleta);
				
				while($fila = mysql_fetch_assoc($resultado)){
					$calificacion = $fila['calificacion'];
					 if ($calificacion === null) {
                    $calificacion = '-';
					
                }else{
					if ($calificacion<8){
						$calificacion = 'NA';
					} 
					}

					$asignatura = utf8_encode($fila['nom_mod']);
					$clave = utf8_encode($fila['clave_sep']);
					//$seriacion =utf8_encode($fila['seriacion']);
					$sem = $fila['per_mod'];
					if($sem==1){

						$i0 = 11;

						$ia = $i0+$i1;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i1=$i1+1;

					}elseif($sem==2){

						$i0 = 18;

						$ia = $i0+$i2;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i2=$i2+1;

					}elseif($sem==3){

						$i0 = 25;

						$ia = $i0+$i3;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i3=$i3+1;

					}elseif($sem==4){

						$i0 = 32;

						$ia = $i0+$i4;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i4=$i4+1;

					}elseif($sem==5){

						$i0 = 39;

						$ia = $i0+$i5;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i5=$i5+1;

					}elseif($sem==6){

						$i0 = 46;

						$ia = $i0+$i6;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i6=$i6+1;

					}elseif($sem==7){

						$i0 = 53;

						$ia = $i0+$i7;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i7=$i7+1;

					}elseif($sem==8){

						$i0 = 60;

						$ia = $i0+$i8;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i8=$i8+1;

					}elseif($sem==9){

						$i0 = 67;

						$ia = $i0+$i8;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i8=$i8+1;

					}
					elseif($sem==10){

						$i0 = 75;

						$ia = $i0+$i8;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i8=$i8+1;

					}
				}
					}else{

				$objPHPExcel = $objReader->load("Plantilla_Historial.xls");
		
				$objPHPExcel->setActiveSheetIndex(0);
		

				//$objPHPExcel->getActiveSheet()->setCellValue('E10',$perGrp.'° Semestre');
				$objPHPExcel->getActiveSheet()->setCellValue('B6',$desCarrera);
				$objPHPExcel->getActiveSheet()->setCellValue('C4',$nom_alm);
				$objPHPExcel->getActiveSheet()->setCellValue('F6',$boleta);
				$objPHPExcel->getActiveSheet()->setCellValue('A8','CON RVO DE LA SEP ACUERDO Nº'.$acuerdo.','.$fecha.', CLAVE DE REGISTRO DEL PLAN DE ESTUDIOS. D.G.E.S. 2005');
				
				while($fila = mysql_fetch_assoc($resultado)){
					$calificacion = $fila['calificacion'];
					 if ($calificacion === null) {
                    $calificacion = '-';
					
                }else{
					if ($calificacion<8){
						$calificacion = 'NA';
					} 
					}

					$asignatura = utf8_encode($fila['nom_mod']);
					$clave = utf8_encode($fila['clave_sep']);
					//$seriacion =utf8_encode($fila['seriacion']);
					$sem = $fila['per_mod'];
					if($sem==1){

						$i0 = 13;

						$ia = $i0+$i1;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i1=$i1+1;
						
					}elseif($sem==2){

						$i0 = 19;

						$ia = $i0+$i2;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i2=$i2+1;

					}elseif($sem==3){

						$i0 = 25;

						$ia = $i0+$i3;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i3=$i3+1;

					}elseif($sem==4){

						$i0 = 31;

						$ia = $i0+$i4;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$ia, $clave);
						//$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);

						$i4=$i4+1;

					}
				}

			}
			}
			// Create new PHPExcel object





			
			// Rename sheet
			//$objPHPExcel->getActiveSheet()->setTitle($boleta);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		
			/*$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);*/

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			//$objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel2007)
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header("Content-Disposition: attachment;filename=Historial_$boleta.xls");
			header("Cache-Control: max-age=0");

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			$objWriter->save('php://output');
		}
	}
	exit;
?>