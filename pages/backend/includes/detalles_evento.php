<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$id = $_GET['param_id'];



if($id==""){
	
	echo ("Debes seleccionar un evento");
	
}else{
	$conn = $oe->conexion->query("select a.id_host,b.nombre,b.id_contrato,b.ip,c.nombre from incidentecop a,hosts b,new_proyectos c where a.id=$id and a.id_host=b.id and b.id_contrato=c.codigo ");
	
	
	while($row = mysqli_fetch_row($conn))
	{
		echo "Nombre de CI: ".$row[1]."<br> Código de contrato: ".$row[2]. "<br> Nombre de contrato: ".  $row[4]."<br> IP: ".$row[3]."";
	}
	$oe->cerrar();
}
?>