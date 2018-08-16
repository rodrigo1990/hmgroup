<?php
	$id = $_GET['elemento'];
	$baja = "Delete from marcas_home where id=$id";
	include ("../conexion.php");
	echo mysql_query($baja);
?>