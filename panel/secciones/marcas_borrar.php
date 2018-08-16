<?php
	$id = $_GET['elemento'];
	$baja = "Delete from marcas where id=$id";
	include ("../conexion.php");
	echo mysql_query($baja);
?>