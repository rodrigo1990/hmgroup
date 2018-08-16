<?php

$host=strtolower(${"HTTP_HOST"});
$nueva_url = str_replace("www.", "webmail.", $host);
header("Location: http://".$nueva_url);
//
exit;

//$vocales = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
//$solo_consonantes = str_replace("www.", "webmail.", $host);
?>