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
	
	include("conexion.php");
	$conexion=conexion();
	$PTD_RUT = $_GET["PTD_RUT"];
	
	$sql = "select ab_box.box_codigo
from ab_box
inner join ab_box_especialidad
on ab_box_especialidad.box_codigo = ab_box.box_codigo
INNER JOIN ESPECIALIDAD_PRESTADOR
ON ESPECIALIDAD_PRESTADOR.ESP_CODIGO = ab_box_especialidad.esp_codigo
where ESPECIALIDAD_PRESTADOR.PTD_RUT='$PTD_RUT' ";
	
	$rs = sqlsrv_query($conexion,$sql);
	
	if( $rs === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}


		
	$sqlDos = "select * 
from especialidad_prestador
inner join especialidad
on especialidad_prestador.ESP_CODIGO = especialidad.ESP_CODIGO
WHERE especialidad_prestador.PTD_RUT = '$PTD_RUT'";
	
	$rsDos = sqlsrv_query($conexion,$sqlDos);
	
	if( $rsDos === false )
	{
	echo "Error al ejecutar consulta.</br>";
	die( print_r( sqlsrv_errors(), true));
	}
	
	
	
	
	
	
	?>
  
  
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.html" class="logo">
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
                      <small>Gestión Datos Tree Garden</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
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

 <ul class="sidebar-menu">
            <li class="header">Gesti&oacute;n Datos</li>
            <!-- Optionally, you can add icons to the links -->
			
			<li class="treeview active">
              <a href="#"><i class='fa fa-user'></i> <span> Médicos </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li ><a  href="medicoModificar.php"> Ver Médico </a></li>
				<li ><a  href="profesorModificar.php"> Añadir Documentos </a></li>
				<li ><a  href="profesorModificar.php"> Ver Documentos </a></li>
				<li ><a  href="profesorModificar.php"> Generar Contrato </a></li>
				<li class="active"><a  href="asignarPreReservaMed.php"> Crear Pre - Reserva </a></li>
				<li ><a  href="asignarPreReservaMed.php"> Ver Agenda Médico </a></li>
              </ul>
            </li>
			
            <li class="treeview ">
              <a href="crearUsuario.php"><i class='fa fa-user'></i> <span> lalala </span> </a>
              
            

	<li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span>Apoderado</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a  href="apoderadoModificar.php">Modificar</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span>Estudiantes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a  href="estudianteModificar.php">Modificar</a></li>
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
            <small>Hora Pre - Reserva Médica</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Médico</li>
			<li class="active">Pre - Reserva</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<div class="box">
          <div class="box-body">
                  <table id="example1" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th><center> Código Box </center></th>

						<th><center> Horario </center></th>
						<th><center> Asignar Pre - Reserva </center></th>
                      </tr>
                    </thead>
                    <tbody>
					<tr>
						<?php
						while ($row = sqlsrv_fetch_array($rs))
						{
						$box_codigo = $row['box_codigo'];
						?>

						<td><?php echo $box_codigo; ?></td>
						<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onClick="medicoModificar('<?php echo $PTD_RUT ; ?>')"> Ver Horario Box </button></td>
						<td><a href='addBloquePreRes.php?box_codigo=<?php echo $box_codigo; ?>'> Asignar </button></td>
					</tr>
						<?php
						}
						
						?>
					</tbody>
				</table>
				<?php
				
				sqlsrv_free_stmt( $rs);
				sqlsrv_close($conexion);
				?>
			</div>
			</div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">TreeGarden</a>.</strong> Todos los derechos reservados.
      </footer>
      
     
    </div><!-- ./wrapper -->
	
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
	

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
 
	
		function medicoModificar(idUser){
			
				$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "modificarMedicoBaseDeDatos.php",
					data: 'box_codigo='+idUser,
					success: function(valor){
						
						if(valor!="Ocurrio un error intentelo nuevamente"){
							
							$("#box_codigo").val(valor.box_codigo);
							$("#ESP_NOMBRE").val(valor.ESP_NOMBRE);
						}else{
							$("#box_codigo").val(valor);
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
      var nivel=$("#nivel").val();
      if(nivel=='Sala Cuna'){
      nivel=1;
     }else{
      if(nivel=='Medio'){
        nivel=2;
      }
      nivel=3;
     }


			
			$.ajax(
				{
					dataType: 'json',
					type: 'POST',
					url: "modificarProfesorBaseDeDatos2.php",
					data: 'rut='+rut+'&nombre='+nombre+'&apellidoP='+apellidoP+'&apellidoM='+apellidoM+'&nivel='+nivel,
					success: function(valor){
						
						if(valor!="Ocurrio"){
							document.location.href = 'profesorModificar.php';
							
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