<?php
/*Datos de conexion a la base de datos*/
$db_host = "localhost";
$db_user = "root";
$db_pass = "jorge";
$db_name = "Empleados"; // Nombre de tu base
//Ejecutar la conexion 
$con = new mysqli($db_host, $db_user, $db_pass, $db_name);

// if(mysqli_connect_errno()){
// 	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
// }
?>
