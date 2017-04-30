<?php
	function conexion(){
		
		$serverName = "200.111.139.90";
/* Usuario y clave.  */
$uid = "JSANDOVAL";
$pwd = "J6239SAN";
/* Array asociativo con la información de la conexion */
$connectionInfo = array( "UID"=>$uid,
"PWD"=>$pwd,
"Database"=>"CLINIWIN");
 
/* Nos conectamos mediante la autenticación de SQL Server . */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
echo "No es posible conectarse al servidor.</br>";
die( print_r( sqlsrv_errors(), true));
}
		
	 return $conn;
	}
?>