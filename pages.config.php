<?php

$_PAGE_PERMISSIONS = array(
	"1" => array(
		"006" => false,
		"017" => false,
		"018" => false,
		"012" => false,
		"014" => false,
		"013" => false,
		"015" => false,
		"016" => false,
		"023" => false,
		"024" => false,
	),
	"2" => array(
		"011" => false,
		"010" => false,
		"017" => false,
		"018" => false,
		"012" => false,
		"013" => false,
		"015" => false,
		"016" => false,
		"001" => false,
		"003" => false,
		"008" => false,
		"002" => false,
		"023" => false,
		"024" => false,
	),
	"3" => array(
			"006" => false,
			"017" => false,
			"018" => false,
			"009" => false,
			"011" => false,
			"010" => false,
			"012" => false,
			"013" => false,
			"014" => false,
			"015" => false,
			"016" => false,
			"023" => false,
			"024" => false,
	),
	"4" => array(
		
	),
	"5" => array(
			"017" => false,
			"018" => false,
			"012" => false,
			"013" => false,
			"015" => false,
			"016" => false,
			"023" => false,
			"024" => false,
			
	),
);

// Pagina Actual : 024

$_PAGE_CONFIG = array(
		//000 siempre es la home
		"000" => array(
			"show" => true,
			"isSubmenu" => false,
			"big" => "GTI",
			"small" => "Tablero de control",
			"menu" => "Tablero de control",
			"menu_css_class" => "fa-dashboard",
			"link" => 'pages/tablero/body.php'
		),
		
		"009" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-clock-o",
				"small" => "Bitacora de Operación",
				"menu" => "Bitacora de operación",
				"submenu" => array(
						"2" => "006",
						"3" => "010",
						"4" => "011",
						"5" => "014"
				)
		),
				"006" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Bitacora de operación",
						"small" => "Actividades del mes",
						"menu" => "Actividades del mes",
						"link" => 'pages/bitacora_operacion/actividades_mes/body.php',
						"menu_css_class" => "fa-list"
				),
				"010" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Bitacora de operación",
						"small" => "Pendientes aprobacion",
						"menu" => "Pendientes aprobacion",
						"link" => 'pages/bitacora_operacion/actividades_pendientes/body.php',
						"menu_css_class" => "fa-edit"
				),
				"011" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Bitacora de operación",
						"small" => "Asignacion de contratos",
						"menu" => "Asignacion de contratos",
						"link" => 'pages/bitacora_operacion/asignacion_contratos/body.php',
						"menu_css_class" => "fa-edit"
				),
				"014" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Bitacora de operación",
						"small" => "Registro de Ausentismo",
						"menu" => "Registro de Ausentismo",
						"link" => 'pages/bitacora_operacion/registro_ausentismo/body.php',
						"menu_css_class" => "fa-plane"
				),
		"012" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-info",
				"small" => "Gestión de eventos",
				"menu" => "Gestión de eventos",
				"submenu" => array(
						"1" => "013",
						"2" => "023",
						"3" => "024",
				)
		),
				"013" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Gestión de eventos",
						"small" => "Nuevo evento",
						"menu" => "Nuevo evento",
						"link" => 'pages/gestion_eventos/nuevo_evento/body.php',
						"menu_css_class" => "fa-plus"
				),
		
				"023" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Gestión de eventos",
						"small" => "Servicio",
						"menu" => "Servicio",
						"link" => 'pages/gestion_eventos/nuevo_evento/servicio.php',
						"menu_css_class" => "fa-plus"
				),
				
				"024" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Gestión de eventos",
						"small" => "Nuevo Contacto",
						"menu" => "Nuevo Contacto",
						"link" => 'pages/gestion_eventos/nuevo_contacto/body.php',
						"menu_css_class" => "fa-plus"
				),
		
		
		"015" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-database",
				"small" => "Gestión de configuración",
				"menu" => "Gestión de configuración",
				"submenu" => array(
						"1" => "016",
				)
		),
				"016" => array(
						"show" => true,
						"isSubmenu" => true,
						"big" => "Gestión de configuracion",
						"small" => "Editar CIs",
						"menu" => "Editar CIs",
						"link" => 'pages/gestion_configuracion/editar_cis/body.php',
						"menu_css_class" => "fa-pencil-square-o"
				),
		"017" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-cogs",
				"small" => "Administracón",
				"menu" => "Administracón",
				"submenu" => array(
						"1" => "018",
				)
		),
			"018" => array(
					"show" => true,
					"isSubmenu" => true,
					"big" => "Administracónn",
					"small" => "Actualizar Usuarios",
					"menu" => "Actualizar Usuarios",
					"link" => 'pages/administracion/actualizar_usuarios/body.php',
					"menu_css_class" => "fa-user-plus"
			),
		"007" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Cambiar contraseña",
				"menu" => "Cambiar contraseña",
				"link" => 'pages/cambiar_contrasena/body.php',
				"menu_css_class" => "fa-key"
		),
		"001" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-line-chart",
				"small" => "Reportes",
				"menu" => "Reportes",
				"submenu" => array(
						"page1" => "003",
						"page2" => "008",
						"page3" => "019",
						"page4" => "020",
						"page5" => "021",
						"page5" => "022"
				)
		),
		"003" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Contratos",
				"menu" => "Contratos",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/contratos/body.php"
		),
		"008" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Productividad",
				"menu" => "Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/productividad/body.php"
		),
		
		"019" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Grafico Productividad",
				"menu" => "Grafico Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_productividad/body.php"
		),
		"020" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Grafico Productividad Personas",
				"menu" => "Grafico Prod. Personas",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_productividad_personas/body.php"
		),
		"021" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Historico de actividades diarias",
				"menu" => "Grafico Hist. Act.",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/grafico_histo_actividades/body.php"
		),
		"022" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Reporte de novedades",
				"menu" => "Reporte de novedades",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/novedades/body.php"
		),
		"002" => array(
			"show" => true,
			"isSubmenu" => false, 
			"big" => "GTI",
			"small" => "Sugerencias",
			"menu" => "Sugerencias",
			"menu_css_class" => "fa-envelope",
			"link" => 'pages/sugerencias/body.php'
		),
		"004" => array(
				"show" => false,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Registro actividad",
				"link" => 'pages/bitacora_operacion/registro/body.php'
		),
		"500" => array(
				"show" => false,
				"link" => 'pages/error/500.php'
		),
		"404" => array(
				"show" => false,
				"link" => 'pages/error/404.php'
		)
		
);
