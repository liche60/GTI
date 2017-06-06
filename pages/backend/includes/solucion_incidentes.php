<script type='text/javascript'>
    function redireccionar1()
    {
        window.location = "../../index.php";
    }
    setTimeout("redireccionar()", 20);
</script>
 
<script type='text/javascript'>
    function redireccionar2()
    {
        window.location = "../../index.php?page=026";
    }
    setTimeout("redireccionar()", 20);
</script> 

<?php
session_start();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");

    $id = $_POST['id_incidente'];
    $ticket = $_POST['ticket'];
    $descripcion = $_POST['descripcion'];
    $tipo_incidente = $_POST['tipo_evento'];//recibe en valor del radio button


    $con = new conexion;
    $query = "select ticket from ticket where ticket='$ticket'";
    $consulta = $con->conexion->query($query);
    $num = $consulta->fetch_array();

    class notificarSolucion {

        function enviar() {
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

            $headers .= "From: Bitacora de operaciones <bitacora@arus.com.co>" . "\r\n";
            mail("dgskdj@gmail.com", "Solución incidente", "Se se ha solucionado el incidente", $headers);
            echo "<script> alert('Mensaje enviado') </script>";
            echo "<script> redireccionar1(); </script>";
        }

    }

    if ($num == 0) {


        if ($tipo_incidente == "individual") {
            $con->cambiarEstadoIncidente($id);
            $con->insertarNuevoTiquet($ticket, $id, $descripcion, $tipo_incidente);
            $con->cerrar();
        }
        else {
            $con->cambiarEstadoIncidenteMasivo($id);
            $con->insertarNuevoTiquet($ticket, $id, $descripcion, $tipo_incidente);
            $con->cerrar();
        }
 
        $oe = new notificarSolucion();
        $oe->enviar();
    } else {
        echo "<script> alert('El número del ticket ya se encuentra') </script>";
        echo "<script> redireccionar2(); </script>";
    }
} 