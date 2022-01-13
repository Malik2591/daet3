<?php
include("conexion.php");
include("header.html");
include("control.php");


		session_start();
		include("conexion.php");
		
	if(isset($_GET['boleta'])){
		$boleta =$_GET['boleta'];
		$password = md5(trim($boleta));
		$rol = '4';
		
		$usuario = $_GET['boleta'];
		$nacionalidad = utf8_decode($_GET['nacionalidad']);
		$fecha = utf8_decode($_GET['fecha']);
		$casa = utf8_decode($_GET['casa']);
		$movil = utf8_decode($_GET['movil']);
		$email = utf8_decode($_GET['email']);
		$oficina= utf8_decode($_GET['oficina']);
		
		$calle = $_GET['calle'];
		$num_ext = $_GET['num_ext'];
		$num_int = $_GET['num_int'];
		$colonia = $_GET['colonia'];
		$cod_post = $_GET['cod_pos'];
		$estado = $_GET['estado'];
		$del_mun = $_GET['del_mun'];
		
		$nombre = $_GET['nombre'];
		$apellidos = $_GET['apellidos'];
		
		$referencia = $_GET['referencia'];
		$grupo = $_GET['grupo'];
		$carrera = $_GET['carrera'];
		
		//inserta informacion en usuario
		$query = "INSERT INTO `univesn6_sgat`.`Usuario` (`id_usr` ,`pass_usr` ,`Rol_id_rol` ,`fecha` ,`nacionalidad` ,`movil` ,`casa` ,`email_usr` ,`Direccion_id_dir_usr` ,`oficina`) VALUES ('$boleta', '$password', '$rol', '$fecha' , '$nacionalidad' , '$movil', '$casa' , '$email', NULL, '$oficina')";
		mysql_query($query,$link);
		/*echo '1.) '.mysql_error().'<br />'; */
		
		
		//Inserta información en alumno
		$query = "INSERT INTO Alumno (rfc_alm,nom_alm,ape_alm,blq_alm,ref_inscripcion,Alumno_Carrera_id_carrera,Grupo_actual) VALUES ('$boleta', '$nombre', '$apellidos', '0', '$referencia',$carrera,$grupo)";
		mysql_query($query,$link);
		/*echo '2.) '.mysql_error().'<br />'; */ 
		
		//informacion de grupo
		$query = "INSERT INTO `univesn6_sgat`.`Alumno_has_Grupo` (`Alumno_rfc_alm` ,`Grupo_id_grp`) VALUES ('$boleta', '$grupo')";
		mysql_query($query,$link);
		/*echo '3.) '.mysql_error().'<br />'; */
			
		$query = sprintf("INSERT INTO `univesn6_sgat`.`Historial` (`Alumno_rfc_alm`) VALUES ('%s')",mysql_real_escape_string($boleta));
		mysql_query($query,$link);
		
		$id_hist = mysql_insert_id();
		$query = sprintf("INSERT INTO `univesn6_sgat`.`Alumno_has_Historial` (``,`Alumno_rfc_alm`) VALUES ('%s')",mysql_real_escape_string($boleta));
		mysql_query($query,$link);
		
		$query = "INSERT INTO `Direccion`(`calle`, `num_ext`, `num_int`, `colonia`, `cod_pos`, `estado`,`del_mun`) VALUES ('$calle','$num_ext','$num_int','$colonia','$cod_post','$estado','$del_mun')";
		mysql_query($query,$link);
		$idDir = mysql_insert_id();
		
		$query = "UPDATE `Usuario` SET  `Direccion_id_dir_usr`='$idDir' WHERE Usuario.id_usr='$usuario'";
		mysql_query($query,$link);
		
		$query = "SELECT * FROM Carrera WHERE id_carrera='$carrera'";
		$cR = mysql_query($query,$link);
		$sA = mysql_fetch_assoc($cR);
		$saldo = $sA['costo_mens'];
		
		$query = "INSERT INTO `Cuenta`(`saldo_cnt`, `adeudo_cnt`, `Alumno_rfc_alm`) VALUES ('$saldo','0','$boleta')";
		mysql_query($query,$link);
		/*echo '4.)'.mysql_error();*/
		
		
		//$idCarrera = $historial['Alumno_Carrera_id_carrera']; usar $carrera
		//$idHistorial = $historial['id_hist']; usar id_hist
		
		//historial
		$query2 = "SELECT * FROM Modulo WHERE id_Carrera='$carrera'";
		$modulos = mysql_query($query2,$link);
		echo mysql_error();
		
		while($modulo = mysql_fetch_assoc($modulos)){
			$idModulo = $modulo['id_mod'];
			$query3 = "INSERT INTO `Historial_has_Modulo`(`Historial_id_hist`, `Modulo_id_mod`) VALUES ('$id_hist','$idModulo')";
			mysql_query($query3,$link);
			//echo mysql_error();
			//echo $query3.'<br />';
		}
	}
