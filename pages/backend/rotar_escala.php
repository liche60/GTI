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
    
    $con = new conexion;
    
    
    $cedula=$_GET['valor'];
    $event=$_GET['id_even'];
    
    $algo=explode("-", $event);    
    $id_evento=$algo[0];
    $tipo_event=$algo[1];
    
    if($tipo_event=="mas")
    {
    
	    
	    if($cedula=="null" || $id_evento=="null")
	    {
	    	echo "<script> alert('No has elegido valores') </script>";
	    	echo "<script> redireccionar2(); </script>";
	    }
	    
	    else 
	    {
	    	$con->rotarescala($cedula, $id_evento);
	    	echo "<script> alert('Cambio exitoso') </script>";
	    	echo "<script> redireccionar1(); </script>";
	    }
    
    }
    
    else 
    {
    	echo "<script> alert('Solo Eventos Masivos') </script>";
    	echo "<script> redireccionar2(); </script>";
    }
    
}
?>