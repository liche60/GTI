<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script> 
<script src="dist/js/pages/operaciones.js"></script>
<link rel="stylesheet" href="plugins/select2/select2.min.css"/>

<style>
	.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}
</style>

    <script>
			$(document).ready(function() {
				$('#zctb').DataTable();
			} );
			function select(link){
				var id = link.id;               
        document.getElementById("id_actividad").value = id;
				$('html,body').scrollTop(0); 
                queryActividad();
			}
</script>
    


<?php

if($userinfo->area == 23){
$consulta ="select id,plataforma,categoria,actividad from actividad where area=" . $userinfo->area . "";
}else
{
$consulta ="SELECT id,plataforma,categoria,actividad FROM actividad where area=8 or area=".$userinfo->area."";
}

$editar=0;
$editar_res=null;
if( isset($_GET['editar']) ){
	$editar=1;
	$id_editar = $_GET['editar'];
	$query="select * from registro_actividad where id = ".$id_editar."";
	$editar_res=$wish->conexion->query($query);
}

if($editar){
	$row_editar= $editar_res->fetch_object();
	$id_actividad = $row_editar->id_actividad;
	$numerotiquete = $row_editar->numerotiquete;
	$descripcion = $row_editar->descripcion;
	$id_contrato = $row_editar->id_contrato;
	$tiempoReal = $row_editar->tiempoReal;
	$tiempo_calculado = $row_editar->tiempo_calculado;
						
							?>
						<script>
                                     document.getElementById("id_actividad").value="<?php echo $id_actividad;  ?>";
                                     queryActividad();
                                     document.getElementById("numerotiquete").value="<?php echo $numerotiquete;  ?>";
                                     document.getElementById("descripcion").value="<?php echo $descripcion;  ?>";
                                     document.getElementById("<?php echo $id_contrato; ?>").selected = true;
                                     document.getElementById("tiempo_calculado").value="<?php echo $tiempo_calculado;  ?>";
                                     document.getElementById("tiempoRealMin").value="<?php echo $tiempoReal;  ?>";
                        </script>       
							<?php
                            }
                        ?>
                            
        


      <div class="row">
        <div class="col-md-12">

          
          <!-- /.box -->

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Lista de actividades</h3>
            </div>
            <div class="box-body">
              <table id="zctb" class="display table table-striped table-bordered table-hover" >
											<thead>
												<tr>
													<th>ID</th>
													<th>Plataforma</th>
													<th>Categoria</th>
													<th>Actividad</th> 
												</tr>  
											</thead>
											<tbody>
												<?php												





                        
                         if($consulta = $wish->conexion->query($consulta))
                        {
                          while($obj = $consulta->fetch_object())

                          {?>
                        <tr>
                          <td><a href="#" onclick="select(this)" id="<?php printf($obj->id);?>"><?php printf($obj->id);?></a></td>
                          <td><?php printf($obj->plataforma);?></td>
                          <td><?php printf($obj->categoria);?></td>
                          <td><?php printf($obj->actividad);?></td>  
                        </tr> 
                        <?php }}
                          $consulta->close();
                        ?>
                                                
											</tbody>								
										</table>   
                
              
              
             
            </div>           
          </div>
        </div>              
      </div>

  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        
        
      

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->


   
     <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2();
	     });
    </script>

    