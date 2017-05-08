<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");


$tipo=$_POST['tipo'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$id_host=$_POST['id_host'];
$accion=$_POST['accion'];
$tiempo=$_POST['tiempo'];



$con = new conexion; 
$con->insertService($tipo, $nombre, $descripcion, $id_host, $accion, $tiempo);
$con->cerrar(); 
}
