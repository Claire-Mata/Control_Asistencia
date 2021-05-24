<?php
// Buscar usuario en base de datos

if(!empty($_POST)) {
    $usuario = mysqli_real_escape_string($con, $_POST['name']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['password']);;
    $consulta = "SELECT * FROM empleados WHERE codigo = '$usuario' AND contrasenia = '$contrasenia' AND tipo = '1'";
    $resultado = $con -> query($consulta);
    $filas = $resultado -> num_rows;
    if($filas > 0){
        $fila = $resultado -> fetch_assoc();
            // $_SESSION["tipo_usuario"] = $fila["tipo"];
            // echo "<script type='text/javascript'>alert('pagina de admin');</script>";
            header("Location: admin_ventana.php");
    }else{
        $mensaje = 'usuario o contrasenia incoreccto';
        echo "<script type='text/javascript'>alert('$mensaje');</script>";
        // header("Location: index.php");   
    }
}

?>