<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
include("../../modelo/conexion.php");

$tiempo = $_POST['tiempo'];
$user_id = $_POST['user'];
$minutos = $_POST['minutos']+1;
$numero=$_POST['numero'];

$wish = new conexion; 
$wish->act_tiempo($user_id, $minutos, $numero);
//$wish->cerrar();
}
?>