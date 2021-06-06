<?php
include("conexion.php");

if(!empty($_POST)) {
    $co = mysqli_real_escape_string($con, $_POST['cod_form']);
        
    if($co != $_SESSION['id_empleado']){
        $consulta = "SELECT * FROM empleados WHERE codigo = '$co'";
        $resultado = $con -> query($consulta);
        $filas = $resultado -> num_rows;

        if($filas > 0){
            $fila = $resultado -> fetch_assoc();
            if($fila["estado"] != 0){
                $consulta = "UPDATE `empleados` SET `estado` = '0' WHERE `codigo` = '$co'";
                echo "<script type='text/javascript'>alert('¡Eliminado con exito!');</script>";
                $con -> query($consulta);
            }else{
                echo "<script type='text/javascript'>alert('Código no encontrado.');</script>";
            }
        }else{
            echo "<script type='text/javascript'>alert('Código no encontrado.');</script>";
        }
    }else{
        echo "<script type='text/javascript'>alert('¡No puedes eliminarte tu mismo!');</script>";
    }
}

?>