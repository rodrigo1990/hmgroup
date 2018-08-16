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
		
		$descripcion = utf8_encode($fila['descripcion']);
        $descripcion = html_entity_decode($descripcion);
        $descripcion = str_replace("Ã¡", "á",$descripcion);
        $descripcion = str_replace("Ã©", "é",$descripcion);
        $descripcion = str_replace("Ã*", "í",$descripcion);
        $descripcion = str_replace("Ã³", "ó",$descripcion);
        $descripcion = str_replace("Ãº", "ú",$descripcion);
        $descripcion = str_replace("Ã", "Á",$descripcion);
        $descripcion = str_replace("Ã‰", "É",$descripcion);
        $descripcion = str_replace("Ã", "Í",$descripcion);
        $descripcion = str_replace("Ã“", "Ó",$descripcion);
        $descripcion = str_replace("Ãš", "Ú",$descripcion);
        $descripcion = str_replace("Ã±", "ñ",$descripcion);
        $descripcion = str_replace("Ã‘", "Ñ",$descripcion);
        $descripcion = str_replace("Â¿", "¿",$descripcion);
        $descripcion = str_replace("Â«", "'",$descripcion);
        $descripcion = str_replace("Â»", "'",$descripcion);
        $descripcion = str_replace("Â¡", "¡",$descripcion); 
		
?>