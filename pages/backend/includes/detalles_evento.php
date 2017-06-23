<?php

include ('../../../modelo/conexion.php');
$oe= new conexion();
$ids = $_GET['param_id'];

$algo=explode("-", $ids);


$id=$algo[0];
$mas=$algo[1];

if($mas == "ind")
{

	$query1 = $oe->conexion->query("select a.servicio_afectado,b.nombre,b.id_contrato,b.ip,c.nombre from incidentecop a,hosts b,new_proyectos c where a.id=$id and a.id_host=b.id and b.id_contrato=c.codigo
									limit 1 ");
	
	while($row = $query1->fetch_row())
	{
		echo "Nombre de CI: ".$row[1]."<br> Código de contrato: ".$row[2]. "<br> Nombre de contrato: ".  $row[4]."<br> IP: ".$row[3]."<br> Servicio afectado: ".$row[0];
	}
}


else 
{
	$query2 = $oe->conexion->query("select a.id_evento as numero_evento, b.id_contrato as codigo_contrato, c.nombre as nombre_Contrato from registro_masivo a,hosts b,new_proyectos c where a.id_host=b.id and
									b.id_contrato=c.codigo and a.id_evento=" . $id . " LIMIT 1");


	while ($row2 = mysqli_fetch_row($query2))
	{
		echo "Evento número: " . $row2[0] . "<br> Código de contrato: " . $row2[1] . "<br> Nombre de contrato: " . $row2[2]."";
	}
	
}	
	$oe->cerrar();

?>

