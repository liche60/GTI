<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include("../../../modelo/conexion.php");
	$con = new conexion;
	$id=$_POST['id_detalles'];
	$servicio=$_POST['Uservicio'];
	$dispo=$_POST['Udispo'];
	$delay=$_POST['Udelay'];
	$check=$_POST['Ucheck'];
	$war=$_POST['Uwar'];
	$cri=$_POST['Ucri'];
	$tip=$_POST['Utipo_umbral'];
	$respon=$_POST['Urespo'];
	$horario=$_POST['Uhorario'];
	$puerto=$_POST['Upuerto'];
	$accion_critico=$_POST['Uaccion'];
	
	
	$algo=explode("-", $tip);
	$tipo=$algo[0];
	$tipo_nom=$algo[1];
	
	//$nuevo=array($delay,$check,$war,$cri,$puerto,$accion_critico,$dispo,$tipo,$horario);
	//$nuevo=array(12,3,'10%','60%','90','si que si hay','1',3,'habil');
	
	/*$servicio=array("delay","tiempo de chequeo","valor warning","valor critical","puerto",
			"accion critica","disponibilidad","tipo umbral","horario"
	);
	
	
	$cambio=array();
	
	
	$registro_ant=$con->conexion->query("select * from detalle_servicio where id_detalle=119");
	
	$reg_ant=$registro_ant->fetch_array();
	
	$anti=array($reg_ant['delay'],$reg_ant['tiempo_chequeo'],$reg_ant['val_war'],$reg_ant['val_cri'],
			$reg_ant['puerto'],$reg_ant['accion_critico'],$reg_ant['disponibilidad'],
			$reg_ant['id_tipo_umbral'],$reg_ant['horario']);
	
	
	for($i=0;$i<count($nuevo);$i++){
		
		if($nuevo [$i] != $anti[$i]){
			
			$cambio[$i]=$servicio[$i].": ".$nuevo[$i];
			
			
		}else{
			
			$cambio[$i]=$servicio[$i].": No se genero cambio en esta caracteristica";
		}
	}
	
	
	for($i=0;$i<count($cambio);$i++){
		
		echo $cambio[$i] ."<br>";
	}
	*/
	$con->update_servicio_ci($id, $dispo, $delay, $check, $war, $cri, $tipo, $horario, $puerto, $accion_critico);
	
	$con->deleteEscalamiento($id);
	
	
	foreach ($respon as $responsable)
	{
		$con->insertEscalamiento($id, $responsable);
	}
	
	
	//$nuevo_responsable=$con->conexion->query("select a.nombre , a.correo from new_personas a, escalamiento b where b.id_persona=a.cedula and b.id_detalle=$id");
	$con->cerrar();
}


?>