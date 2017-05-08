<?php
class conexion{
	public $conexion;
	private $server = "bitacora.arus.com.co";
	private $usuario = "root";
	private $pass = "pruebas48";
	private $db = "gti";
	public $pdo_conn;
	public function __construct() {
		$this->conexion = new mysqli ( $this->server, $this->usuario, $this->pass, $this->db );
		
		if ($this->conexion->connect_errno) {
			
			die ( "Fallo al tratar de conectar con MySQL: (" . $this->conexion->connect_errno . ")" );
		}
		$this->conexion->query ( "SET NAMES 'utf8'" );
		$this->pdo_conn = new PDO ( "mysql:host=$this->server;dbname=$this->db", $this->usuario, $this->pass );
	}
	public function cerrar() {
		$this->conexion->close ();
	}
	public function login($correo, $password) {
		$query = "select p.cedula,p.nombre,u.id,p.proyecto,u.fecha_control,p.cargo,p.correo_personal,p.jefe,p.celular,u.rol from new_usuario u,new_personas p where u.correo = '$correo' and u.correo = p.correo and u.password = '$password' and u.estado='A'";
		$consulta = $this->conexion->query ( $query );
		$num = mysqli_num_rows ( $consulta );
		if ($num == 1) {
			$row = mysqli_fetch_array ( $consulta );
			$id = $row ['cedula'];
			$proyecto = $row ['proyecto'];
			$lider_id = $row ['jefe'];
			$cargo = $row ['cargo'];
			$area = $this->getAreaByUserId ( $id );
			$name = $row ['nombre'];
			session_start ();
			$_SESSION ['authenticated'] = 1;
			$_SESSION ['rol'] = $row ['rol'];
			$_SESSION ['user_id'] = $id;
			$_SESSION ['user_name'] = $name;
			$_SESSION ['lider_id'] = $lider_id;
			$_SESSION ['proyecto'] = $proyecto;
			$_SESSION ['cargo'] = $cargo;
			$_SESSION ['area'] = $area;
		}
		echo "index.php";
	}
	public function tiempo($tiempo, $user_id) {
		$this->tiempo = $tiempo;
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio,estado,id_contrato) VALUES ( '0','" . $user_id . "','" . $tiempo . "','R',76)";
		$consulta = $this->conexion->query ( $query );
	}
