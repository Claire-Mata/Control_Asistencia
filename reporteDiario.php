<?php
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>

<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->


<div class="container ">

  <div>
    <h1 class="h4 mb-4 mt-5">Reporte diario</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="row">
		<div class="table-responsive mt-5">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Nombre</th>
					<th>Hora de llegada</th>
					<th>Dentro de la empresa</th>
					<th>Hora Salida</th>
					<th>Observacion</th>
				</tr>
				<?php
			
				$filter = 1;
				if($filter){
					//aqui es para mostrar a los empleados
					$sql = mysqli_query($con, "SELECT * FROM marcas WHERE fecha = CURDATE()");
				}

				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						//lo siguiente es para el menu de acciones, de aqui podes borrar todo y solo dejar el de 'ver_llegadas.php'
						//que es donde se hace el reporte de ese empleado
						$codigo = $row['codigo'];
						$query = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$codigo'");
						while($nom = mysqli_fetch_assoc($query)){
							if($nom['estado'] == 1){
								$activo = $nom['activo'] == 0 ? 'Sí' : 'No';
								echo '<tr>
								<td>'.$no.'</td>
								<td>'.$nom['nombres'].'</td>
								<td>'.$row['hora_e'].'</td>
								<td>'.$activo.'</td>
								<td>'.$row['hora_s'].'</td>
								<td>x</td>
								</tr>';
							}
						}
						$no++;
					}
				}
				?>
			<!--<td><a style="text-decoration:none;" href="profile.php?nik='.$row['codigo'].'"><span class="fas fa-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>-->
			</table>
		</div>    
	</div>
</div>
<?php include_once ("foot.php");?>