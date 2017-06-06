<?php
$oe = new conexion();
$oe1 = new conexion();

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

                <input type="hidden" id="id_host" name="id_host" value="<?php echo $idCI?>"> 

                <div class="col-md-6">
                    <div class="form-group">
					
					<label >Servicio afectado</label>
        			<input name="" id="" class="form-control" value="<?php echo $row['tipo'];?>" readonly required> 
 
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

                        <label>Tipo de actividad</label>
                        <select id="tipo_actividad" required name="tipo_actividad" class="form-control" >
                            <option></option>  
                            <option>No programada</option>                  
                            <option>programada</option>
                        </select>

                        <label>Horas de actividad</label>
                        <input name="hrs_actividad" id="txtHoraActividad" class="form-control" required> 

                    </div>
                </div> 
            </div>  
            <div class="col-md-6">
                <div class="form-group">


                    <label>Ticket</label>
                    <input name="ticket" id="ticket" class="form-control" required> 


                    <label>Responsable</label>
                    <input  name="responsable" id="txtResponsable" class="form-control">
  
                    <label>Persona que reporta</label><br>
                    <input name="reporta" id="txtEstado" class="form-control" required> 


                    <label>Fecha y hora de inicio </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="fecha_inicio" name="fecha_inicio" required value=""
                               type="datetime-local" class="form-control" required>		
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success ">Registrar evento</button>
            <a href="index.php"><button type="button" class="btn btn-danger pull-right">Cancelar</button></a>
        </form>
    </div>
</div>
