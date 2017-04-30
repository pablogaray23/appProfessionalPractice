<?php
include("conexion.php");
	$link=conexion();
if(isset($_POST['btn-upload']))
{    


  $box_codigo = $_POST["box_codigo"];
  $especialidad = $_POST["especialidad"];
  
  
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	$sqlDos =  "select * from ab_box_especialidad where box_codigo = '$box_codigo' and esp_codigo = '$especialidad'";

	$buscar = sqlsrv_query($link, $sqlDos , $params, $options);

	$row_count = sqlsrv_num_rows( $buscar ); 
	
	 if($row_count > 0){
	  $message = "Box ya tiene esa especialidad, ingresar denuevo";
	echo "<script type='text/javascript'>alert('$message');</script>";
	$link = "boxAsignarEspecialidad.php?box_codigo=$box_codigo";
	echo ("<script>location.href='$link'</script>");
	  
  }else{
	
	   $usuario = sqlsrv_query($link,"INSERT INTO ab_box_especialidad (box_codigo, esp_codigo) VALUES ('$box_codigo', '$especialidad');");
		  
		   if($usuario){
			     $message = "Especialidad añadida correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "boxAsignarEspecialidad.php?box_codigo=$box_codigo";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	
  } 
  
  
	
     sqlsrv_free_stmt($usuario);
	sqlsrv_close($link);
}
?>