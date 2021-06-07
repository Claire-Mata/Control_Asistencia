<?php

include("conexion.php");
include("funciones.php");
$codigo= $_REQUEST['codigo'];
$fechai = fecha_ymd($_REQUEST['fechai']);
$fechaf=fecha_ymd($_REQUEST['fechaf']);

$sql0="SELECT id, hora_e_sem, hora_s_sem, hora_e_fd, hora_s_fd FROM horario";
$res0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_assoc($res0);

$sql1="SELECT e.codigo,e.nombres,m.fecha,m.hora_e,m.hora_s FROM empleados AS e,marcas AS m
WHERE e.codigo='$codigo'
AND  e.codigo= m.codigo
AND m.fecha BETWEEN '$fechai' AND  '$fechaf'";
$sql = mysqli_query($con, $sql1);

if(mysqli_num_rows($sql) == 0){
	echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
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

		<!--/table>
</div-->
			<?php

}
/*
function obtener_observa($he1,$he2,$tipo){
	//funcion que obtieme los objetos Datetime y retorna la observacion
	//si hubo llegads tardes o salidas temprano
	$tiempoe_dif = $he2->diff($he1);
	$invert_e    = $tiempoe_dif->invert;

	if (isset($invert_e)){
		//aqui le damos formato para imprimirlo
			$dias_tarde1=$tiempoe_dif->format('%d');
			$horas_tarde1=$tiempoe_dif->format('%h');
			$minutos_tarde1=$tiempoe_dif->format('%i');

			if ($invert_e==1 && $tipo=="E") {
				//si es 1 y es de tipo E llego tarde
				return "<strong> Entró tarde:".$horas_tarde1."  Horas, ". $minutos_tarde1." Min.</strong> ";
			}
			if ($invert_e==0 && $tipo=="E") {
				//si es 0 y es de tipo E llego temprano
				return " Entró temprano ".$horas_tarde1."  Horas, ". $minutos_tarde1." Min. ";
			 }
			 if ($invert_e==1 && $tipo=="S") {
				 //si es 1 y es tipo S es porque salio  tarde
	 			return "<strong> Salió tarde:".$horas_tarde1."  Horas, ". $minutos_tarde1." Min.</strong> ";
	 		}
			if ($invert_e==0 && $tipo=="S") {
				//si es 0 y es tipo S es porque salio  temprano
			 return "<strong> Salió temprano:".$horas_tarde1."  Horas, ". $minutos_tarde1." Min.</strong> ";
		 }
	}
}
*/

?>
