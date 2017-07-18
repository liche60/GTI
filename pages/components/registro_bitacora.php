<style>

		
#cronometro { 
	  padding:10px; 
	  border: 5px #4CAF50 double;	  
	  height: 230px;
	  width: 215px;
	  text-align: center;
	  background-color: #FFFFFF;	  
	  border-radius: 5px;
	  float: right; 
      margin: 0em 3em 1em 3em;
}
#reloj { 
	padding: 5px 10px; 
	width: 95%;
	border: 1px solid black; 
    font: normal 1em digital_dream, 
	europa,
	arial; 
	text-align: center; 
    margin: 4px; 
	background-color: #FAFAFA;	
	border-radius: 3px;
	
}
#cronometro [type=button]  { 
margin-bottom: 13px;
 font: normal 9pt arial; 
 width: 85px; 
 }


.boton
{
    padding: 5px 10px;	
	
	box-shadow: 0px 3px 0px 0px #E6E6E6;	
    background-color: #f4f4f4;
    color: #444;
    border-color: #ddd;
    border-radius: 3px;
    border: 1px solid transparent;
    
}

.boton.disabled, .boton[disabled], fieldset[disabled] .boton {
    cursor: not-allowed;
    filter: alpha(opacity=65);
    -webkit-box-shadow: none;
    box-shadow: none;
    opacity: .75;
}

.boton:hover {
    color: #333;
     background-color: #e6e6e6; 
    border-color: #adadad;
}

