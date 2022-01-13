<?php
include("conexion.php");
include("header.html");
include("control.php");

		$cuenta=$_POST["cuenta"];
    	$boleta = $cuenta;
		$nombre = $cuenta;		
		$query = "SELECT * FROM Alumno INNER JOIN Grupo ON Grupo.id_grp=Alumno.Grupo_actual WHERE Alumno.rfc_alm='$boleta' OR Alumno.nom_alm LIKE '%$nombre%' OR Alumno.ape_alm LIKE '%$nombre%'";
		$resultado = mysql_query($query,$link);
		$num = mysql_num_rows($resultado);
			$array =  mysql_fetch_array($resultado);
			$boleta = $array['rfc_alm'];
			$idGrp = $array['id_grp'];
			$desGrp = utf8_encode($array['clave_grp']);
			$periodoGrp = utf8_encode($array['per_grp']);
			$nombre = utf8_encode($array['nom_alm']);
			$apellidos = utf8_encode($array['ape_alm']);
			$motivos = utf8_encode($array['motivos']);
		
			        
    
		  $query = "SELECT * FROM Grupo INNER JOIN Carrera ON Grupo.Carrera_id_carrera=Carrera.id_carrera WHERE Grupo.id_grp='$idGrp' ORDER BY Carrera.id_carrera, Grupo.turno_grp,Grupo.per_grp";
		
		$resultado = mysql_query($query,$link);
		$arrayGrp = mysql_fetch_assoc($resultado);
		$claveGrp = utf8_encode($arrayGrp['clave_grp']);
		$desGrp = utf8_encode($arrayGrp['des_grp']);
		$perGrp = utf8_encode($arrayGrp['per_grp']);
		$turnoGrp = utf8_encode($arrayGrp['turno_grp']);
		$carreraGrp = utf8_encode($arrayGrp['nom_carrera']);
		
		$query = "SELECT * FROM Horario INNER JOIN Hora_Inicio ON Hora_Inicio.id_hora_inicio=Horario.Hora_Inicio_id_hora_inicio INNER JOIN Hora_Fin ON Hora_Fin.id_hora_fin=Horario.Hora_Fin_id_hora_fin INNER JOIN Profesor ON Profesor.rfc_pro=Horario.Profesor_rfc_pro INNER JOIN Modulo ON Modulo.id_mod=Horario.Modulo_id_mod WHERE Horario.Grupo_id_grp='$idGrp' ORDER BY id_mod";
		$resultado = mysql_query($query,$link);
		
	$query="SELECT * FROM Grupo INNER JOIN Carrera ON Grupo.Carrera_id_carrera=Carrera.id_carrera INNER JOIN Carrera_has_Modulo ON Carrera.id_carrera=Carrera_has_Modulo.Carrera_id_carrera INNER JOIN Modulo ON Modulo.id_mod=Carrera_has_Modulo.Modulo_id_mod WHERE Grupo.id_grp='$idGrp' AND Modulo.per_mod='$periodoGrp;'";
	$materiasLista = mysql_query($query,$link);

	echo mysql_error();
	
	while($materiaL = mysql_fetch_assoc($materiasLista)){

		$cH = array();
		$cH['lunes'] = '';
		$cH['martes'] = '';
		$cH['miercoles'] = '';
		$cH['jueves'] = '';
		$cH['viernes'] = '';
		$cH['sabado'] = '';
		
		while($materia = mysql_fetch_assoc($resultado)){
			echo utf8_encode("<tr><td> <small><small>".$materia['nom_mod']."</small></small></td>");
			echo utf8_encode("<td><small><small>".$materia['nom_pro']." ".$materia['ape_pro']."</small></small></td>");
			
			//$lunes_i = substr($materia['lunes-i'], 0, -3);
			
			if($materia['lunes-i']!='00:00:00'){
				$cH['lunes'] = substr($materia['lunes-i'], 0, -3).' a '.substr($materia['lunes-f'], 0, -3);
			}
			else{
				$cH['lunes'] = '';
			}
			
			if($materia['martes-i']!='00:00:00'){
				$cH['martes'] = substr($materia['martes-i'], 0, -3).' a '.substr($materia['martes-f'], 0, -3);
			}
			else{
				$cH['martes'] = '';
			}
			
			if($materia['miercoles-i']!='00:00:00'){
				$cH['miercoles'] = substr($materia['miercoles-i'], 0, -3).' a '.substr($materia['miercoles-f'], 0, -3);
			}
			else{
				$cH['miercoles'] = '';
			}
			
			if($materia['jueves-i']!='00:00:00'){
				$cH['jueves'] = substr($materia['jueves-i'], 0, -3).' a '.substr($materia['jueves-f'], 0, -3);
			}
			else{
				$cH['jueves'] = '';
			}
			
			if($materia['viernes-i']!='00:00:00'){
				$cH['viernes'] = substr($materia['viernes-i'], 0, -3).' a '.substr($materia['viernes-f'], 0, -3);
			}
			else{
				$cH['viernes'] = '';
			}
			
			if($materia['sabado-i']!='00:00:00'){
				$cH['sabado'] = substr($materia['sabado-i'], 0, -3).' a '.substr($materia['sabado-f'], 0, -3);
			}
			else{
				$cH['sabado'] = '';
			}
		
		}}
?>