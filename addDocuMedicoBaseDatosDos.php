<?php

header('Content-Type: text/html; charset=utf-8');

include("conexion.php");
	$link=conexion();
if(isset($_POST['btn-uploadUno']))
{    
	$nivel = '1';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileCurriculum']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileCurriculum']['tmp_name'];
	$file_size = $_FILES[ 'fileCurriculum']['size'];
	$file_type = $_FILES['fileCurriculum']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Curriculum añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}elseif(isset($_POST['btn-uploadDos']))
{
		$nivel = '2';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileFotoT']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileFotoT']['tmp_name'];
	$file_size = $_FILES[ 'fileFotoT']['size'];
	$file_type = $_FILES['fileFotoT']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Fotocopia Título añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
	
	
}elseif(isset($_POST['btn-uploadTres']))
{
		$nivel = '3';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileFotoC']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileFotoC']['tmp_name'];
	$file_size = $_FILES[ 'fileFotoC']['size'];
	$file_type = $_FILES['fileFotoC']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Fotocopia Carnet añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}elseif(isset($_POST['btn-uploadCuatro']))
{
		$nivel = '4';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileFotoCV']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileFotoCV']['tmp_name'];
	$file_size = $_FILES[ 'fileFotoCV']['size'];
	$file_type = $_FILES['fileFotoCV']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Fotocopia Carnet Vacunación añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}elseif(isset($_POST['btn-uploadCinco']))
{
		$nivel = '5';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileCertCap']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileCertCap']['tmp_name'];
	$file_size = $_FILES[ 'fileCertCap']['size'];
	$file_type = $_FILES['fileCertCap']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Certificados de Capacitación añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}elseif(isset($_POST['btn-uploadSeis']))
{
		$nivel = '6';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileCursoA']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileCursoA']['tmp_name'];
	$file_size = $_FILES[ 'fileCursoA']['size'];
	$file_type = $_FILES['fileCursoA']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Cursos Asoc. Esp. añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}else
{
		$nivel = '7';
	
	$PTD_RUT = $_POST["PTD_RUT"];
	
	$lala = $_FILES['fileOtros']['name'];
	$fecha = date("d-m-Y");
     
	     // Check if name has been entered
        if (empty($lala)) {
            $message = "Debe seleccionar al menos un archivo";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
        } else{
			    		$file = $PTD_RUT." ".$fecha." ".$lala;
    $file_loc = $_FILES['fileOtros']['tmp_name'];
	$file_size = $_FILES[ 'fileOtros']['size'];
	$file_type = $_FILES['fileOtros']['type'];
	$folder="uploads/";
	
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
		  $usuario = sqlsrv_query($link,"INSERT INTO ab_documento (doc_file, doc_type, doc_size, nivel, PTD_RUT) VALUES ('$final_fileDos', '$file_type', '$new_size', '$nivel', '$PTD_RUT');");
		  
		    if($usuario){
			     $message = "Archivo añadido correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "addFileMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
				 
			}else{
				echo json_encode('Ocurrio un error intentelo nuevamente');
			  }
		
	}
	else
	{
		
	}
		}
	
	
     sqlsrv_free_stmt($usuario);
	
}

sqlsrv_close($link);

?>