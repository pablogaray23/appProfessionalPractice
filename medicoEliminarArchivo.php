<?php
  include("conexion.php");
  $link=conexion();
  $PTD_RUT=      $_GET['PTD_RUT'];
  $doc_codigo=      $_GET['doc_codigo'];
  
    
  $estudiante= sqlsrv_query($link, "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.doc_codigo = '$doc_codigo'");
  $nmyestudiante = sqlsrv_num_rows($estudiante);
  $row = sqlsrv_fetch_array($estudiante);
  $doc_file = $row['doc_file'];
  
  
  $elDirectorio = utf8_decode($doc_file);
	//echo $elDirectorio;
	$mmmm = array('../arriendoCM/uploads/',$elDirectorio);	
	$mmmm=implode($mmmm);
	//echo $mmmm;
	
	$mmmm2 = array('el directorio',$elDirectorio,' sera eliminado');	
	$mmmm2=implode($mmmm2);
	
	$message = " el directorio fue eliminado";
	unlink($mmmm);
	$estudiante = sqlsrv_query($link, "DELETE FROM ab_documento WHERE ab_documento.PTD_RUT='$PTD_RUT' AND ab_documento.doc_codigo='$doc_codigo'");
	//echo "<script type='text/javascript'>alert('$mmmm2');</script>";
	    


  
    if($estudiante){
       $message = "Archivo Eliminado correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
    }else{
      echo json_encode('Ocurrio un error intentelo nuevamente');
    } 
    
  
  

sqlsrv_free_stmt($estudiante);
	sqlsrv_close($link);


?>