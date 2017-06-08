<?php
$oe = new conexion();
$usuario = new UserInfo();
$id_detalle = $_POST['id_detalle'];
//$cont = $_POST['contra'];
//$idCI = $_POST["valci"];  //1
$ip = $_POST["ip"];

$conn = $oe->conexion->query("select a.id_detalle, b.nombre, c.tipo from detalle_servicio a, hosts b, tipo_servicios c where 
a.id_host=b.id and a.id_tipo_servicio=c.id and id_detalle='$id_detalle'");
$num_evento = $oe->conexion->query("SELECT (max(id)+1) as Numero_de_evento FROM incidentecop");

$evento = $num_evento->fetch_assoc();
$row = $conn->fetch_assoc();


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
</style>

<div class="box box-info">
    <div class="box-body">
        <h3 class="box-title">Registro de incidentes</h3>
        <!-- Barra de progreso -->
        <div class="progress progress-sm active">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">                  
            </div> 
        </div>      
 
        <label style="color: green;">EVENTO NÚMERO: </label>
        <label><?php echo $evento['Numero_de_evento']; ?>  </label><br><BR>

        
        <form method="post" action="pages/backend/nuevo_incidente.php">
            <div class="col-md-23">

               <input name="reporta" type="hidden" id="txtEstado" value="<?php echo $userinfo->user_name = $_SESSION['user_id'];?>" class="form-control" required>

                <div class="col-md-6">
                    <div class="form-group">
					
					<label >Servicio afectado</label>
        			<input name="servicio" class="form-control" value="<?php echo $row['tipo'];?>" readonly required> 
 
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
                    <select name="mesa" id="ticket" class="form-control" required>
                    	<option></option>
                    	<option>Maya</option>
                    	<option>Marco</option>
                    </select> 


                    <label>Responsable</label>
                    <input  name="responsable" id="txtResponsable" class="form-control">
  
                    <label>Persona que reporta</label><br>
                    <input value="<?php echo $userinfo->user_name = ucwords(strtolower($_SESSION['user_name']));?>" class="form-control" required disabled> 


                    <label>Fecha y hora de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio" name="fecha_inicio" type="datetime-local" class="form-control" required>		
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
