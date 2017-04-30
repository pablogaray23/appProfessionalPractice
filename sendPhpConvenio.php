<?php

header('Content-Type: text/html; charset=utf-8');

	require_once('AttachMailer.php'); 

include("conexion.php");
	$link=conexion();
if(isset($_POST['btn-upload']))
{    

	$nivel = $_POST["nivel"];	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$doc_file = $_POST["doc_file"];
	
	
	$folder="../sistemaUno/convenios/".$doc_file;
	
	

$mailer = new AttachMailer("pagaray22@gmail.com", "pagaray@alumnos.ubiobio.cl", "asunto", "hello contenido del mensaje");
$mailer->attachFile("garantia.pdf");
$mailer->send() ? "Enviado": "Problema al enviar";
	
	
	
	
	 
	
	sqlsrv_close($link);
}
?>