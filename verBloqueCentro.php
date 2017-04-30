<?php
session_start();
include_once ('conexion.php');

if(!isset($_SESSION['user']))
{
	header("Location: login.html");
}

if($_SESSION['perfil']==3){
}elseif($_SESSION['perfil']==1){
	$message = "usted no puede ver esta pagina";
	//session_start();
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: index.php");	
}
else{
	$message = "usted no puede ver esta pagina";
	//session_start();
	echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: indexCallCenter.php");
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
    <title>Gestion Box</title>
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
	$PTD_RUT = $_GET["PTD_RUT"];
	
	
$sql = "select * from ab_agenda_detalle, ab_agenda_medico 
where ab_agenda_detalle.agm_codigo = ab_agenda_medico.agm_codigo
and agd_id_agendaDetalle = '$PTD_RUT'";
	
	$rs = sqlsrv_query($conexion, $sql);
	
	if( $rs === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	
	
	?>
  

    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="indexCentroMedico.php" class="logo">
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
                  <span class="hidden-xs">Centro Médico</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <p>
                     Centro Médico
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
              <p>Centro Médico</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
            </div>
		</div>
			  
   <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
            <li class="header">Gesti&oacute;n Datos</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span>Médicos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li ><a  href="medicoVerAgendasCentro.php"> Agenda Médica </a></li>
              </ul>
            </li>
			 
	 <li class="treeview active">
              <a href="#"><i class='fa fa-home'></i> <span> Box </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li  class="active"><a  href="verBoxCuadriculaCentro.php"> Ver Todos Boxs </a></li>
				<li><a  href="boxVerPorEspCentro.php"> Ver Boxs Por Esp. </a></li>
				<li><a  href="verBoxTorreANorteCentro.php"> Ver Boxs Torre Antigua - Ala Norte </a></li>
				<li><a  href="verBoxTorreASurCentro.php"> Ver Boxs Torre Antigua - Ala Sur </a></li>
				
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
            <small> Visualizar Información Reserva Médica </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Box</li>
			<li class="active">Gestion Agenda Médica</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
      <div class="box box-info">
                <div class="box-header with-border">
                  <center>
				  <h3 class="box-title">Visualizar Información Reserva Médica </h3>
				  </center>
                </div>
                <div class="box-body">
        <div class="col-lg-6 col-lg-offset-3">
		
		
		
						<?php
						while ($row = sqlsrv_fetch_array($rs))
						{
						$agm_codigo = $row['agm_codigo'];
						$est_codigo = $row['est_codigo'];
						$estadoReserva = '';
						if($est_codigo=='1'){
							$estadoReserva = 'Pre - Reserva ';
						}else{
							$estadoReserva = 'Confirmada ';
						}
						
						
						$agd_id_agendaDetalle = $row['agd_id_agendaDetalle'];
						$agd_dia = $row['agd_dia'];
						
						$diaReserva = '';
						
						if ($agd_dia=='2') {
							$diaReserva = 'Lunes';
						} elseif ($agd_dia == '3') {
							$diaReserva = 'Martes';
						} elseif ($agd_dia == '4') {
							$diaReserva = 'Miercoles';
						} elseif ($agd_dia == '5') {
							$diaReserva = 'Jueves';
						}  elseif ($agd_dia == '6') {
							$diaReserva = 'Viernes';
						} else {
							$diaReserva = 'Sabado';
						}
						
						$agd_hora_inicio = $row['agd_hora_inicio'];
						
						$horaInicio = '';
						
						$horaInicio = $agd_hora_inicio/60;
						
						$whole = floor($horaInicio);      // 1
						$fraction = $horaInicio - $whole;
						
						if($fraction==0.5){
							$horaInicioDos = round($horaInicio, 0, PHP_ROUND_HALF_DOWN).' : 30 ';
						}else{
							$horaInicioDos = round($horaInicio, 0, PHP_ROUND_HALF_DOWN).' : 00 ';
						}
						
						
						
						//$horaInicioDos = round($horaInicio, 0, PHP_ROUND_HALF_DOWN);
						
						
						$agd_hora_fin = $row['agd_hora_fin'];
						
						$horaFin = '';
						
						$horaFin = $agd_hora_fin/60;
						
						$wholeDos = floor($horaFin);      // 1
						$fractionDos = $horaFin - $wholeDos;
						
						if($fractionDos==0.5){
							$horaFinDos = round($horaFin, 0, PHP_ROUND_HALF_DOWN).' : 30 ';
						}else{
							$horaFinDos = round($horaFin, 0, PHP_ROUND_HALF_DOWN).' : 00 ';
						}
						
						
						;
						
						$PTD_RUT = $row['PTD_RUT'];
						
						$queryEspecialidadMedico= sqlsrv_query($conexion, "select * from ab_especialidad_prestador, especialidad where ab_especialidad_prestador.ESP_CODIGO = especialidad.ESP_CODIGO and ab_especialidad_prestador.PTD_RUT = '$PTD_RUT'");
  //$nmyestudiante = sqlsrv_num_rows($estudiante);
  $rowEspecialidad = sqlsrv_fetch_array($queryEspecialidadMedico);
  $especialidadMedico = $rowEspecialidad['ESP_NOMBRE'];
  
  $queryNombreMedico= sqlsrv_query($conexion, "select * from ab_prestador where  ab_prestador.PTD_RUT = '$PTD_RUT'");
  //$nmyestudiante = sqlsrv_num_rows($estudiante);
  $rowNombreMedico = sqlsrv_fetch_array($queryNombreMedico);
  $paraNombreMedico = $rowNombreMedico['PTD_NOMBRE'];
	$paraApellidoPMedico = $rowNombreMedico['PTD_APELLIDOP'];	
	$paraApellidoMMedico = $rowNombreMedico['PTD_APELLIDOM'];	
	$paraNombreFinal = $paraNombreMedico." ".$paraApellidoPMedico." ".$paraApellidoMMedico." ";
						
						$box_codigo = $row['box_codigo'];
						
						 $queryNumeroBox= sqlsrv_query($conexion, "select * from ab_box where  ab_box.box_codigo = '$box_codigo'");
  //$nmyestudiante = sqlsrv_num_rows($estudiante);
  $rowNumeroBox = sqlsrv_fetch_array($queryNumeroBox);
  $paraNumeroBox = $rowNumeroBox['box_numero'];
						
						?>
						
						
					<form method="post" enctype="multipart/form-data" action="modificarReservaEstado2.php">

                  

                  
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Información del Horario </p></span>
                    <input style="display:none" id="agm_codigo" name="agm_codigo" value="<?php echo $agm_codigo; ?>" class="form-control" readonly="readonly" placeholder="Código Box" type="text">
                  </div>
				  
				  
				  

                  <div class="input-group">
                    <span class="input-group-addon"><p> Estado Reserva</p></span>
                    <input  id="numero"  value="<?php echo $estadoReserva; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   
				  
				   
				   <div class="input-group">
                    <span class="input-group-addon"><p> Dia Reserva </p></span>
                    <input  id="numero"  value="<?php echo $diaReserva; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   
				   <div class="input-group">
				    <span class="input-group-addon"><p> Hora Inicio Reserva </p></span>
                    <input  id="numero"  value="<?php echo $horaInicioDos; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                   
                  </div>
				  
				   
				   <div class="input-group">
                    <span class="input-group-addon"><p> Hora Fin Reserva </p></span>
                    <input  id="numero"  value="<?php echo $horaFinDos; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   <div class="input-group">
                    <span class="input-group-addon"><p> Información del Médico </p></span>
                    <input style="display:none" id="agd_id_agendaDetalle" name="agd_id_agendaDetalle" value="<?php echo $agd_id_agendaDetalle; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   
				   <div class="input-group">
                    <span class="input-group-addon"><p> R.U.T. Medico </p></span>
                    <input  id="numero"  value="<?php echo $PTD_RUT; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Nombre Completo Medico </p></span>
                    <input  id="numero"  value="<?php echo $paraNombreFinal; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Especialidad Medico </p></span>
                    <input  id="numero"  value="<?php echo $especialidadMedico; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   <div class="input-group">
                    <span class="input-group-addon"><p> Información del Box </p></span>
                    <input style="display:none"  id="box_codigo" name="box_codigo"  value="<?php echo $box_codigo; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				   
				   <div class="input-group">
                    <span class="input-group-addon"><p> Número Box </p></span>
                    <input  id="numero"  value="<?php echo $paraNumeroBox; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
				  
				      
                  <br>			  
                  <div class="row">
           <br>
				  
				 
				  
				  </form>

				  
				  
				  
						<?php
						}
						
						?>



                 
                  <div class="row">
           <br>
          </div><!-- /.col-lg-6 -->
		  
		  
		    
		  
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
			if (!confirm('¿Desea eliminar la agenda al médico?')) e.preventDefault();
		};
		for (var i = 0, l = elems.length; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		}
	</script>
	
   <script type="text/javascript">
   
 	function modificarUsuario2(){
			var agd_id_agendaDetalle=$("#agd_id_agendaDetalle").val();
			var nivel=$("#nivel").val();
			if(nivel=='Pre - Reserva'){
				nivel=1;
			}else{
				nivel=2;
			}
			
			$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "modificarReservaEstado2.php",
					data: 'agd_id_agendaDetalle='+agd_id_agendaDetalle+'&nivel='+nivel,
					success: function(valor){
						
						if(valor!="Ocurrio"){
							document.location.href = 'verBoxCuadricula.php';
							
						}else{
							
						}
					}
				 });	
			
		}
    
   
    </script>
  </body>
</html>