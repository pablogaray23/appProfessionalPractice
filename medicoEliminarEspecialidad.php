<?php
  include("conexion.php");
  $link=conexion();
  $PTD_RUT=      $_GET['PTD_RUT'];
  $ESP_CODIGO=      $_GET['ESP_CODIGO'];
    
  $estudiante= sqlsrv_query($link, "SELECT * FROM ab_especialidad_prestador WHERE PTD_RUT = '$PTD_RUT'");
  $nmyestudiante = sqlsrv_num_rows($estudiante);
  $row = sqlsrv_fetch_array($estudiante);
  


    
    $estudiante = sqlsrv_query($link, "DELETE FROM ab_especialidad_prestador WHERE PTD_RUT='$PTD_RUT' AND ESP_CODIGO='$ESP_CODIGO'");


  
    if($estudiante){
       $message = "Especialidad Eliminada correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "medicoModificarEspecialidad.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
    }else{
      echo json_encode('Ocurrio un error intentelo nuevamente');
    } 
    
  
  

sqlsrv_free_stmt($estudiante);
	sqlsrv_close($link);

?>