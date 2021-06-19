<!--PHP PARA MODIFICAR EMPLEADOS-->

<?php
include("head.php");
include("leftmenu.php");
include("modificar.php");
//primero nos traemos el id del empleado
if( isset($_GET["nik"])){
  $id = $_GET["nik"];
}
//se trae todo de ese empleado 
$query = "SELECT * FROM empleados WHERE codigo =$id";

$resultados = $con -> query($query);
$res = $resultados->fetch_assoc();

function imprimirTipo($tipo){
  if($tipo==1){
    echo '<option value="0" id="emp" >Empleado</option>
    <option value="1" selected="selected" id="admin" >Administrador</option>';
  }
  else{
    echo '<option value="0" selected="selected" id="emp" >Empleado</option>
    <option value="1" id="admin">Administrador</option>';
  }
}
//luego aqui se muestra al usuario
?>

<div class="container ">
  <div>
    <h1 class="h4 mb-4 mt-5">Datos del empleado &raquo; Modificar datos</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="container mt-5">
    <form class=" row d-flex flex-column " action="" method="post">
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <p class="mb-2">Código de empleado</p>
        <input type="text" name="codigo" class="form-control" placeholder="Código de empleado" value="<?=$res['codigo']?>" required readonly>  
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <p class="mb-2">Nombre Completo</p>
        <input type="text" name="nombres" class="form-control" placeholder="Nombre completo" value="<?=$res['nombres']?>" required> 
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <div class="row">
          <div class="col-6">
            <p class="mb-2">DUI</p>
            <input type="text" name="dui" class="form-control" placeholder="DUI" value="<?=$res['dui']?>" required> 
          </div>
          <div class="col-6">
            <p class="mb-2">Telefono</p>
            <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?=$res['telefono']?>" required>  
          </div>
        </div>
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <p class="mb-2">Dirección</p>
        <textarea name="direccion" class="form-control" placeholder="Dirección" required><?=$res['direccion']?></textarea>  
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <p class="mb-2">Puesto</p>
        <input type="text" name="puesto" class="form-control" placeholder="Puesto" value="<?=$res['puesto']?>" required>
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <label class="control-label">Tipo de usuario:</label>
        <select id="tipo" name="tipo" class="form-select form-select-sm" aria-label=".form-select-sm example">
          <?php imprimirTipo($res['tipo']);?>
        </select>
      </div>
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <input type="password" id="contra" name="pass" class="form-control" placeholder="Contraseña" required>
      </div>
      <div class="container mb-3 col-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 col-xxl-6 ">
        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
        <a href="reporteEmp.php" class="btn btn-sm btn-danger">Cancelar</a>      
      </div>
    </form>
  </div>
</div>

<?php include_once ("foot.php");?>
<script>

$(document).ready(function(){

  //sirve para la primera vez que viene
  let seleccion = $('#tipo').find('option:selected').val();
  console.log(seleccion);

  if(seleccion==1){
    $("#contra").show();
    $("#contra").prop("required",true);
  }
  else{
    $("#contra").hide();
    $("#contra").removeAttr("required");
  }

  //luego este para cuando se cambia en el document
  $("#tipo").change(function(){
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
