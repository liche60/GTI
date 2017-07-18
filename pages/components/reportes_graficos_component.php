<script type="text/javascript"
	src="https://www.gstatic.com/charts/loader.js"></script>

<?php

include 'pages/components/reportes_filtros.php';
if (isset ( $_POST ["filtered"] ) && $filtros != false) {
	$query = applyFilters ( $query, $filtros );
	$query = preg_replace('/\s+/', ' ', trim($query));	
	?>
<script type='text/javascript'>
        $(document).ready(function(){
            $.ajax({
                	type: "POST",
                	contentType: "application/json; charset=utf-8",
                    url :'pages/backend/printchart.php',
                    data: "<?php echo $query;?>",
                    dataType:'JSON',
                    success: function(result_<?php echo $report;?>){
                        google.charts.load('current', {'packages':['corechart']});
                          google.charts.setOnLoadCallback(function(){   
                          drawChartpie_<?php echo $report;?>(result_<?php echo $report;?>);
                        });
                    }
            }); 

            function drawChartpie_<?php echo $report;?>(result_<?php echo $report;?>){

                var data_<?php echo $report;?> = new google.visualization.DataTable();
                data_<?php echo $report;?>.addColumn('string','columna');
                data_<?php echo $report;?>.addColumn('number','Disponibilidad');  
                data_<?php echo $report;?>.addColumn('number','Capacidad');                
                var dataArray_<?php echo $report;?> = [];
                $.each(result_<?php echo $report;?>, function(i, obj_<?php echo $report;?>) {
                    dataArray_<?php echo $report;?>.push([obj_<?php echo $report;?>.columna, parseInt(obj_<?php echo $report;?>.valores),parseInt(obj_<?php echo $report;?>.valores1) ]);
                });
                
                data_<?php echo $report;?>.addRows(dataArray_<?php echo $report;?>);

                var piechart_options_<?php echo $report;?> ={
                   // width: 1000,
                    height: 500,
                   // 'chartArea': {'width': '130%', 'height': '130%'},
                    bars: 'horizontal', 
                    series: {
                        0: { axis: 'columna' }, // Bind series 0 to an axis named 'distance'.
                        1: { axis: 'valores' }, // Bind series 1 to an axis named 'brightness'.
                        2: { axis: 'valores1' }, 
                         },
                      axes: {
                          x: {
                            distance: {label: 'parsecs'}, // Bottom x-axis.
                            brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
                          }
                        }, 
                    is3D: true};
                <?php 
                if($grafico == "pie"){
                ?>
                	var piechart_<?php echo $report;?> = new google.visualization.PieChart(document.getElementById('piechart_<?php echo $report;?>_div'));
				<?php }	if($grafico == "bar"){
	                ?>
	                	var piechart_<?php echo $report;?> = new google.visualization.BarChart(document.getElementById('piechart_<?php echo $report;?>_div'));
				<?php }?>
				<?php if($grafico == "column"){
	                ?>
	                	var piechart_<?php echo $report;?> = new google.visualization.ColumnChart(document.getElementById('piechart_<?php echo $report;?>_div'));
				<?php }?>
				
				
                piechart_<?php echo $report;?>.draw(data_<?php echo $report;?>, piechart_options_<?php echo $report;?>);
                }

        });
    </script>
 
<?php }?> 
 
<!-- /.box --> 

<div class='box box-success'>
	<div class='box-header with-border'>
		<h3 class='box-title'><?php echo $titulo;
		?></h3>
	
                
		<?php
		if ($filtros != false) {
			printFilterModal ( $filtros, $page, $wish );
		}
		
		?>
		<div class='box-tools pull-right'>
			<button type='button' class='btn btn-box-tool' data-widget='collapse'>
				<i class='fa fa-minus'></i>
			</button>
			<button type='button' class='btn btn-box-tool' data-widget='remove'>
				<i class='fa fa-times'></i>
			</button>
			<?php echo $report;?>
		</div>
	</div>
	<div class='box-body'>
		<div class='col-sm-offset-1'>
			<div class='chart'>
				<div id='piechart_<?php echo $report;?>_div'></div>
			</div>
		</div>
	</div>
</div>

