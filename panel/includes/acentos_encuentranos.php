<?php
	$titulo1 = utf8_encode($fila['titulo1']);
        $titulo1 = html_entity_decode($titulo1);
        $titulo1 = str_replace("Ã¡", "á",$titulo1);
        $titulo1 = str_replace("Ã©", "é",$titulo1);
        $titulo1 = str_replace("Ã*", "í",$titulo1);
        $titulo1 = str_replace("Ã³", "ó",$titulo1);
        $titulo1 = str_replace("Ãº", "ú",$titulo1);
        $titulo1 = str_replace("Ã", "Á",$titulo1);
        $titulo1 = str_replace("Ã‰", "É",$titulo1);
        $titulo1 = str_replace("Ã", "Í",$titulo1);
        $titulo1 = str_replace("Ã“", "Ó",$titulo1);
        $titulo1 = str_replace("Ãš", "Ú",$titulo1);
        $titulo1 = str_replace("Ã±", "ñ",$titulo1);
        $titulo1 = str_replace("Ã‘", "Ñ",$titulo1);
        $titulo1 = str_replace("Â¿", "¿",$titulo1);
        $titulo1 = str_replace("Â«", "'",$titulo1);
        $titulo1 = str_replace("Â»", "'",$titulo1);
        $titulo1 = str_replace("Â¡", "¡",$titulo1);
		
	$titulo2 = utf8_encode($fila['titulo2']);
        $titulo2 = html_entity_decode($titulo2);
        $titulo2 = str_replace("Ã¡", "á",$titulo2);
        $titulo2 = str_replace("Ã©", "é",$titulo2);
        $titulo2 = str_replace("Ã*", "í",$titulo2);
        $titulo2 = str_replace("Ã³", "ó",$titulo2);
        $titulo2 = str_replace("Ãº", "ú",$titulo2);
        $titulo2 = str_replace("Ã", "Á",$titulo2);
        $titulo2 = str_replace("Ã‰", "É",$titulo2);
        $titulo2 = str_replace("Ã", "Í",$titulo2);
        $titulo2 = str_replace("Ã“", "Ó",$titulo2);
        $titulo2 = str_replace("Ãš", "Ú",$titulo2);
        $titulo2 = str_replace("Ã±", "ñ",$titulo2);
        $titulo2 = str_replace("Ã‘", "Ñ",$titulo2);
        $titulo2 = str_replace("Â¿", "¿",$titulo2);
        $titulo2 = str_replace("Â«", "'",$titulo2);
        $titulo2 = str_replace("Â»", "'",$titulo2);
        $titulo2 = str_replace("Â¡", "¡",$titulo2);
?>