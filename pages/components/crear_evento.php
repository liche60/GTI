 
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

     $("#contra").change(function (oe) {
    	 var id = $(this).val();
    	 document.getElementById("masivo").style.display="block";
    	 $("#conmasivo").val(id);
    	 //var opt = $('option[value="'+$(this).val()+'"]');
    	 //var id = opt.attr('id'); 		
    	 $.get("pages/backend/includes/ci.php", { param_id: id}, function(data){
	     $("#ci").html(data);
	     
	     $("#tipo_ci").val();
	     
      });
   })
         
      $("#ci").change(function () {
        	
    	  var id = $(this).val();
    	  
    	 //var opt = $('option[value="'+$(this).val()+'"]');
     	 //var id = opt.attr('id');
         $.get("pages/backend/includes/ip.php", { info_id: id}, function(data){
         $("#ip").val(data);
       });
     })

     $("#ci").change(function () {
        	
    	  var id = $(this).val();
    	 //var opt = $('option[value="'+$(this).val()+'"]');
     	 //var id = opt.attr('id');
         $.get("pages/backend/includes/tipo_ci.php", { info_id: id}, function(data){
         $("#tipo_ci").val(data);
       });
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
       
   
       <form method="post" action="index.php?page=025">
       <div class="col-md-6">
       <div class="form-group">

        <label>Contrato</label>
        <select id="contra" required name="contrato" class="form-control" style=" width: 100%;"></select>

        <label>Selecciona CI</label> 
        <select id="ci" required name="sci" class="form-control"  style=" width: 100%;"></select>
		
		<!-- 
        <label>Sistema Operativo</label>
        <select id="so" class="form-control"  style="width: 100%;" disabled></select> -->
        
        
		
        </div></div>
        
        <div class="col-md-6">
        <div class="form-group">
        
        <label>IP</label>        
        <input id="ip" class="form-control" name="ip" style="width: 100%;" readonly>
        
       <!-- <label>Ambiente</label>
        <select id="ambiente" class="form-control"  style="width: 100%;" disabled></select>
        
         label>Horario Notificación</label>
        <select id="ho" class="form-control"  style="width: 100%;" disabled></select> -->
        
        <label> Tipo </label>
       	<input  id="tipo_ci"class="form-control " name="tipo_ci" readonly>        
        
        </div>
           
        </div>  
        <button type="submit" class="btn btn-success pull-right">siguiente</button> 
        </form>
        
         <form method="post" action="index.php?page=029">
        <input type="hidden" id="conmasivo" name="conmasivo">
        <button  type="submit" class="btn btn-success pull-left" id="masivo" style="display: none">Registro Masivo</button>
        </form>
        
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
    
