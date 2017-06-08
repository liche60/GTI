<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include ("../../modelo/conexion.php");
	
	$editar=$_POST['editar'];
	$id_actividad = $_POST ['id_actividad'];
	$user_id = $_SESSION ['user_id'];
	$fecha_inicio = $_POST ['fecha_inicio'];
	$tiempoReal = $_POST ['tiempoReal'];
	$numerotiquete = $_POST ['numerotiquete'];
	$descripcion = $_POST ['descripcion'];
	$id_contrato = $_POST ['id_contrato'];
	$horaExtra = $_POST ['horaExtra'];
	$estado = 'F';
	if($horaExtra == 'Si'){
		$estado = 'P';
	}else{
		$horaExtra = 'No';
	}
	$wish = new conexion ();
	
	if($editar == 0){
		
		date_default_timezone_set ('America/Bogota');
		$fecha=strftime(" %Y-%m-%d %H:%M:%S");
		$fecha_fin = strtotime ( '+'.$tiempoReal.' minute' , strtotime ( $fecha ) ) ;
		$fecha_fin= strftime( '%Y-%m-%d %H:%M:%S', $fecha_fin);
		
		
		$wish->registrarNuevaActividad ( $id_actividad, $user_id, $fecha_inicio, $fecha_fin, $tiempoReal, $numerotiquete, $descripcion, $id_contrato, $horaExtra, $estado);
	}else{
		
		date_default_timezone_set ('America/Bogota');
		$fecha=strftime(" %Y-%m-%d %H:%M:%S");
		$fecha_fin = strtotime ( '+'.$tiempoReal.' minute' , strtotime ( $fecha ) ) ;
		$fecha_fin= strftime( '%Y-%m-%d %H:%M:%S', $fecha_fin);
		
		$id_reg = $_POST['id'];
		$wish->actualizarActividad ($id_reg, $user_id, $id_actividad, $descripcion, $fecha_inicio, $fecha_fin, $tiempoReal, $numerotiquete, $id_contrato, $horaExtra, $estado);
	}
	
	
	
	
	
	
	$wish->cerrar ();
	
	header ( "Location: ../../index.php" );
}

?>