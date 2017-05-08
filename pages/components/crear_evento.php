 
 <link rel="stylesheet" href="plugins/select2/select2.min.css"/>
<style>
.scrollbar
{
	margin-left: 30px;
	float: left;
	height: 300px;
	width: 65px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}
.select2-container--default .select2-selection--single
{
	border-radius: 0;
    border-color: #d2d6de;
    width: 100%;
    height: 34px;
}
</style>

<script type="text/javascript">
	 $(document).ready(function(){
     $("#contra").load("pages/backend/includes/contrato.php");     

     $("#contra").change(function () {
         $("#contra option:selected").each(function () {
    	 var id = $(this).val();    	 
    	 //var opt = $('option[value="'+$(this).val()+'"]');
    	 //var id = opt.attr('id'); 		
    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){
	     $("#ci").html(data)             
      });
    })
   })
         
      $("#ci").change(function () {
        $("#ci option:selected").each(function () {
    	  var id = $(this).val();
    	 //var opt = $('option[value="'+$(this).val()+'"]');
     	 //var id = opt.attr('id');
         $.get("pages/backend/includes/ip.php", { info_id: id}, function(data){
         $("#ip").val(data);
       });
     })
    })
   });
</script> 
	

 <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">CI</h3>
              <!-- Barra de progreso -->
              <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 40%">                  
                </div>
              </div>              
               
       <div class="box-body">       
       <div class="row">
       
   
       <form method="post" action="index.php?page=023"  >
       <div class="col-md-6">
       <div class="form-group">

        <label>Contrato</label>
        <select id="contra" name="contrato" class="form-control" style=" width: 100%;"></select>

        <label>Selecciona CI</label> 
        <select id="ci" name="sci" class="form-control"  style=" width: 100%;"></select>

        <label>Sistema Operativo</label>
        <select id="so" class="form-control"  style="width: 100%;" disabled></select>
        
        <label>IP</label>        
        <input id="ip" class="form-control"  style="width: 100%;" readonly>
		
        </div></div>
        
        <div class="col-md-6">
        <div class="form-group">
        
        <label>Ambiente</label>
        <select id="ambiente" class="form-control"  style="width: 100%;" disabled></select>
        
        <label>Horario Operativo</label>
        <select id="ho" class="form-control"  style="width: 100%;" disabled></select>
        
        <label> - </label>
       	<input  id="b"class="form-control " list="a" name="a" readonly>        
        
        </div>
        
        
        <div class="box-footer">
           <a href="index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
          <button type="submit" class="btn btn-success pull-right">Siguiente</button>          
           </div>
           </div>
        </form>
        </div> 
        
        </div>
        </div>
        </div>

    <script src="plugins/select2/select2.full.min.js"></script>
    <script>
	     $(function () {
	    $("select").select2()
	     });
    </script>
	