﻿<?php
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
    <title>Gestion Médicos</title>
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

 // include("conexion.php");
  $conexion=conexion();
  $sql = "select * from especialidad ";
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
              <li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span>Médicos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <li ><a  href='crearMedico.php?PTD_RUT="#"'> Crear Médico </a></li>
			   <li ><a  href="medicoGestionar.php"> Gestionar Médico </a></li>
				<li><a  href="adddirDocumentoMedico.php"> Antecedentes Médicos </a></li>
				<li ><a  href="medicoVerAgendas.php"> Agenda Médica y Convenio </a></li>
				<li ><a  href="createAgendaMedicaAdmin.php"> Crear Agenda por Médico </a></li>
              </ul>
            </li>
			
			 
			 <li class="treeview active">
              <a href="#"><i class='fa fa-home'></i> <span> Box </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li ><a  href="crearBox.php"> Crear un Box </a></li>
				<li ><a  href="boxGestionar.php"> Gestionar Box </a></li>
				<li><a  href="verBoxCuadricula.php"> Ver Todos Boxs </a></li>
				<li class="active"><a  href="boxVerPorEspAdmin.php"> Ver Boxs Por Esp. </a></li>
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
            <small>Agenda Médica</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li >Agenda</li>
			<li class="active">Médicos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
		
		<div class="box">
		<center>
		  <blockquote>
			  <h3>En esta sección</h3>
				<footer>Por cada especialidad seleccionada, se podrá realizar las sgtes funcionalidades:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</footer>
				<p><font size='2'>Ver Agenda Ocupación Esp.: visualizar en cuales box se imparte esa especialidad y su horario &nbsp;</br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;        </font> </p>
				<p><font size='2'></font> </p>
	  
		  </blockquote>
		  </center>

          <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Esp Código</th>
                        <th>Nombre Esp.</th>
                        <th>Agenda</th>
                      </tr>
                    </thead>
                    <tbody>
          <tr>
            <?php
            while ($row = sqlsrv_fetch_array($rs))
            {
            $ESP_CODIGO = $row["ESP_CODIGO"];
            $ESP_NOMBRE = $row['ESP_NOMBRE'];

            ?>

            <td><?php echo $ESP_CODIGO; ?></td>
            <td><?php echo $ESP_NOMBRE; ?></td>

           <td> <a href='verAgendaBoxEspAdmin.php?ESP_CODIGO=<?php echo $ESP_CODIGO;?>' class="modificar" > Ver Agenda Ocupación Esp. </a>  </td>
            </tr>
            <?php
            }
            
            ?>
          </tbody>
        </table>
        <?php
        sqlsrv_close($conexion);
        ?>
      </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">ClínicaChillán</a>.</strong> Todos los derechos reservados.
      </footer>
      
     
    </div><!-- ./wrapper -->
	
	
	
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar Médico</h4>
      </div>
      <div class="modal-body">

                  

                  
                 <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <input  id="PTD_RUT" name="PTD_RUT" class="form-control" readonly type="email">
                  </div>
                  <br> 
                  
                  </br>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input  id="PTD_NOMBRE" name="PTD_NOMBRE" class="form-control" placeholder="Nombre" type="email">
                  </div>
                  <br> 
				  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <input  id="EDAD" name="EDAD" class="form-control" readonly type="email">
                  </div>
                  <br> 
                  
                  </br>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input  id="CORREO" name="CORREO" class="form-control" placeholder="Nombre" type="email">
                  </div>
                  <br> 
                  
                  

                
				   <br>
				   
                   <center><button onClick="modificarUsuario2();" class="btn btn-info">Modificar</button></center>
                    
				
         
      </div>
	</div>
    </div>
  </div>
	

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
			if (!confirm('¿Desea eliminar especialidad al médico?')) e.preventDefault();
		};
		for (var i = 0, l = elems.length; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		}
	</script>
	
   <script type="text/javascript">
   
   
   
   function modificarProfesor(idUser){
			
			$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "buscarMedicoBaseDeDatos.php",
					data: 'PTD_RUT='+idUser,
					success: function(valor){
						
						if(valor!="Ocurrio un error intentelo nuevamente"){
							
							$("#PTD_RUT").val(valor.PTD_RUT);
							$("#PTD_NOMBRE").val(valor.PTD_NOMBRE);
							$("#EDAD").val(valor.EDAD);
              $("#CORREO").val(valor.CORREO);
						}else{
							$("#PTD_RUT").val(valor);
						}
					}
				 });	
		
		$('#myModal').find('.modal-body');
		$('#myModal').modal(options);				
		}
		
		function modificarUsuario2(){
			var rut=$("#rut").val();
			var nombre=$("#nombre").val();
			var apellidoP=$("#apellidoP").val();
      var apellidoM=$("#apellidoM").val();
      var direccion=$("#direccion").val();
      var telefono=$("#telefono").val();
      


			
			$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "modificarApoderadoBaseDeDatos2.php",
					data: 'rut='+rut+'&nombre='+nombre+'&apellidoP='+apellidoP+'&apellidoM='+apellidoM+'&direccion='+direccion+'&telefono='+telefono,
					success: function(valor){
						
						if(valor!="Ocurrio"){
							document.location.href = 'apoderadoModificar.php';
							
						}else{
							
						}
					}
				 });	
			
		}
   
   
   
   
   
      $(function () {
        $("#example1").DataTable({
      "oLanguage": {
        "sSearch": "Buscar: "
      }
    });
    
    
      });
	  
	  
	  
	  $(document).ready(function()
	{
		$('table#example1 td a.delete').click(function()
		{
			
			var id = $(this).parent().parent().attr('id');
			
			if (confirm("Esta seguro de eliminar al usuario ?"))
			{
				
			
				
				$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "clienteEliminarBaseDeDatos.php",
					data: 'run='+id,
					success: function(valor){
						
						if(valor=="OK"){
							document.location.href = 'clienteEliminar.php';
						}else{
							alert(valor);
						}
					}
				 });				
			
				
			}
		});

	});
	  
	  
    </script>
  </body>
</html>