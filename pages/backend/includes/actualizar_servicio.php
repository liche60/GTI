<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../../modelo/conexion.php");
	$id=$_POST['id_detalles'];
	//$servicio=$_POST['servicio'];
	$dispo=$_POST['Udispo'];
	$delay=$_POST['Udelay'];
	$check=$_POST['Ucheck'];
	$war=$_POST['Uwar'];
	$cri=$_POST['Ucri'];
	$tipo=$_POST['Utipo_umbral'];
	$responsable=$_POST['Urespo'];
	$horario=$_POST['Uhorario'];
	$puerto=$_POST['Upuerto'];
	$accion_critico=$_POST['Uaccion'];
	
	$con = new conexion;
	$con->update_servicio_ci($id, $dispo, $delay, $check, $war, $cri, $tipo, $responsable, $horario, $puerto, $accion_critico);
	$con->cerrar();
	
}