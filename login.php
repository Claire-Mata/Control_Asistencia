<?php
session_start();
session_destroy();
session_start();

// Buscar usuario en base de datos
//PARA ENTRAR EN TIPO ADMINISTRADOR
//USUARIO: ADMIN
//CONTRA: admin
if(!empty($_POST)) {
    $usuario = mysqli_real_escape_string($con, $_POST['name']);
    $encriptar = mysqli_real_escape_string($con, $_POST['password']);
    $contrasenia = sha1($encriptar);
    $consulta = "SELECT * FROM empleados WHERE codigo = '$usuario' AND contrasenia = '$contrasenia' AND tipo = '1' AND estado = '1'";
    $resultado = $con -> query($consulta);
    $filas = $resultado -> num_rows;
    if($filas > 0){
        $fila = $resultado -> fetch_assoc();
        $_SESSION['id_empleado'] = $fila["codigo"];
        // si no inicia sesion que lo mande al index

        if(!isset($_SESSION['id_empleado'])){
            header("Location: index.php");
        }else{
            //si no que lo mande a reporte de empleado
            header("Location: reporteEmp.php");
        }
    }else{
        $mensaje = 'usuario o contrasenia incoreccto';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
        // si es incorrecto algun campo
    }
}
?>