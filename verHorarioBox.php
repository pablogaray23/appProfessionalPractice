<?php
	include("conexion.php");
	$link=conexion();

	$PTD_RUT = 'lalal';
	
	echo json_encode($PTD_RUT);
	
    
	

	
	sqlsrv_close($link);

?>
