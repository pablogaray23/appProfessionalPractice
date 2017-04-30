<?php


header('Content-Type: text/html; charset=utf-8');

include("conexion.php");
	$link=conexion();
if(isset($_POST['btn-upload']))
{    

	$nivel = '8';	
	$PTD_RUT = $_POST["PTD_RUT"];
	$valor_arriendo= $_POST['valor_arriendo'];
	
	$file = $_FILES['file']['name'];
	
	 $message = $PTD_RUT;
//	echo "<script type='text/javascript'>alert('$message');</script>";
	$messageDos = $file;
//	echo "<script type='text/javascript'>alert('$messageDos');</script>";
	
	$datetime = date_create()->format('Y-m-d H:i:s');
//	echo "<script type='text/javascript'>alert('$fecha');</script>";
	
	$unNombre = substr($file, 11 , -4);
//	echo "<script type='text/javascript'>alert('$unNombre');</script>";
     
	
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES[ 'file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="convenios/";
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	$emmm = utf8_decode($file);
	// make file name in lower case
	$new_file_name = strtolower($emmm);
	// make file name in lower case
	
	$new_file_nameDos = strtolower($file);
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	$final_fileDos=str_replace(' ','-',$new_file_nameDos);
	
	
		if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		
		
	$agenda = sqlsrv_query($link, "DECLARE @id int;

INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT')
SELECT @id = SCOPE_IDENTITY();
insert into ab_historial (his_fecha, valor_arriendo, doc_codigo)
	VALUES ('$datetime', '$valor_arriendo', @id);");
		
		
		    if($agenda){
			     $message = "Convenio añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addConvenioMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
	
	
     sqlsrv_free_stmt($agenda);	
	
	 
	
	sqlsrv_close($link);
}
?>