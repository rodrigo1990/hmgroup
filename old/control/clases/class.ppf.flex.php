<?php

class PFlex {
	
	/**
	 * Estático: A partir de un vector o de una matriz, efectúa la traducción a un
	 * archivo xml, y agrega los errores y mensajes pertinentes
	 *
	 * @param array $array
	 * @param boolean $retornar
	 * @return string
	 */
	var $GET;
	var $POST;
	var $FILES;
	
	
	function listaToXML($array=array(),$retornar=false,$MSG=false,$ERROR=false,$ERRORS=array()){
		
		$esMultiple=false;
		$cadena='';
		$string=array();
		
		$string[]='<?xml version="1.0" encoding="utf-8"?>';
		$string[]='<contenido>';
		$string[]='<mensaje>';
		if($MSG){
			$string[]=PFlex::CDATA($MSG);
		}
		$string[]='</mensaje>';
		$string[]='<errores>';
		if($ERROR){
			foreach($ERRORS as $error){
				$string[]=PFlex::CDATA($error);
			}
		}
		$string[]='</errores>';
		
		$cant=0;
		foreach($array as $ind => $item){
			if(is_array($item)){
				$cant+=1;	
			}
		}
		
		if($cant=count($array)){
			$string[]=PFlex::getContenidoXML($array,'data');
		}
		else{
			$string[]='<data rows="'.count($array).'">';
			$string[]=PFlex::getContenidoXML($array,'item');
			$string[]='</data>';
		}
			
		$string[]='</contenido>';
		
		$stringFinal=implode("\n",$string);
		if($retornar){
			return $stringFinal;
		}
		echo $stringFinal;
	}
	
	function getContenidoXML($array,$nombre){
		$string=array();
		$arrays=array();
		$cadena='';
		foreach($array as $variable => $valor){
			if(is_array($valor)){
				$arrays[$variable]=$valor;
			}
			else{
				$cadena.=$variable.'="'.$valor.'" ';
			}
		}
		$string[]='<'.$nombre.' '.$cadena.'rows="'.count($arrays).'">';
		foreach($arrays as $variable => $item){
			if(is_integer($variable)){
				$variable='item';
			}
			$string[]=PFlex::getContenidoXML($item,$variable);
		}
		$string[]='</'.$nombre.'>';
		return implode("\n",$string);
	}
	
	/**
	 * Privado: encierra una cadena en caracteres CDATA para evitar conflictos con la nomenclatura XML
	 *
	 * @param string $string
	 * @return string
	 */
	function CDATA($string){
		return '<![CDATA['.$string.']]>';
	}
	
	
	function debugFlex($filename='debug.std.txt',$GET,$POST,$FILES){
		$this->GET=$GET;
		$this->POST=$POST;
		$this->FILES=$FILES;
		
		$string=array();
		$string[]='RAW DATA:';
		$string[]='GET DATA:';
		foreach($_GET as $var => $val){
			$string[]=$var.':'.$val;
		}
		$string[]='POST DATA:';
		foreach($_POST as $var => $val){
			$string[]=$var.':'.$val;
		}
		$string[]='FILE DATA:';
		foreach($_FILES as $var => $array){
			$string[]=$var.':';
			foreach($array as $var2 => $val2){
				$string[]=$var2.':'.$val2;
			}
		}
		$string[]='-------------------------';
		$string[]='PPF DATA:';
		$string[]='GET DATA:';
		foreach($this->GET as $var => $val){
			$string[]=$var.':'.$val;
		}
		$string[]='POST DATA:';
		foreach($this->POST as $var => $val){
			$string[]=$var.':'.$val;
		}
		$string[]='FILE DATA:';
		foreach($this->FILES as $var => $array){
			$string[]=$var.':';
			foreach($array as $var2 => $val2){
				$string[]=$var2.':'.$val2;
			}
		}
		$contenido=implode("\n",$string);
		$fp=fopen(PF::getPath(FLEX_DEBUG_PATH.'/'.$filename),'w');
		fwrite($fp,$contenido);
		fclose($fp);
	}
	
