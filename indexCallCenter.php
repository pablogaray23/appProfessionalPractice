<?php
session_start();
include_once ('conexion.php');

if(!isset($_SESSION['user']))
{
	header("Location: login.html");
}

if($_SESSION['perfil']==2){
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
    <title>Gestion Box Clínicos</title>
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

    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="indexCallCenter.php" class="logo">
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
                  <span class="hidden-xs">Call - Center</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <p>
                      Call - Center
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
              <p>Call - Center</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
            </div>
          </div>


                       <ul class="sidebar-menu">
            <li class="header">Gesti&oacute;n Datos</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span>Médicos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li ><a  href="medicoVerAgendasCall.php"> Agenda Médica </a></li>
              </ul>
            </li>
              
            <li class="treeview">
              <a href="#"><i class='fa fa-home'></i> <span> Box </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li><a  href="verBoxCuadriculaCall.php"> Ver Todos Boxs </a></li>
				<li><a  href="boxVerPorEspCall.php"> Ver Boxs Por Esp. </a></li>
				<li><a  href="verBoxTorreANorteCall.php"> Ver Boxs Torre Antigua - Ala Norte </a></li>
				<li><a  href="verBoxTorreASurCall.php"> Ver Boxs Torre Antigua - Ala Sur </a></li>
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
            Bienvenido

            <small><?php echo $_SESSION['user']; ?></small>
			<h1>
            Su perfil es 

            <small> Usuario Call - Center </small>
          </h1>
		  
		
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>
		
		 
	  <div class="container">
  <h3>Sobre el sistema...</h3>
  <p>Una explicación general del sistema : </p>
  <blockquote>
    <p> Sistema de asignación de horarios médicos y convenios de box clínicos para profesionales médicos. </p>
	<p>  </p>
	<p>                     Este sistema permite realizar una gestión automatizada de las asignaciones de horarios y/o agendas médicas para los distintos profesionales tanto médicos u otros de la Clínica. </p>
    <footer>De Pablo Garay Cofré</footer>
  </blockquote>
</div>
		

     
      </div><!-- /.content-wrapper -->
	  
	 
	  

      <!-- Main Footer -->
      <footer class="main-footer">
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="index.html">Clínica Chillán</a>.</strong> Todos los derechos reservados.
      </footer>
      
     
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
	
	<script type="text/javascript">
    $(function(){
    $('a#logout').click(function(){
        if(confirm('¿Estás seguro de cerrar tu sesión?')) {
            return true;
        }

        return false;
    });
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
   </body>
</html>