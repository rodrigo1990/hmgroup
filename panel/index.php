<?php
    error_reporting(0);

	$_POST = evita_sqlinjection($_POST);
	$_GET = evita_sqlinjection($_GET);
	$_REQUEST = evita_sqlinjection($_REQUEST);
	$_SERVER = evita_sqlinjection($_SERVER);
	$_COOKIE = evita_sqlinjection($_COOKIE);

	function evita_sqlinjection($var)
	{
		if (!is_array($var))
		return addslashes($var);

		$new_var = array();
		foreach ($var as $k => $v)
		$new_var[addslashes($k)] = evita_sqlinjection($v);

		return $new_var;
	}
	$error2=$_GET[error2];
	
	include("validacion.php");
	
	$__SECCIONES = array(
        "home"                          => "Inicio",

        "home_contenido"            	=> "Home",
        "home_bloques_inferiores"       => "Home - Bloques Inferiores",
        "home_bloque"            		=> "Bloque fondo madera",
        "slider_agregar"            	=> "Slider - Agregar",
        "slider_seleccionar"        	=> "Slider - Seleccionar",
        "slider_editar"        			=> "Slider - Editar",

        // MARCAS
        "marcas_home_agregar"            	=> "Marcas - Agregar",
        "marcas_home_seleccionar"        	=> "Marcas - Seleccionar",
        "marcas_home_editar"        		=> "Marcas - Editar",

        // PRODUCTOS
        "productos_agregar"            	=> "Productos - Agregar",
        "productos_seleccionar"        	=> "Productos - Seleccionar",
        "productos_editar"        		=> "Productos - Editar",
        "productos_descuentos"        	=> "Productos - Descuento en total compra",

        // MARCAS
        "marcas_agregar"            	=> "Marcas - Agregar",
        "marcas_seleccionar"        	=> "Marcas - Seleccionar",
        "marcas_editar"        			=> "Marcas - Editar",

        // CATEGORIAS
        "categorias_agregar"            => "Categorías - Agregar",
        "categorias_seleccionar"        => "Categorías - Seleccionar",
        "categorias_editar"        		=> "Categorías - Editar",

        // SUBCATEGORIAS
        "subcategorias_agregar"         => "Subcategorías - Agregar",
        "subcategorias_seleccionar"     => "Subcategorías - Seleccionar",
        "subcategorias_editar"        	=> "Subcategorías - Editar",

        // SUSCRIPCIONES
        "suscripciones_contenido"    	=> "Suscripciones - Editar Contenido",
        "suscripciones_agregar"         => "Suscripciones - Agregar",
        "suscripciones_seleccionar"     => "Suscripciones - Seleccionar",
        "suscripciones_editar"        	=> "Suscripciones - Editar",

        "pedidos"    		=> "Pedidos",
        "pedidos_editar"    => "Pedidos Editar",

        // LISTADOS
        "listados_contenido"   		=> "Listados - Editar Contenido",

        // CLIENTES
        "cliente_agregar"            => "Cliente - Agregar",
        "cliente_seleccionar"        => "Cliente - Seleccionar",
        "cliente_editar"        	 => "Cliente - Editar",

        // CONTACTO
        "contacto_contenido"    		=> "Contacto - Editar Contenido",
        "redes_sociales"    			=> "Redes sociales",
	);

	if(!$__SECCIONES[$_GET['s']])
	{
		$__SEC = "home";
	}
	else
	{
		$__SEC = $_GET['s'];
	}

	include("conexion.php");
