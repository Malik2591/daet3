<?php
	session_start();
	echo 'Redirigiendo...';
	
	session_unset();
	session_destroy();
	
	header("Location: index.php");
?>