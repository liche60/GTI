
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$ausentismo  =$_POST['ausentismo'];
$fini  =$_POST['fecha_inicio'];
$ffin  =$_POST['fecha_fin'];
$com  =$_POST['comentario'];
$user_id  =$_POST['user_id'];
$proyecto  =$_POST['proyecto'];

$wish = new conexion; 
$wish->registrarAusentismo($user_id, $proyecto, $fini, $ffin, $ausentismo, $com);
$wish->cerrar(); 

header("Location: ../../index.php");

}

?>