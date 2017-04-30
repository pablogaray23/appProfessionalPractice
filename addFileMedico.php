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
	
	
<script src="http://code.jquery.com/jquery.min.js"></script>
<link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
	
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  
  <style>
    .alnright { text-align: left; }
	
	.form-control { width: 200px; height: 60px; }
	
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}	
	
</style>
  
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
	
	//include("conexion.php");
	$conexion=conexion();
	$PTD_RUT = $_GET["PTD_RUT"];
	
	$sql = "select * from ab_prestador where PTD_RUT='$PTD_RUT'";
	
		
	$rs = sqlsrv_query($conexion,$sql);
	
	if( $rs === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}

	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	$sqlCurriculum = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '1' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsCurriculum = sqlsrv_query($conexion,$sqlCurriculum, $params, $options);
	
	if( $rsCurriculum === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countCurriculum = sqlsrv_num_rows( $rsCurriculum ); 
	
	$sqlFotoT = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '2' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsFotoT = sqlsrv_query($conexion,$sqlFotoT, $params, $options);
	
	if( $rsFotoT === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countFotoT = sqlsrv_num_rows( $rsFotoT ); 
	
	$sqlFotoC = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '3' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsFotoC = sqlsrv_query($conexion,$sqlFotoC, $params, $options);
	
	if( $rsFotoC === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countFotoC = sqlsrv_num_rows( $rsFotoC ); 
	
	
	$sqlFotoCV = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '4' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsFotoCV = sqlsrv_query($conexion,$sqlFotoCV, $params, $options);
	
	if( $rsFotoCV === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countFotoCV = sqlsrv_num_rows( $rsFotoCV ); 
	
	
	
	$sqlCertCap = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '5' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsCertCap = sqlsrv_query($conexion,$sqlCertCap, $params, $options);
	
	if( $rsCertCap === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countCertCap = sqlsrv_num_rows( $rsCertCap ); 
	
	
	
	$sqlCursoA = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '6' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsCursoA = sqlsrv_query($conexion,$sqlCursoA, $params, $options);
	
	if( $rsCursoA === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countCursoA = sqlsrv_num_rows( $rsCursoA ); 
	
	
	$sqlOtros = "select  * from ab_documento WHERE ab_documento.PTD_RUT = '$PTD_RUT' and ab_documento.nivel = '7' ORDER BY ab_documento.doc_codigo  DESC";
	
	$rsOtros = sqlsrv_query($conexion,$sqlOtros, $params, $options);
	
	if( $rsOtros === false )
{
echo "Error al ejecutar consulta.</br>";
die( print_r( sqlsrv_errors(), true));
}
	$row_countOtros = sqlsrv_num_rows( $rsOtros ); 
	
	
		$sqlCuatro = "select  * from ab_especialidad_prestador , especialidad
WHERE especialidad.ESP_CODIGO = ab_especialidad_prestador.ESP_CODIGO AND
ab_especialidad_prestador.PTD_RUT = '$PTD_RUT'";
	
	
	$rsCuatro = sqlsrv_query($conexion, $sqlCuatro);
  
  if( $rsCuatro === false )
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

 <ul class="sidebar-menu">
            <li class="header">Gesti&oacute;n Datos</li>
            <!-- Optionally, you can add icons to the links -->
			
				 <!-- Optionally, you can add icons to the links -->
             <li class="treeview active">
              <a href="#"><i class='fa fa-user'></i> <span> Médicos </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
			  <li ><a  href='crearMedico.php?PTD_RUT="#"'> Crear Médico </a></li>
                 <li ><a  href="medicoGestionar.php"> Gestionar Médico </a></li>
				<li class="active"><a  href="adddirDocumentoMedico.php"> Antecedentes Médicos </a></li>
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
            <li >Médico</li>
			 <li class="active">Archivos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         
      <div class="box box-info">
                <div class="box-header with-border">
                  <center>
				  <h3 class="box-title">Documentos Antecedentes Médicos </h3>
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

                  

                  
            <form method="post" enctype="multipart/form-data" action="addDocuMedicoBaseDatosDos.php">
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> R.U.T. Médico </p></span>
                    <input  id="PTD_RUT" name="PTD_RUT" value="<?php echo $PTD_RUT; ?>" class="form-control" readonly="readonly" placeholder="Código Box" type="email">
                  </div>

                  <div class="input-group">
                    <span class="input-group-addon"><p> Nombre Médico </p></span>
                    <input  id="numero"  value="<?php echo $nombre; ?>" class="form-control" readonly="readonly" placeholder="Número Box" type="email">
                  </div>
				  
				  
				  
				  <div class="input-group">
                    <span class="input-group-addon"><p> Especialidades del Médico </p></span>
					
						   <table id="example" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th><center>  </center></th>
                      </tr>
                    </thead>
                    <tbody>
					<tr>
						<?php
						while ($rowCuatro = sqlsrv_fetch_array($rsCuatro))
						{
						$ESP_CODIGO = $rowCuatro['ESP_CODIGO'];
						$ESP_NOMBRE = $rowCuatro['ESP_NOMBRE'];
						?>

						<td class='alnright'><?php echo $ESP_NOMBRE; ?></td>					
					</tr>
						<?php
						}
						
						?>
					</tbody>
				</table>
				  
					
                  </div>
				  
				  
			
				  
				   <div class="input-group">
                    <span class="input-group-addon"><p> Antecedentes Médicos </p></span>
                  </div>
				  
				   <table id="example1" style="text-align:center;" class="table table-bordered table-striped table-condensed">
                     <thead>
                      <tr>
                        <th width="50px"> Tipo Documento </th>
                        <th width="150px"> Nombre Documento </th>
						
						<th width="50px"> Visualizar </th>
						<th width="30px"> Descargar </th>
						<th width="30px"> Eliminar </th>
						<th width="1000px">  </th>
						<th width="2px">  </th>
                      </tr>
                    </thead>
					
					<?php
					
					if($row_countCurriculum==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color = 'blue'> Curriculum </font></td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Curriculum </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					
					<td><input id="fileField" class="form-control" name="fileCurriculum" type="file" /></td>
					
					<td><input type="submit" name="btn-uploadUno" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>					
					
                   	
					<tr>
						<?php
						while ($rowCurriculum = sqlsrv_fetch_array($rsCurriculum))
						{
						$doc_codigo = $rowCurriculum['doc_codigo'];
						$doc_file = $rowCurriculum['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowCurriculum['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowCurriculum['PTD_RUT'];
						?>

						<td class='alnright'> <font color = 'blue'> Curriculum </font></td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>				
				
						<?php
					
					if($row_countFotoT==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color = 'blue'> Fotocopia Título </font> </td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Fotocopia Título </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					
					<td><input id="fileField" class="form-control" name="fileFotoT" type="file" /></td>
					
					<td><input type="submit" name="btn-uploadDos" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>		
                   	
					<tr>
						<?php
						while ($rowFotoT = sqlsrv_fetch_array($rsFotoT))
						{
						$doc_codigo = $rowFotoT['doc_codigo'];
						$doc_file = $rowFotoT['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowFotoT['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowFotoT['PTD_RUT'];
						?>

						<td class='alnright'> <font color = 'blue'> Fotocopia Título </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>					
				
						<?php
					
					if($row_countFotoC==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color = 'blue'> Fotocopia Carnet </font></td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Fotocopia Carnet </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					
					<td><input id="fileField" class="form-control" name="fileFotoC" type="file" /></td>
					
					<td width="250px"><input size="3" type="submit" name="btn-uploadTres" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>	
                   	
					<tr>
						<?php
						while ($rowFotoC = sqlsrv_fetch_array($rsFotoC))
						{
						$doc_codigo = $rowFotoC['doc_codigo'];
						$doc_file = $rowFotoC['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowFotoC['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowFotoC['PTD_RUT'];
						?>

						<td class='alnright'> <font color = 'blue'> Fotocopia Carnet </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>					
				
							<?php
					
					if($row_countFotoCV==0){					
					
					?>
					
					<tr>
					<td class='alnright'><font color='blue'> Fotocopia Carnet Vacunación </font></td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Fotocopia Carnet Vacunación </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					
					<td><input id="fileField" class="form-control" name="fileFotoCV" type="file" /></td>
					
					<td><input type="submit" name="btn-uploadCuatro" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>	
                   	
					<tr>
						<?php
						while ($rowFotoCV = sqlsrv_fetch_array($rsFotoCV))
						{
						$doc_codigo = $rowFotoCV['doc_codigo'];
						$doc_file = $rowFotoCV['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowFotoCV['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowFotoCV['PTD_RUT'];
						?>

						<td class='alnright'> <font color='blue'> Fotocopia Carnet Vacunación </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>					
				
							<?php
					
					if($row_countCertCap==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color='blue'> Certificados de Capacitación </font> </td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Certificados de Capacitación </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					
					<td><input id="fileField" class="form-control" name="fileCertCap" type="file" /></td>
					
					<td><input type="submit" name="btn-uploadCinco" value="Subir Archivo"> </td>
					</tr>
				
					<?php
					
					}else{
					
					?>	
                   	
					<tr>
						<?php
						while ($rowCertCap = sqlsrv_fetch_array($rsCertCap))
						{
						$doc_codigo = $rowCertCap['doc_codigo'];
						$doc_file = $rowCertCap['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowCertCap['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowCertCap['PTD_RUT'];
						?>

						<td class='alnright'> <font color='blue'> Certificados de Capacitación </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>					
				
							<?php
					
					if($row_countCursoA==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color='blue'> Cursos Asoc. Esp. </font> </td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Cursos Asoc. Esp. </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					<td><input id="fileField" class="form-control" name="fileCursoA" type="file" /></td>
					<td><input type="submit" name="btn-uploadSeis" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>	
                   	
					<tr>
						<?php
						while ($rowCursoA = sqlsrv_fetch_array($rsCursoA))
						{
						$doc_codigo = $rowCursoA['doc_codigo'];
						$doc_file = $rowCursoA['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowCursoA['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowCursoA['PTD_RUT'];
						?>

						<td class='alnright'> <font color='blue'> Cursos Asoc. Esp. </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>						
				
							<?php
					
					if($row_countOtros==0){					
					
					?>
					
					<tr>
					<td class='alnright'> <font color='blue'> Otros </font> </td>
					<td><center>  </center></td>
					<td><center> <font color='red' > Médico No Posee Otros Documentos </font> </center></td>
					<td><center>  </center></td>
					<td><center>  </center></td>
					<td><input id="fileField" class="form-control" name="fileOtros" type="file" /></td>
					  
					<td><input type="submit" name="btn-uploadSiete" value="Subir Archivo"> </td>
					</tr>
					
					<?php
					
					}else{
					
					?>	
                   	
					<tr>
						<?php
						while ($rowOtros = sqlsrv_fetch_array($rsOtros))
						{
						$doc_codigo = $rowOtros['doc_codigo'];
						$doc_file = $rowOtros['doc_file'];
						//$adada = utf8_decode($doc_file);
						$nivel = $rowOtros['nivel'];
						
						  if($nivel=='1'){
							$nivel='Curriculum';
							}elseif ($nivel == '2') {
							$nivel = 'Fotocopia Título';
							} elseif ($nivel == '3') {
							$nivel = 'Fotocopia Carnet';
							} elseif ($nivel == '4') {
							$nivel = 'Fotocopia Carnet Vacunación';
							}elseif ($nivel == '5') {
							$nivel = 'Certificados de Capacitación';
							} elseif ($nivel == '6') {
							$nivel = 'Cursos Asoc. Esp.';
							}  else {
							$nivel = 'Otros';
							}
						 
						$PTD_RUT = $rowOtros['PTD_RUT'];
						?>

						<td class='alnright'> <font color='blue'> Otros </font> </td>
						<td><?php echo $doc_file; ?></td>
						
						<td> <a href="../arriendoCM/uploads/<?php echo $doc_file;?>" target="_blank" ><img align=center src="imagenes/Files-View-File-icon.png" height="42" width="42"></a> </td>	
						<td> <a href='medicoDescargarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' > <img align=center src="imagenes/download_document-128.png" height="42" width="42"> </a>  </td>					
						<td> <a href='medicoEliminarArchivo.php?PTD_RUT=<?php echo $PTD_RUT;?> &doc_codigo= <?php echo $doc_codigo;?>' class="confirmation" > <img align=center src="imagenes/recycle_bin-512.png" height="42" width="42"> </a>  </td>
						<td><center>  </center></td>
					<td><center>  </center></td>
					</tr>
					
						<?php
						}
					}
						
						?>					
				</table>
				
				  
				  
				  
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