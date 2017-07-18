<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<style>

.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
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
$escala = $oe->conexion->query("SELECT distinct a.nombre, a.correo, a.celular, b.area, c.id, c.contacto, a.cedula FROM new_personas a,
								areas b, sub_grupo c, new_usuario d WHERE c.cedula=a.cedula and a.cedula=d.cedula 
								and b.id=d.area and d.area in (9, 10, 11, 12) order by 4 asc");
$conn = $oe->conexion->query("SELECT nombre FROM new_proyectos where codigo='$contrato'");
$row4=$conn->fetch_row();
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
	<select class="form-control" required name="respo" id="responsable" style="width: 100%;">
	<option value="" disabled selected> Seleccione un responsable </option>
	 <?php 
	 while ($row3 = $escala->fetch_row())
    {
    	echo '<option value="'.$row3[1]."-".$row3[6].'">'.ucwords(strtolower($row3[0]))." ---> " . $row3[3].'</option>';
    }mysqli_data_seek($escala, 0);
    ?>
	<!-- 	<option value="prueba1">APP</option>
		<option value="prueba2">BD</option>
		<option value="prueba3">NOC</option>
		<option value="prueba4">SOC</option>
	 -->
		
	</select>
	
	</div>
	</div>
	</div>
	<div class="col-md-6">
	<div class="form-group">
	<p id="event"><strong>Evento: </strong><?php echo $row2['id_evento']+1;?></p>
	
	
	<label>Mesa</label>
      <select name="mesa"  class="form-control" required>
      <option value="" disabled selected> Seleccione una mesa  </option>
	      <option value="Maya">Maya</option>
	      <option value="Marco">Marco</option>
	      <option value="serviciogco@arus.com.co">servicio gco</option>
	   </select> 
	
	
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
		<option value="disponibilidad">Disponibilidad</option>
		<option value="capacidad">Capacidad</option>
	</select>
	
	<label>Tipo de Evento</label>
	<select class="form-control" name="t_evento">
		<option></option>
		<option value="critival">Critical</option>
		<option value="warning">Warning</option>
	</select>
	
	<label>Minutos de actividad</label>
    <input type="number" name="h_actividad" id="txtHoraActividad" class="form-control" value="0" required readonly>
                        
    <label>Tipo de actividad</label>
    <div class="input__row">
	    <ul class="buttons">
			<li>
				<input id="radiobtn_1" class="radiobtn" name="t_actividad" type="radio" value="Programada" tabindex="1" required>
				<span></span>
				<label for="radiobtn_1" id="r1" >Programada</label>
				</li>
				<li>
				<input id="radiobtn_2" class="radiobtn" name="t_actividad" type="radio" value="No programada" tabindex="2" required>
				<span></span>
				<label for="radiobtn_2" id="r2">No programada</label>
			</li>
		</ul>
	</div>
	
	</div>
	</div>
	
	<input type="hidden" name="contrato" value="<?php echo $row4[0];?>">
	<input type="hidden" name="event" value="<?php echo $row2['id_evento']+1;?>">
	<button type="submit" class="btn btn-success">Enviar</button>
	<button id="btnesc" type="button" class="btn btn-info pull-center">Escala</button>
	<a href="index.php"><button type="button" class="btn btn-danger pull-right" >Cancelar</button></a>
</form>



</div>
</div>
</div>

<!-- INICIO DE MODAL ESCALAMIENTO -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 135%; border-radius:10px;" class="modal-content">
		<div class="modal-header">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
        
        <label style="font-size: 22px;">Escalamiento</label> <br><br>
        
       <?php 
       	
       echo"
			<div style=' width: 101.5%; height:320px; overflow: scroll;'>
			<table class='table table-bordered table-striped table-hover'>
		<tr>
			<th style='width:30%;'>Nombre</th>
			<th style='width:10%;'>Contacto</th>
			<th style='width:30%;'>Número</th>
			<th style='width:30%;'>Correo</th>
			<th style='width:15%;'>Area</th>
		</tr>";

		while ($row3 = $escala->fetch_row())
		{
			echo"
				 <tr>
				 <td>".ucwords(strtolower($row3[0]))."</td>
				    <td>$row3[5]</td>
				    <td>$row3[2]</td>
				    <td>$row3[1]</td>
				    <td>$row3[3]</td>
				</tr>";
		}
		echo "</table></div>"
       ?>
		
		</div>							
		 </div>
		  </div>
		    </div>
			</div>
		</div>
	<!-- FIN DE MODAL -->


<script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("#responsable").select2();
	     });
    </script>
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

$("#btnesc").on("click", function(){
		$("#myModal").modal('show');
		});
</script>


