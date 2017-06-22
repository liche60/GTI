<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../modelo/conexion.php");
	$id=$_POST['ids'];
	$servicio=$_POST['servicio'];
	$dispo=$_POST['dispo'];
	$delay=$_POST['delay'];
	$war=$_POST['war'];
	$cri=$_POST['cri'];
	$tipo=$_POST['tipo'];
	$respon=$_POST['responsable'];
	$check=$_POST['check'];
	$horario=$_POST['horario'];
	$puerto=$_POST['puerto'];
	$accion=$_POST['accion'];
	
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
		
	}
	
	
	$con->cerrar();
	
}