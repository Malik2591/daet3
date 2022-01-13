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
		if($num==1){
			$array =  mysql_fetch_array($resultado);
			$boleta = $array['rfc_alm'];
			$idGrp = $array['id_grp'];
			$desGrp = utf8_encode($array['clave_grp']);
			$periodoGrp = utf8_encode($array['per_grp']);
			$nombre = utf8_encode($array['nom_alm']);
			$apellidos = utf8_encode($array['ape_alm']);
			$motivos = utf8_encode($array['motivos']);
		
			switch ($periodoGrp) {
										case '20':
											$color_tabla="warning";
											break;
										case '25':
											$color_tabla="success";
										break;
										
										default:
											$color_tabla="default";
									    break;
			}

?>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script language="JavaScript"> 
    function habilita(){
        $(".form-control").removeAttr("disabled");
		$("#cancelar").removeClass("hide");
	    $("#guardar").removeClass("hide");
		$("#editar").addClass("hide");

    } 

    function deshabilita(){ 
        $(".form-control").attr("disabled","disabled");
		$("#cancelar").addClass("hide");
	    $("#guardar").addClass("hide");
		$("#editar").removeClass("hide");
	
    }
	function habilita2(){
        $(".calificacion").removeAttr("disabled");
		$("#cancelar_c").removeClass("hide");
	    $("#guardar_c").removeClass("hide");
		$("#editar_c").addClass("hide");

    } 

    function deshabilita2(){ 
        $(".calificacion").attr("disabled","disabled");
		$("#cancelar_c").addClass("hide");
	    $("#guardar_c").addClass("hide");
		$("#editar_c").removeClass("hide");
	
    }
</script> 

<div class="panel panel-info" style="width:90%;padding-left:5%;padding-right:5%;">
  <div class="panel-heading">
    <form action="resultados_alumnos.php" method="post">
      <div class="form-group">
        
          Resultados de busqueda
          <input  class="form" value="<?php echo $cuenta;?>" name="cuenta" type="text" required="" >
          <button class="btn btn-success btn-circle" type="submit"><i class="fa fa-search fa-fw"></i> </button>
        </center>
      </div>
    </form>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th><font><font>Maricula</font></font></th>
            <th><font><font>Nombre</font></font></th>
            <th><font><font>Grupo</font></font></th>
            <th><font><font>Semestre</font></font></th>
          </tr>
        </thead>
        <tbody>
          <tr class="<?php echo $color_tabla ?>">
            <td><font><font> <?php echo $boleta;?></font></font></td>
            <td><font><font><?php echo $nombre;echo " ";echo $apellidos;?></font></font></td>
            <td><font><font><?php echo $desGrp;?></font></font></td>
            <td><font><font><?php echo $periodoGrp;?></font></font></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="panel-body">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Datos </a> </li>
      <li><a href="#profile" data-toggle="tab">Kardex</a> </li>
      <li><a href="#messages" data-toggle="tab">Mensajes</a> </li>
      <li><a href="#settings" data-toggle="tab">Horario</a> </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
        <?
		$query = "SELECT * FROM (Usuario INNER JOIN Direccion ON Usuario.Direccion_id_dir_usr=Direccion.id_dir_usr) INNER JOIN Alumno ON Usuario.id_usr = Alumno.rfc_alm WHERE Usuario.id_usr='$boleta'";
 
		$result = mysql_query($query,$link);
		$num = mysql_num_rows($result);

			$array = mysql_fetch_array($result);
			$nombre = utf8_encode($array['nom_alm']);
			$apellido = utf8_encode($array['ape_alm']);
			$fecha = date('d-m-Y',strtotime($array['fecha']));
			
			$nacionalidad = utf8_encode($array['nacionalidad']);
			$casa = utf8_encode($array['casa']);
			$movil = utf8_encode($array['movil']);
			$oficina= utf8_encode($array['oficina']);
			$email = utf8_encode($array['email_usr']);
			
			$calle = utf8_encode($array['calle']);
			$num_ext = utf8_encode($array['num_ext']);
			$num_int = utf8_encode($array['num_int']);
			$colonia = utf8_encode($array['colonia']);
			$cod_post = utf8_encode($array['cod_pos']);
			$estado = utf8_encode($array['estado']);
			$del_mun = utf8_encode($array['del_mun']);
		
?>
        <h4>Datos de Casa</h4>
        <form name="datos">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Nombre(s):</strong> <span class="info">
               <input class="form-control" name="nom" id="disabledInput" type="text" value=" <?= $nombre;?>" disabled="">
                </span></td>
              <td><strong>Apellidos: </strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value=" <?= $apellidos;?>" disabled="">
                </span></td>
            </tr>
            <tr>
              <td ><strong>Fecha de Nacimiento: </strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?= $fecha?>" disabled="disabled"> 
                </span></td>
              <td><strong>Nacionalidad: </strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?=$nacionalidad?>" disabled=""> 
                </span></td>
            </tr>
            <tr>
              <td><strong>N&uacute;mero de casa:</strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value=" <?= $casa;?>" disabled="">
                </span></td>
              <td><strong>N&uacute;mero de m&oacute;vil:</strong> <span class="info">
              <input class="form-control" id="disabledInput" type="text" value="<?= $movil?>" disabled="">  
                </span></td>
            </tr>
            <tr>
              <td><strong>Email</strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?= $email;?>" disabled=""> 
                </span></td>
              <td><strong>Telefono de Oficina:</strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?= $oficina;?>" disabled=""> 
                </span></td>
            </tr>
          </tbody>
        </table>
        <table class="table table-striped">
          <tbody>
            <tr> </tr>
            <tr>
              <td><strong>Calle</strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?= $calle?>" disabled=""> 
                </span></td>
              <td><strong>N&uacute;mero ext.</strong> <span class="info">
                <input class="form-control" id="disabledInput" type="text" value="<?= $num_ext?>t" disabled="">
                </span>&nbsp;&nbsp;&nbsp; <strong>N&uacute;mero int.</strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value=" <?= $num_int?>" disabled="">
                </span></td>
            </tr>
            <tr>
              <td><strong>Colonia </strong> <span class="info">
                <input class="form-control" id="disabledInput" type="text" value="<?=$colonia?>" disabled="">
                </span></td>
              <td><strong>Delegaci&oacute;n/Municipio: </strong> <span class="info">
                <input class="form-control" id="disabledInput" type="text" value="<?=$del_mun?>" disabled="">
                </span></td>
            </tr>
            <tr>
              <td><strong>C&oacute;digo postal: </strong> <span class="info">
               <input class="form-control" id="disabledInput" type="text" value="<?=$cod_post?>" disabled="">
                </span></td>
              <td><strong>Estado: </strong> <span class="info">
              <input class="form-control" id="disabledInput" type="text" value="<?=$estado?>" disabled="">  
                </span></td>
            </tr>
          </tbody>
        </table>
        <button type="button" name="editar" class="btn  btn-info" id="editar" onclick="habilita()">Editar</button>
        <button type="button"  name="guardar" class="btn btn-success hide" id="guardar" disabled="disabled" >Guardar</button>
        <button type="button"  name="cancelar" class="btn btn-danger hide" id="cancelar" onclick="deshabilita()"  >Cancelar</button>
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
     
        <h4>Kardex</h4>
        <p>  <?
	  $query_hist="SELECT * FROM `Historial` WHERE `Alumno_rfc_alm` LIKE '$boleta'";
	  $resultado_hist = mysql_query($query_hist,$link);
	  $num_hist = mysql_num_rows($resultado_hist);
      if($num==1){
			$array =  mysql_fetch_array($resultado);
			$historial = $array['id_hist'];
			$query_calificaciones = "SELECT * FROM Historial INNER JOIN Historial_has_Modulo ON Historial_has_Modulo.Historial_id_hist=Historial.id_hist INNER JOIN Modulo ON Modulo.id_mod=Historial_has_Modulo.Modulo_id_mod WHERE Historial.Alumno_rfc_alm='$boleta' AND Modulo.per_mod<='$periodoGrp' ORDER BY  `Modulo`.`per_mod` ASC";
		$materias = mysql_query($query_calificaciones,$link);
		$total = mysql_num_rows($materias);
		$indice = 1;
			
				 ?>
	   <form role="form" action="registra_calificaciones.php" method="post">
            <fieldset>
           <table width="95%" border="0" cellpadding="0" cellspacing="3"  class="table table-striped">
           
           
           
           
           <?
		$i=1;
		while ($fila = mysql_fetch_assoc($materias)) {
			$calificacion = $fila['calificacion'];
			if($calificacion===null){
				$calificacion='-';
			}
?>
		<tr>
			<td class="numero"><?echo utf8_encode($fila["nom_mod"]);?></td>
			<td class="numero">

				<span class="edit-c">
				<input type="text" value="<?=$fila['calificacion']?>" name="calificacion<?=$i?>"  class="calificacion"disabled=""/>
				</span>
			</td>
		</tr>
<?
			$i=$i+1;
		}
?>
		<tr style="text-align:center;">
			<td colspan="2" style="padding: 10px 10px 10px 10px;">
				</table>
        <button type="button" name="editar" class="btn  btn-info" id="editar_c" onclick="habilita2()">Editar</button>
        <button type="button"  name="guardar" class="btn btn-success hide" id="guardar_c" disabled="disabled" >Guardar</button>
        <button type="button"  name="cancelar" class="btn btn-danger hide" id="cancelar_c" onclick="deshabilita2()"  >Cancelar</button>
			</td>
		</tr>
		
		

	</table>
           
	 
	 <? }
	  else{?><div class="panel-body">
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Lo sentimos!!</h4>
</div>
<div class="modal-body"> El alumno tiene un problema en el historial porfavor avise al departamento de sistemas. </div>
<div class="modal-footer"> <a href="index.php" class="btn btn-warning" data-dismiss="modal">Regresar a la busqueda.</a> </div> 
<?
}
	  ?></p>
      </div>
      <div class="tab-pane fade" id="messages">
        <h4>Mensajes</h4>
        <p></p>
      </div>
      <div class="tab-pane fade" id="settings">    
       <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0px; border:0 px; margin:0;">
          <thead>
         
          	<tr>
			<th><small><small>Materia</small></small></th>
			<th><small><small>Profesor</small></small></th>
			<th><small><small>Lunes</small></small></th>
			<th ><small><small>Martes</small></small></th>
			<th ><small><small>Mi&eacute;rcoles</small></small></th>
			<th ><small><small>Jueves</small></small></th>
			<th ><small><small>Viernes</small></small></th>
			<th ><small><small>S&aacute;bado</small></small></th>
		
		</tr>
          </thead>
          <?
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
?>
          <tbody>
          <?
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
?>
			<td><small><small><?=$cH['lunes']?></small></small></td>
			<td><small><small><?=$cH['martes']?></small></small></td>
			<td><small><small><?=$cH['miercoles']?></small></small></td>
			<td><small><small><?=$cH['jueves']?></small></small></td>
			<td><small><small><?=$cH['viernes']?></small></small></td>
			<td><small><small><?=$cH['sabado']?></small></small></td>
			
		</tr>
        <?		
		}}
