<!--PHP PARA ELIMINAR EMPLEADO -->

<?php
include("head.php");
include("leftmenu.php");
include("eliminar.php");

?>

<link href="css/bootstrap-datepicker.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
  <div class="container-fluid">
    <div class="content">
      <h2>Datos del empleado &raquo; Eliminar empleado</h2>
      <hr>
      <form class="form-horizontal" action="" method="post">
      <div class="form-group">
             <div class="col-sm-6">
                <div class="alert alert-warning" role="alert">
                    Nota: Una vez eliminado un empleado, no podrás deshacer la acción.
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="codigo" class="form-control" placeholder="ID" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
          <div class="col-sm-6">
              <input type="submit" name="remove" class="btn btn-sm btn-primary" value="Eliminar">
              <a href="admin_ventana.php" class="btn btn-sm btn-danger">Cancelar</a> <!-- index.php -->
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<?php include_once ("foot.php");?>