@media ( max-width : 700px) {
	
	
	
	#cronometro
	{
		width: 40%;
	}	
}
</style>
<?php
// Para los festivos
$dias=array();
$conn = $wish->conexion->query("SELECT fecha FROM festivo ");
$horas = $wish->conexion->query("select sum(tiempoReal) as total from registro_actividad r 
								where cedula = $userinfo->user_id and DATE(fecha_inicio) = DATE(NOW()) and estado in ('F', 'R');");

$min1 = $wish->conexion->query ( "select tiempoReal, descripcion, fecha_inicio from registro_actividad where id_contrato=1" );
$valor1 = $min1->fetch_row();

$min2 = $wish->conexion->query ( "select tiempoReal, descripcion, fecha_inicio from registro_actividad where id_contrato=2" );
$valor2 = $min2->fetch_row();

$min3 = $wish->conexion->query ( "select tiempoReal, descripcion, fecha_inicio from registro_actividad where id_contrato=3" );
$valor3 = $min3->fetch_row();


$total=$horas->fetch_row();
$falta=510-$total[0];
while ($row=$conn->fetch_assoc())
{
	$dias[]=$row['fecha'];
}



$ctrl = $wish->getFechaControlUser($userinfo->user_id);
$pending_query = "select 
v.selected_date, 
(select  (sum(tiempoReal)/60) as registro 
	from registro_actividad 
    where cedula = $userinfo->user_id 
		and DATE_FORMAT(fecha_inicio,'%Y-%m-%d') = v.selected_date
) as tiempo 
from 
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
where v.selected_date between '$ctrl' and NOW() - INTERVAL 1 DAY
and DATE_FORMAT(v.selected_date,'%w') <> 0 
and DATE_FORMAT(v.selected_date,'%w') <> 6
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[0]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[1]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[2]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[3]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[4]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[5]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[6]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[7]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[8]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[9]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[10]' 
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[11]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[12]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[13]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[14]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[15]'
and DATE_FORMAT(v.selected_date,'%Y-%m-%d') <> '$dias[16]'";

$pen = $wish->conexion->query ( $pending_query );
$registros = 0;
$reg_pen = array ();
while ( $arr = $pen->fetch_array () ) {
	$selected_date = $arr ["selected_date"];
	$tiempo = $arr ["tiempo"];
	$tmp = array (
			$selected_date => $tiempo 
	);
	if ($tiempo < 8.5) {
		array_push ( $reg_pen, $tmp );
		$registros ++;
	}
}

$current_query = "select 
DATE_FORMAT(fecha_inicio,'%T') hora, id,
(select a.actividad from actividad a where a.id = r.id_actividad) actividad,
(select a.categoria from actividad a where a.id = r.id_actividad) categoria,
descripcion,
tiempoReal
from 
registro_actividad r 
where cedula = $userinfo->user_id and DATE(fecha_inicio) = DATE(NOW()) and estado = 'F'
order by fecha_inicio desc;";

$reg_cur = $wish->conexion->query ( $current_query );


?>
<!-- Cronometro -->

<script src="dist/js/pages/operaciones.js"></script>
<script src="dist/js/pages/cronometro.js"></script>
<script src="dist/js/pages/registro_actividad.js"></script>


<link type="text/css" rel="stylesheet"
	href="dist/css/pages/contador.css">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet" type="text/css">





<script>
            document.getElementById("inicio").disabled = true;             
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 4, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>


<?php
$query = $wish->getActiveTaskForUser ( $userinfo->user_id );
$row = mysqli_fetch_array ( $query );
$numero_filas = mysqli_num_rows ( $query );
$initialDate = $row ['fecha_inicio'];


?>


<!-- /.row -->
<!-- Main row -->
<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Actividades</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool"
						data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
					<div class="box-body no-padding">
				
	<div class="pad">
		<section class="col-lg-12 connectedSortable">

		<!-- Custom tabs (Charts with tabs)-->
		<div class="nav-tabs-custom">
			
			<!-- Tabs within a box -->
			
			<ul class="nav nav-tabs pull-right">

				<li class="pull-left header"><i class="fa fa-clock-o"></i>
					Cronometro</li>
			</ul>
			
					<?php
					if ($registros == 0) {
						?>
			
						<!-- EPACIO DE BOTONES E INPUTS -->

<!-- #1 -->
	<div id="n1">
		<div class="col-md-4">
       	<div class="form-group">
		
			<form id="stopForm1" action="index.php?page=004" method="POST">
				<input type="hidden" name="especifica" value="1">
			
				<input type="hidden" name="initDate1" id="initDate1" value="<?php echo $valor1[2];?>">
				<input type="hidden" name="endTime1" id="endTime1" value="<?php echo $valor1[0];?>">
				<input type="hidden" id="user_id1" value="<?php echo $user_id ?>">
			</form>	<br><br>
				
				<div id="cronometro">
				<label id="act1" style="color: black;"><?php echo $valor1[1];?></label> 
					<div id="reloj">
					   <span id="horas1">00</span>:<span id="minutos1">00</span>:<span id="segundos1">0</span>
					</div><br>				
							
					
					<div class="btns">
						<button type="button" class="boton" id="inicio1" onclick="empezar(1);" >Iniciar &#9658;</button>
						<button type="button" class="boton" id="continuar1" onclick="continuar(1);" disabled>Reiniciar &#9658;</button>
						<button type="button" class="boton" id="parar1" onclick="parar(1);" disabled>Pausar &#8718;</button>					
						<button type="button" class="boton" id="guardar1" onclick="guardar(1);" disabled>Guardar &#8631;</button>
						<button type="button" class="boton" id="btn1">2</button>
						<button type="button" class="boton" id="btn2">3</button>
					</div>	
					<div id="resultado"></div>
				</div>
		</div>
		</div>
	</div>
<!-- FIN #1-->
<!-- #2 -->
	<div id="n2">
		<div class="col-md-4">
       	<div class="form-group">
		
			<form id="stopForm2" action="index.php?page=004" method="POST">
				<input type="hidden" name="especifica" value="2">
			
				<input type="hidden" name="initDate2" id="initDate2" value="<?php echo $valor2[2];?>"> 
				<input type="hidden" name="endTime2" id="endTime2" value="<?php echo $valor2[0];?>">
				<input type="hidden" id="user_id2" value="<?php echo $user_id ?>">
			</form>	<br><br>
				
				<div id="cronometro">
				<label id="act2" style="color: black;"><?php echo $valor2[1];?></label>
					<div id="reloj">
				   <span id="horas2">00</span>:<span id="minutos2">00</span>:<span id="segundos2">0</span>
				</div><br>			
						
				
				<div class="btns">
					<button type="button" class="boton" id="inicio2" onclick="empezar(2);" >Iniciar &#9658;</button>					
					<button type="button" class="boton" id="continuar2" onclick="continuar(2);" disabled>Reiniciar &#9658;</button>
					<button type="button" class="boton" id="parar2" onclick="parar(2);" disabled>Pausar &#8718;</button>					
					<button type="button" class="boton" id="guardar2" onclick="guardar(2);" disabled>Guardar &#8631;</button>
					<button type="button" class="boton" id="btn3" disabled>1</button>
					<button type="button" class="boton" id="btn4" disabled>3</button>
				</div>	
				<div id="resultado"></div>
				</div>
		</div>
		</div>
	</div>
<!-- FIN #2 -->
<!-- #3 -->	
	<div id="n3">
		<div class="col-md-4">
       	<div class="form-group">
		
			<form id="stopForm3" action="index.php?page=004" method="POST">
				<input type="hidden" name="especifica" value="3">
			
				<input type="hidden" name="initDate3" id="initDate3" value="<?php echo $valor3[2];?>"> 
				<input type="hidden" name="endTime3" id="endTime3" value="<?php echo $valor3[0];?>">
				<input type="hidden" id="user_id3" value="<?php echo $user_id ?>">
			</form>	<br><br>
				
				<div id="cronometro">
				<label id="act3" style="color: black;"><?php echo $valor3[1];?></label>
					<div id="reloj">
				   <span id="horas3">00</span>:<span id="minutos3">00</span>:<span id="segundos3">0</span>
				</div><br>				
					
				
				<div class="btns">
						<button type="button" class="boton" id="inicio3" onclick="empezar(3);" >Iniciar &#9658;</button>					
						<button type="button" class="boton" id="continuar3" onclick="continuar(3);" disabled>Reiniciar &#9658;</button>
						<button type="button" class="boton" id="parar3" onclick="parar(3);" disabled>Pausar &#8718;</button>						
						<button type="button" class="boton" id="guardar3" onclick="guardar(3);" disabled>Guardar &#8631;</button>
						<button type="button" class="boton" id="btn5" disabled>1</button>
						<button type="button" class="boton" id="btn6" disabled>2</button>
				</div>	
				<div id="resultado"></div>
				</div>	
		</div>
		</div>
	</div>
<!-- FIN #3 -->
<table id="pendientes" class="table table-striped table-bordered">
	
	<tr>
		<td>
			<label>Minutos Restantes</label>
		</td>
		<td> <?php echo $falta;?></td>
	</tr>
 
</table>
<!-- FIN DE EPACIO DE BOTONES E INPUTS -->
						
						
							<!-- <a href="index.php?page=004" class="btn btn-app"> <i
								class="fa fa-edit"></i> Registro de Actividad
							</a> -->
							<div style="text-align: center;">
								<a href="index.php?page=014" class="btn btn-app"> <i
									class="fa fa-plane"></i> Registro de ausentismo
								</a>
							</div>
						
			
			<?php
					} else {
						?>
						<br>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="callout callout-danger">
						<h3>Alerta!</h3>
						<p>
							El cronometro no se activara hasta que se complete el tiempo
							diario necesario, el cual es de mínimo 8 horas y 30 minutos, en
							caso de ausentismos (vacaciones, permisos, incapacidades), por
							favor registrarlo en la sección de ausentismos, de lo contrario
							usar el registro por demanda para completar las horas pendientes.
							<br>
						</p>
					</div>


					<div class="pad">
						<!-- Map will be created here -->
						<h3 class="box-title">Registros Pendientes</h3>
						<table id="pendientes" class="table table-striped table-bordered"
							>
							
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Tiempo registrado</th>
									<th>Tiempo pendiente</th>
								</tr>
							</thead>
							<tbody>
                               <?php
						foreach ( $reg_pen as $r ) {
							foreach ( $r as $key => $value ) {
								$falta = 8.5 - $value;
								?>
                                    <tr>
									<td><?php printf($key);?></td>
									<td><?php printf(round($value,2));?></td>
									<td><?php printf(round($falta,2));?></td>
								</tr>
                                            <?php
							}
						}
						?>
                                        </tbody>
						</table>
						<div class="col-md-offset-4">
							<a href="index.php?page=004" class="btn btn-app"> <i
								class="fa fa-edit"></i> Registro de Actividad
							</a> <a href="index.php?page=014" class="btn btn-app"> <i
								class="fa fa-plane"></i> Registro de ausentismo
							</a>
						</div>
					</div>
				</div>
			</div>
 			
 			
			<?php }?>
		</div>




		<script>
    
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
    
    </script>


    <?php
				if ($numero_filas > 0) {
					?>
    <script>
    /*
       // var d = <?php// echo "'".$initialDate."'" ?>;
        var date = new Date(d.substr(0, 4), d.substr(5, 2) - 1, d.substr(8, 2), d.substr(11, 2), d.substr(14, 2), d.substr(17, 2));
        console.log("date: "+date);
        inicioAutomatico(date);*/
        
    </script>
    <?php
				}
				?>
    
    </section>

</div>
</div>				
</div>
<script>

	$(document).ready(function(){
	    	 $("#n2").find("input,select,button").prop("disabled",true);
			 $("#n3").find("input,select,button").prop("disabled",true); 
	    	});

	$("#btn1").on("click", function(){
		$("#n2").find("input, #inicio2, #btn3, #btn4").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
	});
	$("#btn2").on("click", function(){
		$("#n3").find("input, #inicio3, #btn5, #btn6").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n2").find("input, button").prop("disabled",true);
	});
	$("#btn3").on("click", function(){
		$("#n1").find("input, #inicio1, #btn1, #btn2").prop("disabled",false);
		$("#n2").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	$("#btn4").on("click", function(){
		$("#n3").find("input, #inicio3, #btn5, #btn6").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n2").find("input, button").prop("disabled",true);
	});
	$("#btn5").on("click", function(){
		$("#n1").find("input, #inicio1, #btn1, #btn2").prop("disabled",false);
		$("#n2").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	$("#btn6").on("click", function(){
		$("#n2").find("input, #inicio2, #btn3, #btn4").prop("disabled",false);
		$("#n1").find("input, button").prop("disabled",true);
		$("#n3").find("input, button").prop("disabled",true);
	});
	
	
	$("#parar1").on("click", function(){
		document.getElementById("btn1").disabled = false;
		document.getElementById("btn2").disabled = false;
		document.getElementById("guardar1").disabled = false;		
	});
	
	$("#parar2").on("click", function(){
		document.getElementById("btn3").disabled = false;
		document.getElementById("btn4").disabled = false;
		document.getElementById("guardar2").disabled = false;
	});
	
	$("#parar3").on("click", function(){
		document.getElementById("btn5").disabled = false;
		document.getElementById("btn6").disabled = false;
		document.getElementById("guardar3").disabled = false;
	});
</script>