<?php
include("conexion.php");
include("funciones.php");
$fechai = fecha_ymd($_REQUEST['fechai']);
$fechaf=fecha_ymd($_REQUEST['fechaf']);
$sql_e="SELECT  * FROM empleados";
$res_e = mysqli_query($con, $sql_e);
if(mysqli_num_rows($res_e) == 0){
	echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
	//primero estas variables nos ayudaran despues
	$diasTrabajados=1;
	$no = 1;
	$llegadasTardia=0;
	$salidasTemprano=0;

	while($row = mysqli_fetch_assoc($res_e)){
		$observacion="";
		$arrayconta = cuenta_salidas_entradas($row['codigo'],$fechai,$fechaf);
		$llegTarde=$arrayconta[0];
		$salTemp=$arrayconta[1];
		$observacion=$arrayconta[2];
		//luego mostramos
?>
		<tr>
			<td>
				<?php echo $no?> <!--el numero-->
			</td>
			<td>
				<?php echo $row['codigo']?>
			</td>
			<td>
				<?php echo $row['nombres']?>
			</td>
			<td>
				<?php  echo diasTrab($row['codigo'],$fechai,$fechaf);
				?>
			</td>
			<td>
				<?php
				echo $llegTarde;
				?>
			</td>
			<td>
				<?php	echo $salTemp;?>
			</td>
			<td>
				<?php	echo $observacion;?>
			</td>
		</tr>
		<?php
		$no++;
	}
	?>
	<?php

}
//funcion para los dias trabajados
function diasTrab($codigo,$fechai,$fechaf){
	include("conexion.php");
	//include("funciones.php");
	$diasTrab=0;
	$sql = mysqli_query($con, "SELECT * FROM marcas
		 WHERE codigo='$codigo'
		 AND fecha BETWEEN '$fechai' AND '$fechaf'");
		 while($row = mysqli_fetch_assoc($sql)){
			 $codigo=$row['codigo'];
		 	 $diasTrab++;
		}
	return $diasTrab;
}
//funcion que cuenta cuantas salidas y entradas tardes tuvo el trabajador
function cuenta_salidas_entradas($codigo,$fechai,$fechaf){
	include("conexion.php");

	$sql0="SELECT id, hora_e_sem, hora_s_sem, hora_e_fd, hora_s_fd FROM horario";
	$res0 = mysqli_query($con, $sql0);
	$row0 = mysqli_fetch_assoc($res0);

	$sql1="SELECT m.codigo,m.fecha,m.hora_e,m.hora_s FROM marcas AS m
	WHERE    m.codigo='$codigo'
	AND m.fecha BETWEEN '$fechai' AND  '$fechaf'";
	$res= mysqli_query($con, $sql1);

	//funcion que obtieNe los objetos Datetime y retorna la observacion
	//si hubo llegads tardes o salidas temprano
	$llegatardes=0;
	$saltemprano=0;
	while($row = mysqli_fetch_assoc($res)){

		if(date("w",strtotime($row['fecha']))>0 && date("w",strtotime($row['fecha']))<6){
			//Entradas tarde al trabajo
			$hes1 = new DateTime($row['fecha']." ".$row0['hora_e_sem']);//aqui agarra la config del horario y la fecha
			$hes2 = new DateTime($row['fecha']." ".$row['hora_e']);//aqui agarra la hora de entrada y la fecha

			$tiempoe_dif = $hes2->diff($hes1);
			$invert_e    = $tiempoe_dif->invert;
			if (isset($invert_e)){
				if ($invert_e==1 ) {
					$llegatardes++;
				}
			}
			//salidas temprano del trabajo
			$hss1 = new DateTime($row['fecha']." ".$row0['hora_s_sem']);//aqui agarra la config del horario y la fecha
			$hss2 = new DateTime($row['fecha']." ".$row['hora_s']);//aqui agarra la hora de entrada y la fecha
			$tiempos_dif = $hss2->diff($hss1);
			$invert_s    = $tiempos_dif->invert;
			if (isset($invert_s)){
				if ($invert_s==0 ) {
					$saltemprano++;
				}
			}

		}
		if(date("w",strtotime($row['fecha']))==6 || date("w",strtotime($row['fecha']))==0){//esto ya es para sabado y domingo
			$hefd1 = new DateTime($row['fecha']." ".$row0['hora_e_fd']);//config horario
			$hefd2 = new DateTime($row['fecha']." ".$row['hora_e']);//esto es para el finde


			$tiempoe_dif2 = $hefd2->diff($hefd1);
			$invert2    = $tiempoe_dif2->invert;
			if (isset($invert2)){
				if ($invert2==1 ) {
				$llegatardes++;
				}
			}
			//salida temprano
			$hsfd1 = new DateTime($row['fecha']." ".$row0['hora_s_fd']);//config horario
			$hsfd2 = new DateTime($row['fecha']." ".$row['hora_s']);//esto es para el finde
			$tiempof_dif = $hsfd2->diff($hsfd1);
			$invert_sf    = $tiempof_dif->invert;
			if (isset($invert_sf)){
				if ($invert_sf==0) {
					$saltemprano++;
				}
			}
		}

	}
	$observacion=" ";
	if($llegatardes>0){
		$observacion.="<p class='text-warning'>Tiene Llegadas Tarde</p>";
	}

	if($saltemprano>0){
		$observacion.="<p class='text-info'>Tiene Salidas Temprano</p>";
	}

	$arrayconta = array($llegatardes,$saltemprano,$observacion);
	return $arrayconta;
}


?>
