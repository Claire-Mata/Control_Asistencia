<?php
include("conexion.php");

$co = mysqli_real_escape_string($con, $_POST['codigo']);
    
$consulta = "SELECT * FROM empleados WHERE codigo = '$co'";
$resultado = $con -> query($consulta);
$filas = $resultado -> num_rows;

if($filas > 0){
    $fila = $resultado -> fetch_assoc();
    if($fila["tipo"] == 1){
        $consulta = "UPDATE `empleados` SET `estado` = '0' WHERE `codigo` = '$co'";
        echo "<script type='text/javascript'>alert('Usuario Eliminado');</script>";
        $con -> query($consulta);
    }else{
        echo "<script type='text/javascript'>alert('ID no encontrado');</script>";
    }
}else{
    $mensaje = 'ID no encontrado';
    echo "<script type='text/javascript'>alert('$mensaje');</script>";
}

?>