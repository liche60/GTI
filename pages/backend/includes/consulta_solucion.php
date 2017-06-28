<?php  

include ('../../../modelo/conexion.php');
$oe= new conexion();


$valor = $_POST['individual'];
$cedula = $_POST['cedula'];
$txt="ind";
$txt2="mas";


if ($valor=='individual')
{
	$query = $oe->conexion->query ( "SELECT id FROM incidentecop where estado='P' and responsable=$cedula" );
	
	echo '<option value="" disabled selected> Seleccione ID de incidente </option>';
	while($row = $query->fetch_assoc ())
	{
		
		echo '<option value="'.$row['id']."-".$txt .'">'. $row['id'].' </option>';
	}
}

else 
{
	$query = $oe->conexion->query ( "SELECT distinct id_evento  FROM registro_masivo where estado='P' and responsable=$cedula" );
	
	echo '<option value="" disabled selected> Seleccione ID de incidente Masivo </option>';
	while($row = $query->fetch_assoc ())
	{
		echo '<option value="'.$row['id_evento']."-".$txt2 .'">'. $row['id_evento'].' </option>';
	}
}

$oe->cerrar();

?>

