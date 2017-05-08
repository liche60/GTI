<style>
td
{
	padding: 5px;
	border-color: black;
	text-align: center;
}
table
{
	margin: auto;	
}
</style>
<!-- 
<script type="text/javascript">   
    window.setTimeout('location.reload()', 6000); carga toda la página cada X segundos       
</script>
 -->

<?php
$id = $_POST['sci'];
$cont = $_POST['contrato'];

$oe= new conexion();
$conn = $oe->conexion->query("SELECT id, nombre, id_host, descripcion FROM servicios where id_host='$id'");
$ser = $oe->conexion->query("SELECT * FROM tipo_servicios");
//echo $id ." - ";
//echo $cont;
?>



<form method="post" action="#"><br><br>
	<div class="box box-danger">
	<div class="box-header with-border">
	<div class="box-body">
	<div class="row">
	<input type="hidden" name="sci" value="<?php echo $id?>">

	<table id="tabla" class="table table-bordered table-striped">	
		<tr>
			<td>
				<button id="btn" type="button" title="Agregar un Servicio" class="btn btn-default pull-center">+</button>
			</td>
			<td>
				<h4>Servicio</h4>
			</td>
			<td>
				<h4>Descripción</h4>
			</td>		
		</tr>
		
		<?php		
		while($row = $conn->fetch_assoc())
		{		$id_host= $row['id_host'];
				
		?>
		<tr>
			<td>
				<input required type="radio" value="<?php echo $row['id']?>" name="otro">
			</td>
			<td>
				<input readonly class="form-control" name="servicio" type="text" value="<?php echo $row['nombre'] ?>">
			</td>
			<td>
				<textarea readonly rows="2" class="form-control" name="descripcion" style="resize: none;"><?php echo $row['descripcion']?> </textarea>
			</td>
		</tr>
		<?php }
		?>
		
		<tr>		
			<td>
				<button id="act" type="button" class="btn btn-default pull-center">Refresh</button>
			</td>	
			<td colspan="2">			
				<input type="submit"class="btn btn-success pull-center">				
			</td>				
		</tr>	
	</table>
	
	</div>
	</div>
	</div>
	</div>
</form>



	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel" align="center">Nuevo Servicio</h4>
		  </div>
			<div class="modal-body">
			 <div class="col-md-13">
			  <div class="box box-info">
				<div class="box-body">				
	
	<form name="formulario" action="" onSubmit="enviarDatos(); return false" >
	   <div class="col-md-6">
       <div class="form-group">

        <label>Tipo</label>
        <select  name="tipo" required class="form-control">
        <?php		
       //
        while($row = $ser->fetch_assoc())
        {
        	echo '<option value="'.$row['tipo'].'">'.$row['tipo'].'</option>';
        }
		?>       
		
		</select>
		
        <label>Nombre</label> 
        <input required name="nombre" class="form-control">     

        <label>Descripción</label>
        <textarea class="form-control"  name="descripcion" cols="100" style="resize: none;"></textarea>   
        
        <input type="hidden" name="id_host" value="<?php echo $id_host; ?>">
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
        
        <label>Acción Crítica</label>
        <textarea class="form-control" name="accion"> </textarea>   
        
        <label>Tiempo Máximo de Contacto</label>
        <input class="form-control" name="tiempo">     
        </div>
        </div>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<div class="form-group">		
		<button type="submit"  id="btn2" class="btn btn-success">Aceptar</button>
		<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		</div>
	</form>
	
		</div>							
		 </div>
		  </div>
		    </div>
			<div class="modal-footer"></div>
			</div>
		</div>
	</div>

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


function enviarDatos()
{
	tipo = document.formulario.tipo.value;
	nombre = document.formulario.nombre.value;
	descripcion = document.formulario.descripcion.value;
	id_host = document.formulario.id_host.value;
	accion = document.formulario.accion.value;
	tiempo = document.formulario.tiempo.value;	
	
	ajax = objetoAjax();
	ajax.open("POST", "pages/backend/registro_servicio.php", true); 
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	ajax.send("&tipo="+tipo+"&nombre="+nombre+"&descripcion="+descripcion+"&id_host="+id_host+"&accion="+accion+"&tiempo="+tiempo) 
}	
</script>

<script type="text/javascript">
        $('#act').click(function() {            
        	window.setTimeout('location.reload()');
        });    
</script>

<script type="text/javascript">
$("#btn").click(function(){
    $("#myModal").modal({show: true});
});

$("#btn2").click(function(){
$("#myModal").modal("hide");
});
</script>

