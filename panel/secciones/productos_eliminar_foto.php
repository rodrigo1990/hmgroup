<?php
	$id = $_GET['elemento'];
	$baja = "Delete from productos_fotos where id=$id";
	include ("../conexion.php");
	echo mysql_query($baja);
?>