?>
<div class="panel panel-info" style="width:800px;">
  <div class="panel-heading">
      <div class="form-group">
      <center> <h4> Agregar nuevo alumno</h4> </center>
      </div></div>
       <div class="panel-body">
<table class="table table-striped" style="width:750px">
				<tr>
					<td align="center" colspan="2"><strong>Datos acad&eacute;micos</strong></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				<tr>
					<td><strong>Cuenta: 
					  <input type="text" name="boleta" required="required" class="span3"/>
					</strong></td>
					<td><strong>Referencia:
					  <input type="text" name="referencia" required="required" class="span3"/>
					</strong></td>
				</tr>
				<tr>
					<td><strong>Carrera:
					  <select name="carrera">
					    <?
					$query = "SELECT * FROM Carrera";
					$carreras = mysql_query($query,$link);
					
					while($carrera = mysql_fetch_assoc($carreras)){
?>
					    <option value="<?=$carrera['id_carrera']?>">
					      <?=$carrera['nom_carrera']?>
				        </option>
					    <?						
					}
?>
				    </select>
					</strong></td>
					<td><strong>Grupo: 
					  <select name="grupo">
					    <?
					$query = "SELECT * FROM Grupo";
					$grupos = mysql_query($query,$link);
					
					while($grupo = mysql_fetch_assoc($grupos)){
?>
					    <option value="<?=$grupo['id_grp']?>">
					      <?=$grupo['clave_grp']?>
				        </option>
					    <?						
					}
?>
				    </select>
					</strong></td>
				</tr>
				<tr>
					<td>
				    <strong>Turno:
				    <select id="turno" name="turno" class="span2">
				      <option value="m">Matutino</option>
				      <option value="v">Vespertino</option>
			        </select>
				    </strong></td>
					<td></td>
				</tr>
				
		 </table>
			<br />
		
<table class="table table-striped" style="width:750px">
				<tr>
					<td height="36" colspan="2" style="text-align:center;"><strong>Datos personales</strong></td>
				</tr>
				<tr>
					<td>Nombre (s):
					  <input type="text" id="editar-nombre" name="nombre" value="" required="required" class="span3" />
					</td>
					<td>Apellidos:
					  <input type="text" id="editar-apellidos" name="apellidos" value="" required="required" class="span3" />
					</td>
				</tr>
				<tr>
					<td>Fecha de Nacimiento:<span class="edit">
					  <input type="text" id="editar-fecha" name="fecha" value="" required="required" class="span3" />
					</span></strong></td>
					<td><strong>Nacionalidad: <span class="edit">
					  <input type="text" id="editar-nacionalidad" name="nacionalidad" value="Mexicana" class="span3"/>
					</span></strong></td>
				</tr>
				<tr>
					<td><strong>Tel&eacute;fono de casa:<span class="edit">
					  <input type="text" id="editar-casa" name="casa" value="" required="required" class="span3"/>
					</span></strong></td>
					<td><strong>Telefono Movil: <span class="edit">
					  <input type="text" id="editar-movil" name="movil" value="" required="required" class="span3"/>
					</span></strong></td>
				</tr>
				<tr>
					<td><strong>Tel Oficina:<span class="edit">
					  <input type="text" id="oficina" name="oficina" value="" class="span3"/>
					</span></strong></td>
					<td><strong>Email:<span class="edit">
					  <input type="text" id="editar-email" name="email" value="" required="required" class="span3"/>
					</span></strong></td>
				</tr>
				
				</table>


<br>



			<table class="table table-striped" style="width:750px">
				<tr>
					<td colspan="2"><strong>Direcci&oacute;n</strong></td>
				</tr>
				
				

					<td><strong>Calle<span class="edit">
					  <input type="text" id="editar-calle" name="calle" value="" required="required" class="span3" />
					</span></strong></td>


						

							<td><strong>N&uacute;mero ext.</strong>&nbsp;<span class="edit numero">
							  <input type="text" id="editar-num-ext" name="num_ext" value="" required="required" class="span2"/>
							</span>&nbsp;&nbsp;<strong>N&uacute;mero int
							<input type="text" id="editar-num-int" name="num_int" value="" class="span2" />
							.</strong></td>


						
				
				<tr>
					<td><strong>Colonia <span class="edit">
					  <input type="text" id="editar-col" name="colonia" value="" required="required" class="span3"/>
					</span></strong></td>
					<td><strong>Delegaci&oacute;n/Municipio: <span class="edit">
					  <input type="text" id="editar-del" name="del_mun" value="" required="required" class="span3"/>
					</span></strong></td>
				
				

				<tr>
					<td><strong>C.P.: <span class="edit">
					  <input type="text" id="editar-cod-pos" name="cod_pos" value="" required="required" class="span3" />
					</span></strong></td>
					<td><strong>Estado: <span class="edit">
					  <input type="text" id="editar-est" name="estado" value="" required="required" class="span3"/>
					</span></strong></td>
				</tr>
				</tbody>
			</table>
			<br />
			<br />
			<center><input type="submit" value="Guardar" /></center>
  </div>
</div>
<?php 
include("footer.html");
?>
