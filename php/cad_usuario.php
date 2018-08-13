<?php
	
	include "../_app/Config.inc.php";
	
	$info = $_POST;
	
	$crud->cadastra_usuario($info);
	
	header("Location:../lista_ger");
	
?>