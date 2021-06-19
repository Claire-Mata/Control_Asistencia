<?php
//aqui se hace los que estan adentro de la empresa
require_once("head.php");
require_once("leftmenu.php");

//aqui activo es para ver si esta en la empresa
$activo = 1;
$consulta = "SELECT * FROM empleados WHERE disponible = '$activo'";
$resultados = $con -> query($consulta);
$activos = $resultados -> fetch_all();

//aqui nos ayuda para imprimir los activos osea los que estan dentro de 
//la empresa
function iterarActivos($activos){
    $limite = count($activos);
    for ($i=0; $i < $limite; $i++) { 
    imprimirActivo($i+1,$activos[$i][0],$activos[$i][1],$activos[$i][5]);  
    } 
}

//aqui ya se imprime
function imprimirActivo($numero,$codigo,$nombre,$cargo){
    echo <<<_ACTIVO
        <tr>
            <td>$numero</td>
            <td>$codigo</td>
            <td>$nombre</td>
            <td>$cargo</td>
            <tr>
    _ACTIVO;
}

//aqui ya es lo que se le muestra al usuario
?>

<div class="container">
    <div>
        <h1 class="h4 mb-4 mt-5">Empleados activos actualmente</h1>
        <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
    </div>
    <div class="row">
        <div class="col-sm-12  col-11 d-flex justify-content-center">
            <button class="btn btn-primary" id="refrescar">refrescar</button>
        </div>
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover">
                <tr>
                    <th>No</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                </tr>
                <?php iterarActivos($activos); ?>
            </table>
        </div>    
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script>
    //al darle refrescar hace la funcion otra ves
    $("#refrescar").click(function(){

        location.reload()
    })

</script>
</body>
</html>