<?php

// Reporte de productividad
/*$consulta = "select `r`.`id_actividad` AS `id_actividad`,`a`.`plataforma` AS `plataforma`,
`a`.`categoria` AS `categoria`,`a`.`actividad` AS `actividad`
,`r`.`cedula` AS `cedula`
,(select area from areas where id=`d`.`area`) AS Namearea
,`d`.`area` AS `area`
,`r`.`fecha_inicio` AS `fecha_inicio`
,`r`.`tiempoReal` AS `tiempoReal`
,(select nombre from new_personas where cedula = r.cedula) AS nombre
,`r`.`descripcion` AS `descripcion`
,`r`.`id_contrato` AS `id_contrato`
,`p`.`codigo` AS `proyecto`
from (((`registro_actividad` `r` join `actividad` `a`) join `new_usuario` `d`) join `new_proyectos` `p`)
where (  ( `r`.`fecha_inicio` > '<filtro1>' and `r`.`fecha_inicio` < '<filtro2>'   ) 
and (`r`.`id_actividad` = `a`.`id`) 
and (`r`.`id_contrato` = `p`.`codigo`) 
and (`r`.`cedula` = `d`.`cedula`) 
and (`r`.`estado` = 'F') 
and (`d`.`area`  <> 0 )
		) 
having 
		Namearea like '%<filtro3>%'
order by `r`.`fecha_inicio` asc";*/

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

//Reporte mensual
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


$_REPORTS_CONFIG = array(
		"ejemplo" => array(
			"tipo" => "tabla|grafico",
			"titulo" => "Reporte de ...",
			"query" => "select columnaquery1,columnaquery2,columnaquery3 from ...",
			"columnas" => array(
				"columnaquery1" => "columnatabla1",
				"columnaquery2" => "columnatabla2",
				"columnaquery3" => "columnatabla3",
			),
			"filtros" => array(
					"columnaquery1" => array(
							"nombre" => "nombrecampoform",
							"tipo" => "text"
					),
					"columnaquery2" => array(
							"nombre" => "nombrecampoform",
							"tipo" => "datetime"
					),
			)
		),
		"contratos" => array(
				"tipo" => "tabla",
				"titulo" => "Reporte de Estado de Contratos",
				"query" => "SELECT codigo,nombre,estado FROM new_proyectos;",
				"columnas" => array(
						"codigo" => "Codigo del proyecto",
						"nombre" => "Nombre",
						"estado" => "Estado",
				)
		),
		"productividad" => array(
				"tipo" => "tabla",
				"titulo" => "Reporte de Productividad",
				"query" => $consulta,
				"columnas" => array(
						"contrato" => "Código de Proyecto",
						"cedula" => "Cédula",
						"nombre" => "Nómbre",
						"fecha" => "Fecha",
						"horas_programadas" => "Horas Programadas",
						"horas_laboradas" => "Horas Laboradas",
				),
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date",
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array(
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro4" => array(
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false
						),
				)
				),
		
		"grafico_productividad" => array(
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad",
				"query" => $consulta2,
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date"
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array(
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false
						),
				)
		),
		
		"grafico_productividad_personas" => array(
				"tipo" => "grafico",
				"grafico" => "pie",
				"titulo" => "Reporte de Productividad Personas",
				"query" => $consulta3,
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date",
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array(
								"nombre" => "Correo",
								"tipo" => "text"
						),
				)
		),
		"grafico_hist_actividades" => array(
				"tipo" => "grafico",
				"grafico" => "bar",
				"titulo" => "Reporte Histórico de Actividades",
				"query" => $consulta4,
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date",
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array(
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro4" => array(
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select area as value,area as display from areas",
								"requerido" => false
						),
				)
		),
		"novedades" => array(
				"tipo" => "tabla",
				"titulo" => "Reporte de Novedades",
				"query" => $consulta5,
				"columnas" => array(
						"fecha" => "Fecha",
						"tipo" => "Tipo de Novedad",
						"proyecto" => "Código de Proyecto",
						"descripcion" => "Descripción",
				),
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date",
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						"filtro3" => array(
								"nombre" => "Código de Proyecto",
								"tipo" => "text",
								"requerido" => false
						),
						"filtro4" => array(
								"nombre" => "Tipo de Novedad",
								"tipo" => "select",
								"query_select" => "select distinct tipo as value, tipo as display from new_novedades",
								"requerido" => false
						)
				)
		),
		
		"mensuales" => array(
				"tipo" => "tabla",
				"titulo" => "Reporte Mensual",
				"query" => $consulta6,
				"columnas" => array(
						"fecha_inicio" => "Fecha inicio",
						"actividad" => "Actividad",
						"plataforma" => "Plataforma",
						"categoria" => "Categoria",
						"tiempoReal" => "Tiempo Real",
						"correo" =>  "Correo",
						"Contrato" => "Contrato",
						"area" => "Area",
						
				),
				"filtros" => array(
						"filtro1" => array(
								"nombre" => "Fecha Inicio",
								"tipo" => "date",
						),
						"filtro2" => array(
								"nombre" => "Fecha Fin",
								"tipo" => "date"
						),
						
						"filtro3" => array(
								"nombre" => "Area",
								"tipo" => "select",
								"query_select" => "select id as value,area as display from areas",
								"requerido" => false
						),
						"filtro4" => array(
								"nombre" => "Correo",
								"tipo" => "text",
								"requerido" => false
						),
				)
		)
		
		
		
);
