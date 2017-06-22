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
$correo_responsable=$_POST['corresponsable'];
$estado='P';
$id_host=$_POST['id_host'];
 
//el estado lo mando directo

$wish=new conexion();
$wish->registrarIncidente($servicio, $tipo_evento, $causa_evento, $tipo_actividad, $reporta, $fecha, $hrs_actividad,
        $mesa,$responsable,$estado,$id_host);

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>" . "\r\n";
$this_mail = mail("dgskdj@gmail.com", "incidente", "Se se ha Generado un incidente", $headers);
echo "<script> alert('Mensaje enviado') </script>";
echo "<script> redireccionar1(); </script>";

$wish->cerrar(); 
 
}

?>