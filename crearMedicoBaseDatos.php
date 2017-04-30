<?php
 include("conexion.php");
  $link=conexion();
    if (isset($_POST["submit"])) {
        $PTD_RUT = $_POST["PTD_RUT"];
		  $PTD_NOMBRE = $_POST["PTD_NOMBRE"];
		  $PTD_APELLIDOP = $_POST["PTD_APELLIDOP"];
		  $PTD_APELLIDOM = $_POST["PTD_APELLIDOM"];
		  
		  $CORREO = $_POST["CORREO"];
		  $PTD_DIRECCION = $_POST["PTD_DIRECCION"];
		  $codigoA = $_POST["codigoA"];
		  
		  
		  $unaParte = substr($PTD_RUT, 0, -1);
		  $unaParteDos = substr($PTD_RUT, -1);
	//	  echo $unaParte;
		  
		  $largo = strlen($PTD_RUT);
		  $findme = 'k';
		  $pos = strpos($unaParteDos, $findme);
		  
		
 
        // Check if name has been entered
        if (empty($_POST['PTD_RUT'])) {
            $message = "Debe ingresar al menos un rut";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$yourURL="crearMedico.php?PTD_RUT=#";
	echo ("<script>location.href='$yourURL'</script>");	
        }elseif(!is_numeric($unaParte) && $pos === false){
			$message = "R.U.T. debe contener solo numeros";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$yourURL="crearMedico.php?PTD_RUT=$PTD_RUT";
	echo ("<script>location.href='$yourURL'</script>");	
		} else{
			    	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	$sqlDos =  "select * from ab_prestador where ab_prestador.PTD_RUT = '$PTD_RUT'";

	$buscar = sqlsrv_query($link, $sqlDos , $params, $options);

	$row_count = sqlsrv_num_rows( $buscar ); 
  
  if($row_count > 0){
	  $message = "Medico existe, ingresar denuevo";
	echo "<script type='text/javascript'>alert('$message');</script>";
	$yourURL="crearMedico.php?PTD_RUT=$PTD_RUT";
	echo ("<script>location.href='$yourURL'</script>");	 
	  
  }else{
	
	$usuario = sqlsrv_query($link, "INSERT INTO ab_prestador (PTD_RUT,PTD_NOMBRE,CORREO,PTD_APELLIDOP,PTD_APELLIDOM,PTD_DIRECCION) VALUES ('$PTD_RUT', '$PTD_NOMBRE', '$CORREO', '$PTD_APELLIDOP', '$PTD_APELLIDOM', '$PTD_DIRECCION');");
	
	$especialidad = sqlsrv_query($link, "INSERT INTO ab_especialidad_prestador (PTD_RUT, ESP_CODIGO) VALUES ('$PTD_RUT', '$codigoA');");

  if($usuario and $especialidad){
	
    $message = "Medico creado correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "modificarMedico.php?PTD_RUT=$PTD_RUT";
				 echo ("<script>location.href='$link'</script>");
			}else{
				json_encode('Ocurrio un error intentelo nuevamente');
			  }	
  }   
		}
	sqlsrv_free_stmt($usuario);
    sqlsrv_free_stmt($especialidad);
	
      
 

}else{
	$PTD_RUT = $_POST["PTD_RUT"];
	
	  $buscarMedico = "select * from ab_prestador where ab_prestador.PTD_RUT = '$PTD_RUT'";
	  
	  $params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	$buscar = sqlsrv_query($link, $buscarMedico , $params, $options);

	$row_count = sqlsrv_num_rows( $buscar ); 
  
  if($row_count == 0){
	  
	  $message = " No existe medico";
				echo "<script type='text/javascript'>alert('$message');</script>";
	  
	$yourURL="crearMedico.php?PTD_RUT=$PTD_RUT";
	echo ("<script>location.href='$yourURL'</script>");	 
	  
	
	  
  }else{
	   $message = "Medico existe";
	echo "<script type='text/javascript'>alert('$message');</script>";
	  
	  $link = "modificarMedico.php?PTD_RUT=$PTD_RUT";
	echo ("<script>location.href='$link'</script>");  
	
  } 
}

sqlsrv_close($link);
    
?>