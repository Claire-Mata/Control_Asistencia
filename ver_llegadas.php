<?php
include("head.php");
include("leftmenu.php");
include("conexion.php");
include("funciones.php");
$codigo= $_GET['codigo'];
$fechai=date('d-m-Y');
$fechaf=date('d-m-Y');
$sql = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$codigo'");
$nombre='';
if(mysqli_num_rows($sql) >0){
	$row = mysqli_fetch_assoc($sql);//aqui nos da un array asociativo
	$nombre=$row['nombres'];
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
	<div class='row'>
		<h3>Buscar por Empleado y Rango de Fechas</h3>
		<h3>Empleado:<?php echo strtoupper($nombre)?></h3>
		<input type='hidden' value='<?php echo $codigo?>' id='codigo' name='codigo' />
		<!--aqui le pedimos las fechas-->
		<div class="col-sm-4">
			<div class="form-control">
				<label class="col-sm-4 control-label">Fecha de inicio</label>
				<div class="col-sm-4">
					<input type="text" name="fechai" id="fechai"  class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" value="<?php echo $fechai?>" required>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-control">
				<label class="col-sm-4 control-label">Fecha  Fin</label>
				<div class="col-sm-4">
					<input type="text" name="fechaf" id="fechaf"  class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" value="<?php echo $fechaf?>" required>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-6">
					<!--cuando le de click en el boton de enviar ocupamos el ver_llegadas.js para buscar que hay en ese rango de fecha-->
					<button type="button" class="btn btn-outline-info s" name="buscar" id="buscar">Enviar</button>
				</div>
			</div>
		</div>
	</div>
	<div class='mostrar_datos'>
		<h5>Lista de LLegadas por Fechas</h5>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<!--ya aqui mostramos todos los datos dentro del rango de fecha-->
				<thead>
					<tr>
						<th>No</th>
						<th>Código</th>
						<th>Fecha</th>
						<th>Hora Entrada</th>
						<th>Hora Salida</th>
						<th>Observacion</th>
					</tr>
				</thead>
				<tbody id='mostrar_datoss'> <!--aqui mete los datos que en reporte-->
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include_once ("foot.php");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/ver_llegadas.js"></script>
  