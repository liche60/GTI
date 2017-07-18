

 <link rel="stylesheet" href="plugins/select2/select2.css"/>

<?php 
include 'pages/components/reportes_filtros.php';
?>

<script>

	document.getElementById("inicio").disabled = true;       
                  
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 1, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>




<div class="panel-body">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $titulo; ?></h3>
				</div>

            	<?php
													if ($filtros != false) {
														printFilterModal ( $filtros, $page, $wish);
													}
													
													?>
          
                <?php
																
																	if (isset ( $_POST ["filtered"] ) || $filtros == false) {
																		?>
            	<?php $query = applyFilters($query,$filtros); ?>
            	
            	
         
				<div class="box-body">
				
				   <div style=" width: 100.5%; height:280px; overflow-y: scroll;">
				   
					<table id="dataTable-<?php echo $report;?>"
						class="table table-bordered table-striped">
						<thead>
							<tr>
							                <?php
																		
																		foreach ( $columns as $col => $show_col ) {
																			?>
							<th><?php printf($show_col)?></th>
							<?php
																		}
																		?>
							                </tr>
						</thead>
						<tbody>
							                <?php
																		
																		if ($consulta = $wish->conexion->query ( $query )) {
																			while ( $arr = $consulta->fetch_array () ) 

																			{
																				?>
							<tr>
								<?php
																				
																				foreach ( $columns as $col => $show_col ) {
																					?>
							<td><?php printf($arr[$col])?></td>
							<?php
																				}
																				?>
								 
							</tr>
							<?php
																			}
																			$consulta->close ();
																		}
						 												?>
							                </tbody>

					</table>
					</div>
				</div>
				<?php
																	
																}
																?>
			</div>
		</div>
	</div>
</div>




<script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>