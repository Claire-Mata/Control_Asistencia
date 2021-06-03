<?php
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
	<div class="container">
		<div class="content">
			<h2>Reporte Diario</h2>
			<hr>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Nombre</th>
						<th>Hora de llegada</th>
						<th>Dentro de la empresa</th>
						<th>Hora Salida</th>
						<th>Observacion</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
				<?php include_once ("foot.php");?>