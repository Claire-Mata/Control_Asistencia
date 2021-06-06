<?php
session_start();
if(isset($_SESSION['id_empleado'])){
    header("Location: index.php");
}

// Buscar usuario en base de datos
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
        // echo $_SESSION["idEmpleado"];
        header("Location: admin_ventana.php");
    }else{
        $mensaje = 'usuario o contrasenia incoreccto';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
        // header("Location: index.php");   
    }
}
?>