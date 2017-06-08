
<!--SCRIPT PARA EL SELECT INDIVIDUAL-->
        <script type="text/javascript">
            $(document).ready(function () {

                $("#evento").change(function () {
                    $("#evento option:selected").each(function () {
                        var id = $(this).val();
                        $.get("pages/backend/includes/detalles_evento.php", {param_id: id}, function (data) {
                            $("#info_evento").html(data)
                        });
                    }) 
                })

                $("#info_evento").change(function () {
                    $("#info_evento option:selected").each(function () {

                        var id = $(this).val();
                        $.get("pages/backend/includes/ip.php", {info_id: id}, function (data) {
                        });
                    })
                })
            });
        </script> 


        <!--SCRIPT PARA EL SELECT MASIVO-->
        <script type="text/javascript">
            $(document).ready(function () {

                $("#evento_masivo").change(function () {
                    $("#evento_masivo option:selected").each(function () {
                        var id = $(this).val();
                        $.get("pages/backend/includes/detalles_evento_masivo.php", {param_id: id}, function (data) {
                            $("#info_evento").html(data)
                        });
                    })
                })

                $("#info_evento").change(function () {
                    $("#info_evento option:selected").each(function () {

                        var id = $(this).val();
                        $.get("pages/backend/includes/ip.php", {info_id: id}, function (data) {
                            $("#ip").val(data);
                        });
                    })
                })
            });
        </script> 


        <script>
            function habilitar(value)

            {
                if (value == "1")

                {
                    // habilitamos
                    document.getElementById("segundo").disabled = false;
                } else if (value == "2") {
                    // deshabilitamos
                    document.getElementById("segundo").disabled = true;
                }
            }
        </script>


        <style>
            input, select
            {
                max-width: 400px;
                margin: auto;
            }
            td
            {	
                text-align: center;
            }
            #tabla
            {
                margin: auto;
                width: 90%;	
            }
            textarea.foo
            {
                resize:none;
            }
        </style>

        <br><br><br><br>
        <?php
        $oe = new conexion();
        $query = $oe->conexion->query("SELECT id  FROM incidentecop where estado='P'");
        $query1 = $oe->conexion->query("SELECT distinct id_evento FROM registro_masivo where estado='P'");
        ?>


        <div class="box box-info">
            <div class="box-body">
                <h3 class="box-title">Solución de incidentes</h3><br>
                <!-- Barra de progreso -->

<form method="post" action="pages/backend/solucion_incidente.php">
                <div class="col-md-5">
                    <div class="form-group">

                        <LABEL>TIPO DE EVENTO</LABEL><br><BR>                                                                   

                            EVENTO <input type="radio" name="tipo_evento" id="mostrar_evento" value="individual"><br>
                            EVENTO MASIVO<input type="radio" name="tipo_evento" id="mostrar_evento_masivo"  value="masivo" ><br><br><br>


                            <label>ID DEL EVENTO</label>
                            <select class="form-control" id="a"></select>
                            <select class="form-control" id="evento" name="id_incidente"  style="display:none" >

                                <option></option>
                                <?php while ($row = $query->fetch_assoc()) {
                                    ?>
                                    <option><?php echo $row['id']; ?></option>
                                <?php } ?>


                            </select> 


                            <select class="form-control" id="evento_masivo" name="id_incidente"  style="display:none" >


                                <option></option>
                                <?php while ($row2 = $query1->fetch_assoc()) {
                                    ?>
                                    <option><?php echo $row2['id_evento']; ?></option>
                                <?php } ?>

                            </select>


                            <label>NÚMERO DEL TICKET</label>

                            <input type="number" name="ticket" class="form-control" required size="50">
                            
                    </div>
                </div> 



                <div class="col-md-6">
                    <div class="form-group">

                        <label>INFORMACIÓN</label><br>

                        <label id="info_evento" class="foo" class="form-control"  style=" width: 50%;"> </label> <br>                           
                        <br><br>

                        <label>DETALLES</label><br>

                        <textarea class="foo" rows="4" cols="80" name="detalles"></textarea><br>

                    </div>
                    <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
				<button type="submit" class="btn btn-success pull-right">Registrar evento</button>
                </div>
                
              
             </form> 
            </div>
            
        </div>

        <script>
           $(document).ready(function () {
               $("#mostrar_evento").on("click", function () {
                   $('#a').hide();
                   $('#evento_masivo').hide();
                   $('#evento').show(); //muestro mediante id

                   document.getElementById('evento_masivo').selectedIndex = 0;

               });
               $("#mostrar_evento_masivo").on("click", function () {
                   $('#a').hide();
                   $('#evento').hide(); //oculto mediante id
                   $('#evento_masivo').show();

                   document.getElementById('evento').selectedIndex = 0;

               });
           });
       </script>

