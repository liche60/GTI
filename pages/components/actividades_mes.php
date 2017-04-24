
<script>
            document.getElementById("inicio").disabled = true;             
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 4, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>


<?php

$editar=0;
$editar_res=null;
if( isset($_GET['editar']) ){
	$editar=1;
	$id_editar = $_GET['editar'];
	$query="select * from registro_actividad where id = ".$id_editar."";
	$editar_res=$wish->conexion->query($query);
}

$consulta = "SELECT
r.id,
a.categoria,
a.actividad,
a.plataforma,
p.nombre as proyecto,
r.descripcion,
r.fecha_inicio,
r.numerotiquete,
r.fecha_fin,
r.tiempo_calculado,
r.tiempoReal,
r.estado
FROM registro_actividad r,
actividad a,
new_proyectos p
where a.id = r.id_actividad and
r.cedula = $userinfo->user_id
and r.id_contrato = p.codigo
and MONTH(fecha_inicio) = MONTH(NOW())
and YEAR(fecha_inicio) = YEAR(NOW())
order by  r.fecha_inicio desc
";

?>




<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header"></div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="zctb"
					class="display table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Actividad</th>
							<th>Contrato</th>
							<th>Descripción</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
							<th>Duración</th>
							<th>Editar</th>
						</tr>
					</thead>
					<tbody>
                                                <?php

						if ($consulta = $wish->conexion->query ( $consulta )) {
							while ( $obj = $consulta->fetch_object () ) 

							{
								?>
                                                <tr>
							<td><?php printf($obj->actividad);?></td>
							<td><?php printf($obj->proyecto);?></td>
							<td><?php printf($obj->descripcion);?></td>
							<td><?php printf($obj->fecha_inicio);?></td>
							<td><?php printf($obj->fecha_fin);?></td>
							<td><?php printf($obj->tiempoReal);?></td>
							<td><?php if($obj->estado != 'R'){ ?>
                                                        <a
								href="index.php?page=004&editar=<?php echo $obj->id ?>">
                                                            <?php } ?>
                                                            <input
									type="image" src="dist/img/edit.svg">
							</a></td>
						</tr> 
                                                <?php
																																																	
}
																																																	$consulta->close ();
																																																}
																																																?>         
                                            </tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>

