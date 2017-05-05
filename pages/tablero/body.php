<?php 
if($rol == 1){ //lider
	include "pages/components/metricas_lider.php";
	include "pages/components/productiviad_recursos_lider.php";
}
if($rol == 2){ //analista
	include "pages/components/metricas_ingeniero.php";
	include "pages/components/registro_bitacora.php";
}
if($rol == 3){ //auditor
	include "pages/components/metricas_lider.php";
	include "pages/components/productiviad_recursos_lider.php";
}
if($rol == 4){ //administrador
	include "pages/components/metricas_ingeniero.php";
	include "pages/components/registro_bitacora.php";
	include "pages/components/metricas_lider.php";
	include "pages/components/productiviad_recursos_lider.php";
}
if($rol == 5){ //lider tecnico
	include "pages/components/metricas_ingeniero.php";
	include "pages/components/registro_bitacora.php";
	include "pages/components/metricas_lider.php";
	include "pages/components/productiviad_recursos_lider.php";
}
?>