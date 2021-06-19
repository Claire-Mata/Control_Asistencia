<!--PHP PARA ELIMINAR EMPLEADO -->

<?php
include("head.php");
include("leftmenu.php");
include("eliminar.php");
?>

<div class="container ">
  <div>
    <h1 class="h4 mb-4 mt-5">Datos del empleado &raquo; Eliminar empleado</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="container mt-5">
    <form class=" row d-flex flex-column " action="" method="post">
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <div class="alert alert-warning" role="alert">
            Nota: Una vez eliminado un empleado, no podrás deshacer la acción.
        </div>
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <input type="text" name="cod_form" class="form-control" placeholder="Codigo de empleado" required>     
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Eliminar">
        <a href="admin_ventana.php" class="btn btn-sm btn-danger">Cancelar</a>      
      </div>
    </form>
  </div> 
</div>

<?php include_once ("foot.php");?>
