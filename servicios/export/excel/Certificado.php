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

			$nom_alm=utf8_encode($arrayAlm['nom_alm']." ".$arrayAlm['ape_alm']);

			$query = "SELECT * FROM Grupo INNER JOIN Carrera ON Carrera.id_carrera=Grupo.Carrera_id_carrera WHERE id_grp=$idGrupo";
			$resultado = mysql_query($query,$link);
			$arrayGrp = mysql_fetch_assoc($resultado);

			$desCarrera = $arrayGrp['nom_carrera'];
			$idCarrera = $arrayGrp['id_carrera'];
			$perGrp = $arrayGrp['per_grp'];
			$acuerdo = $arrayGrp['rvoe_carrera'];
			$fecha = utf8_decode($arrayGrp['fecha_acuerdo']);

			$query = "SELECT * FROM Historial INNER JOIN Historial_has_Modulo ON Historial_has_Modulo.Historial_id_hist=Historial.id_hist INNER JOIN Modulo ON Modulo.id_mod=Historial_has_Modulo.Modulo_id_mod WHERE Historial.Alumno_rfc_alm='$boleta' AND Modulo.per_mod<='$perGrp'";
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

			$cal1=0;
			$cal2=0;
			$cal3=0;
			$cal4=0;
			$cal5=0;
			$cal6=0;
			$cal7=0;
			$cal8=0;
			$cal_sem=0;
			$num_mat1=1;
			$num_mat2=1;
			$num_mat3=1;
			$num_mat4=1;
			$num_mat5=1;
			$num_mat6=1;
			$num_mat7=1;
			$num_mat8=1;
			$num_mat_sem=1;

			$arrcal=array(
			'6' => 'SEIS',
			'7' => 'SIETE',
			'8' => 'OCHO',
			'9' => 'NUEVE',
			'10' => 'DIEZ');

			if($idCarrera==1){

				$objPHPExcel = $objReader->load("Plantilla_Certificado_Licenciatura.xls");
		
				$objPHPExcel->setActiveSheetIndex(0);
		
				$objPHPExcel->getActiveSheet()->setCellValue('C4',$nom_alm);
				
				while($fila = mysql_fetch_assoc($resultado)){
					$calificacion = $fila['calificacion'];

					$asignatura = utf8_encode($fila['nom_mod']);
					$clave = utf8_encode($fila['clave_sep']);
					$seriacion =utf8_encode($fila['seriacion']);
					$sem = $fila['per_mod'];
					if($sem==1){

						$i0 = 9;

						$ia = $i0+$i1;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal1=$cal1+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal1=$cal1+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat1=$num_mat1+1;
						$num_mat_sem=$num_mat_sem+1;
						$i1=$i1+1;

					}elseif($sem==2){

						$i0 = 17;

						$ia = $i0+$i2;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal2=$cal2+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal2=$cal2+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat2=$num_mat2+1;
						$num_mat_sem=$num_mat_sem+1;
						$i2=$i2+1;

					}elseif($sem==3){

						$i0 = 25;

						$ia = $i0+$i3;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal3=$cal3+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal3=$cal3+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat3=$num_mat3+1;
						$num_mat_sem=$num_mat_sem+1;
						$i3=$i3+1;

					}elseif($sem==4){

						$i0 = 33;

						$ia = $i0+$i4;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal4=$cal4+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal4=$cal4+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat4=$num_mat4+1;
						$num_mat_sem=$num_mat_sem+1;
						$i4=$i4+1;

					}elseif($sem==5){

						$i0 = 41;

						$ia = $i0+$i5;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal5=$cal5+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal5=$cal5+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat5=$num_mat5+1;
						$num_mat_sem=$num_mat_sem+1;
						$i5=$i5+1;

					}elseif($sem==6){

						$i0 = 49;

						$ia = $i0+$i6;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal6=$cal6+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal6=$cal6+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat6=$num_mat6+1;
						$num_mat_sem=$num_mat_sem+1;
						$i6=$i6+1;

					}elseif($sem==7){

						$i0 = 57;

						$ia = $i0+$i7;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal7=$cal7+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal7=$cal7+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat7=$num_mat7+1;
						$num_mat_sem=$num_mat_sem+1;
						$i7=$i7+1;

					}elseif($sem==8){

						$i0 = 65;

						$ia = $i0+$i8;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal8=$cal8+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal8=$cal8+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat8=$num_mat8+1;
						$num_mat_sem=$num_mat_sem+1;
						$i8=$i8+1;

					}

					
				}

				$num_mat1=$num_mat1-1;
				$calaux=$cal1/$num_mat1;
				$objPHPExcel->getActiveSheet()->setCellValue('G16', $calaux);

				$num_mat2=$num_mat2-1;
				$calaux=$cal2/$num_mat2;
				$objPHPExcel->getActiveSheet()->setCellValue('G24', $calaux);

				$num_mat3=$num_mat3-1;
				$calaux=$cal3/$num_mat3;
				$objPHPExcel->getActiveSheet()->setCellValue('G32', $calaux);

				$num_mat4=$num_mat4-1;
				$calaux=$cal4/$num_mat4;
				$objPHPExcel->getActiveSheet()->setCellValue('G40', $calaux);

				$num_mat5=$num_mat5-1;
				$calaux=$cal5/$num_mat5;
				$objPHPExcel->getActiveSheet()->setCellValue('G48', $calaux);

				$num_mat6=$num_mat6-1;
				$calaux=$cal6/$num_mat6;
				$objPHPExcel->getActiveSheet()->setCellValue('G56', $calaux);

				$num_mat7=$num_mat7-1;
				$calaux=$cal7/$num_mat7;
				$objPHPExcel->getActiveSheet()->setCellValue('G64', $calaux);

				$num_mat8=$num_mat8-1;
				$calaux=$cal8/$num_mat8;
				$objPHPExcel->getActiveSheet()->setCellValue('G72', $calaux);

				$num_mat_sem=$num_mat_sem-1;
				$cal_sem=$cal_sem/$num_mat_sem;

				$objPHPExcel->getActiveSheet()->setCellValue('C75', $cal_sem);

			}else{

				$objPHPExcel = $objReader->load("Plantilla_Certificado.xls");
		
				$objPHPExcel->setActiveSheetIndex(0);
		

				//$objPHPExcel->getActiveSheet()->setCellValue('E10',$perGrp.'° Semestre');
				$objPHPExcel->getActiveSheet()->setCellValue('B1',$desCarrera);
				$objPHPExcel->getActiveSheet()->setCellValue('C3',$nom_alm);
				$objPHPExcel->getActiveSheet()->setCellValue('E1',$acuerdo);

				
				while($fila = mysql_fetch_assoc($resultado)){
					$calificacion = $fila['calificacion'];

					$asignatura = utf8_encode($fila['nom_mod']);
					$clave = utf8_encode($fila['clave_sep']);
					$seriacion =utf8_encode($fila['seriacion']);
					$sem = $fila['per_mod'];
					if($sem==1){

						$i0 = 8;

						$ia = $i0+$i1;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal1=$cal1+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal1=$cal1+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat1=$num_mat1+1;
						$num_mat_sem=$num_mat_sem+1;
						$i1=$i1+1;

					}elseif($sem==2){

						$i0 = 15;

						$ia = $i0+$i2;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal2=$cal2+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal2=$cal2+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat2=$num_mat2+1;
						$num_mat_sem=$num_mat_sem+1;
						$i2=$i2+1;

					}elseif($sem==3){

						$i0 = 22;

						$ia = $i0+$i3;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal3=$cal3+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal3=$cal3+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat3=$num_mat3+1;
						$num_mat_sem=$num_mat_sem+1;
						$i3=$i3+1;

					}elseif($sem==4){

						$i0 = 29;

						$ia = $i0+$i4;

						$objPHPExcel->getActiveSheet()->setCellValue('B'.$ia, $asignatura);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ia, $clave);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$ia, $seriacion);

						if($calificacion===null){

							$calificacion='NP';
				
							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, 'No Presento');

							$cal4=$cal4+0;
							$cal_sem=$cal_sem+0;

						}else{

							$objPHPExcel->getActiveSheet()->setCellValue('E'.$ia, $calificacion);
							$objPHPExcel->getActiveSheet()->setCellValue('F'.$ia, $arrcal[utf8_encode($calificacion)]);

							$cal4=$cal4+$calificacion;
							$cal_sem=$cal_sem+$calificacion;
				
						}

						$num_mat4=$num_mat4+1;
						$num_mat_sem=$num_mat_sem+1;
						$i4=$i4+1;

					}

					
				}


				$num_mat1=$num_mat1-1;
				$calaux=$cal1/$num_mat1;
				$objPHPExcel->getActiveSheet()->setCellValue('G14', $calaux);

				$num_mat2=$num_mat2-1;
				$calaux=$cal2/$num_mat2;
				$objPHPExcel->getActiveSheet()->setCellValue('G21', $calaux);

				$num_mat3=$num_mat3-1;
				$calaux=$cal3/$num_mat3;
				$objPHPExcel->getActiveSheet()->setCellValue('G27', $calaux);

				$num_mat4=$num_mat4-1;
				$calaux=$cal4/$num_mat4;
				$objPHPExcel->getActiveSheet()->setCellValue('G35', $calaux);

				$num_mat_sem=$num_mat_sem-1;
				$cal_sem=$cal_sem/$num_mat_sem;

				$objPHPExcel->getActiveSheet()->setCellValue('C38', $cal_sem);

			}

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);


			// Redirect output to a client’s web browser (Excel2007)
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header("Content-Disposition: attachment;filename=Certificado_$boleta.xls");
			header("Cache-Control: max-age=0");

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			$objWriter->save('php://output');
		}
	}
	exit;
?>