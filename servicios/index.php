<?php
include("header.html");
include("control.php");

?>
 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                      <div class="panel-body">
                    	<center>
                   		 <h2>Gestión de Alumnos<br> <br></h2>
                   			<form action="resultados_alumnos.php" method="post">
                   				
                                <div class="form-group">
                                      <input  class="form" placeholder="No. de Cuenta" name="cuenta" type="text" required="">         
                                       <button class="btn btn-success btn-circle" type="submit"><i class="fa fa-search fa-fw"></i> </button>
                                        </div>
                                       
                   			</form>
                   			 </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
<?php
include("footer.html");
?>
