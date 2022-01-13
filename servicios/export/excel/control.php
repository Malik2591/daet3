<?
	if(!isset($_SESSION['usuario'])&&!isset($_SESSION['rol'])){
		header("Location: ../checkpoint/index.php");
	}
	else{
		if($_SESSION['rol']!=='5f82c4cc00aa13b4d16458481c75d39a'){
			header("Location: ../../error/401.php");
		}
	}
?>