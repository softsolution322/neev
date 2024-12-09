<?php 

$database = "DATACAPTURE";
$serverName = "203.129.217.179, 1433"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"DATACAPTURE", "UID"=>"sa", "PWD"=>"Mica$007");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}


?>