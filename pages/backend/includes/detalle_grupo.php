<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

	include("../../../modelo/conexion.php");
	$con = new conexion;
	$oe=$_POST['id_escala'];

	if($oe!=4)
	{
		$query = $con->conexion->query("SELECT a.*, b.nombre FROM sub_grupo a, grupo b where a.id_grupo=b.id_grupo
		and b.id_grupo=$oe order by nivel;");
	}
	
	else 
	{
		$query = $con->conexion->query("SELECT a.*, b.nombre FROM sub_grupo a, grupo b where a.id_grupo=b.id_grupo and b.id_grupo=3
		union SELECT a.*, b.nombre FROM sub_grupo a, grupo b where a.id_grupo=b.id_grupo and b.id_grupo=1;");
	}

	echo"
	<table class='table table-bordered table-striped table-hover'>
		<tr>
			<th style='width:30%;'>Nombre</th>
			<th style='width:10%;'>Nivel</th>
			<th style='width:30%;'>Número</th>
			<th style='width:30%;'>Correo</th>
			<th style='width:15%;'>Grupo</th>
			<th style='width:15%;'>Modalidad</th>
			<th style='width:15%;'>Horario</th>
		</tr>";

	while ($row2 = $query->fetch_row())
	{
		echo"
			 <tr>
			    <td>$row2[1]</td>
			    <td>$row2[2]</td>
			    <td>$row2[3]</td>
			    <td>$row2[4]</td>
			    <td>$row2[8]</td>
				<td>$row2[6]</td>
				<td>$row2[7]</td>
			</tr>";
	}	
	echo "</table>";

}