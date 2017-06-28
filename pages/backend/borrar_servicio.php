<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");
$con = new conexion;

	$borrar=$_POST['borrar'];
	
	$correo="dgskdj@gmail.com";
	$correo2="jhon.montoya@arus.com.co";
	
	
	
	$query = $con->conexion->query ( "select  e.nombre as CI, b.tipo as Servicio from detalle_servicio a, tipo_servicios b,
									  hosts e where	a.id_host=e.id and a.id_tipo_servicio=b.id and a.id_detalle=$borrar" );
	
	$row = $query->fetch_assoc ();
	
	$con->deleteservicio($borrar);
	$con->cerrar();
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>\r\n";
	$this_mail = mail($correo, "Se Elimina Servicio", "Se ha eliminado el servicio: ". $row['Servicio']." del CI :".$row['CI'], $headers);
}

?>