<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../modelo/conexion.php");
	$tipo=$_POST['tipo'];
	
	$con = new conexion;
	$con->nuevoservicio($tipo);
	$con->cerrar();
	
}