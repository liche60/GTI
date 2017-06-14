
<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script>
<script src="dist/js/pages/operaciones.js"></script>

<?php
$query = "select actividad from actividad";
$res = $wish->conexion->query ( $query );


setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");


if ($userinfo->area == 23) {
	$query = "select id from actividad where area=" . $userinfo->area . "";
} else {
	$query = "select id from actividad where  area='8' or area=" . $userinfo->area . "  order by id ";
}

$re = $wish->conexion->query ( $query );
$fila = mysqli_fetch_row ( $re );

$query = "select * from proyecto";
$rea = $wish->conexion->query ( $query );

$query = "select categoria from actividad";
$rep = $wish->conexion->query ( $query );

$queryContratos = "SELECT codigo,alias FROM new_lider_contratos where id_lider = $lider_id;";
$rContratos = $wish->conexion->query ( $queryContratos );

$editar = 0;
$editar_res = null;
if (isset ( $_GET ['editar'] )) {
	$editar = 1;
	$id_editar = $_GET ['editar'];
	$query = "select * from registro_actividad where id = " . $id_editar . "";
	$editar_res = $wish->conexion->query ( $query );
}
?>

<!-- Main content -->
<div class="col-md-12">
	<div class="box box-default">
		<div class="box-body">
			<form action="pages/backend/registrar_nueva_actividad.php"
				method="POST" onsubmit="return validacion(this)">
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Actividad</label> <input type="text" id="actividad"
								class="form-control" disabled required>
						</div>
						<div class="form-group">
							<label>Categoria</label> <input type="text" name="categoria"
								id="categoria" required class="form-control" disabled required>
						</div>
						<div class="form-group">
							<label>Plataforma</label> <input id="plataforma" type="text"
								class="form-control" disabled required>
						</div>
						<input type="hidden" id="areaa" name="areaa" value="<?php echo $userinfo->area;?>">
						<!-- /.form-group -->
						<div class="form-group">
							<label>Contrato</label> <select id="id_contrato"
								name="id_contrato" class="form-control select2"
								style="width: 100%;" required>
								<option value="" id=""></option>            
                  <?php
																		while ( $row = $rContratos->fetch_object () ) {
																			?>

                    <option id="<?php echo $row->codigo; ?>"
									value="<?php echo $row->codigo; ?>"><?php echo $row->alias;?></option>
                    <?php } ?>  
                </select>
						</div>



						<div class="form-group">
							<label>Descripción</label>
							<textarea id="descripcion" name="descripcion"
								class="form-control" rows="5" placeholder="Descripción" required></textarea>
						</div>
						<!-- /.form-group -->
					</div>
					<!-- /.col -->
					<div class="col-md-6">
						<div class="form-group">
							<label>Id actividad</label> <select id="id_actividad"
								name="id_actividad" class="form-control select2"
								style="width: 100%;" onchange="queryActividad();" required>
								<option value="" id=""></option>
                 <?php
																	
																	while ( $row = $re->fetch_object () ) {
																		$row->id;
																		?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?></option>
                    <?php } ?>  
                </select>

						</div>


						<div class="form-group">
							<label>N° Tiquete</label> <input type="text" id="numerotiquete"
								name="numerotiquete" class="form-control">
						</div>

<!-- fecha -->
						<div class="form-group">
							<i class="fa fa-calendar"></i> <label>Fecha y hora de inicio</label>
							<input id="fecha_inicio" name="fecha_inicio" required value="<?php echo $fecha?>"
								type="datetime" class="form-control" >
						</div>
						<div class="form-group">
							<label>Tiempo Real (minutos)</label> <input id="tiempoReal"
								name="tiempoReal" type="number" class="form-control">
						</div>


						<div class="form-group">
							<label>Hora extra</label> <br> <input name="horaExtra"
								id='horaExtra' type="checkbox" value="Si">
						</div>




 <?php
	if ($editar) {
		?>
															<script>
																<?php
		$row_editar = $editar_res->fetch_object ();
		$id_actividad = $row_editar->id_actividad;
		$numerotiquete = $row_editar->numerotiquete;
		$descripcion = $row_editar->descripcion;
		$id_contrato = $row_editar->id_contrato;
		$tiempoReal = $row_editar->tiempoReal;
		$horaExtra = $row_editar->horaExtra;
		$fecha_inicio = $row_editar->fecha_inicio;
		?>
		
							                                     document.getElementById("id_actividad").value="<?php echo $id_actividad;  ?>";
							                                     queryActividad();
							                                     document.getElementById("numerotiquete").value="<?php echo $numerotiquete;  ?>";
							                                     document.getElementById("descripcion").value="<?php echo $descripcion;  ?>";
							                                     document.getElementById("<?php echo $id_contrato; ?>").selected = true;
							                                     document.getElementById("tiempoReal").value="<?php echo $tiempoReal;  ?>";
							                                     document.getElementById("fecha_inicio").value="<?php echo $fecha_inicio;  ?>";
							                                     if($horaExtra == 'Si'){
							                                     	document.getElementById("horaExtra").checked = true;;
							                                     }
							                                     
															  </script>

						<input type="hidden" id="id" name="id"
							value="<?php echo $id_editar; ?>" /> <input type="hidden"
							id="editar" name="editar" value="1" />
                                                        <?php
	} else {
		?>
                                                         <input
							type="hidden" name="editar" value="0" />
                                                         <?php
	}
	
	?>        
              





						<br>
						<button type="submit" class="btn btn-success"
							style="width: 150px;">Guardar</button>
						&nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php"><button
								type="button" class="btn btn-danger" style="width: 150px;">Cancelar</button></a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>