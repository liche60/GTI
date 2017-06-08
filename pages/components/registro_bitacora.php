<?php
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
and DATE_FORMAT(v.selected_date,'%w') <> 6";

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
DATE_FORMAT(fecha_inicio,'%T') hora,
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
<div class="row">
	<!-- Left col -->
	<section class="col-lg-12 connectedSortable">

		<!-- Custom tabs (Charts with tabs)-->
		<div class="nav-tabs-custom">
			<input type="hidden" id="user_id" value="<?php echo $user_id ?>">
			<!-- Tabs within a box -->
			<ul class="nav nav-tabs pull-right">

				<li class="pull-left header"><i class="fa fa-clock-o"></i>
					Registro de Actividades</li>
			</ul>
			
					<?php
					if ($registros == 0) {
						?>
			
						<div class="pad">
						<!-- Map will be created here -->
						<h3 class="box-title">Registros del día de hoy</h3>
						<div class="col-md-offset-4">
							<a href="index.php?page=004" class="btn btn-app"> <i
								class="fa fa-edit"></i> Registro de Actividad
							</a> <a href="index.php?page=014" class="btn btn-app"> <i
								class="fa fa-plane"></i> Registro de ausentismo
							</a>
						</div>
						<table id="pendientes" class="table table-striped table-bordered"
							>
							
							<thead>
								<tr>
									<th>Hora</th>
									<th>Actividad</th>
									<th>Categoria</th>
									<th>Descripción</th>
									<th>Duración (min)</th>
								</tr>
							</thead>
							<tbody>
                               <?php
						while ( $r = $reg_cur->fetch_object () ) {
							
								?>
                                    <tr>
                                    	<td><?php printf($r->hora);?></td>
										<td><?php printf($r->actividad);?></td>
										<td><?php printf($r->categoria);?></td>
										<td><?php printf($r->descripcion);?></td>
										<td><?php printf($r->tiempoReal);?></td>							
									</tr>
                                            <?php
						}
						?>
                                        </tbody>
						</table>
						
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
								$falta = 8 - $value;
								?>
                                    <tr>
									<td><?php printf($key);?></td>
									<td><?php printf($value);?></td>
									<td><?php printf($falta);?></td>
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
    
        var d = <?php echo "'".$initialDate."'" ?>;
        var date = new Date(d.substr(0, 4), d.substr(5, 2) - 1, d.substr(8, 2), d.substr(11, 2), d.substr(14, 2), d.substr(17, 2));
        console.log("date: "+date);
        inicioAutomatico(date);
        
    </script>
    <?php
				}
				?>
    
    </section>

</div>
