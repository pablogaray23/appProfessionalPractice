<?php
  include("conexion.php");
  $link=conexion();

  $PTD_RUT=      $_GET['PTD_RUT'];
  $agm_codigo=      $_GET['agm_codigo'];
  $agd_id_agendaDetalle=      $_GET['agd_id_agendaDetalle'];
    
//  $message = $PTD_RUT;
//	echo "<script type='text/javascript'>alert('$message');</script>";
	
	//$messageDos = $agm_codigo;
	//echo "<script type='text/javascript'>alert('$messageDos');</script>";
	
	//$messageTres = $agd_id_agendaDetalle;
	//echo "<script type='text/javascript'>alert('$messageTres');</script>";
	
	  $estudiante= sqlsrv_query($link, "SELECT * from ab_agenda_medico, ab_agenda_detalle
WHERE ab_agenda_medico.agm_codigo = ab_agenda_detalle.agm_codigo AND
ab_agenda_medico.PTD_RUT = '$PTD_RUT' AND
ab_agenda_medico.agm_codigo = '$agm_codigo' AND
ab_agenda_detalle.agd_id_agendaDetalle = '$agd_id_agendaDetalle'");
  $nmyestudiante = sqlsrv_num_rows($estudiante);
  $row = sqlsrv_fetch_array($estudiante);
  
  $box_codigo = $row['box_codigo'];
  


    
    $estudiante = sqlsrv_query($link, "DELETE FROM ab_agenda_medico WHERE ab_agenda_medico.agm_codigo='$agm_codigo'");
	
	$estudianteDos = sqlsrv_query($link, "DELETE FROM ab_agenda_detalle WHERE ab_agenda_detalle.agd_id_agendaDetalle = '$agd_id_agendaDetalle'");
	
	$estudianteTres = sqlsrv_query($link, "DELETE FROM ab_box_especialidad WHERE ab_box_especialidad.agd_id_agendaDetalle = '$agd_id_agendaDetalle'");


  
    if($estudiante and $estudianteDos and $estudianteTres){
       $message = "Agenda Médica Eliminada correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "crearAgendaMedico.php?box_codigo=$box_codigo";
				// box_codigo=$box_codigo
				 echo ("<script>location.href='$link'</script>");
    }else{
      echo json_encode('Ocurrio un error intentelo nuevamente');
    } 
	
    

sqlsrv_free_stmt($estudiante);
sqlsrv_free_stmt($estudianteDos);
	sqlsrv_close($link);

?>