<?php

setlocale (LC_TIME, 'es_ES.utf8','esp');
date_default_timezone_set ('America/Bogota');
$fecha=strftime("%Y-%m-%d %H:%M:%S");


$oe = new conexion();
$usuario = new UserInfo();
$id_detalle = $_POST['id_detalle'];
//$cont = $_POST['contra'];
$id_persona=$_POST['otro'];

// Aprovechar el ID DETALLE para sacar el HOST y la IP Para el envío del correo 





$conn = $oe->conexion->query("select a.id_detalle, b.nombre, b.ip, b.id as id_host, c.tipo, c.id as id_tipo from detalle_servicio a, hosts b, tipo_servicios c where 
a.id_host=b.id and a.id_tipo_servicio=c.id and id_detalle='$id_detalle'");

$num_evento = $oe->conexion->query("SELECT (max(id)+1) as Numero_de_evento FROM incidentecop");
$query=$oe->conexion->query("select nombre from new_personas where cedula=$id_persona");

$evento = $num_evento->fetch_assoc();
$row = $conn->fetch_assoc();
$info=$query->fetch_assoc();

?> 

<style>
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
    <div class="box-body">
        <h3 class="box-title">Registro</h3>
        <!-- Barra de progreso -->
        <div class="progress progress-sm active">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 95%">                  
            </div> 
        </div>      
 
        <p id="event"><strong>Evento: </strong><?php echo $evento['Numero_de_evento'];?></p>

        
        <form method="post" action="pages/backend/nuevo_incidente.php">
            <div class="col-md-23">
				<input name="nombre_host" type="hidden"  value="<?php echo $row['nombre'];?>" class="form-control" required>
				<input name="ip" type="hidden"  value="<?php echo $row['ip'];?>" class="form-control" required>
				<input name="id_host" type="text"  value="<?php echo $row['id_host'];?>" class="form-control" required>
               <input name="reporta" type="hidden" id="txtEstado" value="<?php echo $userinfo->user_name = $_SESSION['user_id'];?>" class="form-control" required>

                <div class="col-md-6">
                    <div class="form-group">
					
					<label >Servicio afectado</label>
					<input class="form-control" value="<?php echo $row['tipo'];?>" readonly required>
        			<input type="hidden" name="servicio" class="form-control" value="<?php echo $row['id_tipo'];?>" readonly required> 
 
                        <label>Tipo de evento</label>
                        <select id="evento" required name="evento" class="form-control" >
                            <option></option>
                            <option>Warning</option>
                            <option>Critical</option>
                        </select>

                        <label>Causa del evento</label>
                        <select id="causa_evento" required name="causa_evento" class="form-control"  >
                            <option></option>  
                            <option>Disponibilidad</option>
                            <option>Capacidad</option>      
                        </select>

                        <label>Minutos de actividad</label>
                        <input type="number" name="hrs_actividad" id="txtHoraActividad" class="form-control" value="0" required readonly>
                        
                        <label>Tipo de actividad</label>
                        <div class="input__row">
                       <ul class="buttons">
						   <li>
						     <input id="radiobtn_1" class="radiobtn" name="tipo_actividad" type="radio" value="Programada" tabindex="1" required>
						     <span></span>
						     <label for="radiobtn_1" id="r1" >Programada</label>
						     </li>
						     <li>
						     <input id="radiobtn_2" class="radiobtn" name="tipo_actividad" type="radio" value="No programada" tabindex="2" required>
						     <span></span>
						     <label for="radiobtn_2" id="r2">No programada</label>
						   </li>
						 </ul>
						</div>
                    </div>
                </div> 
            </div>  
            <div class="col-md-6">
                <div class="form-group">


                    <label>Mesa</label>
                    <select name="mesa"  class="form-control" required>
                    	<option></option>
                    	<option>Maya</option>
                    	<option>Marco</option>
                    	<option value="serviciogco@arus.com.co">servicio gco</option>
                    </select> 


                    <label>Responsable</label>
                    <input  name="corresponsable" value="<?php echo $info['nombre'];?>" id="txtResponsable" class="form-control" readonly>
                    <input type="hidden" name="idresponsable" value="<?php echo $id_persona;?>" id="txtResponsable" class="form-control" readonly>
  
                    <label>Persona que reporta</label><br>
                    <input name="nombre_reporta" value="<?php echo $userinfo->user_name = ucwords(strtolower($_SESSION['user_name']));?>" class="form-control" required readonly> 


                    <label>Fecha y hora de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio" name="fecha_inicio"  class="form-control" value="<?php echo $fecha;?>" required>		
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success ">Registrar evento</button>
            <a href="index.php"><button type="button" class="btn btn-danger pull-right">Cancelar</button></a>
        </form>
    </div>
</div>

<script>
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
