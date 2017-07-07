<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<link rel="stylesheet" href="plugins/multiselect/multipleSelect.css">


<style>
	.select2-container--default .select2-selection--single, .w3-input
	{
		padding: 5px;
	    display: block;
	    border: none;
	    border-bottom: 1px solid #ccc;
	}
	
	.ms-options ms-active
	{
		min-height: 100px; 
		max-height: 100px;
	}
	
	.ms-drop.bottom
	{
		width: 310px;
		
	}
	
	
</style>

<?php 

error_reporting(E_ALL ^ E_NOTICE);
$oe= new conexion();
$id = $_POST['sci'];
$contrato = $_POST['contrato'];
$ip = $_POST['ip'];

$conn = $oe->conexion->query("select a.id_detalle, a.accion_critico, a.tiempo_chequeo, a.horario, a.id_host, a.puerto, a.accion_critico, e.nombre as CI, b.tipo as Servicio, a.disponibilidad,  a.delay, a.val_war as Warning, a.val_cri
								as Critical,  d.nombre as Tipo_de_umbral from detalle_servicio a, tipo_servicios b, tipo_umbral d,
								 hosts e where a.id_host=e.id and a.id_tipo_servicio=b.id and a.id_tipo_umbral=d.id_tipo_umbral and
								 e.id='$id' and a.estado='A' order by a.id_detalle desc");

$ser = $oe->conexion->query("SELECT * FROM tipo_servicios");
$escala = $oe->conexion->query("select a.nombre, a.cedula, b.contacto from new_personas a, sub_grupo b where a.cedula=b.cedula;");

$cont = $oe->conexion->query("SELECT nombre FROM new_proyectos where codigo='$contrato'");
$nom = $oe->conexion->query("SELECT nombre FROM hosts where id='$id'");
$contra = $cont->fetch_assoc();
$nomc = $nom->fetch_assoc();

?>


	<div class="box box-info">
	<div class="box-header with-border">
	<div class="box-body">
	

	<P> <strong style="font-size: 120%;">CONTRATO: </strong> <?php echo $contra['nombre'];?> <br>
	<strong style="font-size: 120%;">CI: </strong>  <?php echo $nomc['nombre'];?> <br>
	<strong style="font-size: 120%;">IP: </strong>  <?php echo $ip;?>
	</P>
<br>	
<div style=" width: 101.5%; height:280px; overflow-y: scroll;">

	<table id="tabla" class="table table-bordered table-hover table-striped">
		<tr style="text-align: center;">
		
						
			<td style="width:16%">
				<h4>SERVICIOS</h4>
			</td>
			
			<td style="width:10%">
				<h4>DISPONI<br>BILIDAD</h4>
			</td>
			
			<td style="width:10%">
				<h4>DELAY</h4>
			</td>
			
			<td style="width:10%">
				<h4>TIEMPO CHEQUEO (min)</h4>
			</td>
			
			<td style="width:10%">
				<h4>WARNING</h4>
			</td>
			
			<td style="width:10%">
				<h4>CRITICAL</h4>
			</td>
			
			<td style="width:10%">
				<h4>TIPO_UMBRAL</h4>
			</td>
			<td style="width:10%">
				<h4>RESPONSABLE</h4>
			</td>
			
			<td style="width:10%">
				<h4>HORARIO NOTIFICA<BR>CION</h4>
			</td>
			
			<td style="width:10%">
				<h4>PUERTO</h4>
			</td>
			
			<td style="width:10%">
				<h4>CONFIGURAR</h4>
			</td>
		</tr>
		
		<?php		
		while($row = $conn->fetch_assoc())
			{
			?>
		<tr style="text-align: center;">
		
				
				
				<td style="text-align: left;">
					<label class="accion" title="Acción Crítica: <?php echo $row['accion_critico'];?>"> <?php echo $row['Servicio'];?> </label>
				</td>
				 
				<td>
					<?php echo $row['disponibilidad'];?>
				</td>
				
				<td>
					<?php echo $row['delay'];?>
				</td>
				
				<td>
					<?php echo $row['tiempo_chequeo'];?>
				</td>
				
				<td>
					<?php echo $row['Warning'];?>
				</td>
				
				<td>
					<?php echo $row['Critical'];?>
				</td>
				
				<td>
					<?php echo $row['Tipo_de_umbral'];?>
				</td>
				
				<td>
				<form onsubmit="MostrarConsulta('<?php echo $row['id_detalle'];?>'); return false">
					<button data-target="#modalescala" data-toggle="modal" class="btn btn-default" >Escala</button>
				</form>
				</td>
				<!-- ESTE ES LA COLUMNA DE LOS HORARIOS DE NOTIFICACIÓN POR SERVICIO PARA PONER EL COMENTARIO -->
				<td>
					<?php echo $row['horario'];?>
				</td>
			
			<td>
				<?php echo $row['puerto'];?>
			</td>
				
				<td>
					<div class="col-md-4" style="padding-right: 23px;">
					<div class="form-group">
						<a href="#" data-target="#modalactualizar" data-toggle="modal" onclick="upd('<?php echo $row['Servicio'];?>','<?php echo $row['accion_critico'];?>',<?php echo $row['id_detalle'];?>, <?php echo $row['delay'];?>, <?php echo $row['tiempo_chequeo'];?>, '<?php echo $row['Warning'];?>', '<?php echo $row['Critical'];?>', <?php echo $row['puerto'];?>);">
						<button id="upda" type="submit" title="actualizar" class="btn btn-default"><i class="fa fa-refresh"></i></button>
						</a>					
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group">
						<a href="#" data-target="#modaleliminar" data-toggle="modal" onclick="elim(<?php echo $row['id_detalle'];?>);">
						<button type="submit" title="Eliminar" class="btn btn-default"><i class="fa fa-times"></i></button>
						</a>
					</div>
					</div>
				</td>
			</tr>
		<?php }?>
	</table>
<br>

	</div>
</div>

<div style=" width: 100.5%;  overflow-y: scroll;">

<form name="formulario" id="formulario" action="" onSubmit="enviarservicio(); return false" >
<table id="tabla" class="table table-bordered table-hover table-striped">
	<tr>
		<td>
			<select class="w3-input select2" name="servicio" style="width:95px" required>
			<option value="" disabled selected> Servicio </option>
				<?php
		        while($rowser = $ser->fetch_assoc())
		        {
		        	echo '<option value="'.$rowser['id'].'">'.$rowser['tipo'].'</option>';
		        }
				?>       
				</select>
		</td>
		
		<td style="width:10%">
			<select class="w3-input select2" name="dispo" >
				<option value="-" selected>Dispon.</option>
				<option value="0"> Down </option>
				<option value="1"> Up </option>
			</select>
		</td>
		
		<td >
			<input name="delay" placeholder="delay" class="w3-input war" type="text" style="width:75px" required>
		</td>
		
		<td>
			<input name="check" placeholder="chequeo" class="w3-input war" type="text" style="width:75px" required>
		</td>
		
		<td >
			<input name="war" placeholder="warning" class="w3-input war" type="text" style="width:75px" >
		</td>
		
		<td >
			<input name="cri" placeholder="critical" class="w3-input war" type="text" style="width:75px" >
		</td>
		
		<td >
			<select class="w3-input select2" name="tipo" >
				<option value="" disabled selected>T. Umbral</option>
				<option value="1-Porcentaje"> Porcentaje </option>
				<option value="2-sesiones"> sesiones </option>
				<option value="3-segundos"> segundos </option>
			</select>
		</td>

		<td >
			<select  id="responsable" name="responsable[]" class="respon" style="width:100px" multiple required>
			<?php		
			while($rowesc = $escala->fetch_assoc())
			{
			?>
				<option value="<?php echo $rowesc['cedula'];?>"> <?php echo $rowesc['nombre']. "---".$rowesc['contacto'];?> </option>	
				<?php }  mysqli_data_seek($escala, 0); // -> esta línea es para resetear el puntero y reutilizar la consulta para otro fetch?> 
			</select>
		</td>
		
		<td style="width:10%">
			<select class="w3-input select2" name="horario" required>
				<option value="" disabled selected> Horario notifi </option>
				<option value="7x24">7x24</option>
				<option value="5x12">5x12</option>
				<option value="habil">Hábil</option>
			</select>
		</td>
		
		<td style="width:10%">
			<input name="puerto" value="" placeholder="puerto" class="w3-input war" type="number" style="width:75px">
		</td>
		
		<td style="width:2%">
			<button type="submit" name="update" class="btn btn-success pull-leftt ">Agregar</button>
		</td>
	</tr>
	<tr>
		<td>
			<textarea name="accion" rows="1"  placeholder="acción crítica" class="w3-input war" style="width:100px" required></textarea>
		</td>
	</tr>
</table>
<input type="hidden" value="<?php echo $id;?>" name="ids">
<input type="hidden" value="<?php echo $nomc['nombre'];?>" name="nombre_host">
<input type="hidden" value="<?php echo $ip;?>" name="ip">
</form>


<form name="formula" action="" onSubmit="enviarDato(); return false" >
	<div class="col-md-4">
		<div class="form-group">
			<div class="input-group">
				<input placeholder="Ingresar un tipo de servicio" title="Ingresar un nuevo servicio" required name="tipo" class="form-control" style="width:100%">
				<div class="input-group-addon">
						<button style="border-radius: 50%;" type="submit" title="Agregar">+</button>
				</div>
			</div>
		</div>
	</div>
</form>
	
	<!-- <button type="submit" name="update" class="btn btn-success pull-right">Enviar</button> -->
	<a href="javascript:history.back(1)"><button type="button" class="btn btn-danger pull-right"><i class="fa fa-step-backward" aria-hidden="true"></i> Atrás</button></a>
</div>
	</div>
	
	</div>
	
	<!-- INICIO DE MODAL ELIMINAR -->
	<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel" align="center">SE VA A ELIMINAR UN SERVICIO</h4>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-danger">
		<div class="box-body">
        
        <label style="font-size: 22px;">Confirmar</label> <br><br>
       
		<form name="formular" action="" onSubmit="elimser(); return false" >
		<input type="hidden" id="id_detalle" name="borrar">
		<button type="submit" class="btn btn-success">Aceptar</button>
		<button type="button" class="btn btn-danger pull-right " data-dismiss="modal" aria-hidden="true">Cancelar</button>
		</form>
		
		</div>							
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->
	
	<!-- INICIO DE MODAL ACTUALIZAR -->
	<div class="modal fade" id="modalactualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-success">
		<div class="box-body">
        
        <label style="font-size: 22px;">Actualizar</label> <br><br>
        
        <form id="formupd" name="formupd" action="" onSubmit="updateservicio(); return false" >
      	
      	<div class="col-md-6">
       	<div class="form-group">
       	
       	<label>Delay</label>  
       	<input id="Udelay" name="Udelay"  class="w3-input war" type="text" required>
       	<label>Tiempo de chequeo (min)</label>
       	<input id="Ucheck" name="Ucheck"  class="w3-input war" type="text" required>
       	<label>Warning</label>
       	<input id="Uwar" name="Uwar"  class="w3-input war" type="text" >
       	<label>Critical</label>
       	<input id="Ucri" name="Ucri"  class="w3-input war" type="text" >
       	<label>Puerto</label>
       	<input id="Upuerto" name="Upuerto" class="w3-input war" type="text">
       	<label>Acción Crítica</label>
       	<textarea id="Uaccion" name="Uaccion" class="w3-input war" required></textarea>
       	</div>
       	</div>
		
		<div class="col-md-6">
       	<div class="form-group">
       	
       		<label>Disponibilidad</label><br>
       	<select id="Udispo" name="Udispo" class="w3-input war" style="width: 70%;" required>
       			<option value="-" disabled selected>Dispon.</option>
				<option value="0"> Down </option>
				<option value="1"> Up </option>
			</select><br><br>
       	     	<input id="Uservicio" name="Uservicio"  type="hidden" >
       	<label>Tipo Umbral</label><br>
       	<select id="Utipo_umbral" name="Utipo_umbral"  class="w3-input war" style="width: 70%;" required>
       			<option value=""></option>
				<option value="1-Porcentaje"> Porcentaje </option>
				<option value="2-sesiones"> sesiones </option>
				<option value="3-segundos"> segundos </option>
			</select><br><br>
			
       	<label>Responsable</label><br>
       	<select id="Urespo" name="Urespo[]"  class="respon" style="width:100px;" multiple required>
       	<!-- OPTIONS -->
       	
       	<?php		
			while($rowesc2 = $escala->fetch_assoc())
			{
			?>
				<option value="<?php echo $rowesc2['cedula'];?>"> <?php echo $rowesc2['nombre']. "---".$rowesc2['contacto'];?> </option>	
				<?php }?>
       	
			</select>
			
		<br><br>
       	<label>Horario</label><br>
      <select id="Uhorario" name="Uhorario" class="w3-input war" style="width:70%" required>
				<option value=""></option>
				<option value="7x24">7x24</option>
				<option value="5x12">5x12</option>
				<option value="habil">Hábil</option>
			</select><br><br>
       	
       	<input type="hidden" id="id_detalles" name="id_detalles">
       	</div>
       	</div>
				
		<button type="submit" class="btn btn-success">Aceptar</button>
		<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		</form> 
       
		</div>							
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->
	
	<!-- INICIO DE MODAL ESCALAMIENTO -->
	<div class="modal fade" id="modalescala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div style="width: 130%; border-radius:10px;" id="modalesc" class="modal-content">
		<div class="modal-header">
		<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
		<div class="col-md-13">
		<div class="box box-info">
		<div class="box-body">
        
        <label style="font-size: 22px;">Escalamiento</label> <br><br>
        
        <div id="resultado">
		</div> 
		<!-- <button type="button" class="btn btn-danger pull-right butt" data-dismiss="modal" aria-hidden="true">Cerrar</button> -->
		
		</div>							
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->
	
	
	<script src="plugins/multiselect/multipleSelect.js"></script>
	
	
	
	<script type="text/javascript">
function objetoAjax()
{
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {

		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false; }
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function elimser()
{
	borrar = document.formular.borrar.value;
	
	ajax = objetoAjax();
	ajax.open("POST", "pages/backend/borrar_servicio.php", true); 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	ajax.send("&borrar="+borrar)
	alertify.alert("<b>Servicio Eliminado", function () {
    	  window.setTimeout('location.reload()');
    });
}

function enviarDato()
{
	/*tipo = document.formula.tipo.value;
	
	ajax = objetoAjax();
	ajax.open("POST", "pages/backend/nuevo_servicio.php", true); 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	ajax.send("&tipo="+tipo)*/


    alertify.alert("<b>Registro exitoso", function () {
    	  window.setTimeout('location.reload()');
    });
	   
}

function updateservicio()
{

	$.ajax({
	       
	type:  'POST',
	
	url:   'pages/backend/includes/actualizar_servicio.php',
	
	       data: $("#formupd").serialize(),
	});
	
	window.setTimeout('location.reload()');
}

function enviarservicio()
{

	$.ajax({
        
		type:  'POST',
		
		url:   'pages/backend/servicio_ci.php',
		
        data: $("#formulario").serialize(),
});
	
	window.setTimeout('location.reload()');
}

function MostrarConsulta(datos){

	ids = datos;
        $.ajax({
            
        		type:  'POST',
        		
        		url:   'pages/backend/includes/detalle_grupo.php',
        		
                data: { id_escala: ids },
               
                success:  function (data) 
                {
                   $("#resultado").html(data);

                }
        });
}

</script>

<script>
/*$('.butt').click(function(){            
	window.setTimeout('location.reload()');
});  */

//Script para Habilitar y Deshabilitar
/*$("#os").on("click", function(){
   	var x = document.getElementsByClassName("btn");
   		
       if(x[0].disabled==false)
       	{
    	   $('.btn').attr('disabled','disabled');

    	   for(i=0; i<x.length; i++)
	   		{	
	       	   x[i].style.background="#FAFAFA";
	   		} 
       	}
      	
       else
       	{
    	   $('.btn').removeAttr("disabled");
       	}
});*/
</script>

 <script src="plugins/select2/select2.full.min.js"></script>
    <script>

    $(function (){
    	$(".select2").select2();
     });

    $(".respon").multipleSelect({
        placeholder: "responsable",
        filter: true,
    });

	     function upd(servicio, accion, id_detalle, delay, check, war, cri, puerto)
	     {
	     	$('#id_detalles').val(id_detalle);
            $("#Udelay").val(delay);
            $("#Ucheck").val(check);
            $("#Uwar").val(war);
            $("#Ucri").val(cri);
            $("#Upuerto").val(puerto);
            $("#Uaccion").val(accion);
            $("#Uservicio").val(servicio);
	     }

	     function elim(id_detalle)
	     {
	     	$('#id_detalle').val(id_detalle);
	     }

	     $(document).ready(function(){
	    	    $('.accion').tooltip();   
	    	});
    </script>
    
   
    




