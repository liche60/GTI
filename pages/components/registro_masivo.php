<br>
<?php if(isset($_POST['conmasivo']))
{?>
<style>
#event
{
	font-size: 20px;
	padding: 1px 15px;
	color: blue;
	text-align: right;
	font-family: calibri;
}
</style>
<div class="box box-info">
<div class="box-header with-border">
<div class="w3-containerbox-body">

<!-- FORM -->
<form method="post" action="pages/backend/registro_masivo.php" >
	<div class="col-md-6">
	<div class="form-group">
<p> Buscar: Ctrl + f </p>
<?php
$oe = new conexion();
$contrato=$_POST['conmasivo'];
$ci = $oe->conexion->query("select id, nombre from hosts where id_contrato='$contrato'");
$query2 = $oe->conexion->query("SELECT id_evento FROM registro_masivo ORDER BY id_evento desc LIMIT 1");
$row2 = $query2->fetch_assoc();
?>

    <select id="cis" name="cis[]" multiple>
    <?php 
    while($row=$ci->fetch_assoc())
    {
    	echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    }
    ?>
    </select>
    
    <br>
    <label>Descripción</label>
	<textarea class="form-control" name="desc"></textarea>

	</div>
	</div>
	
	<div class="col-md-6">
	<div class="form-group">
	<p id="event"><strong>Evento: </strong><?php echo $row2['id_evento']+1;?></p>
	
	<div class="form-group">
		<label>Fecha Inicio</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</div>
			<input id="f_inicio" name="f_inicio" type="datetime-local" class="form-control" >
		</div>
	</div>
	
	<label>Horas de actividad</label>
	<input name="h_actividad" type="text" class="form-control">
	
	<label>Tipo de Evento</label>
	<select class="form-control" name="t_evento">
		<option></option>
		<option>Programada</option>
		<option>No programada</option>
	</select>
	
	<label>Causa del Evento</label>
	<select class="form-control" name="c_evento">
		<option></option>
		<option>Disponibilidad</option>
		<option>Capacidad</option>
	</select>
	
	<label>Tipo de Actividad</label>
	<select class="form-control" name="t_actividad">
		<option></option>
		<option>Critical</option>
		<option>Warning</option>
	</select>
	
	
	
	</div>
	</div>
	
	
	<input type="hidden" name="event" value="<?php echo $row2['id_evento']+1;?>">
	<button type="submit" class="btn btn-success">Enviar</button>
	<a href="index.php"><button type="button" class="btn btn-danger pull-right" >Cancelar</button></a>
</form>

</div>
</div>
</div>

<?php } 
else {
	echo "<script> alert('debe elegir contrato primero'); window.location='index.php?page=013';</script>";
}?>


<script>
$('#cis').lwMultiSelect({
  	addAllText:"Seleccionar Todos",
    removeAllText:"Removerlos",
    selectedLabel:"CI Seleccionados",
});

$('#cis').data('plugin_lwMultiSelect').removeAll();
$( "#cis option:checked" ).val();


</script>


