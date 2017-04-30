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
	
	
	$conexion=conexion();
	
	$PTD_RUT=      $_GET['PTD_RUT'];
	
		$sql = "SELECT * FROM ab_prestador, ab_especialidad_prestador , especialidad
WHERE ab_prestador.PTD_RUT = ab_especialidad_prestador.PTD_RUT AND especialidad.ESP_CODIGO = ab_especialidad_prestador.ESP_CODIGO AND
ab_prestador.PTD_RUT = '$PTD_RUT'";
	
		
	$rs = sqlsrv_query($conexion, $sql);
	
	 if( $rs === false )
	{
  echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
  
	
	$sqlDos = "select * from especialidad ORDER BY ESP_NOMBRE";
	
		
	$rsDos = sqlsrv_query($conexion, $sqlDos);
	
	
	
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
			  <li class="active" ><a  href='crearMedico.php?PTD_RUT="#"'> Crear Médico </a></li>
         	   <li ><a  href="medicoGestionar.php"> Gestionar Médico </a></li>
				<li><a  href="adddirDocumentoMedico.php"> Antecedentes Médicos </a></li>
				<li ><a  href="medicoVerAgendas.php"> Agenda Médica y Convenio </a></li>
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
            <small> Médico </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Médico</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
      <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Nuevo Médico</h3>
                </div>
                <div class="box-body">
        <div class="col-lg-6 col-lg-offset-3">
		
		
			<form class="form-horizontal" role="form" method="post" action="crearMedicoBaseDatos.php">
			<div class="form-group">
				<label for="PTD_RUT" class="col-sm-2 control-label">R.U.T. Médico</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="PTD_RUT" name="PTD_RUT" value="<?php echo $PTD_RUT; ?>" placeholder="R.U.T. Médico (sin puntos ni guión ej. 1293456789 o 012934567k)" >
					<font color='blue'> Máximo 10 dígitos </font>
				</div>
				<label for="PTD_RUT" class="col-sm-2 control-label"></label>
				<div class="col-sm-10">
					<input id="submit" name="search" type="submit" value="Buscar Médico" class="btn btn-primary">
					<label for="PTD_RUT" class="col-sm-2 control-label"><img align=center src="imagenes/698627-icon-111-search-128.png" height="42" width="42"></label>					
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Nombre Médico</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="PTD_NOMBRE" name="PTD_NOMBRE" placeholder="Nombre Médico" >
					
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Apellido Paterno Médico</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="PTD_APELLIDOP" name="PTD_APELLIDOP" placeholder="Apellido Paterno Médico" >
					
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Apellido Materno Médico</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="PTD_APELLIDOM" name="PTD_APELLIDOM" placeholder="Apellido Materno Médico" >
					
				</div>
			</div>
			
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Dirección</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="PTD_DIRECCION" name="PTD_DIRECCION" placeholder="Dirección Médico" >
					
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="CORREO" name="CORREO" placeholder="example@domain.com" >
					
				</div>
			</div>
			
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label"> Especialidad </label>
				
				<div class="col-sm-10">
					<select id="codigoA" name="codigoA" class="form-control">
					
					<?php
						while ($rowDos = sqlsrv_fetch_array($rsDos))
						{
						echo "<option value='".$rowDos['ESP_CODIGO']."' selected>".$rowDos['ESP_NOMBRE']."</option>";
						?>
						
						<?php
						}
						
						?>
					
                    </select>
					
				</div>
                    
			</div>
			
			
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Guardar Médico" class="btn btn-primary">
				</div>
			</div>
		</form> 
		
	
					 
          </div><!-- /.col-lg-6 -->

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
   
  </body>
</html>