<?php
include("conexion.php");
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
	
	if($_POST['submit'])
	{
		$usu_login = $_POST['username'];
		$usu_clave = md5($_POST['password']);

		$stmt=$mysqli->prepare("SELECT usu_clave
									  FROM usuarios
									  WHERE usu_login=(?) AND usu_clave=(?)");

		$stmt->bind_param("ss",$usu_login,$usu_clave);

		$stmt->execute();

		$resultado=$stmt->get_result();

		$fila=$resultado->fetch_assoc();

		if($fila["usu_clave"]==$usu_clave){
			session_start();
			$_SESSION[login] = "ok";
			$stmt->close();
			header("location:index.php");
		}else{
			$error=1;
		}
	}
	?>

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="70" alt="" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> INGRESAR</h2>
					</div>
					<div class="panel-body">
						<form id="form" action="login.php" method="post">
							<div class="form-group mb-lg">
								<label>Usuario:</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Contraseña:</label>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									
								</div>
								<div class="col-sm-4 text-right">
									<input type="submit" name="submit" class="btn btn-primary hidden-xs" value="Ingresar" />
									<!--  <button
									class="g-recaptcha btn btn-primary hidden-xs"
									data-sitekey="6LeagmoUAAAAANgPbe8bVsI0Myf-D88ToK_dEvFi"
									data-callback="onSubmit">
									Ingresar
									</button>-->

								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2015. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->
		


		<script>
	       function onSubmit(token) {
	         document.getElementById("form").submit();
	       }
     	</script>
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
	</body>
</html>