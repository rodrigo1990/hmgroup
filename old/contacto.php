<?php
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$consulta = $_POST['consulta'];
$redirect  = "gracias.html";

$para = "info@hmgroup.com.ar";
$asunto = "Formulario de Contacto Web";



//

$meses = array (null, "Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$dias = array ("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$nombreMes = $meses[date("n")];
$nombreDia =  $dias[date("w")];
$fecha = getdate(time());
$fecha = $nombreDia ." ".date("j")." de ".$nombreMes." de ".date("Y");

//

$de ="$nombre $apellido<$email> ";
$cabeza = "MIME-Versión: 1.0\r\n"; 
$cabeza  = "From:$de\r\n";
$cabeza .= "Reply-To:$from\r\n";
$cabeza .= "Content-type: text/html; charset=iso-8859-1\r\n";
$cabeza .= "Cc: consultas@hmgroup.com.ar\r\n";

//

//
//estilos

$estilo1='.titulo{ font-family:MS Sans Serif;font-size: 11px;color:#800001;font-weight:bold;}'; 
$estilo2='.contenido{font-family:MS Sans Serif;color:#000000;font-size: 11px;}'; 
$empezar_est_1='<span class="titulo">'; 
$empezar_est_2='<span class="contenido">'; 
$terminar_est='</span> '; 

//cabezera

$imagen_coorporativa='<img src="http://www.hmgroup.com.ar/img/loguito.jpg" align="top">';


//armamos la cabezara

$cuerpo = 
'<p align="left"><span class="titulo">'.
$imagen_coorporativa.$titulo_correo.
'</span></p><hr align="left" width="400"><p><meta http-equiv="Content-Type" content="text/html"; charset=iso-8859-1"><style type="text/css">';

// definimos los estilos

$cuerpo.=$estilo1.$estilo2; 

//armamos el cuerpo

$cuerpo.='</style></head><body><p>'.

$empezar_est_1.'La siguiente consulta fue escrita por:'.$terminar_est. 
$empezar_est_2.$nombre." ".$apellido .$terminar_est
.'<p>'.

$empezar_est_1.'Correo Electrónico:'.$terminar_est. 
$empezar_est_2.$email.$terminar_est
.'<p>'.


$empezar_est_1.'Telèfono:'.$terminar_est. 
$empezar_est_2.$telefono.$terminar_est
.'<p>'.

$empezar_est_1.'Fax:'.$terminar_est. 
$empezar_est_2.$fax.$terminar_est
.'<p>'.

$empezar_est_1.'Consulta:'.$terminar_est. 
$empezar_est_2.$consulta.$terminar_est
.'<p>';
//echo "$cuerpo";

$cabeza=trim($cabeza);
mail($para,$asunto,$cuerpo,$cabeza) or die("error=Error al enviar el mensaje");
header ("Location: $redirect");
?>