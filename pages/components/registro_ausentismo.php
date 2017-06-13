<script src="plugins/datetimepicker/js/bootstrap-datetimepicker.es.js"></script>
<script src="plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<link href="plugins/datetimepicker/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">



<form method="post" action="pages/backend/registro_ausentismo.php">


<input type="hidden" name="user_id" value="<?php echo $userinfo->user_id;?>">
<input type="hidden" name="proyecto" value="<?php echo $userinfo->proyecto;?>">

	<div class="row">
		<div class="col-md-12">

			<div class="box box-danger">
				<div class="box-header">
					<br>
					<h3 class="box-title">Registro de Ausentismo</h3>
					<br>
					<br>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Tipo de ausentismo</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-list-alt"></i>
							</div>
							<select id="ausentismo" name="ausentismo"
								class="form-control select2" style="width: 100%;" required>
								<option value="Vacaciones">Vacaciones</option>
								<option value="Permiso">Permiso</option>
								<option value="Incapacidad">Incapacidad</option>
								<option value="Evento corporativo">Evento corporativo</option>
								<option value="Descanso por turnos">Descanso por turnos</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Fecha inicio (Este dia no estabas en la compañía)</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="fecha_inicio" name="fecha_inicio" required value=""
								type="date" class="form-control" required>								
						</div>
					</div>


					<div class="form-group">
						<label>Fecha fin (Este dia regresaste a la compañía)</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							
							<input id="fecha_fin" name="fecha_fin" type="date"
								class="form-control" required>
						</div>
					</div>

					<div class="form-group">
						<label>Comentario</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-commenting"></i>
							</div>
							<textarea id="comentario" name="comentario"  class="form-control"
								required></textarea>
						</div>
					</div>
					<br>

					<button type="submit" class="btn btn-success" style="width: 150px;">Guardar</button>

					<a href="index.php"><button type="button" class="btn btn-danger"
							style="width: 150px;">Cancelar</button></a>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</form>


