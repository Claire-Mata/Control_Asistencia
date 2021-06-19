<?php
//las siguientes funciones es para darle formatos a las fechas 
function fecha_dmy($fecha){
    $dia = substr($fecha,8,2);
    $mes = substr($fecha,5,2);
    $a = substr($fecha,0,4);
    $fecha = "$dia-$mes-$a";
    return $fecha;
}
function fecha_ymd($fecha){
    $dia = substr($fecha,0,2);
    $mes = substr($fecha,3,2);
    $a = substr($fecha,6,4);
    $fecha = "$a-$mes-$dia";
    return $fecha;
}
//funcion para observaciones segun hora de entrada y salida
function obtener_observa($he1,$he2,$tipo){
	//funcion que obtieNe los objetos Datetime y retorna la observacion
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
?>
