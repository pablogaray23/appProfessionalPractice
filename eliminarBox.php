<?php
  include("conexion.php");
  $link=conexion();

  $box_codigo=      $_GET['box_codigo'];
    
  $estudiante= sqlsrv_query($link, "select * from ab_box, ab_box_especialidad
where ab_box.box_codigo = ab_box_especialidad.box_codigo 
and ab_box.box_codigo = '$box_codigo'");
 // $nmyestudiante = sqlsrv_num_rows($estudiante);
  $row = sqlsrv_fetch_array($estudiante);
  


    
    $estudiante = sqlsrv_query($link, "DELETE FROM ab_box WHERE box_codigo='$box_codigo'");
	
	$estudianteDos = sqlsrv_query($link, "DELETE FROM ab_box_especialidad WHERE box_codigo='$box_codigo'");


  
    if($estudiante and $estudianteDos){
       $message = "Box Eliminado correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "boxGestionar.php";
				 echo ("<script>location.href='$link'</script>");
    }else{
      echo json_encode('Ocurrio un error intentelo nuevamente');
    } 
    


sqlsrv_free_stmt($estudiante);
sqlsrv_free_stmt($estudianteDos);
	sqlsrv_close($link);

?>