<?php 
  
include ('../../../modelo/conexion.php');
$oe= new conexion();  
$id = $_GET['info_id'];

$conn = $oe->conexion->query("SELECT horario_operativo FROM hosts WHERE id='$id'");
  
while($row = $conn->fetch_assoc())
  {
  	echo $row['horario_operativo'];
  }
  
$oe->cerrar();
?>