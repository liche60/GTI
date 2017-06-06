<?php 
  
include ('../../../modelo/conexion.php');
$oe= new conexion();  
$id = $_GET['info_id'];

$conn = $oe->conexion->query("SELECT a.tipo, b.tipo as nombre FROM hosts a, tipo_dispositivo b WHERE a.tipo=b.id and a.id='$id'");
  
while($row = $conn->fetch_assoc())
  {
  	echo $row['nombre'];
  }
  
$oe->cerrar();
?>