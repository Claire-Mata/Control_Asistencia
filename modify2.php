<!--PHP PARA MODIFICAR EMPLEADOS-->

<?php
require_once("head.php");
require_once("leftmenu.php");
?>

<link href="css/bootstrap-datepicker.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
  <div class="container-fluid">
    <div class="content">
      <h2>Datos del empleado &raquo; Modificar datos</h2>
      <hr>
      <form class="form-horizontal" action="" method="post">
      <div class="form-group">
          <div class="col-sm-6">
            <input type="text" name="id" class="form-control" placeholder="ID" required>
          </div>
        </div>
        <br>
        <div class="form-group">
          <!-- <label class="col-sm-3 control-label">Nombres</label> -->
          <div class="row">
                <div class="col-sm-3">
                    <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" name="dui" class="form-control" placeholder="DUI" required>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
                </div>
            </div>   
        </div>
        <br>
        <div class="form-group">
          <div class="col-sm-6">
            <textarea name="direccion" class="form-control" placeholder="Dirección"></textarea>
          </div>
        </div>
        <br>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" name="email" class="form-control" placeholder="Email" required>
          </div>
        </div>
        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label class="control-label">Género</label>
                    <select name="genero" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="1">M</option>
                        <option value="2">F</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <label class="control-label">Fecha de nacimiento</label>
                    <input type="text" name="fecha_nacimiento" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
                    </div>
                </div>
            </div>   
        </div>
        <br>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="text" name="puesto" class="form-control" placeholder="Puesto" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">&nbsp;</label>
          <div class="col-sm-6">
            <input type="submit" name="modify" class="btn btn-sm btn-primary" value="Guardar datos">
            <a href="admin_ventana.php" class="btn btn-sm btn-danger">Cancelar</a> <!-- index.php -->
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <?php include_once ("foot.php");?>
  <script>
  $('.date').datepicker({
    format: 'dd-mm-yyyy',
  })
  </script>