?>
<?
$boleta_
?>
          </tbody>
          </table>
          <br /><center>
        <form method="POST" action="">
 		<input type="hidden" name="boleta" value='<?=$cuenta?>'></input>
 		<input type="submit"  class="btn  btn-info" value="Imprimir  Horario">
</form></center>
      </div>
    </div>
  </div>
</div>
</div>
<?php }
                   			 else{
                   			 	if($num>1){
                   			 		?>
<br />
<!--Aqui empieza la  plantilla para varios resultados-->
<div class="container">
        <div class="row">
           <div class="panel panel-default" style="width:90%;padding-left:5%;padding-right:5%;>
                   <div class="panel-body">
  <div class="panel-heading"></div>
    <form action="resultados_alumnos.php" method="post">
      <div class="form-group">
        
          Resultados de busqueda
          <input  class="form" value="<?php echo $cuenta;?>" name="cuenta" type="text" required="" >
          <button class="btn btn-success btn-circle" type="submit"><i class="fa fa-search fa-fw"></i> </button>
        </center>
      </div>
    </form>
  </div>
  <div class="panel-body">
    <div class="table table-striped table-bordered table-hover">
      <table class="table" >
        <thead>
          <tr>
            <th><font><font>Maricula</font></font></th>
            <th><font><font>Nombre</font></font></th>
            <th><font><font>Grupo</font></font></th>
            <th><font><font>Semestre</font></font></th>
            <th></th>
          </tr>
        </thead>
        <?php
										while($alumno = mysql_fetch_assoc($resultado)){
											$desGrp = utf8_encode($alumno['clave_grp']);
											$idAlumno = $alumno['rfc_alm'];
											$idGrp = $alumno['id_grp'];
											$periodoGrp = utf8_encode($alumno['per_grp']);
											$nombre = utf8_encode($alumno['nom_alm']);
											$apellidos = utf8_encode($alumno['ape_alm']);
											$nom_grupo= utf8_encode($array['des_grp']);
									?>
        <tbody ">
          <?php
									
									switch ($periodoGrp) {
										case '20':
											$color_tabla="warning";
											break;
										case '25':
											$color_tabla="success";
										break;
										
										default:
											$color_tabla="default";
									    break;
									}
									?>
            <tr class="<?php echo $color_tabla ?>">
          
          <form action="resultados_alumnos.php" method="post">
            <input type="hidden" name="cuenta"  value="<?php echo $idAlumno;?>"/>
            <td><font><font> <?php echo $idAlumno;?></font></font></td>
            <td><font><font><?php echo $nombre;echo " ";echo $apellidos;?></font></font></td>
            <td><font><font><?php echo $desGrp;?></font></font></td>
            <td><font><font><?php echo $periodoGrp;?></font></font></td>
            <td><button class="btn btn-<?php echo $color_tabla ?> btn-circle" type="submit"><i class="fa fa-search fa-fw"></i> </button></td>
              </tr>
            
          </form>
          <?php	}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
                   			 	} 
                   			 	else{
                   			 		?>
<div class="panel-body">
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Lo sentimos!!</h4>
</div>
<div class="modal-body"> El alumno que busca no aprece por esa informacion verifique los datos por favor. </div>
<div class="modal-footer"> <a href="index.php" class="btn btn-warning" data-dismiss="modal">Regresar a la busqueda.</a> </div>
<?PHP
                   			 	}

                  			 }

 	
include("footer.html");
?>