<?php 
  
include ('../../../modelo/conexion.php');
$oe= new conexion();  
$id = $_GET['info_id'];

$conn = $oe->conexion->query("SELECT * FROM hosts WHERE id='$id' ");
  
while($row = $conn->fetch_assoc())
  {
  	echo $row['ip'];
  }
  
$oe->cerrar();
?>