<?php
session_start();
include_once ('conexion.php');

if(!isset($_SESSION['user']))
{
	header("Location: login.html");
}

if($_SESSION['perfil']==1){
	
}elseif($_SESSION['perfil']==2){
	$message = "usted no puede ver esta pagina";
	//session_start();
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: indexCallCenter.php");	
}
else{
	$message = "usted no puede ver esta pagina";
	//session_start();
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: indexCentroMedico.php");
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gestion Médico</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  
  
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.min.css">
<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-blue sidebar-mini">
  
  
  	<?php
	
	//include("conexion.php");
	$conexion=conexion();
	
	$PTD_RUT=      $_GET['PTD_RUT'];
	
	$sql = "SELECT * FROM ab_prestador where
ab_prestador.PTD_RUT = '$PTD_RUT'";
	
		
	$rs = sqlsrv_query($conexion, $sql);
  
  if( $rs === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
	
	
	

	$sqlDos = "select * from especialidad";
	
		
	$rsDos = sqlsrv_query($conexion, $sqlDos);
	
  
  if( $rsDos === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
	
	
	$sqlTres = "select  * from ab_especialidad_prestador , especialidad
WHERE especialidad.ESP_CODIGO = ab_especialidad_prestador.ESP_CODIGO AND
ab_especialidad_prestador.PTD_RUT = '$PTD_RUT'";
	
	
	$rsTres = sqlsrv_query($conexion, $sqlTres);
  
  if( $rsTres === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
	
	$sqlCinco = "SELECT * FROM ab_agenda_medico, ab_agenda_detalle, ab_box
where ab_agenda_medico.agm_codigo = ab_agenda_detalle.agm_codigo
AND ab_agenda_medico.box_codigo = ab_box.box_codigo
AND ab_agenda_medico.PTD_RUT = '$PTD_RUT'";
	
	
	$rsCinco = sqlsrv_query($conexion, $sqlCinco);
  
  if( $rsCinco === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
	
	
	?>
  

    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>línica<b>C</b>hillán</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>C</b>línica<b>C</b>hillán</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="dist/img/avatar5.png" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Administrador</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <p>
                      Administrador
                      <small>Gestión Datos Clínica Chillán</small>
					  <small><?php echo $_SESSION['user']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                     <div class="pull-right">
                      <a href="cerrarSesion.php?logout"  class="btn btn-default btn-flat" id="logout" >Cerrar Sesi&oacute;n</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Administrador</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
            </div>
          </div>
 <!-- Sidebar Menu -->
        
		        <ul class="sidebar-menu">
            <li class="header">Gesti&oacute;n Datos</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview active">
              <a href="#"><i class='fa fa-user'></i> <span> Médicos </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			  <li ><a  href='crearMedico.php?PTD_RUT="#"'> Crear Médico </a></li>
			   <li ><a  href="medicoGestionar.php"> Gestionar Médico </a></li>
				<li ><a  href="adddirDocumentoMedico.php"> Antecedentes Médicos </a></li>
				<li class="active" ><a  href="medicoVerAgendas.php"> Agenda Médica y Convenio </a></li>
				<li ><a  href="createAgendaMedicaAdmin.php"> Crear Agenda por Médico </a></li>
              </ul>
            </li>
			
			 
			     <li class="treeview">
              <a href="#"><i class='fa fa-home'></i> <span> Box </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a  href="crearBox.php"> Crear un Box </a></li>
				<li><a  href="boxGestionar.php"> Gestionar Box </a></li>
				<li><a  href="verBoxCuadricula.php"> Ver Todos Boxs </a></li>
					<li><a  href="boxVerPorEspAdmin.php"> Ver Boxs Por Esp. </a></li>
				<li><a  href="verBoxTorreANorte.php"> Ver Boxs Torre Antigua - Ala Norte </a></li>
				<li><a  href="verBoxTorreASur.php"> Ver Boxs Torre Antigua - Ala Sur </a></li>
              </ul>
            </li>


          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gesti&oacute;n
            <small> Convenio Médico </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Médico</li>
			 <li class="active">Convenio</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
      <div class="box box-info">
                <div class="box-header with-border">
                  <center>
				  <h3 class="box-title"> Ver Horario Agenda Médica</h3>
				  </center>
                </div>
                <div class="box-body">
        <div class="col-lg-6 col-lg-offset-3">
		
		
		
						<?php
						while ($row = sqlsrv_fetch_array($rs))
						{
						$PTD_RUT = $row['PTD_RUT'];
						$PTD_NOMBRE = $row['PTD_NOMBRE'];
						$PTD_APELLIDOP = $row['PTD_APELLIDOP'];
						$PTD_APELLIDOM = $row['PTD_APELLIDOM'];
						$nombre = "".$PTD_NOMBRE."  ".$PTD_APELLIDOP."  ".$PTD_APELLIDOM."";
						
						$PTD_DIRECCION = $row['PTD_DIRECCION'];
						$CORREO = $row['CORREO'];
						?>
						

                  

                  
                  <form method="post" enctype="multipart/form-data" action="reporte_historial.php" target="_blank">
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> R.U.T. Médico </p></span>
                    <input  id="PTD_RUT" name="PTD_RUT" value="<?php echo $PTD_RUT; ?>" class="form-control" readonly="readonly" placeholder="Código Box" type="email">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon"><p> Nombre Médico</p></span>
                    <input  id="PTD_NOMBRE"  value="<?php echo $nombre; ?>" class="form-control" readonly="readonly" placeholder="Nombre Médico" type="email">
                  </div>
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Dirección Médico </p></span>
                    <input  id="EDAD" name="EDAD" value="<?php echo $PTD_DIRECCION; ?>" class="form-control" readonly="readonly" placeholder="Dirección Médico" type="email">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon"><p> E - Mail Médico</p></span>
                    <input  id="CORREO"  value="<?php echo $CORREO; ?>" class="form-control" readonly="readonly" placeholder="Email Médico" type="email">
                  </div>
				  
				   <div class="input-group">
                    <span class="input-group-addon"><p> Valor Arriendo </p></span>
                    <input type="text" class="form-control" id="valor_arriendo" name="valor_arriendo" placeholder="Valor Arriendo" >
					
					
					
                  </div>
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Especialidades </p></span>
                  </div>
				  
				  
				   <table id="example1" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th><center> Nombre Especialidad </center></th>
                      </tr>
                    </thead>
                    <tbody>
					<tr>
						<?php
						while ($rowTres = sqlsrv_fetch_array($rsTres))
						{
						$ESP_CODIGO = $rowTres['ESP_CODIGO'];
						$ESP_NOMBRE = $rowTres['ESP_NOMBRE'];
						?>

						<td><?php echo $ESP_NOMBRE; ?></td>					
					</tr>
						<?php
						}
						
						?>
					</tbody>
				</table>
				
				<center>
				<div id="datepicker"></div>
					<div id="datos">
						<label for='fecha'>Fecha:</label>
						<!-- Campo de texto que recibira el valor seleccionado en el datepicker 
						le he puesto el atributo readonly para no poder escribir directamente -->
						<input type='text' name='fecha' id='fecha' value="<?php echo date("d-m-Y"); ?>" readonly />
					</div>
				</center>
				
				<div class="input-group">
                    <span class="input-group-addon"><p> Agenda Médica </p></span>
                  </div>
				
					   <table id="example1" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th><center> Día Semana </center></th>
                        <th><center> Número Box </center></th>
						<th><center> Horario Desde </center></th>
						<th><center> Horario Hasta </center></th>
						<th><center> Estado </center></th>
                      </tr>
                    </thead>
                    <tbody>
					<tr>
						<?php
						
	
						$resultado = 0;
						
						while ($rowCinco = sqlsrv_fetch_array($rsCinco))
						{
						$agd_dia = $rowCinco['agd_dia'];
						if($agd_dia=='2'){
						$agd_dia='Lunes';
						}elseif ($agd_dia == '3') {
						$agd_dia = 'Martes';
						} elseif ($agd_dia == '4') {
						$agd_dia = 'Miercoles';
						} elseif ($agd_dia == '5') {
						$agd_dia = 'Jueves';
						}  elseif ($agd_dia == '6') {
						$agd_dia = 'Viernes';
						} else {
						$agd_dia = 'Sabado';
						}
						$box_numero = $rowCinco['box_numero'];
						$agd_hora_inicio = $rowCinco['agd_hora_inicio'];
						$agd_hora_fin = $rowCinco['agd_hora_fin'];
						
						
					
						
						$arrayHorasTodas = array('480','510','540','570','600','630','660','690','720','750','780','810','840','870','900','930','960','990','1020'
	,'1050','1080','1110','1140','1170','1200','1230','1260','1290','1320','1350','1380','1410','1440');	
						
						$arrayHorasFijas = array('480','540','600','660','720','780','840','900','960','1020','1080','1140','1200','1260','1320','1380','1440');
						
						if( is_array($arrayHorasFijas) && in_array($agd_hora_inicio, $arrayHorasFijas) ){
						//	echo "el valor de entrada $agd_hora_inicio existe en el nuevo array";
						//	echo "</br>";
						}else{
						//	echo "el valor de entrada $agd_hora_inicio no existe en el nuevo array";
						//	echo "</br>";
						}
						
						if( is_array($arrayHorasFijas) && in_array($agd_hora_fin, $arrayHorasFijas) ){
						//	echo "el valor de entrada $agd_hora_fin existe en el nuevo array";
						//	echo "</br>";
						}else{
						//	echo "el valor de entrada $agd_hora_fin no existe en el nuevo array";
						//	echo "</br>";
						}
						
						$esInicio = array_search($agd_hora_inicio, $arrayHorasTodas);
						//echo "es inicio : ".($esInicio+1);
						//echo "</br>";
						$esFin = array_search($agd_hora_fin, $arrayHorasTodas);
						//echo "es fin : ".($esFin+1);
						//echo "</br>";
						$diferenciaIni = ($esFin+1)-($esInicio+1);
						//echo "diferencia : ".$diferenciaIni;
						//echo "</br>";
						
						$division = $diferenciaIni/2;
						//echo "division : ".$division;
						//echo "</br>";
						$resultado =$resultado + $division;
						
						//$resultado++;
						//$resultado++;
						
						 if($agd_hora_inicio=='480'){
							$agd_hora_inicio='8:00';
							}elseif ($agd_hora_inicio == '510') {
							$agd_hora_inicio = '8:30';
							} elseif ($agd_hora_inicio == '540') {
							$agd_hora_inicio = '9:00';
							} elseif ($agd_hora_inicio == '570') {
							$agd_hora_inicio = '9:30';
							}  elseif ($agd_hora_inicio == '600') {
							$agd_hora_inicio = '10:00';
							} elseif ($agd_hora_inicio == '630') {
							$agd_hora_inicio = '10:30';
							} elseif ($agd_hora_inicio == '660') {
							$agd_hora_inicio = '11:00';
							} elseif ($agd_hora_inicio == '690') {
							$agd_hora_inicio = '11:30';
							}  elseif ($agd_hora_inicio == '720') {
							$agd_hora_inicio = '12:00';
							}elseif ($agd_hora_inicio == '750') {
							$agd_hora_inicio = '12:30';
							} elseif ($agd_hora_inicio == '780') {
							$agd_hora_inicio = '13:00';
							} elseif ($agd_hora_inicio == '810') {
							$agd_hora_inicio = '13:30';
							}  elseif ($agd_hora_inicio == '840') {
							$agd_hora_inicio = '14:00';
							}elseif ($agd_hora_inicio == '870') {
							$agd_hora_inicio = '14:30';
							} elseif ($agd_hora_inicio == '900') {
							$agd_hora_inicio = '15:00';
							} elseif ($agd_hora_inicio == '930') {
							$agd_hora_inicio = '15:30';
							}  elseif ($agd_hora_inicio == '960') {
							$agd_hora_inicio = '16:00';
							} elseif ($agd_hora_inicio == '990') {
							$agd_hora_inicio = '16:30';
							} elseif ($agd_hora_inicio == '1020') {
							$agd_hora_inicio = '17:00';
							} elseif ($agd_hora_inicio == '1050') {
							$agd_hora_inicio = '17:30';
							}  elseif ($agd_hora_inicio == '1080') {
							$agd_hora_inicio = '18:00';
							} elseif ($agd_hora_inicio == '1110') {
							$agd_hora_inicio = '18:30';
							} elseif ($agd_hora_inicio == '1140') {
							$agd_hora_inicio = '19:00';
							} elseif ($agd_hora_inicio == '1170') {
							$agd_hora_inicio = '19:30';
							}  elseif ($agd_hora_inicio == '1200') {
							$agd_hora_inicio = '20:00';
							} elseif ($agd_hora_inicio == '1230') {
							$agd_hora_inicio = '20:30';
							} elseif ($agd_hora_inicio == '1260') {
							$agd_hora_inicio = '21:00';
							} elseif ($agd_hora_inicio == '1290') {
							$agd_hora_inicio = '21:30';
							}  elseif ($agd_hora_inicio == '1320') {
							$agd_hora_inicio = '22:00';
							} elseif ($agd_hora_inicio == '1350') {
							$agd_hora_inicio = '22:30';
							} elseif ($agd_hora_inicio == '1380') {
							$agd_hora_inicio = '23:00';
							} elseif ($agd_hora_inicio == '1410') {
							$agd_hora_inicio = '23:30';
							} else {
							$agd_hora_inicio = '24:00';
							}
						
						 if($agd_hora_fin=='480'){
							$agd_hora_fin='8:00';
							}elseif ($agd_hora_fin == '510') {
							$agd_hora_fin = '8:30';
							} elseif ($agd_hora_fin == '540') {
							$agd_hora_fin = '9:00';
							} elseif ($agd_hora_fin == '570') {
							$agd_hora_fin = '9:30';
							}  elseif ($agd_hora_fin == '600') {
							$agd_hora_fin = '10:00';
							} elseif ($agd_hora_fin == '630') {
							$agd_hora_fin = '10:30';
							} elseif ($agd_hora_fin == '660') {
							$agd_hora_fin = '11:00';
							} elseif ($agd_hora_fin == '690') {
							$agd_hora_fin = '11:30';
							}  elseif ($agd_hora_fin == '720') {
							$agd_hora_fin = '12:00';
							}elseif ($agd_hora_fin == '750') {
							$agd_hora_fin = '12:30';
							} elseif ($agd_hora_fin == '780') {
							$agd_hora_fin = '13:00';
							} elseif ($agd_hora_fin == '810') {
							$agd_hora_fin = '13:30';
							}  elseif ($agd_hora_fin == '840') {
							$agd_hora_fin = '14:00';
							}elseif ($agd_hora_fin == '870') {
							$agd_hora_fin = '14:30';
							} elseif ($agd_hora_fin == '900') {
							$agd_hora_fin = '15:00';
							} elseif ($agd_hora_fin == '930') {
							$agd_hora_fin = '15:30';
							}  elseif ($agd_hora_fin == '960') {
							$agd_hora_fin = '16:00';
							} elseif ($agd_hora_fin == '990') {
							$agd_hora_fin = '16:30';
							} elseif ($agd_hora_fin == '1020') {
							$agd_hora_fin = '17:00';
							} elseif ($agd_hora_fin == '1050') {
							$agd_hora_fin = '17:30';
							}  elseif ($agd_hora_fin == '1080') {
							$agd_hora_fin = '18:00';
							} elseif ($agd_hora_fin == '1110') {
							$agd_hora_fin = '18:30';
							} elseif ($agd_hora_fin == '1140') {
							$agd_hora_fin = '19:00';
							} elseif ($agd_hora_fin == '1170') {
							$agd_hora_fin = '19:30';
							}  elseif ($agd_hora_fin == '1200') {
							$agd_hora_fin = '20:00';
							} elseif ($agd_hora_fin == '1230') {
							$agd_hora_fin = '20:30';
							} elseif ($agd_hora_fin == '1260') {
							$agd_hora_fin = '21:00';
							} elseif ($agd_hora_fin == '1290') {
							$agd_hora_fin = '21:30';
							}  elseif ($agd_hora_fin == '1320') {
							$agd_hora_fin = '22:00';
							} elseif ($agd_hora_fin == '1350') {
							$agd_hora_fin = '22:30';
							} elseif ($agd_hora_fin == '1380') {
							$agd_hora_fin = '23:00';
							} elseif ($agd_hora_fin == '1410') {
							$agd_hora_fin = '23:30';
							} else {
							$agd_hora_fin = '24:00';
							}
						
						$est_codigo = $rowCinco['est_codigo'];
						
						if($est_codigo=='1'){
							$est_codigo='Pre - Reserva';
						}else{
							$est_codigo='Confirmada';
						}
						
						?>

						<td><?php echo $agd_dia; ?></td>
						<td><?php echo $box_numero; ?></td>
						<td><?php echo $agd_hora_inicio; ?></td>						
						 <td><?php echo $agd_hora_fin; ?></td>	
						 <td><?php echo $est_codigo; ?></td>	
					</tr>
						<?php
						
						
						}
						
						?>
					</tbody>
				</table>
                  <div class="row">
           
                  <div class="row">
				  
				     <table id="example1" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th><center> Total de Horas </center></th>
                      </tr>
                    </thead>
                    <tbody>
					<tr>
					

						<td><?php echo $resultado; ?></td>				
					</tr>
					</tbody>
				</table>
				  
          </div><!-- /.col-lg-6 -->
           <div class="box-footer">
                   <center><input type="submit" name="btn-upload" value="Generar Convenio"></center>
				  
				  

			 </div><!-- /.col-lg-6 -->	  
				  </form>
				  
						<?php
						
						
						
						
						
						}
						
						?>



                 
		  
		  
		    
		  
                  </div><!-- /.row -->

                  </div><!-- /input-group -->
        
                </div><!-- /.box-body -->
            

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">ClínicaChillán</a>.</strong> Todos los derechos reservados.
      </footer>
      
     
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
	
	<script>
	$( "#datepicker" ).datepicker({
		// Formato de la fecha
		dateFormat: "dd-mm-yy",
		// Primer dia de la semana El lunes
		firstDay: 1,
		// Dias Largo en castellano
		dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
		// Dias cortos en castellano
		dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
		// Nombres largos de los meses en castellano
		monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		// Nombres de los meses en formato corto 
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
		// Cuando seleccionamos la fecha esta se pone en el campo Input 
		onSelect: function(dateText) { 
			  $('#fecha').val(dateText);
		  }
	});
	</script>

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		var elems = document.getElementsByClassName('confirmation');
		var confirmIt = function (e) {
			if (!confirm('¿Desea eliminar especialidad al médico?')) e.preventDefault();
		};
		for (var i = 0, l = elems.length; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		}
	</script>
	
  
  </body>
</html>