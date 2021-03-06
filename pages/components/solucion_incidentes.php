<link rel="stylesheet" href="plugins/select2/select2.min.css"/>
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
        
<!--SCRIPT PARA CONSULTA SOLUCION-->
   
<script type="text/javascript">

        function indivi(data, numero)
        {

			
		var valor=data, cedula=numero;
		
        	$.ajax({
                
        		type:  'POST',
        		
        		url:   'pages/backend/includes/consulta_solucion.php',
        		
                data: { individual: valor, cedula: numero},

                success: function(data)
                {
                    $("#evento").html(data);
                },
        	});
        }
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
input, select {
	max-width: 400px;
	margin: auto;
}

td {
	text-align: center;
}

#tabla {
	margin: auto;
	width: 90%;
}

textarea.foo {
	resize: none;
}
</style>

<style>
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}
</style>

<!-- style radio buttons -->

<style>
.input__row {
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

.buttons li label {
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

.radiobtn:checked+span::before {
	content: '';
	border: 2px solid #fff;
	position: absolute;
	width: 14px;
	height: 14px;
	background-color: #c3e3fc;
}
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}
</style>





<br>
<?php
$oe = new conexion ();

$query1 = $oe->conexion->query ( "SELECT distinct id_evento FROM registro_masivo where estado='P'" );
?>


<div class="box box-info">
	<div class="box-body">
		<h3 class="box-title">Solución de incidentes</h3>
		<br> 
		<!-- Barra de progreso -->

		<form method="post" action="pages/backend/solucion_incidentes.php">
			<div class="col-md-5">
				<div class="form-group">

					<LABEL>TIPO DE EVENTO</LABEL><br> 

					<div class="input__row"> 
						<ul class="buttons">
							<li>
							<?php if($userinfo->correo_user != 'compuredescgcnoc@arus.com.co'){?>
							<input id="mostrar_evento" onclick="indivi('individual',<?php echo $userinfo->user_id?>);" class="radiobtn" name="evento" type="radio" value="individual" tabindex="1"> <span></span> <label
								for="mostrar_evento"  id="r1">Evento</label>
							<?php }?>
							
							
							<?php if($userinfo->correo_user == 'compuredescgcnoc@arus.com.co'){?>
								<input id="mostrar_evento_masivo" onclick="indivi('masivo');" class="radiobtn" name="evento" type="radio" value="masivo" tabindex="2"> <span></span> <label
								for="mostrar_evento_masivo" id="r2">Evento masivo</label></li>
							<?php }?>
						</ul>
					</div>

					<label>ID DEL EVENTO</label> 
					<select class="form-control select2" name="id_evento" id="evento" style=" width: 100%;">
					
					</select>
                            
                   <label>NÚMERO DEL TICKET</label>

					<input type="number" name="ticket" class="form-control" required style="max-width: 600px;"> 
					<label>TIPO</label> 
					
						<select class="form-control" id="tipo" name="tipo" required="required" style="width: 100%;">
						<option></option>
						<option>Requerimiento</option>
						<option>Incidente</option>
					
					
					</select><br> <LABEL>HUBO CAMBIO</LABEL><br>

					<div class="input__row">
						<ul class="buttons">
							<li><input id="cambio_si" class="radiobtn"  name="rbtncambio" type="radio" value="si" tabindex="1"> <span></span> 
							<label for="cambio_si" id="r1">Si</label> 
							<input id="cambio_no" class="radiobtn" name="rbtncambio" type="radio" value="no" tabindex="2" > <span></span> <label for="cambio_no" id="r2">No</label><br>
								<label>NUM RFC</label> <input type="number" name="rfc" id="rfc"
								class="form-control" readonly></li>


						</ul>



					</div>


				</div>
			</div>



			<div class="col-md-6">
				<div class="form-group">

					<label>INFORMACIÓN:</label><br> 
					
					<label id="info_evento"
						class="foo"  style="width: 50%;"> 
					</label> <br>
					
					<br> <br> <label>FECHA Y HORA DE CIERRE DEL EVENTO</label><br> 
					
					<input
						type="datetime-local" style="max-width: 600px;" name="fecha_fin" class="form-control" required>
						
						
						<label>DETALLES</label><br>

					<textarea class="form-control" rows="4"  name="detalles" style="resize: none"></textarea>
					<br>



				</div>
				<a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
				<button type="submit" class="btn btn-success pull-right">Registrar
					evento</button>
			</div>


		</form>
	</div>

</div> 


     <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>

<script>
/*

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
           });*/
       </script>

<!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>
$("#cambio_si").on("click", function(){
  var x = document.getElementById("rfc");
  
  $('#rfc').removeAttr("readOnly");
});  

$("#cambio_no").on("click", function(){
  var x = document.getElementById("rfc");

  $('#rfc').attr('readOnly','readOnly ');

}); 


</script>

<!--SCRIPT PARA HABILITAR Y DESHABLITAR-->
<script>
$("#cambio_si").on("click", function(){
  var x = document.getElementById("rfc");
  
  $('#rfc').removeAttr("readOnly");
});  

$("#cambio_no").on("click", function(){
  var x = document.getElementById("rfc");

  $('#rfc').attr('readOnly','readOnly ');

}); 
</script>