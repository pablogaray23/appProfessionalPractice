<?php
	include("conexion.php");
	$link=conexion();
	$box_codigo = $_POST["box_codigo"];
	

    
	$usuario = sqlsrv_query($link,"SELECT ab_box_especialidad.box_codigo, ESPECIALIDAD.ESP_NOMBRE 
FROM ab_box_especialidad
INNER JOIN ESPECIALIDAD
 ON ab_box_especialidad.ESP_CODIGO = ESPECIALIDAD.ESP_CODIGO where ab_box_especialidad.box_codigo='$box_codigo'");
	$row = sqlsrv_fetch_array($usuario);
    
	if($usuario){
		$arr = array('box_codigo' => $row["box_codigo"], 'ESP_NOMBRE' => $row["ESP_NOMBRE"]);
		echo json_encode($arr);
	}else{
		echo json_encode('Ocurrio un error intentelo nuevamente');
	}
	
	sqlsrv_free_stmt($usuario);
	sqlsrv_close($link);

?>
