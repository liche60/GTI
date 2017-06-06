<?php

include ('../../../modelo/conexion.php');
$oe = new conexion();
$id = $_GET['param_id'];


if($id==""){
	
	echo ("Debes seleccionar un evento");
	
}else{
	
	$conn = $oe->conexion->query("select a.id_evento as numero_evento, b.id_contrato as codigo_contrato, c.nombre as nombre_Contrato from registro_masivo a,hosts b,new_proyectos c where a.id_host=b.id and
b.id_contrato=c.codigo and a.id_evento=" . $id . " LIMIT 1");
	
	while ($row = mysqli_fetch_row($conn)) {
		
		echo "Evento número: " . $row[0] . "<br> Código de contrato: " . $row[1] . "<br> Nombre de contrato: " . $row[2]."";
	}
	$oe->cerrar();
}
?>