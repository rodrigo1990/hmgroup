<?php
	$id = $_GET['elemento'];
	$baja = "Delete from slider_home where id=$id";
	include ("../conexion.php");
	echo mysql_query($baja);
?>