

<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");


		$id_evento=$_POST['event'];
		$host=$_POST['cis'];
		$f_inicio=$_POST['f_inicio'];
		$tipo_evento=$_POST['t_evento'];
		$causa_evento=$_POST['c_evento'];
		$tipo_actividad=$_POST['t_actividad'];
		$horas_actividad=$_POST['h_actividad'];
		$mesa=$_POST['mesa'];
		$descripcion=$_POST['desc'];
		$responsable=$_POST['respo'];
		
		$algo=explode("-", $responsable);
		
		$correo=$algo[0];
		$respo=$algo[1];
		echo $respo."<br>".$correo;
		
		$con = new conexion;
		
		foreach ($host as $id_host)
		{
			$con->registro_masivo($id_evento, $id_host, $f_inicio, $tipo_evento, $causa_evento, $tipo_actividad, $horas_actividad, $descripcion, $mesa, $respo);
		}
		$con->cerrar();
		
		header("Location: ../../index.php");
	
	
	
}
?>
