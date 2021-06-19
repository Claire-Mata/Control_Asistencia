<?php
//para marcar asistencia
include("conexion.php");
date_default_timezone_set('America/El_Salvador');
$codigo = $_POST['codigo']; //empleado
$marca = $_POST['marca']; //puede ser entrada o salida E ó S
$fecha=date('Y-m-d');
$hora=date("H:i:s");
$hnull=NULL;
$sql0 = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$codigo'");
//consultar si existe empleado
$nombre="";
if(mysqli_num_rows($sql0)> 0){
	$row0 = mysqli_fetch_assoc($sql0);

	$datos['nombre']= $row0['nombres'];
    $nombre=$row0['nombres'];

$sql1 = mysqli_query($con, "SELECT * FROM marcas WHERE codigo='$codigo' AND fecha='$fecha'");
//consultar si existe empleado
if(mysqli_num_rows($sql1)> 0){

	$row = mysqli_fetch_assoc($sql1);
	$datos['codigo']=$row['codigo'];
	$datos['fecha']=$row['fecha'];
	$datos['hora_e']=$row['hora_e'];
	$datos['hora_s']=$row['hora_s'];
	//para marcar entrada
	if($marca=='E'){
		$update = mysqli_query($con, "UPDATE marcas SET hora_e='$hora' WHERE codigo='$codigo' AND fecha='$fecha'") or die(mysqli_error());
		$update1 = mysqli_query($con, "UPDATE `empleados` SET `disponible` = '1' WHERE `codigo` = '$codigo'");
		$tipo_marc=" MARCA ENTRADA A LAS ";
	}
	//para marcar salida
	if($marca=='S'){
		$update = mysqli_query($con, "UPDATE marcas SET hora_s='$hora' WHERE codigo='$codigo' AND fecha='$fecha'") or die(mysqli_error());
		$update1 = mysqli_query($con, "UPDATE `empleados` SET `disponible` = '0' WHERE `codigo` = '$codigo'");
		$tipo_marc=" MARCA SALIDA A LAS ";
	}
	if($update){
		$datos['operacion']='UPD';
		$datos['mensaje']=$nombre.": ".$tipo_marc." ".$hora;
	}

}else {
//si no hay registro de marcs en la fecha actual, inserta
 if($marca=='E'){
		$q_ins="INSERT INTO marcas(id,codigo, fecha, hora_e) ";
		$tipo_marc=" MARCA ENTRADA A LAS ";
	}
	else {
		$q_ins="INSERT INTO marcas(id,codigo, fecha, hora_s) ";
		$tipo_marc=" MARCA SALIDA A LAS ";
	}
	$q_ins.=" VALUES(DEFAULT,'$codigo','$fecha', '$hora')";
	$insert = mysqli_query($con, $q_ins) or die(mysqli_error());

	if($insert){
		$datos['operacion']='INS';
		$datos['mensaje']=$nombre.": ".$tipo_marc." ".$hora;
	}else {
		$datos['operacion']='NO_EJECUTADA';
		$datos['mensaje']=$nombre." NO REGISTRO MARCA";
	}
}
//si el codigo no existe
}else{
	$datos['operacion']='NO EXISTE';
	$datos['mensaje']=' CODIGO  DE EMPLEADO: '.$codigo.',  NO EXISTE ';

}
echo json_encode($datos);
?>
