<?php
include("conexion.php");
include("header.html");
include("control.php");
?>
<div class="panel panel-info" style="width:90%; padding-left:5%;padding-right:5%;">
  <div class="panel-heading">
      <div class="form-group">
      <center> <h4> Agregar nuevo alumno</h4> </center>
      </div>
      </div>
       
       
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table ">
<form role="form" action="registrar_datos_alumno.php" method="post">            
                             <tr>
    <td width="16%" align="right" valign="middle">Cuenta:</td>
    <td width="31%"><strong>
      <input type="text" name="boleta" required class="span3"/>
    </strong></td>
    <td width="23%" align="right">Carrera:</td>
    <td width="25%"><strong>
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
                             </tr>
  <tr>
    <td align="right" valign="middle">Referencia:</td>
    <td><strong>
      <input type="text" name="referencia" required="required" class="span3"/>
    </strong></td>
    <td align="right">Ciclo:      </td>
    <td><input name="ciclo" type="text" id="ciclo" size="4" maxlength="4" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Turno:</td>
    <td><strong>
      <select id="turno" name="turno" class="span2">
        <option value="m">Matutino</option>
        <option value="v" selected="selected">Vespertino</option>
        <option value="mix">Mixto</option>
      </select>
    </strong></td>
    <td align="right">Grupo:</td>
    <td><strong>
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
  <tr align="right" valign="middle">
    <td colspan="4"><center>
      <strong>Datos Personales.</strong>
    </center></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Nombre (s):</td>
    <td colspan="3"><input name="nombre" type="text" required="required" class="span3" id="editar-nombre" value="" size="80" maxlength="110" /></td>
    </tr>
  <tr>
    <td align="right" valign="middle">Apellidos:</td>
    <td colspan="3"><input name="0" type="text" required="required" class="span3" id="editar-apellidos" value="" size="80" maxlength="110" /></td>
    </tr>
  <tr>
    <td align="right" valign="middle">Fecha de Nacimiento:</td>
    <td><span class="edit">
      <input type="text" id="editar-fecha" name="fecha" value="" required="required" class="span3" />
    </span></td>
    <td align="right" valign="middle">Nacionalidad:</td>
    <td><br>
      <strong><span class="edit">
      <input type="text" id="editar-nacionalidad" name="nacionalidad" value="Mexicana" class="span3"/>
      </span></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Tel&eacute;fono de casa:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-casa" name="casa" value="" required="required" class="span3"/>
    </span></strong></td>
    <td align="right" valign="middle">Telefono Movil:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-movil" name="movil" value="" required="required" class="span3"/>
    </span></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Tel Oficina:</td>
    <td><strong><span class="edit">
      <input type="text" id="oficina" name="oficina" value="" class="span3"/>
    </span></strong></td>
    <td align="right" valign="middle">Email:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-email" name="email" value="" required="required" class="span3"/>
    </span></strong></td>
  </tr>
  <tr align="right" valign="middle">
    <td colspan="4" align="center"><strong>Direccion.</strong></td>
    </tr>
  <tr>
    <td align="right" valign="middle">Calle:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-calle" name="calle" value="" required="required" class="span3" />
    </span></strong></td>
    <td colspan="2">N&uacute;mero ext.<strong>&nbsp;<span class="edit numero">
    <input name="num_ext" type="text" required="required" class="span2" id="editar-num-ext" value="" size="4" maxlength="4"/>
    </span>&nbsp;</strong>&nbsp;N&uacute;mero int.<strong>
    <input name="num_int" type="text" class="span2" id="editar-num-int2" value="" size="4" maxlength="4" />
    </strong></td>
    </tr>
  <tr>
    <td align="right" valign="middle">Colonia:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-col" name="colonia" value="" required="required" class="span3"/>
    </span></strong></td>
    <td align="right" valign="middle">Delegaci&oacute;n/Municipio:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-del" name="del_mun" value="" required="required" class="span3"/>
    </span></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">C.P.:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-cod-pos" name="cod_pos" value="" required="required" class="span3" />
    </span></strong></td>
    <td align="right" valign="middle">Estado:</td>
    <td><strong><span class="edit">
      <input type="text" id="editar-est" name="estado" value="" required="required" class="span3"/>
    </span></strong></td>
  </tr>
  <tr align="right" valign="middle">
    <td colspan="4" class="table table-striped table-responsive"><center><input type="submit" class="btn btn-info " value="Guardar" /></center></td>
    </tr>
                          
                       	     </table>
                      </fieldset>
    				</form>
                   </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
 <?PHP	
include("footer.html");
?>