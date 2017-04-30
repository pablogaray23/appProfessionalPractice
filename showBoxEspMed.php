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
				<li class="active"><a  href="adddirDocumentoMedico.php"> Añadir Documentos </a></li>
				<li ><a  href="profesorModificar.php"> Ver Documentos </a></li>
				<li ><a  href="profesorModificar.php"> Generar Contrato </a></li>
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
				  <h3 class="box-title">Visualizar Info Médico</h3>
				  </center>
                </div>
                <div class="box-body">
        <div class="col-lg-6 col-lg-offset-3">
		
		
		
						<?php
						while ($row = sqlsrv_fetch_array($rs))
						{
						$box_codigo = $row['box_codigo'];
						?>

                  

                  
                  <form method="post" enctype="multipart/form-data" action="addDocuMedicoBaseDatosDos.php">
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Código Box</p></span>
                    <input  id="box_codigo" name="PTD_RUT" value="<?php echo $PTD_RUT; ?>" class="form-control" readonly="readonly" placeholder="Código Box" type="email">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon"><p> Número Box</p></span>
                    <input  id="numero"  value="<?php echo $PTD_NOMBRE; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="email">
                  </div>
				    <div class="input-group">
                    <span class="input-group-addon"><p> Seleccione Documento </p></span>
                  </div>
				   <br>
				    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                    <select id="nivel" name="nivel" class="form-control">
                      <option>Curriculum</option>
                      <option>Fotocopia Título</option>
                      <option>Fotocopia Carnet </option>
                    </select>
                  </div>                
				   <br>
				   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <input  id="file" name="file" class="form-control" readonly type="file">
                  </div>
                  <br>
				  
				  
                  <div class="row">
           <br>
           <div class="box-footer">
                   <center><input type="submit" name="btn-upload" value="Enviar>"</center>
				  
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
   
   function addFile(){

    var PTD_RUT=$('#PTD_RUT').val();
    var nivel=$("#nivel").val();
      if(nivel=='Curriculum'){
      nivel=1;
     }else{
      if(nivel=='Fotocopia Título'){
        nivel=2;
      }
      nivel=3;
     }
    var file=$('#file').val();
     
     $.ajax({
        
        dataType: 'json',
        type: 'POST',
        url: "addDocuMedicoBaseDatosDos.php",
        data: 'PTD_RUT='+PTD_RUT+'&nivel='+nivel+'&file='+file,



        success: function(valor){
          
          if(valor == 'OK'){
			alert("Documento añadido correctamente");          
          
            document.location.href = 'adddirDocumentoMedico.php';
          }else {
            
            alert(valor);
            
          }
        }
      });
     
   }
    
   
    </script>
  </body>
</html>