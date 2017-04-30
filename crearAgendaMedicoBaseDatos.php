<?php
  include("conexion.php");
  $link=conexion();

  $box_codigo = $_POST["box_codigo"];
  $rutMedico = $_POST["rutMedico"];
  
  $dia = $_POST["dia"];
  
  if($dia=='Lunes'){
	$dia='2';
	}elseif ($dia == 'Martes') {
	$dia = '3';
	} elseif ($dia == 'Miercoles') {
	$dia = '4';
	} elseif ($dia == 'Jueves') {
	$dia = '5';
	}  elseif ($dia == 'Viernes') {
	$dia = '6';
	} else {
	$dia = '7';
	}
	
	$horaInicio = $_POST["horaInicio"];
	//echo $horaInicio;
	//echo "</br>";
	
	$horaFin = $_POST["horaFin"];
	//echo $horaFin;
	//echo "</br>";
	
	
		$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


$queryInvestEspM= sqlsrv_query($link, "select * from ab_especialidad_prestador where ab_especialidad_prestador.PTD_RUT = '$rutMedico'");
  //$nmyestudiante = sqlsrv_num_rows($estudiante);
  $rowInvestEspM = sqlsrv_fetch_array($queryInvestEspM);
  $especialidadMedico = $rowInvestEspM['ESP_CODIGO'];
	
	
	
	$sql = "SELECT ab_agenda_detalle.agd_hora_inicio FROM ab_agenda_medico, ab_agenda_detalle 
	WHERE ab_agenda_medico.agm_codigo = ab_agenda_detalle.agm_codigo 
	AND ab_agenda_medico.box_codigo = '$box_codigo' AND ab_agenda_detalle.agd_dia = '$dia' ORDER BY ab_agenda_detalle.agd_hora_inicio ASC ";
	
	
	$buscarHoraInicio = sqlsrv_query($link, $sql, $params, $options);
	
	 if( $buscarHoraInicio === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
			
	$sqlDos = "SELECT ab_agenda_detalle.agd_hora_fin FROM ab_agenda_medico, ab_agenda_detalle 
	WHERE ab_agenda_medico.agm_codigo = ab_agenda_detalle.agm_codigo 
	AND ab_agenda_medico.box_codigo = '$box_codigo' AND ab_agenda_detalle.agd_dia = '$dia' ORDER BY ab_agenda_detalle.agd_hora_fin ASC ";
	
	$buscarHoraFin = sqlsrv_query($link, $sqlDos, $params, $options);
	
	 if( $buscarHoraFin === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
		
	$arrayHoras = array('480','510','540','570','600','630','660','690','720','750','780','810','840','870','900','930','960','990','1020'
	,'1050','1080','1110','1140','1170','1200','1230','1260','1290','1320','1350','1380','1410','1440');		
	
	 if($horaInicio=='8:00'){
	$horaInicio='480';
	}elseif ($horaInicio == '8:30') {
	$horaInicio = '510';
	} elseif ($horaInicio == '9:00') {
	$horaInicio = '540';
	} elseif ($horaInicio == '9:30') {
	$horaInicio = '570';
	}  elseif ($horaInicio == '10:00') {
	$horaInicio = '600';
	} elseif ($horaInicio == '10:30') {
	$horaInicio = '630';
	} elseif ($horaInicio == '11:00') {
	$horaInicio = '660';
	} elseif ($horaInicio == '11:30') {
	$horaInicio = '690';
	}  elseif ($horaInicio == '12:00') {
	$horaInicio = '720';
	}elseif ($horaInicio == '12:30') {
	$horaInicio = '750';
	} elseif ($horaInicio == '13:00') {
	$horaInicio = '780';
	} elseif ($horaInicio == '13:30') {
	$horaInicio = '810';
	}  elseif ($horaInicio == '14:00') {
	$horaInicio = '840';
	}elseif ($horaInicio == '14:30') {
	$horaInicio = '870';
	} elseif ($horaInicio == '15:00') {
	$horaInicio = '900';
	} elseif ($horaInicio == '15:30') {
	$horaInicio = '930';
	}  elseif ($horaInicio == '16:00') {
	$horaInicio = '960';
	} elseif ($horaInicio == '16:30') {
	$horaInicio = '990';
	} elseif ($horaInicio == '17:00') {
	$horaInicio = '1020';
	} elseif ($horaInicio == '17:30') {
	$horaInicio = '1050';
	}  elseif ($horaInicio == '18:00') {
	$horaInicio = '1080';
	} elseif ($horaInicio == '18:30') {
	$horaInicio = '1110';
	} elseif ($horaInicio == '19:00') {
	$horaInicio = '1140';
	} elseif ($horaInicio == '19:30') {
	$horaInicio = '1170';
	}  elseif ($horaInicio == '20:00') {
	$horaInicio = '1200';
	} elseif ($horaInicio == '20:30') {
	$horaInicio = '1230';
	} elseif ($horaInicio == '21:00') {
	$horaInicio = '1260';
	} elseif ($horaInicio == '21:30') {
	$horaInicio = '1290';
	}  elseif ($horaInicio == '22:00') {
	$horaInicio = '1320';
	} elseif ($horaInicio == '22:30') {
	$horaInicio = '1350';
	} elseif ($horaInicio == '23:00') {
	$horaInicio = '1380';
	} elseif ($horaInicio == '23:30') {
	$horaInicio = '1410';
	} else {
	$horaInicio = '1440';
	}
	
	
	 if($horaFin=='8:00'){
	$horaFin='480';
	}elseif ($horaFin == '8:30') {
	$horaFin = '510';
	} elseif ($horaFin == '9:00') {
	$horaFin = '540';
	} elseif ($horaFin == '9:30') {
	$horaFin = '570';
	}  elseif ($horaFin == '10:00') {
	$horaFin = '600';
	} elseif ($horaFin == '10:30') {
	$horaFin = '630';
	} elseif ($horaFin == '11:00') {
	$horaFin = '660';
	} elseif ($horaFin == '11:30') {
	$horaFin = '690';
	}  elseif ($horaFin == '12:00') {
	$horaFin = '720';
	}elseif ($horaFin == '12:30') {
	$horaFin = '750';
	} elseif ($horaFin == '13:00') {
	$horaFin = '780';
	} elseif ($horaFin == '13:30') {
	$horaFin = '810';
	}  elseif ($horaFin == '14:00') {
	$horaFin = '840';
	}elseif ($horaFin == '14:30') {
	$horaFin = '870';
	} elseif ($horaFin == '15:00') {
	$horaFin = '900';
	} elseif ($horaFin == '15:30') {
	$horaFin = '930';
	}  elseif ($horaFin == '16:00') {
	$horaFin = '960';
	} elseif ($horaFin == '16:30') {
	$horaFin = '990';
	} elseif ($horaFin == '17:00') {
	$horaFin = '1020';
	} elseif ($horaFin == '17:30') {
	$horaFin = '1050';
	}  elseif ($horaFin == '18:00') {
	$horaFin = '1080';
	} elseif ($horaFin == '18:30') {
	$horaFin = '1110';
	} elseif ($horaFin == '19:00') {
	$horaFin = '1140';
	} elseif ($horaFin == '19:30') {
	$horaFin = '1170';
	}  elseif ($horaFin == '20:00') {
	$horaFin = '1200';
	} elseif ($horaFin == '20:30') {
	$horaFin = '1230';
	} elseif ($horaFin == '21:00') {
	$horaFin = '1260';
	} elseif ($horaFin == '21:30') {
	$horaFin = '1290';
	}  elseif ($horaFin == '22:00') {
	$horaFin = '1320';
	} elseif ($horaFin == '22:30') {
	$horaFin = '1350';
	} elseif ($horaFin == '23:00') {
	$horaFin = '1380';
	} elseif ($horaFin == '23:30') {
	$horaFin = '1410';
	} else {
	$horaFin = '1440';
	}
	
	$estadoRe = $_POST["estadoRe"];
	
	if($estadoRe=='Pre - Reserva'){
				$estadoRe='1';
			}else{
				$estadoRe='2';
			}
			
	$valorEntrada = $horaInicio;
	//echo $valorEntrada;
		//echo "</br>";
	$valorEntradaDos = $horaFin;
	//	echo $valorEntradaDos;
	//echo "</br>";		

	 
	$enQueI = array_search($valorEntrada, $arrayHoras);
	//	echo "posision valor entrada en el array horas : ".$enQueI;
	//	echo "</br>";
	
	$enQueF = array_search($valorEntradaDos, $arrayHoras);
	//	echo "posision valor final en el array horas : ".$enQueF;
		//echo "</br>";
		
		
		
		
		$stackDos = array();		
		
			for ($k=$enQueI; $k<=$enQueF; $k++){
			
				$cuatro = $arrayHoras[$k];
				array_push($stackDos, $cuatro);
				
		//		echo "$cuatro \n" ;				
					
			}
			//echo "</br>";
		
		
	 

	if($valorEntrada == $valorEntradaDos){
		$esIgual = 1;
	}else{
		$esIgual = 0;
	}
	
	if($valorEntrada > $valorEntradaDos){
		$esMayor = 1;
	}else{
		$esMayor = 0;
	}
		
		 
	//echo "</br>";
	$intersectaFinal = 0;
	$entroAlWhile = 0;
	
		while ($rowUno = sqlsrv_fetch_array($buscarHoraInicio) and $row = sqlsrv_fetch_array($buscarHoraFin)){
		$agd_hora_inicio = $rowUno['agd_hora_inicio'];
		$agd_hora_fin = $row['agd_hora_fin'];
		
		
		$esInicio = array_search($agd_hora_inicio, $arrayHoras) + 1 ;
		//echo "es inicio : ".$esInicio;
		//echo "</br>";
		$esFin = array_search($agd_hora_fin, $arrayHoras) - 1 ;
		//echo "es fin : ".$esFin;
		//echo "</br>";
		
		$stack = array();		
		
			for ($k=$esInicio; $k<=$esFin; $k++){
			
				$tres = $arrayHoras[$k];
				array_push($stack, $tres);
				
			//	echo "$tres \n" ;				
					
			}
	//		echo "</br>";
			
	//print_r($stack);	
	
	//echo "</br>";	
	
	//echo "primer valor del array horas : ".$arrayHoras[$esInicio];
	
	//echo "</br>";	
	
	//echo "ultimo valor del array horas : ".$arrayHoras[$esFin];
	
	//echo "</br>";
	
	if($arrayHoras[$esInicio]==$valorEntradaDos){
	//	echo "el valor ".$arrayHoras[$esInicio]." es igual al valor final ".$valorEntradaDos." ";
		//echo "</br>";
	}else{
	//	echo "el valor ".$arrayHoras[$esInicio]." no es igual al valor final ".$valorEntradaDos." ";
	//	echo "</br>";
	}
	
	if($arrayHoras[$esFin]==$valorEntrada){
		//echo "el valor ".$arrayHoras[$esFin]." es igual al valor inicial ".$valorEntrada." ";
		//echo "</br>";
	}else{
		//echo "el valor ".$arrayHoras[$esFin]." no es igual al valor inicial ".$valorEntrada." ";
		//echo "</br>";
	}
			
			
			$mostrar=array_intersect($stack,$stackDos);
	//echo "aqui muestro el array mostrar intersectar ";
//print_r($mostrar);
			
	//echo "</br>";
	
	
	
	$intersecta = 1;
	//echo "</br>";

// || $emmm==1 || $emmmDos==1
	if(empty($mostrar)){
		$intersectaFinal + 0;
	//	echo $intersectaFinal;
		//echo "</br>";
		//echo "</br>";
	}else{
		$intersectaFinal= $intersectaFinal + $intersecta;
		//echo $intersectaFinal;
		//echo "</br>";
		//echo "</br>";
	}
	
		$entroAlWhile= $entroAlWhile + 1;
		
		//echo "entro al while : ".$entroAlWhile." vez ";
		//echo "</br>";	
			
		//echo "al final del while intersectaFinal es : ". $intersectaFinal;
		//echo "</br>";
		//echo "</br>";
	
		
	}
	
	
	
	$sizeblocksInicio = sqlsrv_num_rows($buscarHoraInicio);
	
	
	//echo "tamanio de  blocksInicio es ".$sizeblocksInicio;
	//echo "</br>";
	
	
	if($valorEntrada=='480'){
							$valorEntrada='8:00';
							}elseif ($valorEntrada == '510') {
							$valorEntrada = '8:30';
							} elseif ($valorEntrada == '540') {
							$valorEntrada = '9:00';
							} elseif ($valorEntrada == '570') {
							$valorEntrada = '9:30';
							}  elseif ($valorEntrada == '600') {
							$valorEntrada = '10:00';
							} elseif ($valorEntrada == '630') {
							$valorEntrada = '10:30';
							} elseif ($valorEntrada == '660') {
							$valorEntrada = '11:00';
							} elseif ($valorEntrada == '690') {
							$valorEntrada = '11:30';
							}  elseif ($valorEntrada == '720') {
							$valorEntrada = '12:00';
							}elseif ($valorEntrada == '750') {
							$valorEntrada = '12:30';
							} elseif ($valorEntrada == '780') {
							$valorEntrada = '13:00';
							} elseif ($valorEntrada == '810') {
							$valorEntrada = '13:30';
							}  elseif ($valorEntrada == '840') {
							$valorEntrada = '14:00';
							}elseif ($valorEntrada == '870') {
							$valorEntrada = '14:30';
							} elseif ($valorEntrada == '900') {
							$valorEntrada = '15:00';
							} elseif ($valorEntrada == '930') {
							$valorEntrada = '15:30';
							}  elseif ($valorEntrada == '960') {
							$valorEntrada = '16:00';
							} elseif ($valorEntrada == '990') {
							$valorEntrada = '16:30';
							} elseif ($valorEntrada == '1020') {
							$valorEntrada = '17:00';
							} elseif ($valorEntrada == '1050') {
							$valorEntrada = '17:30';
							}  elseif ($valorEntrada == '1080') {
							$valorEntrada = '18:00';
							} elseif ($valorEntrada == '1110') {
							$valorEntrada = '18:30';
							} elseif ($valorEntrada == '1140') {
							$valorEntrada = '19:00';
							} elseif ($valorEntrada == '1170') {
							$valorEntrada = '19:30';
							}  elseif ($valorEntrada == '1200') {
							$valorEntrada = '20:00';
							} elseif ($valorEntrada == '1230') {
							$valorEntrada = '20:30';
							} elseif ($valorEntrada == '1260') {
							$valorEntrada = '21:00';
							} elseif ($valorEntrada == '1290') {
							$valorEntrada = '21:30';
							}  elseif ($valorEntrada == '1320') {
							$valorEntrada = '22:00';
							} elseif ($valorEntrada == '1350') {
							$valorEntrada = '22:30';
							} elseif ($valorEntrada == '1380') {
							$valorEntrada = '23:00';
							} elseif ($valorEntrada == '1410') {
							$valorEntrada = '23:30';
							} else {
							$valorEntrada = '24:00';
							}
		if($valorEntradaDos=='480'){
							$valorEntradaDos='8:00';
							}elseif ($valorEntradaDos == '510') {
							$valorEntradaDos = '8:30';
							} elseif ($valorEntradaDos == '540') {
							$valorEntradaDos = '9:00';
							} elseif ($valorEntradaDos == '570') {
							$valorEntradaDos = '9:30';
							}  elseif ($valorEntradaDos == '600') {
							$valorEntradaDos = '10:00';
							} elseif ($valorEntradaDos == '630') {
							$valorEntradaDos = '10:30';
							} elseif ($valorEntradaDos == '660') {
							$valorEntradaDos = '11:00';
							} elseif ($valorEntradaDos == '690') {
							$valorEntradaDos = '11:30';
							}  elseif ($valorEntradaDos == '720') {
							$valorEntradaDos = '12:00';
							}elseif ($valorEntradaDos == '750') {
							$valorEntradaDos = '12:30';
							} elseif ($valorEntradaDos == '780') {
							$valorEntradaDos = '13:00';
							} elseif ($valorEntradaDos == '810') {
							$valorEntradaDos = '13:30';
							}  elseif ($valorEntradaDos == '840') {
							$valorEntradaDos = '14:00';
							}elseif ($valorEntradaDos == '870') {
							$valorEntradaDos = '14:30';
							} elseif ($valorEntradaDos == '900') {
							$valorEntradaDos = '15:00';
							} elseif ($valorEntradaDos == '930') {
							$valorEntrada = '15:30';
							}  elseif ($valorEntrada == '960') {
							$valorEntradaDos = '16:00';
							} elseif ($valorEntradaDos == '990') {
							$valorEntradaDos = '16:30';
							} elseif ($valorEntradaDos == '1020') {
							$valorEntradaDos = '17:00';
							} elseif ($valorEntradaDos == '1050') {
							$valorEntradaDos = '17:30';
							}  elseif ($valorEntradaDos == '1080') {
							$valorEntradaDos = '18:00';
							} elseif ($valorEntradaDos == '1110') {
							$valorEntradaDos = '18:30';
							} elseif ($valorEntradaDos == '1140') {
							$valorEntradaDos = '19:00';
							} elseif ($valorEntradaDos == '1170') {
							$valorEntradaDos = '19:30';
							}  elseif ($valorEntradaDos == '1200') {
							$valorEntradaDos = '20:00';
							} elseif ($valorEntradaDos == '1230') {
							$valorEntradaDos = '20:30';
							} elseif ($valorEntradaDos == '1260') {
							$valorEntradaDos = '21:00';
							} elseif ($valorEntradaDos == '1290') {
							$valorEntradaDos = '21:30';
							}  elseif ($valorEntradaDos == '1320') {
							$valorEntradaDos = '22:00';
							} elseif ($valorEntradaDos == '1350') {
							$valorEntradaDos = '22:30';
							} elseif ($valorEntradaDos == '1380') {
							$valorEntradaDos = '23:00';
							} elseif ($valorEntradaDos == '1410') {
							$valorEntradaDos = '23:30';
							} else {
							$valorEntradaDos = '24:00';
							}
		
	
		//echo $final;
	//echo "el final de intersecta es ". $intersectaFinal;
	//$asignarColorReserva = "</br>";	
	//$asignarColorLetra = " El día tiene $sizeblocksInicio agendas";
	
	if($intersectaFinal!=0 ||  $esIgual==1 || $esMayor==1){
		
		
		  if($esIgual==1){
				$message = " Hora Inicio $valorEntrada y Hora Final $valorEntradaDos no pueden ser iguales";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$yourURL="crearAgendaMedico.php?box_codigo=$box_codigo";
				echo ("<script>location.href='$yourURL'</script>");	 
			} elseif ($esMayor==1) {
				$message = " Hora Inicio $valorEntrada no puede ser mayor a Hora Final $valorEntradaDos ";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$yourURL="crearAgendaMedico.php?box_codigo=$box_codigo";
				echo ("<script>location.href='$yourURL'</script>");	
			}   elseif ($intersectaFinal!=0) {
				$message = " Agenda Médica a crear intersecta alguna existente ";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$yourURL="crearAgendaMedico.php?box_codigo=$box_codigo";
				echo ("<script>location.href='$yourURL'</script>");	 
			}  else {
				$message = " agenda existe ";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$yourURL="crearAgendaMedico.php?box_codigo=$box_codigo";
				echo ("<script>location.href='$yourURL'</script>");	 
			}
		
		
	}else{	
			$agenda = sqlsrv_query($link, "DECLARE @id int, @idDos int;

insert into ab_agenda_medico (box_codigo, PTD_RUT) VALUES ('$box_codigo','$rutMedico')
SELECT @id = SCOPE_IDENTITY();
INSERT INTO ab_agenda_detalle (agd_dia, agd_hora_inicio, agd_hora_fin, est_codigo, agm_codigo) 
	VALUES ('$dia', '$horaInicio', '$horaFin', '$estadoRe', @id)
	SELECT @idDos = SCOPE_IDENTITY();
	
	insert into ab_box_especialidad (esp_codigo, box_codigo, agd_id_agendaDetalle) 
	values ('$especialidadMedico', '$box_codigo', @idDos) ;");	
	

  if($agenda){
    $message = "Agenda creada correctamente";
				echo "<script type='text/javascript'>alert('$message');</script>";
				 $link = "crearAgendaMedico.php?box_codigo=$box_codigo";
				// box_codigo=$box_codigo
				 echo ("<script>location.href='$link'</script>");
			}else{
				json_encode('Ocurrio un error intentelo nuevamente');
			  }  
	}  
	
	  
	sqlsrv_close($link);

?>