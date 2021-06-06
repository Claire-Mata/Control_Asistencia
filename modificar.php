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
    $pass = sha1($encriptar);
    //mysqli_close($con);
    if($codigo != $_SESSION['id_empleado']){
        $consulta = "SELECT * FROM empleados WHERE codigo = '$codigo'";
        $resultado = $con -> query($consulta);
        $filas = $resultado -> num_rows;

        if($filas > 0){
            $fila = $resultado -> fetch_assoc();
            if($fila["estado"] != 0){
                $consulta = "UPDATE empleados SET nombres='$nombres', dui='$dui', direccion='$direccion', telefono='$telefono', puesto='$puesto',tipo='$tipo',contrasenia='$pass' WHERE codigo='$codigo'";
                $con -> query($consulta);
                echo "<script type='text/javascript'>alert('Modificado con exito!');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Código no encontrado.');</script>";
            }
        }else{
            echo "<script type='text/javascript'>alert('Código no encontrado.');</script>";
        }
    }else{
        $mensaje = 'No puedes modificar tus datos.';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
    }
}

?>