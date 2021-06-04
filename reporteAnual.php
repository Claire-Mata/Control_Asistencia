<?php
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

<div class="container ">

  <div>
    <h1 class="h4 mb-4 mt-5">Reporte por Rango de fechas</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="row">
		<div class="table-responsive mt-5">
		<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Nombre</th>
						<th>Dias trabajados</th>
						<th>Llegadas tardes</th>
						<th>Observacion</th>
					</tr>
				</table>
		</div>    
	</div>
</div>


<?php include_once ("foot.php");?>