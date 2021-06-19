<?php
//aqui se hace el agregar
//primero hacemos la conexion con la base de datos 
include("conexion.php");

//aqui agarramos por post todos los datos
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
    //aqui validamos si el codigo ya existe
    if($codigo != $_SESSION['id_empleado']){
        $consulta = "SELECT * FROM empleados WHERE codigo = '$codigo'";
        $resultado = $con -> query($consulta);
        $filas = $resultado -> num_rows;
        //si existe el codigo
        if($filas > 0){
            $fila = $resultado -> fetch_assoc();
            if($fila["estado"] != 0){
                echo "<script type='text/javascript'>alert('Código ya existe');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Intente con otro código');</script>";
            }
        }else{
            //si no existe el codigo se hace la insercion
            $consulta = "INSERT INTO empleados(codigo, nombres, dui, direccion, telefono, puesto, estado,tipo,contrasenia,disponible) VALUES('$codigo','$nombres', '$dui', '$direccion', '$telefono', '$puesto', '1', '$tipo', '$pass', '1')";
            $mensaje = 'Empleado agregado con exito!';
            $con -> query($consulta);
            //esta consulta es para solucionar el bug de que al marcar entrada por primera vez no lo cambiaba a activo, no se que pasaba, solucion cutre, pero funciona
            $consulta = "UPDATE empleados SET disponible='0' WHERE codigo='$codigo'";
            $con ->query($consulta);
            //el mensaje para el usuario
            echo "<script type='text/javascript'>alert('$mensaje');</script>";
        }
    }else{
        //si ya existe el codigo
        $mensaje = 'No puedes volver a registrarte';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
    }
}
?>