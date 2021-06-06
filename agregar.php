<?php
include("conexion.php");

if(!empty($_POST)){
    $codigo = mysqli_real_escape_string($con,$_POST["codigo"]);
    $nombres = mysqli_real_escape_string($con,$_POST["nombres"]);
    $dui = mysqli_real_escape_string($con,$_POST["dui"]);
    $direccion = mysqli_real_escape_string($con,$_POST["direccion"]);
    $telefono = mysqli_real_escape_string($con,$_POST["telefono"]);
    $puesto = mysqli_real_escape_string($con,$_POST["puesto"]);    
    $tipo = mysqli_real_escape_string($con,$_POST["tipo"]);
    $encriptar = mysqli_real_escape_string($con,$_POST["pass"]);
    $pass = sha1(strval($encriptar));
    //mysqli_close($con);
    if($codigo != $_SESSION['id_empleado']){
        $consulta = "SELECT * FROM empleados WHERE codigo = '$codigo'";
        $resultado = $con -> query($consulta);
        $filas = $resultado -> num_rows;

        if($filas > 0){
            $fila = $resultado -> fetch_assoc();
            if($fila["estado"] != 0){
                echo "<script type='text/javascript'>alert('Código ya existe');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Intente con otro código');</script>";
            }
        }else{
            $consulta = "INSERT INTO empleados(codigo, nombres, dui, direccion, telefono, puesto, estado,tipo,contrasenia,activo) VALUES('$codigo','$nombres', '$dui', '$direccion', '$telefono', '$puesto', '1', '$tipo', '$pass', '0')";
            $mensaje = 'Empleado agregado con exito!';
            $con -> query($consulta);
            echo "<script type='text/javascript'>alert('$mensaje');</script>";
        }
    }else{
        $mensaje = 'No puedes volver a registrarte';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
    }
}

?>