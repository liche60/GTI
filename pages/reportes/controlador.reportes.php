
<?php
if (array_key_exists ( $report, $_REPORTS_CONFIG )) {
	$res = $_REPORTS_CONFIG [$report];
	$query = $res ["query"];
	$titulo = $res ["titulo"];
	$page = $_GET["page"];
	$filtros = false;
	if (isset ( $res ["filtros"] )) {
		$filtros = $res ["filtros"];
	}
	$tipo = $res ["tipo"];
	if($tipo == "tabla"){
		$columns = $res ["columnas"];
		include "pages/components/reportes_component.php";
	}elseif ($tipo == "grafico"){
		$grafico = $res ["grafico"];
		include "pages/components/reportes_graficos_component.php";
	}elseif($tipo == "grafico_linea"){
		$grafico= $res ["grafico"];
		include "pages/components/reportes_graficos_linea_component.php";
	}
} else {
	include $vista->_PAGE_CONFIG ["500"] ["link"];
}

?>

