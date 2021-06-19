<?php
//aqui es el reporte por empleado
include("conexion.php");
include("head.php");
include("leftmenu.php");
?>

<div class="container ">
  <div>
    <h1 class="h4 mb-4 mt-5">Lista de Empleados</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  	<div class="row">
		<br>
		<div class="table-responsive mt-5">
			<table class="table table-striped table-hover" id="user">
				<thead >
					<th>No</th>
					<th>Código</th>
					<th>Nombre</th>
					<th>DUI</th>
					<th>Teléfono</th>
					<th>Cargo</th>
					<th>Acciones</th>
				</thead>
				<?php
				$filter = 1;
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
							
								<td>  <span class="fas fa-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>
								<td>'.$row['dui'].'</td>
								<td>'.$row['telefono'].'</td>
								<td>'.$row['puesto'].'</td>';
								$menu1='<td>
								<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-bars"></i> Menu</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
								$menu1.='<li><a class="dropdown-item" href="form_modificar.php?nik='.$row['codigo'].'"><i class="fas fa-edit"></i> Editar</a></li>';
								$menu1.='<li><a class="dropdown-item"  href="eliminar.php?aksi=delete&nik='.$row['codigo'].'" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombres'].'?\')"><i class="fas fa-trash-alt"></i> Borrar</a></li>';
								
								$menu1.="<li><a  class='dropdown-item' href='ver_llegadas.php?codigo=".$row['codigo']."' ><i class='fas fa-eye'></i> Ver LLegadas</a></li>";
								$menu1.="</ul>
								</div>
								</td></tr>";
							echo $menu1;
							$no++;
						}
					}
				?>
			</table>
			<?php 
				if(isset($_GET['res'])) {
					if( $_GET['res'] == 1 ){
						echo <<<_MSJ
							<div class="alert alert-primary alert-dismissible fade show mt-3" role="alert" id="alert">
							Datos eliminados correctamente
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						_MSJ;
					}
					if( $_GET['res'] == 2 ){
						echo <<<_MSJ
							<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert" id="alert">
							No se encontraron datos.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						_MSJ;
					}
					if( $_GET['res'] == 3 ){
						echo <<<_MSJ
							<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert id="alert"">
							Error, no se pudieron eliminar los datos
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						_MSJ;
					}
					$_GET['res']=0;
				}
			?>
		</div>    
	</div>	
</div>

<?php include_once ("foot.php");?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script> 
//para la dataTable
$(document).ready( function () {
    $('#user').DataTable({
		"responsive": true,
		"paging": true,
		"language":{
			"leghntMenu": "mostrar _MENU_ por pagina",
			"zeroRecords":"no se encontro ningun registro que coincida",
			"info": "mostrando _TOTAL_ de _MAX_ registros",
			"search": "buscar",
			"searchPlaceholder": "empleados",
			"infoFiltered": "(de un total de _MAX_ registros)",
			"paginate":{
				"previous": "Anterior",
				"next": "siguiente"
			}
		}
	});

});
</script>
