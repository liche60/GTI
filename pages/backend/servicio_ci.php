<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	error_reporting(E_ALL ^ E_NOTICE);
	include("../../modelo/conexion.php");
	$id=$_POST['ids'];
	$servicio=$_POST['servicio'];
	$dispo=$_POST['dispo'];
	$delay=$_POST['delay'];
	$war=$_POST['war'];
	$cri=$_POST['cri'];
	$tip=$_POST['tipo'];
	$respon=$_POST['responsable'];
	$check=$_POST['check'];
	$horario=$_POST['horario'];
	$puerto=$_POST['puerto'];
	$accion=$_POST['accion'];
	$nombre_host=$_POST['nombre_host'];
	$ip=$_POST['ip'];
	
	
	$algo=explode("-", $tip);
	$tipo=$algo[0];
	$tipo_nom=$algo[1];
	
	
	$con = new conexion;
	$consulta = $con->conexion->query ( "select id_tipo_servicio from detalle_servicio where id_host='$id' and id_tipo_servicio=$servicio");
	$num=$consulta->fetch_array();
	
	if ($num==0)
	{
		
		$con->servicio_ci($id, $servicio, $dispo, $delay, $war, $cri, $tipo, $check, $horario, $puerto, $accion);
		
		$query2=$con->conexion->query("select id_detalle from detalle_servicio order by 1 desc");
		$row=$query2->fetch_row();
		$id_detalle=$row[0];
		
		foreach ($respon as $responsable)
		{
		
			$con->insertEscalamiento($id_detalle, $responsable);
		}
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		
		$headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>" . "\r\n";
		$this_mail = mail("dgskdj@gmail.com, jhon.montoya@arus.com.co", "Se ha Creado un servicio", "Host: $nombre_host<br> IP: $ip<br> Disponibilidad(1-> up 0->down): $dispo <br> 
				Warning: $war<br> Critical : $cri<br> Tipo de umbral: $tipo_nom<br> Tiempo de chequeo: $check<br> Delay: $delay<br> Puerto: $puerto<br> Acción Crítica: $accion<br>", $headers);
	}
	
	
	$con->cerrar();
	
}
?>