/*	public function registrarActividad($user_id, $id, $descripcion, $fecha_final, $tiempoReal, $numerotiquete, $id_contrato) 

	{
		$query = "update registro_actividad set id_actividad=" . $id . ", descripcion='" . $descripcion . "', id_contrato='" . $id_contrato . "', numerotiquete='" . $numerotiquete . "' ,tiempo_calculado='" . $fecha_final . "', fecha_fin=now(),tiempoReal='" . $tiempoReal . "', estado='F' where cedula=" . $user_id . " and estado='R';";
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}*/
	public function actualizarActividad($id_reg, $user_id, $id, $descripcion, $fecha_final, $tiempoReal, $numerotiquete, $id_contrato, $horaExtra, $estado) 

	{
		$query = "update registro_actividad set id_actividad=" . $id . ", descripcion='" . $descripcion . "', id_contrato='" . $id_contrato . "', numerotiquete='" . $numerotiquete . "' , tiempoReal='" . $tiempoReal . "' where id=" . $id_reg . " and cedula=" . $user_id . " and estado='$estado' and horaExtra='$horaExtra' ;";
		
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}
	public function getLiderByUserID($id) {
		$query = "select cedula from new_usuario where cedula = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActiveTaskForUser($user_id) {
		$query = "select * from registro_actividad where estado ='R' and cedula = " . $user_id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActividadesByID($id) {
		$query = "select actividad from actividad where id = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getPlataformaByID($id) {
		$query = "select plataforma from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function getCategoriaByID($id) {
		$query = "select categoria from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function cambiopass($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	public function cambiopasssuper($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	public function registrarNuevaActividad($id_actividad, $user_id, $fecha_inicio, $tiempoReal, $numerotiquete, $descripcion, $id_contrato, $horaExtra, $estado) {
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio,estado,tiempoReal,numerotiquete,descripcion,id_contrato,horaExtra) VALUES ('" . $id_actividad . "','" . $user_id . "','" . $fecha_inicio . "','".$estado."','" . $tiempoReal . "','" . $numerotiquete . "','" . $descripcion . "','" . $id_contrato . "','" . $horaExtra. "')";
		$consulta = $this->conexion->query ( $query );
		
	}
	public function actualizarEstado($id, $nuevoEstado) {
		$query = "update registro_actividad set estado='" . $nuevoEstado . "' where id=" . $id . ";";
		
		$consulta = $this->conexion->query ( $query );
	}
	public function activarContrato($codigo, $alias, $lider) {
		$query = "insert into new_lider_contratos values('" . $codigo . "','" . $alias . "'," . $lider . ");";
		
		$consulta = $this->conexion->query ( $query );
	}
	public function desactivarContrato($codigo, $lider) {
		$query = "delete from new_lider_contratos where codigo = '" . $codigo . "' and id_lider = '" . $lider . "';";
		$consulta = $this->conexion->query ( $query );
	}
	/*
	 * public function registro_analista($nombre, $area, $correo, $pass, $horario, $lider) {
	 * $this->nombre = $nombre;
	 * $this->area = $area;
	 * $this->correo = $correo;
	 * $this->pass = $pass;
	 * $this->horario = $horario;
	 * $this->lider = $lider;
	 *
	 * $query = "INSERT INTO new_usuario (id,nombre,correo,horalaboral,area,lider,password,cargo_id,estado,ubicacion,educacion,habilidades) VALUES ('','" . $nombre . "','" . $correo . "','" . $horario . "','" . $area . "','" . $lider . "','" . $pass . "','2','A','','','')";
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 */
	public function getAreaByUserId($user_id) {
		$queryArea = "select area from new_usuario where cedula=" . $user_id . "";
		$resArea = $this->conexion->query ( $queryArea );
		$area_user = $resArea->fetch_object ();
		$area_user = $area_user->area;
		return $area_user;
	}
	/*
	 * public function actualizarperfil1($nombre, $user_id, $ubicacion, $educacion) {
	 * $query = "update new_usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "' where id=" . $user_id . "";
	 *
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 * public function actualizarperfil($nombre, $user_id, $ubicacion, $habilidades, $educacion) {
	 * $query = "update usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "', habilidades='" . $habilidades . "' where id=" . $user_id . "";
	 *
	 * $consulta = $this->conexion->query ( $query );
	 * }
	 */
	function mysqli_result($res, $row, $field = 0) {
		$res->data_seek ( $row );
		$datarow = $res->fetch_array ();
		return $datarow [$field];
	}
	
	
	public function actualizarPersonasNomus() {
		ini_set ( 'display_errors', 'On' );
		set_time_limit ( 10000 );
		include_once 'modelo/conexion_nomus.php';
		$nomus = new NomusIntegracion ();
		$personas = $nomus->getUsuariosNomus ();
		$disable_query = "update new_personas set estado=2 where estado=0;";
		$this->conexion->query ( $disable_query );
		$disable_query = "update new_personas set estado=0 where estado=1;";
		$this->conexion->query ( $disable_query );
		foreach ( $personas as $key => $registro ) {
			$cedula = $registro ["CEDULA"];
			$nombre = $registro ["NOMBRE"];
			$nombre = str_replace ( "'", "", $nombre );
			$correo = $registro ["CORREO_CORPORATIVO"];
			$correo_personal = $registro ["CORREO_PERSONAL"];
			$celular = $registro ["TEL_CELULAR"];
			$cargo = $registro ["CARGO"];
			$proyecto = $registro ["COD_PROYECTO"];
			$jefe = $registro ["CEDULA_JEFE"];
			$persona_existe = $this->getUserByCedula ( $cedula );
			$número_filas = mysqli_num_rows ( $persona_existe );
			if ($número_filas == 1) {
				// echo "<br>$nombre existe verificando novedades.. ";
				$novedad = false;
				$row = $persona_existe->fetch_object ();
				$proyecto_nov = "";
				$cargo_nov = "";
				$jefe_nov = "";
				$celular_nov = "";
				if (trim ( $row->proyecto ) != trim ( $proyecto )) {
					$proyecto_nov = ",proyecto = '$proyecto'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula que pertenecía al proyecto $row->proyecto ahora pertenece al proyecto $proyecto";
					$this->insertarNovedadPersonal ( "CAMBIO_PROYECTO", $proyecto, $cedula, $descripcion );
					$this->insertarNovedadPersonal ( "CAMBIO_PROYECTO", $row->proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->cargo ) != trim ( $cargo )) {
					$cargo_nov = ",cargo = '$cargo'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de cargo de $row->cargo a $cargo";
					$this->insertarNovedadPersonal ( "CAMBIO_CARGO", $proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->jefe ) != trim ( $jefe )) {
					$jefe_nov = ",jefe = '$jefe'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de jefe ahora es $jefe";
					$this->insertarNovedadPersonal ( "CAMBIO_JEFE", $proyecto, $cedula, $descripcion );
				}
				if (trim ( $row->celular ) != trim ( $celular )) {
					$celular_nov = ",celular = '$celular'";
					$novedad = true;
					$descripcion = "$nombre con cédula $cedula cambia de celular ahora es $celular";
					$this->insertarNovedadPersonal ( "CAMBIO_CELULAR", $proyecto, $cedula, $descripcion );
				}
				if ($novedad) {
					$update = "update new_personas set cedula='$cedula' $cargo_nov $proyecto_nov $jefe_nov $celular_nov where cedula = '$cedula' ";
					$this->conexion->query ( $update );
					// echo $update;
				}
				$enable_query = "update new_personas set estado=1 where cedula='$cedula';";
				$this->conexion->query ( $enable_query );
			} else {
				$insert = "insert into new_personas (cedula,nombre,proyecto,cargo,jefe,correo,correo_personal,celular,estado) 
	 		 			values('$cedula','$nombre','$proyecto','$cargo','$jefe','$correo','$correo_personal','$celular',1)";
				$this->conexion->query ( $insert );
				$descripcion = "$nombre con cédula $cedula con cargo $cargo ingresa a la compañía al proyecto $proyecto";
				$this->insertarNovedadPersonal ( "NUEVO_INGRESO", $proyecto, $cedula, $descripcion );
			}
		}
		
		$inactives_query  = "select * from new_personas where estado=0";
		$result = $this->conexion->query ( $inactives_query );
		while($obj = $result->fetch_object()){
			$descripcion = "$obj->nombre con cédula $obj->cedula del proyecto $obj->proyecto fué retirado de la compañía";
			$this->insertarNovedadPersonal("NUEVO_RETIRO",$obj->proyecto,$obj->cedula,$descripcion);
		}
		$disable_query = "update new_personas set estado=0 where estado=2;";
		$this->conexion->query ( $disable_query );
		ini_set ( 'display_errors', 'Off' );
	}
	function insertarNovedadPersonal($tipo, $proyecto, $cedula, $descripcion) {
		// echo "<br>$descripcion<br>";
		$query = "insert into new_novedades (fecha,tipo,proyecto,cedula,descripcion) values (now(),'$tipo','$proyecto','$cedula','$descripcion')";
		// echo $query;
		$this->conexion->query ( $query );
	}
	function getUserByCedula($cedula) {
		$query = "SELECT proyecto,cargo,jefe,correo_personal,celular FROM new_personas where cedula='$cedula'";
		$persona = $this->conexion->query ( $query );
		
		return $persona;
	}
	
	// Cantidad de analistas
	function getColaboradoresFromLider($lider) {
		$query = "SELECT COUNT(*) FROM new_personas where jefe=$lider";
		$numanalista = $this->conexion->query ( $query );
		return $numanalista;
	}
	// cantidad de actividades de mis analistas
	function getProductividadColaboradores($lider) {
		$query = "SELECT sum(a.tiempo_calculado)/count(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula  and r.jefe=$lider and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW()) AND a.estado='F'";
		$numeroactividades = $this->conexion->query ( $query );
		return $numeroactividades;
	}
	// Cantidad de contratos
	function getContratosByLider($lider) {
		$query = "SELECT COUNT(*) FROM new_lider_contratos where id_lider=$lider";
		$contratos = $this->conexion->query ( $query );
		return $contratos;
	}
	// cantidad de pendientes
	function getPendientesByLider($lider) {
		$query = "SELECT COUNT(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula and jefe=$lider AND a.estado='P'";
		$pendientes = $this->conexion->query ( $query );
		return $pendientes;
	}
	// cantidad de actividades mes
	function getActividadesMesAnalista($cedula) {
		$query = "SELECT COUNT(*) FROM registro_actividad WHERE cedula='$cedula'and estado='F' and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW())";
		$actividadesdelmes = $this->conexion->query ( $query );
		return $actividadesdelmes;
	}
	
	// productividad
	function getProductividad($cedula) {
		$query = " SELECT  round ((avg(a.tiempoReal)),1) productividad  FROM registro_actividad a,new_personas r WHERE a.cedula='$cedula' and MONTH(fecha_inicio) = MONTH(NOW()) and YEAR(fecha_inicio) = YEAR(NOW()) AND a.estado='F'";
		$productividad = $this->conexion->query ( $query );
		return $productividad;
	}
	function getFechaControlUser($cedula) {
		$ctrl_q = "select fecha_control from new_usuario where cedula = '$cedula' ";
		$ctrl_r = $this->conexion->query ( $ctrl_q );
		$ctrl_arr = $ctrl_r->fetch_array ();
		$ctrl = $ctrl_arr ["fecha_control"];
		return $ctrl;
	}
	public function registrarAusentismo($user_id, $proyecto, $fecha_inicio, $fecha_fin, $tipo, $comentario) {
		$query = "insert into
					registro_actividad (id_actividad,fecha_inicio,estado,tiempoReal,descripcion,id_contrato,cedula)
					select
					'8' as id_actividad,
					date_format(v.selected_date,'%Y-%m-%d 07:30:00') as fecha_inicio,
					'A' as estado,
					'510' as tiempoReal,
					'$tipo - $comentario' as descripcion,
					'$proyecto' as id_proyecto,
					'$user_id' as cedula
					from
					(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
							where v.selected_date between '$fecha_inicio' and '$fecha_fin' - INTERVAL 1 DAY
							and DATE_FORMAT(v.selected_date,'%w') <> 0
							and DATE_FORMAT(v.selected_date,'%w') <> 6";
		
		$consulta = $this->conexion->query ( $query );
	}
	
	public function updateHostsFromNagios(){
		
		$oe = new NagiosIntegration();
		foreach ($oe->consolas as $key => $value){
			$conn = $oe->getConnection($key);
			$cis = $conn->query("select distinct address, alias  from ndo.nagios_hosts");
			$this->conexion->query ( "update new_host set estado = 2 where estado = 0;" );
			$this->conexion->query ( "update new_host set estado = 0 where estado = 1 and consola='$key';" );
			while ( $row = $cis->fetch_array()) {
				$host = $row["alias"];
				$ip = $row["address"];
					
				$exist = $this->conexion->query ( "select count(*) cantidad from new_host where alias = '$host' and address = '$ip' and consola = '$key'");
				$resul = $exist->fetch_array();
				if($resul["cantidad"] == 1){
					$this->conexion->query ( "update new_host set estado = 1 where alias = '$host' and address = '$ip' and consola ='$key'");
					//guardar la novedad
					echo "se actualiza $host en $key.<br>";
				}else{
					$this->conexion->query ("insert into new_host (estado, alias, address,consola) values(1, '$host', '$ip', '$key')");
					echo "se inserta $host en $key.<br>";
					//guardar la noveda
				}
			}
			$deletes = $this->conexion->query(" select * from new_host where estado = 0 and consola='$key'");
			while ( $row = $deletes->fetch_array ( ) ) {
			echo "se elimina $host en $key.<br>";
			
			 // guardar novedad
			 }
			$this->conexion->query ( "update new_host set estado = 0 where estado = 2;" );
		
		}
		
		
		
		/*
		 * 1. obtener la lista de funciones de la clase nagiosIntegration
	     * 2. Recorrer las consolas obteniendo su conexión y obtener los hosts de cada conexion 
		 * 		query: select distinct address, alias  from ndo.nagios_hosts
		 * 3. Setear la tabla local de hosts de GTI para que todos los estados de los hosts que estan en 0 queden en 2
		 * 4. Setear la tabla local de hosts de GTI para que todos los estados de los hosts que estan en 1 queden 0
		 * 5. Recorrer cada host y revisar si estan en la tabla de hosts local
		 * 		-> validar en cada host, su nombre, ip y consola
		 * 		-> si no está, insertar el hostname, la ip y la consola, estado, en estado debe quedar un 1 (guardar novedad)
		 * 		-> si está se actualiza el estado a 1
		 * 6. Se consultan los hosts de la tabla de gti local donde los estados sean 0 y se guarda la novedad.
		 * 7. Se acualizan todos los estados que estaban 2 a 0.
		 */
	}
	
	
	public function registroNewContacto($nombre, $celular, $correo, $tipo, $descripcion)
	{
		$query = "insert into new_contactos (nombre, celular, correo, tipo, descripcion) values ('$nombre', $celular, '$correo', '$tipo', '$descripcion')";
		$consulta = $this->conexion->query ( $query );
	}
	
	public function insertService($tipo, $nombre, $descripcion, $id_host, $accion, $tiempo)
	{
		$query = "insert into servicios (tipo, nombre, descripcion, id_host, accion_critica, tiempo_max_contacto) values ('$tipo', '$nombre', '$descripcion', $id_host, '$accion', $tiempo)";
		$consulta = $this->conexion->query ( $query );
	}
	
	
	
	

	
	
}

?>
