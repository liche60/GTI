

<link rel="stylesheet" href="plugins/select2/select2.min.css"/>

  <script> </script>


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
            });
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



<div class="box box-info">
	<div class="box-body">
		<h3 class="box-title">Buscar evento</h3>
		<br> 

		<form method="post" action="pages/backend/solucion_incidentes.php">
			<div class="col-md-5">
				<div class="form-group">

					<LABEL>TIPO DE EVENTO</LABEL><br> 

					<div class="input__row"> 
						<ul class="buttons">
							<li>
							<input id="mostrar_evento" class="radiobtn" name="evento"
								type="radio" value="individual" tabindex="1" onclick="consultaEvento('individual')"> 
								<span></span> 
								
								<label
								for="mostrar_evento" id="r1">Evento</label> 
								
								<input
								id="mostrar_evento_masivo" class="radiobtn" name="evento"
								type="radio" value="masivo" tabindex="2" onclick="consultaEvento('masivo')"> 
								
								<span></span> <label
								for="mostrar_evento_masivo" id="r2">Evento masivo</label></li>
						</ul>
					</div>

					<label>ID DEL EVENTO</label> 
					<select class="form-control" id="evento" name="id_incidente"
						style="width: 100%">


                            </select> 

				</div>
			</div>



		</form>
		
		
		<!-- /.row -->
<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-12 connectedSortable">

		<!-- Custom tabs (Charts with tabs)-->
		<div class="nav-tabs-custom">
			<input type="hidden" id="user_id" value="<?php echo $user_id ?>">
			<!-- Tabs within a box -->
	
			
			
						<div class="pad">
						<!-- Map will be created here -->
						<h3 class="box-title">Información del evento</h3>
				
				   		
			<div  id="info_evento"
						class="foo"  style="width: 50%;"> 
					</div> <br>
				
						
					</div>
			

						<br>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				
				</div>
			</div>
 			
 			
 
		</div>

    </section>

</div>
		
</div>

</div> 



  <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>
<script>

function consultaEvento(data)
{
 
var valor=data;
	$.ajax({
	type:  'POST',
	
	url:   'pages/backend/includes/consulta_solucion.php',
	
        data: { individual: valor },
      
        success: function(data)
        {
       
            $("#evento").html(data);
        },
	});
}


</script>





