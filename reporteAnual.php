<?php
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
		<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
	<div class="container">
		<div class="content">
			<h2>Reporte por Rango de fechas</h2>
			<hr />

            <div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Nombre</th>
					<th>Dias trabajados</th>
					<th>Llegadas tardes</th>
					<th>Observacion</th>
				</tr>

<?php include_once ("foot.php");?>