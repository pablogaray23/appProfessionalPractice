<?php
  include("conexion.php");
  $link=conexion();

  $box_numero = $_POST["box_numero"];
  $box_piso = $_POST["box_piso"];
  
    if($box_piso=='Piso 1'){
	$box_piso='1';
	}elseif ($box_piso == 'Piso 2') {
	$box_piso = '2';
	} elseif ($box_piso == 'Piso 3') {
	$box_piso = '3';
	} else {
	$box_piso = '4';
	}
  
  $box_torre = $_POST["box_torre"];
  
      if($box_torre=='Torre Antigua'){
	$box_torre='1';
	} else {
	$box_torre = '2';
	}
  
  $box_ala = $_POST["box_ala"];
  
  $codigoA = $_POST["codigoA"];
  
   if (empty($_POST['box_numero'])) {
            $message = "Debe ingresar al menos un numero";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$yourURL="crearBox.php";
	echo ("<script>location.href='$yourURL'</script>");	 
        }elseif(!is_numeric($box_numero)){
			$message = "Numero Box debe contener solo numeros";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$yourURL="crearBox.php";
	echo ("<script>location.href='$yourURL'</script>");	 
		}elseif(strlen($box_numero)!=3){
			$message = "Numero Box debe contener max. 3 digitos ";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$yourURL="crearBox.php";
	echo ("<script>location.href='$yourURL'</script>");	 
		}
		else{
  
	  
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	$sqlDos =  "select * from ab_box where ab_box.box_numero = '$box_numero'";

	$buscar = sqlsrv_query($link, $sqlDos , $params, $options);

	$row_count = sqlsrv_num_rows( $buscar ); 
  
  if($row_count > 0){
	  $message = "Box con ese número existe";
	echo "<script type='text/javascript'>alert('$message');</script>";
	$yourURL="crearBox.php";
	echo ("<script>location.href='$yourURL'</script>");	  
	  
  }else{
	
	$usuario = sqlsrv_query($link,"INSERT INTO ab_box (box_numero,acb_codigo_actividad,box_piso,box_torre,box_ala) VALUES ('$box_numero', '$codigoA', '$box_piso', '$box_torre', '$box_ala');");

  if($usuario){
    $message = "Box creado correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "crearBox.php";
				 echo ("<script>location.href='$link'</script>");
			}else{
				json_encode('Ocurrio un error intentelo nuevamente');
			  }	
		}    
	}
  
  sqlsrv_free_stmt($usuario);
  sqlsrv_free_stmt($especialidad);
	sqlsrv_close($link);

?>