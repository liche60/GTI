<?php
/*
$query = $wish->getActiveTaskForUser ( $user_id );

$row = mysqli_fetch_array ( $query );
$numero_filas = mysqli_num_rows ( $query );
$initialDate = $row ['fecha_inicio'];
*/
// Actividades del mes

$actividadesdelmes = $wish->getActividadesMesAnalista($userinfo->user_id);
$productividad = $wish->getProductividad($userinfo->user_id);

?>

<div class="row">       
        
        <?php
								
								echo "
             <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                    <div class='info-box hover-zoom-effect'>
                        <div class='icon bg-blue'>
                            <i class='fa fa-spinner fa-spin fa-3x fa-fw'></i>
                        </div>
                        <div class='content'>
                            <div class='text'>Próximamente</div>
                            <div class='number'><span class=''></span></div>
                    
                        </div>
                    </div>

                </div>
          
        <!-- ./col -->
        <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                    <div class='info-box hover-zoom-effect'>
                        <div class='icon bg-green'>
                            <i class='fa fa-spinner fa-spin fa-3x fa-fw'></i>
                        </div>
                        <div class='content'>
                            <div class='text'>Próximamente</div>
                            <div class='number'><span class=''></span></div>
                    
                        </div>
                    </div>

                </div>                 
                ";
								
								?>



<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad del mes</div><br>
				<div class="number">
                    <?php
																				while ( $row = $productividad->fetch_array ( MYSQLI_NUM ) ) {
																					
																					echo $row [0] . "<br/>\n";
																				}
																				?></div>
			</div>
		</div>

	</div>








	<!-- ./col -->

	<!-- ./col -->
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
			</div>
			
			<div class="content">
				<div class="text">Actividades del mes</div><br>
				<div class="number">
					<a href="index.php?page=006">
					<span class="count"><?php
					while ( $row = $actividadesdelmes->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
					}
					?></span>
					</a>
				</div>
			</div>
			
		</div>

	</div>
	<!-- ./col -->
</div>