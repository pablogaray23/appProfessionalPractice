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
	
	header('Content-Type: text/html; charset=utf-8');
	
	include("conexion.php");
	$conexion=conexion();
	$PTD_RUT = $_GET["PTD_RUT"];
	$doc_codigo=      $_GET['doc_codigo'];
	
	$sql = "select * from ab_prestador where PTD_RUT='$PTD_RUT'";
	
		
	$rs = sqlsrv_query($conexion,$sql);
	
	if( $rs === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}

	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	//$sqlTres = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT'";
	
	$sqlTres = "select * from ab_historial, ab_documento where ab_documento.doc_codigo = ab_historial.doc_codigo and ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.doc_codigo = '$doc_codigo'";
	
	$rsTres = sqlsrv_query($conexion,$sqlTres, $params, $options);
	
	if( $rsTres === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_count = sqlsrv_num_rows( $rsTres ); 
	
	
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
                  <li ><a  href="crearMedico.php"> Crear Médico </a></li>
			   <li ><a  href="medicoGestionar.php"> Gestionar Médico </a></li>
				<li ><a  href="adddirDocumentoMedico.php"> Antecedentes Médicos </a></li>
				<li class="active" ><a  href="medicoVerAgendas.php"> Agenda Médica y Convenio </a></li>
				<li ><a  href="verMedicosReservas.php"> Gestión Reservas </a></li>
              </ul>
            </li>
			
             <li class="treeview">
              <a href="#"><i class='fa fa-user'></i> <span> Box </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a  href="crearBox.php"> Crear un Box </a></li>
				<li><a  href="boxModificarEspecialidad.php"> Asignar Esp. Box </a></li>
				<li><a  href="verBoxCuadricula.php"> Visualizar Boxs </a></li>
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
            <li class="active">Box</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
      <div class="box box-info">
                <div class="box-header with-border">
                  <center>
				  <h3 class="box-title">Enviar Convenio Médico by E - mail </h3>
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
						?>

                  

                  
                  <form method="post" enctype="multipart/form-data" action="sendPhpConvenio.php">
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> R.U.T. Médico </p></span>
                    <input  id="PTD_RUT" name="PTD_RUT" value="<?php echo $PTD_RUT; ?>" class="form-control" readonly="readonly" placeholder="Código Box" type="email">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon"><p> Nombre Médico </p></span>
                    <input  id="numero"  value="<?php echo $nombre; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="email">
                  </div>
				  
				   <div class="input-group">
                    <span class="input-group-addon"><p> Convenio Médico a Enviar </p></span>
                  </div>
				  
				   
						<?php
						while ($rowTres = sqlsrv_fetch_array($rsTres))
						{
						$doc_codigo = $rowTres['doc_codigo'];
						$doc_file = $rowTres['doc_file'];
						//$his_codigo = $rowTres['his_codigo'];
						$his_fecha = $rowTres['his_fecha'];
						
						$dateFromDB = $his_fecha;
						//$newDate = DateTime::createFromFormat("l dS F Y",$dateFromDB); 
						
						$date = $dateFromDB;

						
						//$doc_file = $rowTres['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowTres['nivel'];
						
						  if($nivel=='8'){
							$nivel='Convenio';
							}else {
							$nivel = 'Otros';
							}
						 
						//$PTD_RUT = $rowTres['PTD_RUT'];
						?>

					 <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input  id="doc_file" name="doc_file" value="<?php echo $doc_file; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="text">
                  </div>
                  <br> 
						<?php
						}
					
						
						?>
				
				  
				  
				  
				     <div class="input-group">
                    <span class="input-group-addon"><p> Seleccione Correo Destino </p></span>
                  </div>
				   <br>
				    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                    <select id="nivel" name="nivel" class="form-control">
                      <option>pagaray@alumnos.ubiobio.cl</option>
                      <option>smorales@clinicachillan.cl</option>
                    </select>
                  </div>                
				   <br>
				  
				  
                  <div class="row">
           <br>
           <div class="box-footer">
                   <center><input type="submit" name="btn-upload" value="Enviar"</center>
				  
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
			if (!confirm('¿Desea eliminar el archivo al médico?')) e.preventDefault();
		};
		for (var i = 0, l = elems.length; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		}
	</script>
	
	
		
	
  </body>
</html>