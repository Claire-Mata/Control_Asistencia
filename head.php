<!--CABEZA DE LA INTERFAZ DEL ADMINISTRADOR CON SU NAVBAR-->
<?php
include("conexion.php");

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
    <title>Admin</title>
</head>
<body style="background-color: #e4efe7;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <div class = "d-flex bd-highlight mx-2">
            <a class="btn btn-light d-inline p-2" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Menu</a>
        </div>

        <div class="accordion accordion-flush align-self-end mx-2" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    --- Bienvenid@ <?php echo utf8_decode($fila['nombres']);?> ---
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><a href="salir.php">Cerrar session</a></div>
            </div>
        </div>
    </nav>
    <div class="d-flex align-items-center" >
    
