<?php
$server="localhost";
$usuariodb="root";
$clave_db="";
$base="hmgroup_bd";

$id_con=mysql_connect($server, $usuariodb, $clave_db);
mysql_select_db($base, $id_con);

$mysqli=new mysqli($server,$usuariodb,$clave_db, $base);




?>