?>

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Panel de Administración</title>
		<meta name="keywords" content="Admin" />
		<meta name="description" content="">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<script src="assets/javascripts/jquery-1.11.0.min.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="?s=home" class="logo">
						<img src="assets/images/logo_admin.png" height="50" alt="" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<div class="profile-info" data-lock-name="HMG" data-lock-email="">
								<span class="name">HMG</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="secciones/salir.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Menú
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-parent <?php if(($__SEC == "marcas_home_agregar") ||($__SEC == "marcas_home_seleccionar") ||($__SEC == "home_bloques_inferiores") || ($__SEC == "home_contenido") || ($__SEC == "home_bloque") || ($__SEC == "slider_agregar") || ($__SEC == "slider_seleccionar") || ($__SEC == "sliders_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Home</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "slider_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=slider_agregar">Agregar Slider</a>
											</li>
											<li <?php if(($__SEC == "slider_seleccionar") || ($__SEC == "sliders_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=slider_seleccionar">Editar/Eliminar Slider</a>
											</li>
											<li <?php if($__SEC == "home_contenido") { ?> class="nav-active" <?php } ?>>
												<a href="?s=home_contenido">Novedades y Promociones</a>
											</li>
											<li <?php if($__SEC == "home_bloques_inferiores") { ?> class="nav-active" <?php } ?>>
												<a href="?s=home_bloques_inferiores">Bloques Inferiores</a>
											</li>
											<li <?php if($__SEC == "marcas_home_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=marcas_home_agregar">Agregar Marca</a>
											</li>
											<li <?php if(($__SEC == "marcas_home_seleccionar") || ($__SEC == "marcas_home_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=marcas_home_seleccionar">Editar/Eliminar Marca</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if(($__SEC == "categorias_agregar") || ($__SEC == "categorias_seleccionar") || ($__SEC == "categorias_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-list" aria-hidden="true"></i>
											<span>Categorías</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "categorias_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=categorias_agregar">Agregar Categoría</a>
											</li>
											<li <?php if(($__SEC == "categorias_seleccionar") || ($__SEC == "categorias_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=categorias_seleccionar">Editar/Eliminar Categoría</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if(($__SEC == "subcategorias_agregar") || ($__SEC == "subcategorias_seleccionar") || ($__SEC == "subcategorias_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-list" aria-hidden="true"></i>
											<span>Subcategorías</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "subcategorias_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=subcategorias_agregar">Agregar Subcategoría</a>
											</li>
											<li <?php if(($__SEC == "subcategorias_seleccionar") || ($__SEC == "subcategorias_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=subcategorias_seleccionar">Editar/Eliminar Subcategoría</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if(($__SEC == "productos_descuentos") ||($__SEC == "productos_agregar") || ($__SEC == "productos_seleccionar") || ($__SEC == "productos_editar") || ($__SEC == "productos_agregar_fotos") || ($__SEC == "productos_eliminar_fotos") || ($__SEC == "flores_de_corte") || ($__SEC == "flores_agregar_fotos") || ($__SEC == "flores_seleccionar_fotos") || ($__SEC == "flores_editar_fotos") || ($__SEC == "plantas_vivas") || ($__SEC == "plantas_agregar_fotos") || ($__SEC == "plantas_seleccionar_fotos") || ($__SEC == "plantas_editar_fotos") || ($__SEC == "plantas_vivas_agregar") || ($__SEC == "plantas_vivas_seleccionar") || ($__SEC == "plantas_vivas_editar") || ($__SEC == "flores_de_corte_agregar") || ($__SEC == "flores_de_corte_seleccionar") || ($__SEC == "flores_de_corte_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Productos</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "productos_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=productos_agregar">Agregar Producto</a>
											</li>
											<li <?php if(($__SEC == "productos_seleccionar") || ($__SEC == "productos_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=productos_seleccionar">Editar/Eliminar Producto</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if(($__SEC == "marcas_agregar") || ($__SEC == "marcas_seleccionar") || ($__SEC == "marcas_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-thumb-tack" aria-hidden="true"></i>
											<span>Marcas</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "marcas_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=marcas_agregar">Agregar Marca</a>
											</li>
											<li <?php if(($__SEC == "marcas_seleccionar") || ($__SEC == "marcas_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=marcas_seleccionar">Editar/Eliminar Marca</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if($__SEC == "listados_contenido")  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-file-text-o" aria-hidden="true"></i>
											<span>Precios y Catálogo</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "listados_contenido") { ?> class="nav-active" <?php } ?>>
												<a href="?s=listados_contenido">Editar Contenido</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent <?php if(($__SEC == "cliente_agregar") || ($__SEC == "cliente_seleccionar") || ($__SEC == "cliente_editar"))  { ?> nav-expanded nav-active <?php } ?>">
										<a>
											<i class="fa fa-check" aria-hidden="true"></i>
											<span>Clientes</span>
										</a>
										<ul class="nav nav-children">
											<li <?php if($__SEC == "cliente_agregar") { ?> class="nav-active" <?php } ?>>
												<a href="?s=cliente_agregar">Agregar Cliente</a>
											</li>
											<li <?php if(($__SEC == "cliente_seleccionar") || ($__SEC == "cliente_editar")) { ?> class="nav-active" <?php } ?>>
												<a href="?s=cliente_seleccionar">Editar/Eliminar Cliente</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<?php @require_once("secciones/$__SEC.php"); ?>
			</div>

			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="assets/vendor/raphael/raphael.js"></script>
		<script src="assets/vendor/morris/morris.js"></script>
		<script src="assets/vendor/gauge/gauge.js"></script>
		<script src="assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
		
	</body>
</html>