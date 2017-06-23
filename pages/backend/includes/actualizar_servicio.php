<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

	include("../../../modelo/conexion.php");
	$con = new conexion;
	$id=$_POST['id_detalles'];
	$servicio=$_POST['servicio'];
	$dispo=$_POST['Udispo'];
	$delay=$_POST['Udelay'];
	$check=$_POST['Ucheck'];
	$war=$_POST['Uwar']; 
	$cri=$_POST['Ucri'];
	$tipo=$_POST['Utipo_umbral'];
	$respon=$_POST['Urespo'];
	$horario=$_POST['Uhorario'];
	$puerto=$_POST['Upuerto'];
	$accion_critico=$_POST['Uaccion'];
	 
	//$nuevo=array($delay,$check,$war,$cri,$puerto,$accion_critico,$dispo,$tipo,$horario);
	
	$nuevo=array("2",1,'70%','80%',"","","0",1,"");
	
	
	$servicio=array("delay","tiempo de chequeo","valor warning","valor critical","puerto","accion critica","disponibilidad",
			"tipo umbral","horario"
	);
	
	$cambio=array();
	
	$registro_ant=$con->conexion->query("select * from detalle_servicio where id_detalle=1");
		
	$reg_ant=$registro_ant->fetch_array();
		
	$anti=array($reg_ant['delay'],$reg_ant['tiempo_chequeo'],$reg_ant['val_war'],$reg_ant['val_cri'],
			$reg_ant['puerto'],$reg_ant['accion_critico'],$reg_ant['disponibilidad'],
			$reg_ant['id_tipo_umbral'],$reg_ant['horario']);
	
	
	for($i=0;$i<count($nuevo);$i++){
		
		if($nuevo [$i] != $anti[$i]){
			
			$cambio[$i]=$servicio[$i];
			
			echo $cambio[$i];
		}
		
	}
	
	$con->update_servicio_ci($id, $dispo, $delay, $check, $war, $cri, $tipo, $horario, $puerto, $accion_critico);
	
	$con->deleteEscalamiento($id);
	
	
	foreach ($respon as $responsable)
	{
		$con->insertEscalamiento($id, $responsable);
	}
	

	
	$con->cerrar();
	
}