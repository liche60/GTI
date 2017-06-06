
<?php
$oe1 = new conexion();
$oe2 = new conexion();
$oe3 = new conexion();
?>



<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<style>
    .scrollbar
    {
        margin-left: 30px;
        float: left;
        height: 300px;
        width: 65px;
        background: #F5F5F5;
        overflow-y: scroll;
        margin-bottom: 25px;
    }
    .select2-container--default .select2-selection--single
    {
        border-radius: 0;
        border-color: #d2d6de;
        width: 100%;
        height: 34px;
    }
</style>

  


<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Crear nuevo CI</h3>

                <form method="post" action="pages/backend/nuevo_ci.php">
                    <div class="col-md-6">
                        <div class="form-group">

                            <label>IP</label>
                            <input id="ip" name="ip" class="form-control" style="width: 100%;"  required>

                            <label>Nombre CI</label>
                            <input id="host" name="host" class="form-control"  style="width: 100%;"  required>

                            <label>Contrato </label>
                            <select id="contrato" name="contrato" class="form-control " style="width: 100%;" required> 
                                    
                                 <option value="0"></option>
                                <?php
                                $conn1 = $oe1->conexion->query("SELECT codigo, nombre FROM new_proyectos ");

                                while ($row = $conn1->fetch_assoc()) {
                                    echo '<option value="' . $row['codigo'] . '">' . $row['nombre'] . '</option>';
                                }
                                 
                                $oe1->cerrar();
                                ?> 
                            </select>    
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" >

                            <label>Horario de operación</label>
                            <select id="horario_operacion" name="horario_operacion" class="form-control" style="width:100%;">
                                <option value="0"></option>

                                <?php
                                $conn2 = $oe2->conexion->query("SELECT id, nombre FROM horarios_operativos ");

                                while ($row = $conn2->fetch_assoc()) {
                                    echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                                }

                                $oe2->cerrar();
                                ?>
                            </select> 

                            <label>Ambiente</label>
                            <select id="ambiente" name="ambiente" class="form-control" style="width:100%;"> 
                                <option value="0"></option>
                                <option value="Desarrollo">Desarrollo</option> 
                                <option value="Pruebas">Pruebas</option> 
                                <option value="Producción">Producción</option> 
                            </select> 

                            <label>Tipo de dispositivo</label>
                            <select name="tipo_dispositivo" class="form-control" style="width:100%;">
                                <option value="0"></option>

                                <?php
                                $conn3 = $oe3->conexion->query("SELECT id, tipo FROM tipo_dispositivo ");

                                while ($row = $conn3->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['tipo'] . '</option>';
                                }

                                $oe3->cerrar();
                                ?> 
                            </select>  

                        </div>   
                                    
                        </div>
                        <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        <button type="submit" class="btn btn-success pull-right">Crear CI</button>  
                </form>
</div>
</div>


<?php
