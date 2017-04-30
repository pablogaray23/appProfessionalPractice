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
	
	//unlink($mmmm);
	if (file_exists($mmmm)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($mmmm).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($mmmm));
    readfile($mmmm);
    exit;
}
  
  

sqlsrv_free_stmt($estudiante);
	sqlsrv_close($link);


?>