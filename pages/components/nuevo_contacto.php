<script src="plugins/datetimepicker/js/bootstrap-datetimepicker.es.js"></script>
<script src="plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<link href="plugins/datetimepicker/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">



<form method="post" action="pages/backend/nuevo_contacto.php">


<input type="hidden" name="user_id" value="<?php echo $userinfo->user_id;?>">
<input type="hidden" name="proyecto" value="<?php echo $userinfo->proyecto;?>">

	<div class="row">
		<div class="col-md-12">

			<div class="box box-danger">
				<div class="box-header">
					<br>
					<h3 class="box-title">Nuevo Contacto</h3>
					<br>
					<br>
				</div>
				<div class="box-body">
				
				<div class="form-group">
						<label>Nombre</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user"></i>
							</div>
						<input type="text" class="form-control select2" name="nombre" style="width: 100%;" required>
						</div>
					</div>
					
					<div class="form-group">
						<label>Celular</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-mobile"></i>
							</div>
						<input type="number" class="form-control select2" name="celular" style="width: 100%;" required>
						</div>
					</div>
					
					<div class="form-group">
						<label>Correo</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-envelope"></i>
							</div>
						<input type="text" class="form-control select2" name="correo" style="width: 100%;" required>
						</div>
					</div>
				
				
					<div class="form-group">
						<label>Tipo</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user"></i>
							</div>
							<select id="tipo" name="tipo"
								class="form-control select2" style="width: 100%;" required>
								<option value="C">Cliente</option>
								<option value="I">Contacto Interno</option>
							</select>
						</div>
					</div>

				
					<div class="form-group">
						<label>Descripción</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-commenting"></i>
							</div>
							<textarea id="comentario" name="descripcion"  class="form-control"
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


