<!--PHP PARA MODIFICAR EMPLEADOS-->

<?php
include("head.php");
include("leftmenu.php");
include("modificar.php");
?>

<link href="css/bootstrap-datepicker.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
  <div class="container-fluid">
    <div class="content">
      <h2>Datos del empleado &raquo; Modificar datos</h2>
      <hr>
      <form class="form-horizontal" action="" method="post">
        <div class="form-group">
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" name="codigo" class="form-control" placeholder="Código de empleado" required>
            </div>
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" name="nombres" class="form-control" placeholder="Nombre completo" required>
            </div>
          </div>
          <br>
          <div class="form-group">
              <div class="row m-0">
                  <div class="col-sm-3">
                      <input type="text" name="dui" class="form-control" placeholder="DUI" required>
                  </div>
                  <div class="col-sm-3">
                      <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
                  </div>
              </div>   
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-6">
              <textarea name="direccion" class="form-control" placeholder="Dirección" required></textarea>
            </div>
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" name="puesto" class="form-control" placeholder="Puesto" required>
            </div>
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-6">
              <label class="control-label">Tipo de usuario:</label>
                <select name="tipo" class="form-select form-select-sm" aria-label=".form-select-sm example">
                  <option value="0">Empleado</option>
                  <option value="1">Administrador</option>
                </select>
            </div>
          </div>
          <br>
          <div class="form-group">
            <div class="col-sm-6">
              <input type="password" id="contra" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-6">
              <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
              <a href="admin_ventana.php" class="btn btn-sm btn-danger">Cancelar</a> <!-- index.php -->
            </div>
          </div>
      </form>
    </div>
  </div>
  </div>
  <?php include_once ("foot.php");?>
  <script>
  $(document).ready(function(){
    $("#contra").hide();
    $("#contra").removeAttr("required");
		$(".form-select").change(function(){
      if($(this).val()=="1"){    
          $("#contra").show();
          $("#contra").prop("required",true);
      }else{
        $("#contra").hide();
        $("#contra").removeAttr("required");
      }
    });
	});
  </script>
