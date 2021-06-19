<?php
//aqui se mostraran las llegadas
include("conexion.php");
include("funciones.php");
$codigo= $_REQUEST['codigo'];
$fechai = fecha_ymd($_REQUEST['fechai']);
$fechaf=fecha_ymd($_REQUEST['fechaf']);
//se selecciona las cosas del horario para evaluar si entro temprano 
//o tarde o si salio temprano o tarde
$sql0="SELECT id, hora_e_sem, hora_s_sem, hora_e_fd, hora_s_fd FROM horario";
$res0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_assoc($res0);
//aqui se traen el codigo, el nombre del empleado, la hora en que marco entrada
//la hora que marco la salida, donde el codigo sea igual al codigo que se selecciono
//tambien que me traiga las marcar desde la fecha que ingreso el usuario a la fecha de fin
$sql1="SELECT e.codigo,e.nombres,m.fecha,m.hora_e,m.hora_s FROM empleados AS e,marcas AS m
WHERE e.codigo='$codigo'
AND  e.codigo= m.codigo
AND m.fecha BETWEEN '$fechai' AND  '$fechaf'";
$sql = mysqli_query($con, $sql1);

if(mysqli_num_rows($sql) == 0){
	//en caso que no haya datos
	echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else
{
	$no = 1;
	while($row = mysqli_fetch_assoc($sql)){
		//en lo siguiente es el encabezado de la tabla
		?>
		<tr>
			<td>
				<?php echo $no?> <!--el numero-->
			</td>
			<td>
				<?php echo $row['codigo']?>
			</td>

			<td>
				<?php echo fecha_dmy($row['fecha'])?>
			</td>
			<td>
				<?php echo $row['hora_e']?>
			</td>
			<td>
				<?php echo $row['hora_s']?>
			</td>
			<td>
				<?php
				if(date("w")>0 && date("w")<6){//esto es para el dia de la semana
					if($row['hora_e']){
						$hes1 = new DateTime($row['fecha']." ".$row0['hora_e_sem']);//aqui agarra la config del horario y la fecha
						$hes2 = new DateTime($row['fecha']." ".$row['hora_e']);//aqui agarra la hora de entrada y la fecha
						$obs_es=obtener_observa($hes1,$hes2,"E");//las observaciones (si llego tarde y asi)
						echo $obs_es;//y se imprimen
					}
					else{
						//cuando no marco entrada
						echo "<span class='text-danger'>No marco Entrada</span>";
					}
					if($row['hora_s']){
						$hss1 = new DateTime($row['fecha']." ".$row0['hora_s_sem']);//config horario
						$hss2 = new DateTime($row['fecha']." ".$row['hora_s']);//lo mismo que arriba pero con la salida
						$obs_ss=obtener_observa($hss1,$hss2,"S");//aqui son observacion de la salida tipo, se fue antes o no marco
						echo $obs_ss;
					}
					else{
						echo "<span class='text-danger'>No marco Salida</span>";
					}
				}
				if(date("w")==6 || date("w")==0){//esto ya es para sabado y domingo
					if($row['hora_e']){
						$hefd1 = new DateTime($row['fecha']." ".$row0['hora_e_fd']);//config horario
						$hefd2 = new DateTime($row['fecha']." ".$row['hora_e']);//esto es para el finde
						$obs_efd=obtener_observa($hefd1,$hefd2,"E");
						echo $obs_efd;
					}else{
						echo "<span class='text-danger'>No marco Entrada</span>";
					}
					if($row['hora_s']){
						$hsfd1 = new DateTime($row['fecha']." ".$row0['hora_s_fd']);//config horario
						$hsfd2 = new DateTime($row['fecha']." ".$row['hora_s']);
						$obs_sfd=obtener_observa($hsfd1,$hsfd2,"S");
						echo $obs_sfd;
					}
					else{
						echo "<span class='text-danger'>No marco Salida</span>";
					}
				}
				?>
			</td>
		</tr>
		<?php
		$no++;
	}
	?>
	<?php
}
?>