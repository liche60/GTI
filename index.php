<!DOCTYPE html>
<?php
header("Content-Type: text/html;charset=utf-8");
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
include_once 'modelo/conexion.php';

include_once 'seguridad/userinfo.class.php';
$wish = new conexion;
$user_id = $_SESSION['user_id'];
$rol = $_SESSION['rol'];
$user_name = ucwords(strtolower($_SESSION['user_name']));
$lider_id = $_SESSION['lider_id'];
$correo_user = $_SESSION['correo'];

$userinfo = new UserInfo;
$userinfo->user_id = $_SESSION['user_id'];
$userinfo->lider_id = $_SESSION['lider_id'];
$userinfo->user_name = ucwords(strtolower($_SESSION['user_name']));
$userinfo->area = $_SESSION['area'];
$userinfo->rol =$_SESSION['rol'];
$userinfo->proyecto =$_SESSION['proyecto'];
$userinfo->cargo =ucwords(strtolower($_SESSION['cargo']));
$userinfo->correo_user =$_SESSION['correo'];



//echo $lider_id;
include_once 'plantilla/vista.class.php';
include_once 'pages.config.php'; 

if(isset($_GET["page"])){
	$page = $_GET["page"];
}else{
	$page = "000";
}

$vista = new Vista ( $page , $_PAGE_CONFIG, $_PAGE_PERMISSIONS );
?>
<html>
<?php
include 'plantilla/header.php';
?>
<body class="hold-transition skin-blue sidebar-mini">
<div id="loading"></div>
<div id="page">
<div class="wrapper">
<?php
include 'plantilla/main_header.php';
include 'plantilla/menu_lateral.php';

	?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				
				<?php
				echo $vista->breadcrumb;
				?>
	
				<!-- Main content -->
				<section class="content">
				
					<?php 
						
						try {
							include 'controlador.php';
						} catch (Exception $e) {
							?>
							<script type="text/javascript">
								window.location = "index.php?page=500";
							</script>
							<?php 
						}
						?>
					
				</section>
				<!-- /.content -->
			</div>
	<?php
	include 'plantilla/footer.php';
	?>
</div>
</div>
</body>
</html>
<?php
	} else {
		header ( "Location: login.php" );
	}
?>