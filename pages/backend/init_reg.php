<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	include("../../modelo/conexion.php");
	
	$tiempo = $_POST['tiempo'];
	$user_id = $_POST['user'];
	$minutos = $_POST['minutos']+1;
	$numero=$_POST['numero'];
	$nombre=$_POST['nombre'];
	
	$wish = new conexion;
	$wish->tiempo($tiempo,$user_id, $minutos, $numero, $nombre);
	$wish->cerrar();
}
?>