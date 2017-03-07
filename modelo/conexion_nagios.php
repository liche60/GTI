<?php 

class NagiosIntegration{

	private $consolas = array (
			"nagios1" => array(
					"ip" => "172.26.53.43",
					"port" => "3306",
					"usr" => "root",
					"pass" => "DBadmin.123*"
			),
			
	);
	
	private function getHostTable($consola){ 
		//query de hosts y grupos partiendo de que los grupos de contratos iniciaran con ARUS_%
		$q_hosts = "select distinct (h.alias) as nombre, h.address as ip, substring( g.alias,6) as codigo_proyecto
		from	ndo.nagios_hosts h 
					left join ndo.nagios_hostgroup_members m on h.host_object_id = m.host_object_id
					left join ndo.nagios_hostgroups g on m.hostgroup_id = g.hostgroup_id
		where g.alias like 'ARUS_%'";
		
	}
	
	public function getMemoria($consola,$hora_ini,$hora_fin,$fecha_ini,$fecha_fin,$servidor) {
		$service = "select id from centreon_storage.index_data where host_name='$servidor' and service_description = 'Memoria';";
		$id = "";
		$metric = "select metric_id from centreon_storage.metrics where metric_name = 'percent' and index_id='$id';";
		$metric_id = "";
		getPercentageMetricData($consola,$metric_id,$hora_ini,$hora_fin,$fecha_ini,$fecha_fin);
	}
	
	public function getMemoria($consola,$hora_ini,$hora_fin,$fecha_ini,$fecha_fin,$servidor) {
		$service = "select id from centreon_storage.index_data where host_name='$servidor' and service_description like 'Disk%';";
		$id = "";
		$metric = "select metric_id from centreon_storage.metrics where metric_name = 'percent' and index_id='$id';";
		$metric_id = "";
		getPercentageMetricData($consola,$metric_id,$hora_ini,$hora_fin,$fecha_ini,$fecha_fin);
	}
	
	public function getPercentageMetricData($consola,$metric_id,$hora_ini,$hora_fin,$fecha_ini,$fecha_fin) {
		$query = "select
						STR_TO_DATE(date, '%d-%m-%Y') as day,
						AVG(avg) avg,
						MIN(min) min,
						MAX(max) max
					from(
					select
							from_unixtime(ctime, '%d-%m-%Y %H:00') as date,
							from_unixtime(ctime, '%H') as time,
							AVG(value) as avg,
							MAX(value) as max,
							MIN(value) as min
						from centreon_storage.data_bin
						where id_metric = '$metric_id'
						group by from_unixtime(ctime, '%d-%m-%Y %H:00')
							having time > $hora_ini and time < $hora_fin
							and STR_TO_DATE(date,'%d-%m-%Y')
							between STR_TO_DATE('$fecha_ini','%d-%m-%Y') and STR_TO_DATE('$fecha_fin','%d-%m-%Y')
					) m
					group by STR_TO_DATE(date, '%d-%m-%Y')
					order by day desc";
	}

}

?>
