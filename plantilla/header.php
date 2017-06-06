<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>GTI | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!--Estilo Datatable -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.semanticui.min.css">
  
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  
  <link rel="stylesheet" href="dist/css/pages/infobox.css">
  <link rel="stylesheet" href="dist/css/pages/style.css">
  
  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  
  <!-- Multi select js -->
  <script src="plugins/multiselect/jquery.lwMultiSelect.js"></script>
  <!-- Multi select css -->
  <link rel="stylesheet" href="plugins/multiselect/jquery.lwMultiSelect.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <link rel="shortcut icon"  href="dist/img/favicon.ico">
  
  <script type="text/javascript">
  
  function onReady(callback) {
	    var intervalID = window.setInterval(checkReady, 100);
	    function checkReady() {
	    	body = document.getElementsByTagName('body')[0];
	        if (body !== undefined) {
	        	if (document.readyState == 'complete') {
	            	window.clearInterval(intervalID);
	            	callback.call(this);
	        	}
	        }
	    }

	    var checkReady = function(callback) {
	       
	    }
	}

	function show(id, value) {
	    document.getElementById(id).style.display = value ? 'block' : 'none';
	}

	onReady(function () {
	    show('page', true);
	    show('loading', false);
	});


  </script>
  
</head>