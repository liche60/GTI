
<style>

.resaltar{background-color:#A9A9F5;}
.bor
{
	display:none;
}

#event
{
	font-size: 20px;
	padding: 1px 15px;
	color: blue;
	text-align: right;
	font-family: calibri;
}

.input__row{
 margin-top: 10px;  
}
/* Radio button */
.radiobtn {
 display: none;
}
.buttons {
 margin-left: -40px;
}

.buttons li {
 display: block;
}
.buttons li label{
 padding-left: 30px;
 position: relative;
 left: -25px;
}
.buttons li span {
 display: inline-block;
 position: relative;
 top: 5px;
 border: 2px solid #ccc;
 width: 18px;
 height: 18px;
 background: #fff;
}
.radiobtn:checked + span::before{
 content: '';
 border: 2px solid #fff;
 position: absolute;
 width: 14px;
 height: 14px;
 background-color: #c3e3fc;
}

#buscador
{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
	    width: 20%;
}
@media (max-width: 1150px)
	{
		.lwms-main .lwms-left, .lwms-main .lwms-right, lwms-filterhead
		{
			width: 160px;
		}		
	}
</style>
<?php

setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");


$oe = new conexion();
$contrato=$_POST['conmasivo'];
$ci = $oe->conexion->query("select id, nombre, ip from hosts where id_contrato='$contrato'");
$query2 = $oe->conexion->query("SELECT id_evento FROM registro_masivo ORDER BY id_evento desc LIMIT 1");
$row2 = $query2->fetch_assoc();
?>

<div class="box box-info">
<div class="box-header with-border">
<div class="w3-containerbox-body">

<!-- FORM -->
<form method="post" action="pages/backend/registro_masivo.php" >
	<div class="col-md-6">
	<div class="form-group">
	<div class="row">
<p> Buscar: <input name="buscador" id="buscador" class="form-control" type="text"> </p>


    <select id="cis" name="cis[]" multiple>
    <?php 
    while($row=$ci->fetch_assoc())
    {
    	echo '<option value="'.$row['id'].'">'.$row['nombre']." ---> " . $row['ip'].'</option>';
    }
    ?>
    </select>
    
    <br>
    <label>Descripción</label>
	<textarea class="form-control" name="desc"></textarea>
	
	<label>Responsable</label><br>
    <input value="Monitoreo NOC" class="form-control" required disabled>

	</div>
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
			<input id="f_inicio" name="f_inicio" class="form-control" value="<?php echo $fecha;?>">
		</div>
	</div>
	
	
	
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
	
	<label>Minutos de actividad</label>
    <input type="number" name="h_actividad" id="txtHoraActividad" class="form-control" value="0" required readonly>
                        
    <label>Tipo de actividad</label>
    <div class="input__row">
	    <ul class="buttons">
			<li>
				<input id="radiobtn_1" class="radiobtn" name="t_evento" type="radio" value="Programada" tabindex="1" required>
				<span></span>
				<label for="radiobtn_1" id="r1" >Programada</label>
				</li>
				<li>
				<input id="radiobtn_2" class="radiobtn" name="t_evento" type="radio" value="No programada" tabindex="2" required>
				<span></span>
				<label for="radiobtn_2" id="r2">No programada</label>
			</li>
		</ul>
	</div>
	
	</div>
	</div>
	
	
	<input type="hidden" name="event" value="<?php echo $row2['id_evento']+1;?>">
	<button type="submit" class="btn btn-success">Enviar</button>
	<a href="index.php"><button type="button" class="btn btn-danger pull-right" >Cancelar</button></a>
</form>

</div>
</div>
</div>

<script>
    $(document).ready(function () {
        (function ($) {
            $('#buscador').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('#lista li').hide();
                $('#lista li').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })
        }(jQuery));
    });



$('#cis').lwMultiSelect({
  	addAllText:"Seleccionar",
    removeAllText:"Removerlos",
    selectedLabel:"CI Seleccionados",
});

$('#cis').data('plugin_lwMultiSelect').removeAll();
$( "#cis option:checked" ).val();


//Script para Habilitar y Deshabilitar
$("#radiobtn_1").on("click", function(){
  var x = document.getElementById("txtHoraActividad");
  
  $('#txtHoraActividad').removeAttr("readOnly");
});  

$("#radiobtn_2").on("click", function(){
  var x = document.getElementById("txtHoraActividad");

  $('#txtHoraActividad').attr('readOnly','readOnly ');
  $('#txtHoraActividad').val('0');
}); 
</script>


