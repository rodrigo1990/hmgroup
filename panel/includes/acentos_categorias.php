<?php
	$titulo = utf8_encode($fila['titulo']);
        $titulo = html_entity_decode($titulo);
        $titulo = str_replace("Ã¡", "á",$titulo);
        $titulo = str_replace("Ã©", "é",$titulo);
        $titulo = str_replace("Ã*", "í",$titulo);
        $titulo = str_replace("Ã³", "ó",$titulo);
        $titulo = str_replace("Ãº", "ú",$titulo);
        $titulo = str_replace("Ã", "Á",$titulo);
        $titulo = str_replace("Ã‰", "É",$titulo);
        $titulo = str_replace("Ã", "Í",$titulo);
        $titulo = str_replace("Ã“", "Ó",$titulo);
        $titulo = str_replace("Ãš", "Ú",$titulo);
        $titulo = str_replace("Ã±", "ñ",$titulo);
        $titulo = str_replace("Ã‘", "Ñ",$titulo);
        $titulo = str_replace("Â¿", "¿",$titulo);
        $titulo = str_replace("Â«", "'",$titulo);
        $titulo = str_replace("Â»", "'",$titulo);
        $titulo = str_replace("Â¡", "¡",$titulo);
?>