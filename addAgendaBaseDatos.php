<?php
include("conexion.php");
	$link=conexion();
if(isset($_POST['btn-upload']))
{    


  $PTD_RUT = $_POST["PTD_RUT"];
  $box_codigo = $_POST["box_codigo"];
  
  
    $usuario = sqlsrv_query($link,"insert into ab_agenda_medico(PTD_RUT, box_codigo) VALUES ('$PTD_RUT', '$box_codigo');");
		  
		   if($usuario){
			     $message = "Especialidad añadida correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "asignarPreReservaMed.php";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	
	
     sqlsrv_free_stmt($usuario);
	sqlsrv_close($link);
}
?>