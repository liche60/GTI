<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Estilo DataTable  -->
<link
	href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"
	rel="stylesheet" />
<link
	href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.css"
	rel="stylesheet" />
<link
	href="https://cdn.datatables.net/1.10.12/css/dataTables.semanticui.min.css"
	rel="stylesheet" />

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
				<div style=" width: 100.5%; height:400px; overflow-y: scroll;">
					<table id="dataTable-<?php echo $report;?>" class="table table-bordered table-striped">
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


<!-- DataTables -->
<script
	src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script
	src="https://cdn.datatables.net/1.10.12/js/dataTables.semanticui.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.js"></script>

<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->

<script>
        $(document).ready(function() {
            $('#dataTable-<?php echo $report;?>').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
            } );
        } );
        
    </script>



