
<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$servicio=$_POST['servicio'];
$tipo_evento=$_POST['evento'];
$causa_evento=$_POST['causa_evento'];
$tipo_actividad=$_POST['tipo_actividad'];
$reporta=$_POST['reporta'];
$fecha=$_POST['fecha_inicio'];
$hrs_actividad=$_POST['hrs_actividad'];
$mesa=$_POST['mesa'];
$responsable=$_POST['responsable'];
$estado='P';
$id_host=$_POST['id_host'];
 
//el estado lo mando directo

$wish=new conexion();
$wish->registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad,
        $mesa,$responsable,$estado,$id_host);
$wish->cerrar(); 
 
header("Location: ../../index.php");
  
}

?>