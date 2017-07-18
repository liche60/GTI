
<?php

// Reporte de productividad
/*
 * $consulta = "select `r`.`id_actividad` AS `id_actividad`,`a`.`plataforma` AS `plataforma`,
 * `a`.`categoria` AS `categoria`,`a`.`actividad` AS `actividad`
 * ,`r`.`cedula` AS `cedula`
 * ,(select area from areas where id=`d`.`area`) AS Namearea
 * ,`d`.`area` AS `area`
 * ,`r`.`fecha_inicio` AS `fecha_inicio`
 * ,`r`.`tiempoReal` AS `tiempoReal`
 * ,(select nombre from new_personas where cedula = r.cedula) AS nombre
 * ,`r`.`descripcion` AS `descripcion`
 * ,`r`.`id_contrato` AS `id_contrato`
 * ,`p`.`codigo` AS `proyecto`
 * from (((`registro_actividad` `r` join `actividad` `a`) join `new_usuario` `d`) join `new_proyectos` `p`)
 * where ( ( `r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>' )
 * and (`r`.`id_actividad` = `a`.`id`)
 * and (`r`.`id_contrato` = `p`.`codigo`)
 * and (`r`.`cedula` = `d`.`cedula`)
 * and (`r`.`estado` = 'F')
 * and (`d`.`area` <> 0 )
 * )
 * having
 * Namearea like '%<filtro3>%'
 * order by `r`.`fecha_inicio` asc";
 */
$consulta = "select DATE_FORMAT(fecha_inicio,'%m-%d-%Y') fecha,
r.cedula,
u.correo,
(select nombre from new_personas p where p.cedula = r.cedula ) nombre,
(select proyecto from new_personas p where p.cedula = r.cedula ) contrato,
a.area,
'8.5' as horas_programadas,
round(sum(tiempoReal)/60,2) as horas_laboradas
from registro_actividad r, areas a, new_usuario u
where fecha_inicio between '<filtro1>' and '<filtro2>'
and u.cedula = r.cedula
and a.id = u.area
and r.cedula <> ''
and a.area like '%<filtro4>%'
group by r.cedula, fecha
having correo like '%<filtro3>%'
order by fecha,r.cedula
limit 0,20000;";

// el query debe retornar un campo con nombre columna y otro numerico
$consulta2 = "SELECT 
categoria columna,
sum(tiempoReal) valores 
FROM `productividad_historica` 
where `fecha_inicio` > '<filtro1>' 
and `fecha_inicio` < '<filtro2>'
and `area` like '%<filtro3>%' 
GROUP by categoria";

$consulta3 = "SELECT
categoria columna,
sum(tiempoReal) valores
FROM `productividad_historica`
where `fecha_inicio` > '<filtro1>'
and `fecha_inicio` < '<filtro2>'
and `correo` = '<filtro3>'
GROUP by categoria";

$consulta4 = "select 
	date_format(fecha_inicio,'%m-%d-%Y') as columna, 
	(sum(tiempoReal)/60) as valores 
from productividad_historica 
where correo like '%<filtro3>%'
		and area like '%<filtro4>%'
		and `fecha_inicio` > '<filtro1>'
        and `fecha_inicio` < '<filtro2>'
group by date_format(fecha_inicio,'%m-%d-%Y') 
order by columna;";

$consulta5 = "SELECT fecha,tipo,proyecto,descripcion FROM new_novedades where
			fecha > '<filtro1>'
        and fecha < '<filtro2>'
		and proyecto like '%<filtro3>%'
        and tipo like '%<filtro4>%'";

