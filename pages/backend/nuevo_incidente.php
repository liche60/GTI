<script type='text/javascript'>
    function redireccionar1()
    {
        window.location = "../../index.php";
    }
    setTimeout("redireccionar()", 20); 
</script>
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
$responsable=$_POST['idresponsable'];
$nombre_reporta=$_POST['nombre_reporta'];
$correo_responsable=$_POST['corresponsable'];
$estado='P';
$nombre_host=$_POST['nombre_host'];
$ip=$_POST['ip'];
 
//el estado lo mando directo

$wish=new conexion();
$wish->registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad,
        $mesa,$responsable,$estado,$id_host);

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>" . "\r\n";
$this_mail = mail("dgskdj@gmail.com", "Se ha generado un incidente", "Host: $nombre_host<br> IP: $ip<br> Servicio afectado: $servicio <br> Tipo Evento: $tipo_evento<br> 
					Causa Evento: $causa_evento<br> Minutos de Actividad: $hrs_actividad<br> Tipo Actividad: $tipo_actividad<br> 
					Persona que Reporta: $nombre_reporta<br> Fecha y Hora: $fecha", $headers);
echo "<script> alert('Mensaje enviado') </script>";
echo "<script> redireccionar1(); </script>";

$wish->cerrar(); 
 
}

?>