
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");


$ip=$_POST['ip'];
$nombre_ci=$_POST['host'];
$id_contrato=$_POST['contrato'];
$horario_operativo=$_POST['horario_operacion'];
$ambiente=$_POST['ambiente'];
$tipo_dispositivo=$_POST['tipo_dispositivo'];


$wish=new conexion();
$wish->crearCI($ip, $nombre_ci, $id_contrato, $horario_operativo, $ambiente, $tipo_dispositivo);
$wish->cerrar(); 

header("Location: ../../index.php");
  
}

?>