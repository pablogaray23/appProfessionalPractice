<?php
  include("conexion.php");
  $link=conexion();

  $PTD_RUT=      $_GET['PTD_RUT'];
    
  $estudiante= sqlsrv_query($link, "SELECT * FROM ab_especialidad_prestador, ab_prestador
  WHERE ab_especialidad_prestador.PTD_RUT = ab_prestador.PTD_RUT and  ab_prestador.PTD_RUT = '$PTD_RUT'");
 // $nmyestudiante = sqlsrv_num_rows($estudiante);
  $row = sqlsrv_fetch_array($estudiante);
  


    
    $estudiante = sqlsrv_query($link, "DELETE FROM ab_especialidad_prestador WHERE PTD_RUT='$PTD_RUT'");
	
	$estudianteDos = sqlsrv_query($link, "DELETE FROM ab_prestador WHERE PTD_RUT='$PTD_RUT'");


  
    if($estudiante and $estudianteDos){
       $message = "Medico Eliminado correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "medicoGestionar.php";
				 echo ("<script>location.href='$link'</script>");
    }else{
      echo json_encode('Ocurrio un error intentelo nuevamente');
    } 
    


sqlsrv_free_stmt($estudiante);
sqlsrv_free_stmt($estudianteDos);
	sqlsrv_close($link);

?>