	function buildFlexSimulator($filename='simulator.std.html',$GET,$POST,$FILES){
		$this->GET=$GET;
		$this->POST=$POST;
		$this->FILES=$FILES;
		
		$string[]='<html><head><title>Simulator</title>';
		$string[]='<script type="text/javascript">';
		$string[]='function enviar(){';
		$string[]='var destino=document.getElementById(\'destino\').value;';
		$string[]='var form=document.getElementById(\'formEnvio\');';
		$string[]='form.action = destino;';
		$string[]='form.submit();';
		$string[]='}';
		$string[]='</script>';
		$string[]='</head>';
		$string[]='<body>';
		$url=basename($_SERVER['PHP_SELF']);
		if(count($this->GET)>0 && count($this->POST)==0){
			$string[]='GET DATA:';
			$string[]='DESTINO:<input type="text" name="" id="destino" value="'.$url.'"><br>';
			$string[]='<form method="get" id="formEnvio" action="" >';
			foreach($this->GET as $var => $val){
				$string[]=$var.':<br><input type="text" name="'.$var.'" value="'.$val.'"><br>';
			}
			
		}
		else{
			$string[]='POST DATA:';
			
			$get=array();
			if(count($this->GET)>0){
				foreach($this->GET as $var => $val){
					$get[]=$var.'='.urlencode($val);
				}
				$url.'?'.implode('&',$get);
			}
			
			$string[]='DESTINO:<input type="text" name="" id="destino" value="'.$url.'"><br>';
			$string[]='<form method="post" id="formEnvio" action="" enctype="multipart/form-data">';
						foreach($this->POST as $var => $val){
				$string[]=$var.':<br><input type="text" name="'.$var.'" value="'.$val.'"><br>';
			}
			foreach($this->FILES as $var => $array){
				$string[]=$var.':<br><input type="file" name="'.$var.'"><br>';
			}
			
		}
		$string[]='<input type="button" name="button" id="button" value="Enviar" onclick="enviar();" /><br>';
		$string[]='</form>';
		$string[]='</body></html>';
				
		$contenido=implode("\n",$string);
		$fp=fopen(PF::getPath(FLEX_DEBUG_PATH.'/'.$filename),'w');
		fwrite($fp,$contenido);
		fclose($fp);
	}
	
	/*
	function moveFlexUpload($fileName,$newPath,$pref='FLEX'){
		if(trim($fileName)==''){
			$return='';
		}
		$fileName=basename($fileName);
		
		if(is_file(PF::getPath(FLEX_UPLOAD_PATH.'/'.$fileName))){
			$newFilename=uniqid($pref).'.'.PF::extension($fileName);
			if(copy(PF::getPath(FLEX_UPLOAD_PATH.'/'.$fileName),PF::getPath($newPath.'/'.$newFilename))){
				//echo PF::getPath($newPath.'/'.$newFilename);
				$return=$newFilename;
			}
			else{
				$return=false; 
			}
		}
		else{
			$return=false;
		}
		PF::cleanFlexUploads();
		return $return;
	}
	*/
	
	function translateFlexUpload($fileName){
		$ruta=PF::getPath(FLEX_UPLOAD_PATH.'/'.$fileName);
		if(!is_file($ruta)){
			return array('name'=>'','tmp_name'=>'','size'=>'');
		}
		
		
		if(rand(0,10)==5){
			$this->cleanFlexUploads();
		}
		return array('name'=>$fileName,'tmp_name'=>realpath(PF::getPath(FLEX_UPLOAD_PATH.'/'.$fileName)),'size'=>filesize($ruta));
	}
	
	function cleanFlexUploads(){
		$dir=PF::getPath(FLEX_UPLOAD_PATH);
		$limitTime=time()-600;
		$dp=opendir($dir);
		while($file=readdir($dp)){
			//echo filemtime(PF::getPath(FLEX_UPLOAD_PATH.'/'.$file)).':limite:'.$limitTime.'<br>';
			if(is_file(PF::getPath(FLEX_UPLOAD_PATH.'/'.$file)) && filemtime(PF::getPath(FLEX_UPLOAD_PATH.'/'.$file))<$limitTime){
				//echo 'eliminado<br>';
				PF::deleteFile(PF::getPath(FLEX_UPLOAD_PATH.'/'.$file));
			}
		}
	}
	
}
?>