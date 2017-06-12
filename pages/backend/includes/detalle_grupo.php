<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

	include("../../../modelo/conexion.php");
	$con = new conexion;
	$oe=$_POST['id_escala'];

	
		$query = $con->conexion->query("SELECT b.nombre, b.nivel, b.celular, b.correo, b.metodo, b.horario, c.nombre 
										FROM escalamiento a, sub_grupo b, grupo c where a.id_persona=b.id and b.id_grupo=c.id_grupo 
										and a.id_detalle=$oe order by nivel;");
	
	

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
			    <td>$row2[0]</td>
			    <td>$row2[1]</td>
			    <td>$row2[2]</td>
			    <td>$row2[3]</td>
			    <td>$row2[6]</td>
				<td>$row2[4]</td>
				<td>$row2[5]</td>
			</tr>";
	}	
	echo "</table>";

}