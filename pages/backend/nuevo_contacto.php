<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$nombre=$_POST['nombre'];
$celular=$_POST['celular'];
$correo=$_POST['correo'];
$tipo=$_POST['tipo'];
$descripcion=$_POST['descripcion'];


$wish = new conexion; 
$wish->registroNewContacto($nombre, $celular, $correo, $tipo, $descripcion);
$wish->cerrar(); 

header("Location: ../../index.php");

}
