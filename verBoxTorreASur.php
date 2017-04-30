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
    <title>Gestion Box</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	
	<style>
	
 .example1 {
    color:black;
     width: 50%;
     word-wrap: break-word;
	align:center;
	height:50px;  
	font-size:75%;
	font-family:courier;
	  font-weight: bold;
    background-color: #ADD8E6;
    text-align: center;
    padding: 10px;
    border-top: 1px solid #fff;
    border-left: 1px solid #fff;
    border-bottom: 1px solid #aaa;
    border-right: 1px solid #aaa;
}

.forcedWidth{
    width:100%;
	line-height:8px;
	height:20px; 
}
.forcedWidthDos{
    width:100px;
	height:50px; 
	line-height:8px;
}

</style>
	
	
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

$tableContent = "";
//include("conexion.php");
$link=conexion();
$sql = "select * from ab_box where box_torre = '1' and box_ala = 'Ala Sur' order by box_numero asc ";
	
	$rs = sqlsrv_query($link, $sql);


//$box_codigo = '1';
 
function mostrar($tableContent, $box_codigo, $box_numero){
$link=conexion();
/**
 * Created by JetBrains PhpStorm.
 * User: Marco
 * Date: 8/22/13
 * Time: 9:49 AM
 */


$sqlDos = "select ab_agenda_medico.box_codigo, ab_agenda_medico.PTD_RUT, ab_prestador.PTD_NOMBRE, ab_prestador.PTD_APELLIDOP, especialidad.esp_nombre,
ab_agenda_medico.agm_codigo, ab_agenda_detalle.agd_id_agendaDetalle, 
ab_agenda_detalle.agd_dia, ab_agenda_detalle.agd_hora_inicio, ab_agenda_detalle.agd_hora_fin, 
ab_agenda_detalle.est_codigo, ab_agenda_detalle.agm_codigo 
from ab_agenda_medico, ab_agenda_detalle, ab_prestador, ab_especialidad_prestador, especialidad
where ab_agenda_medico.agm_codigo = ab_agenda_detalle.agm_codigo and 
ab_agenda_medico.PTD_RUT = ab_especialidad_prestador.PTD_RUT and
ab_especialidad_prestador.PTD_RUT = ab_prestador.PTD_RUT and
ab_especialidad_prestador.esp_codigo = especialidad.esp_codigo 
and ab_agenda_medico.box_codigo='$box_codigo'";



$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

$busco = sqlsrv_query($link, $sqlDos , $params, $options);







$row_count = sqlsrv_num_rows( $busco );
   
if ($row_count != 0){
	
	while ($row = sqlsrv_fetch_array($busco)){
	$blocks[] = array('id' => $row["agd_id_agendaDetalle"], 'rut' => $row["PTD_RUT"], 'name' => $row["PTD_NOMBRE"], 'apellido' => $row["PTD_APELLIDOP"], 'estado' => $row["est_codigo"], 'nameDos' => $row["esp_nombre"], 'day' => $row["agd_dia"], 'startTime' => $row["agd_hora_inicio"],
			'endTime' => $row["agd_hora_fin"]);
}

 json_encode($blocks);
	
}else{
	$blocks[] = array('id' => null, 'rut' => null, 'name' => null, 'apellido' => null, 'estado' => null, 'nameDos' => null, 'day' => null, 'startTime' => null,
			'endTime' => null);
	 json_encode($blocks);
	 echo "<center> <h3> <font size ='3', color ='red'> Box $box_numero no posee horario </font> </h3> </center>";
	
}
	
$close = sqlsrv_close($link) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  


$tableContent.= "
            
           <table  class='example1' style='line-height:8px; width:100px; height:100%;'  align='center' class='table table-bordered' data-id='1' border='1'>
                <thead>
                <tr >
                    <th style='border:1px solid black;' >&nbsp;</th>
                    <th style='border:1px solid black;' >Lunes</th>
                    <th style='border:1px solid black;' >Martes</th>
                    <th style='border:1px solid black;' >Miércoles</th>
                    <th style='border:1px solid black;' >Jueves</th>
                    <th style='border:1px solid black;' >Viernes</th>
                    <th style='border:1px solid black;' >Sábado</th>
                </tr>
                </thead>
                <tbody>
        ";

$time = mktime(0, 0, 0, 1, 1);

$earliest   = 720;
$latest     = 1140;


for( $i = 480; $i < 1440; $i += 30 ) {
    // print table rows

    $rowContent = ""; // Holds table cells and content
    $styles     = ""; // holds `class="foo"` (row class)



    for ($j = 2; $j < 8; $j++) {
        // print row columns

        $printed = FALSE;

      


        foreach ( $blocks as $block ) {
            // cycle through Courses and check if there is one scheduled at this time
            if ( ( $block["day"] == $j ) && ( $block["startTime"] == $i ) ) {
                // class starts on this day at this time

                $rowspan    = ( ( $block["endTime"] - $block["startTime"] ) / 30 );
				$dia = $block["day"];
                $content    = $block["name"];
				$unRut = $block["rut"];
												$contentOcho    = $block["nameDos"];
				$numero = strlen($contentOcho);
				$mitad =$numero/2;
				if($numero>14){
					$contentNueve = substr($contentOcho, 0, $mitad);
					$contentDiez = substr($contentOcho, $mitad, $numero);
				}else{
					$contentNueve = $contentOcho;
					$contentDiez = ' ';
				}
				$contentTres    = $block["apellido"];
				$estado    = $block["estado"];
				
				if($estado==1){					
					$lala = 'white';
					$lele = 'red';
				}else{
					$lala = 'black';	
					$lele = 'white';
				}
                $blockID    = $block["id"];
               $rowContent .= "\t" . "<td class='forcedWidth' style='line-height:8px; width:1000px; height:100%;' bgcolor='$lala'  rowspan='$rowspan'   data-id='$blockID' class='block-cell'> <a href='verBloque.php?PTD_RUT=$blockID'> <font color='$lele'> $content </br> $contentTres </br> $contentNueve </br> $contentDiez  </font> </a>  </td>" . "\r\n";

                $printed = TRUE;

            } else if ( ( $block["day"] == $j ) &&  // Class starts this day
                ( $block["startTime"] < $i ) &&     // after this time
                ( $block["endTime"] >= $i + 30) ) { // but isn't finished
                // class is continuing
                $printed = TRUE;
            } else {
                // no class at this time
            }
        }

        if (!$printed)
			$rowContent .= "<td class='forcedWidth' style='line-height:8px; font-size:10px; width:1000px; height:100%;' >  &nbsp; </td>";

    }

    /* Print content */

    $tableContent .= "<tr style='height:1px;'  $styles>" . "\r\n";

    $heading = sprintf("\t" . '<th style="border:1px solid black;"  class="time">%1$s</th>' . "\r\n",        date( 'g:i a', $time + ( $i * 60 ) ) );

    $tableContent .= $heading . $rowContent;

    $tableContent .= "\t" . "</tr>" . "\r\n";

}
echo $tableContent .= '
                </tbody>
            </table>
        ';

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
				<li ><a  href="verBoxCuadricula.php"> Ver Todos Boxs </a></li>
					<li><a  href="boxVerPorEspAdmin.php"> Ver Boxs Por Esp. </a></li>
				<li ><a  href="verBoxTorreANorte.php"> Ver Boxs Torre Antigua - Ala Norte </a></li>
				<li class="active"><a  href="verBoxTorreASur.php"> Ver Boxs Torre Antigua - Ala Sur </a></li>
				
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
            <small>Ver Ocupación Ala Sur</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Box</li>
			<li class="active">Ala Sur</li>
          </ol>
        </section>


        <!-- Main content -->
        <section class="content">
		<div class="box">
          <div class="box-body">
               <table id="example1" style=" width:100%; height:50%; text-align:center;"  class="table table-bordered table-striped table-condensed">
                    <tbody>
						<?php									
						$limite = 4;
						$contador = 0;						
						while ($row = sqlsrv_fetch_array($rs))
						{
							
						$box_codigo = $row['box_codigo'];
						$box_numero = $row['box_numero'];
						$acb_codigo_actividad = $row['acb_codigo_actividad'];
						
						  if($acb_codigo_actividad=='1'){
							$acb_codigo_actividad='atención médica';
							$emmmmColor= 'blue';
							}elseif($acb_codigo_actividad=='2'){
								$acb_codigo_actividad = 'vacunas';
								$emmmmColor= 'red';
							}else {
							$acb_codigo_actividad = 'ecografías';
							$emmmmColor= 'orange';
							}
						
						
							$nameA   = " Box $box_numero";
							
							if($contador==0)								
								echo "<tr class='demarcado'>";
							
						
							
								echo "<td>";	
								echo "<center><h1 id='1' class='table-name'>$nameA</h1></center>";
							echo "<center><font color='black'> Actividad Box  :   </font><font color='$emmmmColor' size='4px'> $acb_codigo_actividad </font></center>";
								
								echo "<table style='text-align:left;' align='center'>";
								echo "<thead>";
								echo "<tr>";
								echo "<th><center> Nombre Especialidad </center></th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								echo "<tr>";
								
									$sqlSiete = "SELECT ab_box_especialidad.esp_codigo, especialidad.ESP_NOMBRE, COUNT(*)
from ab_box_especialidad, especialidad 
where ab_box_especialidad.esp_codigo = especialidad.esp_codigo and  ab_box_especialidad.box_codigo = '$box_codigo'
GROUP BY ab_box_especialidad.esp_codigo, especialidad.esp_nombre
HAVING COUNT(*) > 0";
	
							$rsSiete = sqlsrv_query($link, $sqlSiete);
							
							while ($rowSiete = sqlsrv_fetch_array($rsSiete))
						{
							
					//	$esp_codigo = $rowSiete['esp_codigo'];
						$ESP_NOMBRE = $rowSiete['ESP_NOMBRE'];
						
						echo "<td><center> $ESP_NOMBRE </center></td>";
						echo "</tr>";
					
						
						}
						echo "</tbody>";
						
					
								
								
								echo "</table>";
								echo "</br>";
								
									echo "<table style='text-align:left;'>";
								echo "<tr>";
								echo "<td bgcolor='white'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
								echo "<td>&nbsp;&nbsp; = </td>";
								echo "<td>&nbsp;&nbsp; Pre - Reserva </td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td bgcolor='black'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>";
								echo "<td>&nbsp;&nbsp; = </td>";
								echo "<td>&nbsp;&nbsp; Confirmada </td>";
								echo "</tr>";
								echo "</table>";
								echo "</br>";
								
								echo "<h4> <a href='crearAgendaMedico.php?box_codigo=$box_codigo'> Crear Nueva Agenda </a></h4>";
								
								echo "</br>";
								echo "<div class='mydiv'>";
								mostrar($tableContent,$box_codigo,$box_numero);
								echo " </div>";			
								
								echo "</br>";
								echo "</br>";
								echo "</br>";
								echo "</br>";
								echo "</td>";
									
								$contador++;
								
								if($contador==$limite){
									echo "</tr>";
									$contador=0;
								}  					
						
						}
						
							/*Si no completamos el limite por fila, nos faltará cerrar el tr */
							if($contador!=0){
								echo "</tr>";
							}
						
						?>
					</tbody>
				</table>
				
			</div>
			</div>
        </section><!-- /.content -->
		
		<?php
				
				sqlsrv_close($link);
				?>
		
		
		
		
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Clínica Chillán</a>.</strong> Todos los derechos reservados.
      </footer>
      
     
    </div><!-- ./wrapper -->
	
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"> Ver Horario Box </h4>
      </div>
      <div class="modal-body">

                  
				
         
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
   
	
	
  </body>
</html>