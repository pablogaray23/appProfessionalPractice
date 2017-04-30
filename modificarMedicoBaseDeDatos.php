<?php
	include("conexion.php");
	$link=conexion();
	$PTD_RUT = $_POST["PTD_RUT"];
	
	
	$usuario = sqlsrv_query($link,"SELECT PRESTADOR.PTD_RUT, PRESTADOR.PTD_NOMBRE, ESPECIALIDAD.ESP_NOMBRE 
FROM ESPECIALIDAD_PRESTADOR 
INNER JOIN ESPECIALIDAD
 ON ESPECIALIDAD_PRESTADOR.ESP_CODIGO = ESPECIALIDAD.ESP_CODIGO
INNER JOIN PRESTADOR
 ON PRESTADOR.PTD_RUT = ESPECIALIDAD_PRESTADOR.PTD_RUT where PRESTADOR.PTD_RUT='$PTD_RUT'");
	$row = sqlsrv_fetch_array($usuario);
    
	

    
	if($usuario){
		$arr = array('PTD_RUT' => $row["PTD_RUT"], 'PTD_NOMBRE' => $row["PTD_NOMBRE"], 'ESP_NOMBRE' => $row["ESP_NOMBRE"]);
		echo json_encode($arr);
	}else{
		echo json_encode('Ocurrio un error intentelo nuevamente');
	}
	
	
	sqlsrv_free_stmt($usuario);
	
	sqlsrv_close($link);

?>
