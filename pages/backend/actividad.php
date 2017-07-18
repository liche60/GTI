<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$editar             =$_POST['editar'];
$user_id            = $_SESSION['user_id'];
$id                 =$_POST['id_actividad'];
$numerotiquete      =$_POST['numerotiquete'];
$descripcion        =$_POST['descripcion'];
$id_contrato        =$_POST['id_contrato'];
$tiempoReal         =$_POST['tiempoReal'];
$dato=$_POST['dato'];

$horaExtra = $_POST ['horaExtra'];

$descripcion = str_replace("'", '\\\'', $descripcion );



if($horaExtra == 'Si'){
	$estado = 'P';
}else{
	$horaExtra = 'No';
}
$wish = new conexion ();
    

if($editar == 0){
	
	date_default_timezone_set ('America/Bogota');
	$fecha=$dato;
	$fecha_fin = strtotime ( '+'.$tiempoReal.' minute' , strtotime ( $fecha ) ) ;
	$fecha_fin= strftime( '%Y-%m-%d %H:%M:%S', $fecha_fin);
	
	echo $fecha."<br>".$fecha_fin."<br>";
	$wish->registrarActividad ($user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato, $horaExtra);
}else{
	
	date_default_timezone_set ('America/Bogota');
	$fecha=strftime($fecha_inicio);
	$fecha_fin = strtotime ( '+'.$tiempoReal.' minute' , strtotime ( $fecha ) ) ;
	$fecha_fin= strftime( '%Y-%m-%d %H:%M:%S', $fecha_fin);
	
	$id_reg= $_POST['id'];
    $wish->actualizarActividad ($id_reg,$user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato);
}
$wish->cerrar(); 

//header("Location: ../../index.php");
}
?>