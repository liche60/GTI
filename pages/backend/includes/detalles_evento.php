<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['param_id'];



if($id==""){
	
	echo ("Debes seleccionar un evento");
	
}else{
	$conn = $oe->conexion->query("select a.servicio_afectado,b.nombre,b.id_contrato,b.ip,c.nombre from incidentecop a,hosts b,new_proyectos c where a.id=$id and a.id_host=b.id and b.id_contrato=c.codigo
			limit 1 ");
	
	
	while($row = mysqli_fetch_row($conn))
	{
		echo "Nombre de CI: ".$row[1]."<br> CÃ³digo de contrato: ".$row[2]. "<br> Nombre de contrato: ".  $row[4]."<br> IP: ".$row[3]."<br> Servicio afectado: ".$row[0];
	}
	$oe->cerrar();
}
?>