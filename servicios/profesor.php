<?php
include("conexion.php");
include("header.html");
include("control.php");
?>
 <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <div class="login-panel panel panel-default">
                  
                    <div class="panel-body">
                    	
           <form role="form" action="registra_profesor.php" method="post">
            <fieldset>
           <table width="50%" border="0" cellpadding="3" cellspacing="3"  class="table table-responsive">
  <tr>
    <td width="40">Prefijo:</td>
    <td width="60%"><select name="prefijo">
      <option value="Lic.">Lic.</option>
      <option value="Mtro.">Mtro.</option>
      <option value="Mtra.">Mtra.</option>
      <option value="Dr.">Dr.</option>
      <option value="Dra.">Dra.</option>
      <option value="Mgdo.">Mgdo.</option>
      <option value="Mgda.">Mgda.</option>
      <option value="Juez.">Juez</option>
    </select></td>
  </tr>
  <tr>
    <td>Nombre:</td>
    <td><input type="text" name="nombre" required="required"/></td>
  </tr>
  <tr>
    <td>Apellido Paterno:</td>
    <td><input type="text" name="apellido_p"/></td>
  </tr>
  <tr>
    <td>Apellido Materno:</td>
    <td><input type="text" name="apellido_m"/></td>
  </tr>
  <tr>
    <td>N&uacute;mero de casa:</td>
    <td><input type="text" name="casa" /></td>
  </tr>
  <tr>
    <td>N&uacute;mero de m&oacute;vil 1:</td>
    <td><input type="text" name="movil1" /></td>
  </tr>
  <tr>
    <td>N&uacute;mero de m&oacute;vil 2:</td>
    <td><input type="text" name="movil2"/></td>
  </tr>
  <tr>
    <td>N&uacute;mero de oficina: </td>
    <td><input type="text" name="oficina" /></td>
  </tr>
  <tr>
    <td>Email: </td>
    <td><input type="text" name="mail" /></td>
  </tr>
  <tr>
    <td>Cargo: </td>
    <td><input type="text" name="cargo" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="table table-striped"><center><input type="submit" class="btn btn-success " value="Guardar" /></center></td>
    </tr>
</table>

            </fieldset>
    	</form>
        </div>
                </div>
            </div>
        </div>
    </div>
      

 <?PHP	
include("footer.html");
?>