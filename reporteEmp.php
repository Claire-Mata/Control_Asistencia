<?php
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
	<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
	<div class="container">
		<div class="content">
			<h2>Lista de empleados</h2>
			<hr>

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					//este es para la opcion que aparece eliminar, pero como no haremos eso aqui, lo podes quitar
					$delete = mysqli_query($con, "DELETE FROM empleados WHERE codigo='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>


			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Código</th>
					<th>Nombre</th>
					<th>DUI</th>
					<th>Teléfono</th>
					<th>Cargo</th>
					<th>Acciones</th>
				</tr>
				<?php
				if($filter){
					//aqui es para mostrar a los empleados
					$sql = mysqli_query($con, "SELECT * FROM empleados WHERE estado='$filter' ORDER BY codigo ASC");
				}else{
					$sql = mysqli_query($con, "SELECT * FROM empleados ORDER BY codigo ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						//lo siguiente es para el menu de acciones, de aqui podes borrar todo y solo dejar el de 'ver_llegadas.php'
						//que es donde se hace el reporte de ese empleado
						echo '<tr>
							<td>'.$no.'</td>
							<td>'.$row['codigo'].'</td>
						
							<td><a href="profile.php?nik='.$row['codigo'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>
							<td>'.$row['dui'].'</td>
							<td>'.$row['telefono'].'</td>
							<td>'.$row['puesto'].'</td>';
							$menu1='<td>
							<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i>  Menu</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
							$menu1.='<li><a class="dropdown-item" href="edit.php?nik='.$row['codigo'].'"><i class="glyphicon glyphicon-edit"></i> Editar</a></li>';
							$menu1.='<li><a class="dropdown-item"  href="index2.php?aksi=delete&nik='.$row['codigo'].'" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombres'].'?\')"><i class="glyphicon glyphicon-trash"></i> Borrar</a></li>';
							
							
							$menu1.="<li><a  class='dropdown-item' href='ver_llegadas.php?codigo=".$row['codigo']."' ><i class='glyphicon glyphicon-eye-open'></i> Ver LLegadas</a></li>";
							$menu1.="</ul>
							</div>
							</td></tr>";
						echo $menu1;
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>
	</div>
  <?php include_once ("foot.php");?>
