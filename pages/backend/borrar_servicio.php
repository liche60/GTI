<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

	$borrar=$_POST['borrar'];
	$correo="";
	
	$con = new conexion;
	$con->deleteservicio($borrar);
	$con->cerrar();
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>\r\n";
	$this_mail = mail($correo, "Se Elimina Servicio", "Se Elimina servicio del CI" , $headers);
	
	

}

?>