// Reporte mensual
$consulta6 = "select `r`.`fecha_inicio` AS `fecha_inicio`,
`r`.`tiempoReal` AS `tiempoReal`,
a.actividad,
a.plataforma,
`a`.`categoria` AS `categoria`,
r.id_contrato,
(select np.nombre from new_proyectos np where np.codigo = r.id_contrato )as Contrato,
`d`.`correo` AS `correo`,
(select `ar`.`area` from `areas` `ar` where (`d`.`area` = `ar`.`id`)) AS `area`
from
((`registro_actividad` `r` left join `actividad` `a` on((`a`.`id` = `r`.`id_actividad`)))
left join `new_usuario` `d` on((`d`.`cedula` = `r`.`cedula`))) where (`r`.`estado` = 'F')
and (`r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>'   )
and (d.area like '%<filtro3>%' )
and (d.correo like '%<filtro4>%') 
order by `r`.`fecha_inicio` asc";

// Reporte mensual de eventos abiertos por ci
$consulta7 = "select a.id as 'ID del evento',b.nombre as 'CI',e.tipo as 'Servicio afectado', a.causa_evento as 'Causa del evento',d.nombre as
'Responsable' from incidentecop a,hosts b,new_proyectos c,new_personas d,tipo_servicios e where a.estado='P' and a.id_host=b.id and
b.id_contrato=c.codigo and a.responsable=d.cedula and a.servicio_afectado=e.id and a.id_host=b.id and c.codigo='<filtro1>' and a.fecha between '<filtro2>' and '<filtro3>'";

$consulta8 = "select a.id_evento as 'ID del evento',b.nombre as 'CI' , b.ip as 'IP' ,a.descripcion as 'Descripcion', a.horas_actividad as 
'Hora de actividad',a.tipo_evento as 'Tipo de evento', a.causa_evento as 'Causa del evento' ,d.nombre as 
'Responsable' from registro_masivo a,hosts b,new_proyectos c,new_personas d where a.estado='P' and a.id_host=b.id 
AND b.id_contrato=c.codigo and a.responsable=d.cedula and c.codigo='<filtro1>' and a.f_inicio between '<filtro2>' and '<filtro3>'";

$consulta9 = "select 
reponsable as 'Responsable', sum(cantidad) as 'Cantidad de eventos abiertos' from 
(select a.nombre as reponsable, count(distinct b.id)as cantidad from 
new_personas a, incidentecop b , hosts c where a.cedula=b.responsable and b.estado='P' and b.id_host=c.id 
and c.id_contrato='<filtro1>' and b.fecha between'<filtro2>' and '<filtro3>' group by b.responsable
union (select a.nombre as reponsable, count(distinct b.id_evento)as cantidad from new_personas a, registro_masivo b,hosts
c where a.cedula=b.responsable and b.estado='P' and b.id_host=c.id and c.id_contrato='<filtro1>' and b.f_inicio  
between '<filtro2>' and '<filtro3>' group by b.responsable)) k group by Responsable";

$consulta10 = "select a.id as 'ID de evento',b.nombre as 'CI afectado', c.tipo as 'Servicio afectado',a.tipo_evento as 'Tipo de evento',
 a.causa_evento as 'Causa del evento', a.tipo_actividad as 'Tipo de actividad', d.nombre as 'Persona que reporta',
 a.fecha as 'Fecha del evento',a.horas as 'Horas de actividad', d.nombre as 'Responsable',a.estado as 
'Estado del evento',a.mesa as 'Mesa de notificación',e.ticket as 'Ticket' from incidentecop a, hosts b,tipo_servicios c,
new_personas d,solucion_incidente e where a.id_host=b.id and a.servicio_afectado=c.id and a.responsable=d.cedula
and a.id_host=b.id  and a.id=e.id_evento and e.tipo='individual' and b.id_contrato='<filtro1>' and a.fecha between 
'<filtro2>' and '<filtro3>'";
 
$consulta11 = "select a.id_evento as 'ID de evento',b.nombre as 'CI afectado',a.f_inicio as 'Fecha del evento',
a.descripcion as 'Descripción', a.horas_actividad as 'Horas de actividad',a.tipo_evento as 'Tipo de evento',
a.causa_evento as 'Causa del evento',a.tipo_actividad as 'Tipo de actividad',c.nombre as 'Responsable', 
a.estado as 'Estado del evento', a.mesa as 'Mesa de notificación',d.ticket as 'Tiquet' from registro_masivo a 
inner join hosts b on a.id_host=b.id
inner join new_personas c on a.responsable=c.cedula
left join solucion_incidente d on a.id_evento=d.id_evento and d.tipo='masivo' and b.id_contrato='<filtro1>' and a.f_inicio between '<filtro2>' and '<filtro3>'";

$consulta12 = "select CI as 'Nombre de CI', sum(eventos) as 'Cantidad de eventos abiertos' from 
(select count(a.id_host) as 'eventos',b.nombre as 'CI' from incidentecop a,hosts b where a.id_host=b.id 
and a.id_host=b.id and b.id_contrato='<filtro1>'  and a.fecha BETWEEN '<filtro2>' and '<filtro3>' GROUP by b.nombre 
union (select count(a.id_host) as 'eventos',b.nombre as 'CI' from registro_masivo a , 
hosts b where a.id_host=b.id and b.id_contrato='<filtro1>' and a.f_inicio BETWEEN '<filtro2>' and '<filtro3>'
 group by b.nombre)) k group by ci";
 
$consulta13 = "select a.nombre as 'Nombre de CI',count(b.servicio_afectado) as 
'Cantidad de eventos en servicio por CI' from hosts a, incidentecop b where b.id_host=a.id 
and a.id_contrato='<filtro1>' and b.servicio_afectado='<filtro2>'  and b.fecha BETWEEN '<filtro3>' and '<filtro4>' 
GROUP by b.id_host";

$consulta14 = "SELECT columna, sum(valores) as 'valores' from (select a.nombre as 'columna' , 
count(DISTINCT b.id_evento) as 'valores' from  new_proyectos a, registro_masivo b,hosts c 
where b.id_host=c.id and c.id_contrato=a.codigo and b.f_inicio between '<filtro1>' and '<filtro2>' GROUP
by a.codigo union (select  a.nombre as 'columna',COUNT(b.id) as 'valores'  from new_proyectos a,
incidentecop b,hosts c where b.id_host=c.id and c.id_contrato=a.codigo and
b.fecha between '<filtro1>' and '<filtro2>' GROUP by a.codigo))k group by columna";

$consulta16 = "SELECT columna, sum(valores) as 'valores' from (select a.nombre as 'columna' ,
count(DISTINCT b.id_evento) as 'valores' from  new_proyectos a, registro_masivo b,hosts c
where b.id_host=c.id and c.id_contrato=a.codigo and b.f_inicio between '<filtro1>' and '<filtro2>' GROUP
by a.codigo union (select  a.nombre as 'columna',COUNT(b.id) as 'valores'  from new_proyectos a,
incidentecop b,hosts c where b.id_host=c.id and c.id_contrato=a.codigo and
b.fecha between '<filtro1>' and '<filtro2>' GROUP by a.codigo))k group by columna";
 
$consulta15 = "select nombre as columna, sum(Disponibilidad) as 'valores',sum(Capacidad) as 'valores1'
from (select a.nombre, count(DISTINCT b.id_evento) as 'Disponibilidad' , (select count(DISTINCT b.id_evento) 
as 'Capacidad' from registro_masivo b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Capacidad' and b.f_inicio BETWEEN 
'<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'  group by a.nombre) as Capacidad
from new_proyectos a,registro_masivo b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Disponibilidad'
and b.f_inicio BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%' group by a.nombre
union 
(select a.nombre, count(b.causa_evento) as 'Disponibilidad', (select count(b.id) as 'Capacidad' from incidentecop b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Capacidad' and b.fecha BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'
group by a.nombre) as Capacidad
from new_proyectos a,incidentecop b, hosts c WHERE
b.id_host=c.id and c.id_contrato=a.codigo  and b.causa_evento='Disponibilidad' and 
b.fecha BETWEEN '<filtro2>' and '<filtro3>' and c.id_contrato like '%<filtro1>%'
group by a.nombre))k group by nombre";


$_REPORTS_CONFIG = array (
		"ejemplo" => array (
				"tipo" => "tabla|grafico|grafico_linea",
				"titulo" => "Reporte de ...",
				"query" => "select columnaquery1,columnaquery2,columnaquery3 from ...",
				"columnas" => array (
						"columnaquery1" => "columnatabla1",
						"columnaquery2" => "columnatabla2",
						"columnaquery3" => "columnatabla3" 
				),
				"filtros" => array (
						"columnaquery1" => array (
								"nombre" => "nombrecampoform",
								"tipo" => "text" 
						),
						"columnaquery2" => array (
								"nombre" => "nombrecampoform",
								"tipo" => "datetime" 
						) 
				) 
		),
		"contratos" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Estado de Contratos",
				"query" => "SELECT codigo,nombre,estado FROM new_proyectos;",
				"columnas" => array (
						"codigo" => "Codigo del proyecto",
						"nombre" => "Nombre",
						"estado" => "Estado" 
				) 
		),
		"productividad" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Productividad",
				"query" => $consulta,
				"columnas" => array (
						"contrato" => "Código de Proyecto",
						"cedula" => "Cédula",
						"nombre" => "Nómbre",
						"fecha" => "Fecha",
						"horas_programadas" => "Horas Programadas",
						"horas_laboradas" => "Horas Laboradas" 
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false 
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false 
						) 
				) 
		),
		
		"grafico_productividad" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad",
				"query" => $consulta2,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false 
						) 
				) 
		),
		
		"grafico_productividad_personas" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad Personas",
				"query" => $consulta3,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text" 
						) 
				) 
		),
		"grafico_hist_actividades" => array (
				"tipo" => "grafico",
				"grafico" => "bar",
				"titulo" => "Reporte Histórico de Actividades",
				"query" => $consulta4,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false 
						),
						"filtro4" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false 
						) 
				) 
		),
		"novedades" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte de Novedades",
				"query" => $consulta5,
				"columnas" => array (
						"fecha" => "Fecha",
						"tipo" => "Tipo de Novedad",
						"proyecto" => "Código de Proyecto",
						"descripcion" => "Descripción" 
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Código de Proyecto",
								"tipo" => "text",
								"requerido" => false 
						),
						"filtro4" => array (
								"nombre" => "Tipo de Novedad",
								"tipo" => "select",
								"query_select" => "select distinct tipo as value, tipo as display from new_novedades",
								"requerido" => false 
						) 
				) 
		),
		
		"mensuales" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual",
				"query" => $consulta6,
				"columnas" => array (
						"fecha_inicio" => "Fecha inicio",
						"actividad" => "Actividad",
						"plataforma" => "Plataforma",
						"categoria" => "Categoria",
						"tiempoReal" => "Tiempo Real",
						"correo" => "Correo",
						"Contrato" => "Contrato",
						"area" => "Area" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						),
						
						"filtro3" => array (
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false 
						),
						"filtro4" => array (
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false 
						) 
				) 
		),
		
		"evento_abierto_contrato" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual eventos abiertos por contrato",
				"query" => $consulta7,
				"columnas" => array (
						"ID del evento" => "ID del evento",
						"CI" => "CI",
						"Servicio afectado" => "Servicio afectado",
						"Causa del evento" => "Causa del evento",
						"Responsable" => "Responsable" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_masivo_abierto" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual eventos masivos abiertos por contrato",
				"query" => $consulta8,
				"columnas" => array (
						"ID del evento" => "ID del evento",
						"CI" => "CI",
						"IP" => "IP",
						"Descripcion" => "Descripcion",
						"Hora de actividad" => "Hora de actividad",
						"Tipo de evento" => "Tipo de evento",
						"Causa del evento" => "Causa del evento",
						"Responsable" => "Responsable" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_responsable" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos abiertos por cada responsable por contrato",
				"query" => $consulta9,
				"columnas" => array (
						
						"Responsable" => "reponsable",
						"Cantidad de eventos abiertos" => "Cantidad de eventos abiertos" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_general" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos",
				"query" => $consulta10,
				"columnas" => array (
						
						"ID de evento" => "ID de evento",
						"CI afectado" => "CI afectado",
						"Servicio afectado" => "Servicio afectado",
						"Tipo de evento" => "Tipo de evento",
						"Causa del evento" => "Causa del evento",
						"Tipo de actividad" => "Tipo de actividad",
						"Persona que reporta" => "Persona que reporta",
						"Fecha del evento" => "Fecha del evento",
						"Horas de actividad" => "Horas de actividad",
						"Responsable" => "Responsable",
						"Estado del evento" => "Estado del evento",
						"Mesa de notificación" => "Mesa de notificación",
						"Ticket" => "Ticket" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_masivo_general" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos masivos",
				"query" => $consulta11,
				"columnas" => array (
						
						"ID de evento" => "ID de evento",
						"CI afectado" => "CI afectado",
						"Fecha del evento" => "Fecha del evento",
						"Descripción" => "Descripción",
						"Horas de actividad" => "Horas de actividad",
						"Tipo de evento" => "Tipo de evento",
						"Causa del evento" => "Causa del evento",
						"Tipo de actividad" => "Tipo de actividad",
						"Responsable" => "Responsable",
						"Estado del evento" => "Estado del evento",
						"Mesa de notificación" => "Mesa de notificación",
						"Tiquet" => "Tiquet"
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_ci" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos por CI",
				"query" => $consulta12,
				"columnas" => array (
						
						"Nombre de CI" => "Nombre de CI",
						"Cantidad de eventos abiertos" => "Cantidad de eventos abiertos" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"search" => true,
								"query_select" => "select codigo as value,nombre as display from new_proyectos",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),
		
		"evento_servicio" => array (
				"tipo" => "tabla",
				"titulo" => "Reporte eventos por Servicio",
				"query" => $consulta13,
				"columnas" => array (
						
						"Nombre de CI" => "Nombre de CI",
						"Cantidad de eventos en servicio por CI" => "Cantidad de eventos en servicio por CI" 
				
				),
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false 
						),
						"filtro2" => array (
								"nombre" => "Servicio",
								"tipo" => "select",
						
								"query_select" => "select id as value,tipo as display from tipo_servicios",
								"requerido" => false ,
								"search"=>true
						),
						
						"filtro3" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro4" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				)  
		), 
		 
		"grafico_evento_contrato" => array (
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de eventos por contrato",
				"query" => $consulta14,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						), 
						"filtro2" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				
				) 
		),

	
		
		"grafico_dispo_capa" => array (
				"tipo" => "grafico",
				"grafico" => "column",
				"titulo" => "Reporte disponibilidad , capacidad",
				"query" => $consulta15,
				"filtros" => array (
						"filtro1" => array (
								"nombre" => "Contrato",
								"tipo" => "select",
								"query_select" => "select codigo as value,nombre as display from new_proyectos where codigo='C-G075-01'",
								"requerido" => false
						),						
						"filtro2" => array (
								"nombre" => "Fecha Inicio",
								"tipo" => "date" 
						),
						"filtro3" => array (
								"nombre" => "Fecha Fin",
								"tipo" => "date" 
						) 
				 
				) 
		),
		
		  
		 
		"ci_contrato" => array (
				"tipo" => "tabla",
				"titulo" => "Cantidad de CI's por contrato",
				"query" => "select a.nombre as 'Contrato',count(b.id) as 'Cantidad de CI por contrato' 
                 from new_proyectos a,hosts b where b.id_contrato=a.codigo GROUP by a.codigo;",
				"columnas" => array (
						"Contrato" => "Nombre de contrato",
						"Cantidad de CI por contrato" => "Cantidad de CI's",
					
				)
		),

);


?>

