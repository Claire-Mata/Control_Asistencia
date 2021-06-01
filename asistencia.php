
<?php
require_once("head.php");
require_once("leftmenu.php");


$estado = 1;
$consulta = "SELECT * FROM empleados WHERE estado = '$estado'";
$resultados = $con -> query($consulta);
$activos = $resultados -> fetch_all();


function iterarActivos($activos){
    
     $limite = count($activos);

    for ($i=0; $i < $limite; $i++) { 
        imprimirActivo($activos[$i][1],$activos[$i][6]);  
    } 

}

function imprimirActivo($nombre,$cargo){

    echo <<<_ACTIVO

        <div class="card shadow rounded my-3 col-sm-12  col-11 container" style="background-color: #325288;">
            <div class="card-body row">
                <span class="card-text text-light h6 col-sm-8 col-12">$nombre</span>    
                <span class="card-text text-light h6 col-sm-4 col-12"> $cargo</span>
            </div>
        </div>

    _ACTIVO;
}

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
        <?php iterarActivos($activos); ?>
    </div>
    
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
   <script>

        $("#refrescar").click(function(){

            location.reload()
        })
    
    </script>
</body>
</html>