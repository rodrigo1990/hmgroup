<?php
error_reporting(0);

$mindex="";
$mempresa="";
$mproductos="";
$mmarcas="";
$mcontacto="";
$mcomollegar="";
$menurl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($menurl,'inicio') !== false) {
    $mindex="style='color: #F9A350 !important;'";
}
else if (strpos($menurl,'empresa') !== false) {
	$mempresa="style='color: #F9A350 !important;'";
}
else if (strpos($menurl,'productos') !== false) {
	$mproductos="style='color: #F9A350 !important;'";
}
else if (strpos($menurl,'marcas') !== false) {
	$mmarcas="style='color: #F9A350 !important;'";
}
else if (strpos($menurl,'contacto') !== false) {
	$mcontacto="style='color: #F9A350 !important;'";
}
else if (strpos($menurl,'llegar') !== false) {
	$mcomollegar="style='color: #F9A350 !important;'";
}
else
{
	$mindex="style='color: #F9A350 !important;'";
}

include('panel/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>HMG</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
<link href="css/custom.css" rel="stylesheet">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>