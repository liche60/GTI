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
        window.location = "../../index.php?page=028";
    }
    setTimeout("redireccionar()", 20);
</script> 




<?php
session_start();
if ($_SESSION ['authenticated'] == 1) {
    include("../../modelo/conexion.php");
    
   
    

    $ticket = $_POST['ticket'];
    $ids = $_POST['id_evento'];
    $tipo = $_POST['evento'];//recibe en valor del radio button
    //$tipo=$_POST['tipo'];
    $num_rfc=$_POST['rfc'];
    $fecha_cierre=$_POST['fecha_fin'];
    $detalles = $_POST['detalles'];
    $usuario=$_POST['btnus'];
    
    $algo=explode("-", $ids);
    
    
    $id=$algo[0];

    
    $con = new conexion;
    $query = "select ticket from solucion_incidente where ticket='$ticket'";
    $consulta = $con->conexion->query($query);
    $num = $consulta->fetch_array();

    

    if ($num == 0) {

        if ($tipo == "individual") {
        	$masivo="";
            $con->cambiarEstadoIncidente($id);
            $con->insertarNuevoTiquet($ticket, $id, $tipo, $num_rfc, $fecha_cierre, $detalles);
            $con->cerrar();
        }
        else {
        	$individual="";
            $con->cambiarEstadoIncidenteMasivo($id);
            $con->insertarNuevoTiquet($ticket, $id, $tipo, $num_rfc, $fecha_cierre, $detalles);
            $con->cerrar();
        }
 
    } else {
        echo "<script> alert('El número del ticket ya se encuentra') </script>";
        echo "<script> redireccionar2(); </script>";
    }
    
    echo "<script> redireccionar1(); </script>";
}
?>