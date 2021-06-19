<!--CABEZA DE LA INTERFAZ DEL ADMINISTRADOR CON SU NAVBAR-->
<?php
include("conexion.php");
//para iniciar sesion
session_start();
if(!isset($_SESSION['id_empleado'])){
    header("Location: index.php");
}

$iduser = $_SESSION['id_empleado'];
$consulta = "SELECT * FROM empleados WHERE codigo = '$iduser'";
$resultado = $con -> query($consulta);
$fila = $resultado -> fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8a0597b0e.js" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>
<body style="background-color: #e4efe7;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <div class = "d-flex bd-highlight mx-2">
            <a class="btn btn-light d-inline p-2" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Menu</a>
        </div>

        <div class="dropdown">
        <button class="btn btn-light dropdown-toggle mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user"></i> Bienvenid@ <?php echo utf8_decode($fila['nombres']);?> </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="salir.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesion</a></li>
        </ul>
        </div>

    </nav>
    <div class="d-flex align-items-center" >
    
