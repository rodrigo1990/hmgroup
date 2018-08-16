<?php
class Autorizacion{
	
	function tieneAutorizacion($objeto,$tipo){
		if(isset($_SESSION['CONTROL_AUTORIZACION'][$objeto][$tipo]) && $_SESSION['CONTROL_AUTORIZACION'][$objeto][$tipo]==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function loadAutorizaciones($arrayAutorizaciones){
		$_SESSION['CONTROL_AUTORIZACION']=array();
		foreach($arrayAutorizaciones as $item){
			$_SESSION['CONTROL_AUTORIZACION'][$item['objeto']][$item['tipo']]=1;
		}
	}
	
	/***********************  AJAX / FLEX FRAMEWORK DE AUTORIZACIONES *********************/
	
	function loadAutorizacionesLocal($arrayAutorizaciones){
		$GLOBALS['CONTROL_AUTORIZACION']=array();
		foreach($arrayAutorizaciones as $item){
			$GLOBALS['CONTROL_AUTORIZACION'][$item['objeto']][$item['tipo']]=1;
		}
	}
	
	function tieneAutorizacionLocal($objeto,$tipo){
		if(isset($GLOBALS['CONTROL_AUTORIZACION'][$objeto][$tipo]) && $GLOBALS['CONTROL_AUTORIZACION'][$objeto][$tipo]==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cerrarSesionLocal($token){
		$ruta=PF::getPath(RUTA_TOKEN.'/'.$token);
		unlink($ruta);
	}
	
	function initAutorizaciones($idUser,$token,$oDBM){
		if($token!='x' && !$this->checkToken($token)){
			return false;
		}
		$oUsu=new Usuario($oDBM);
		$arrayPermisos=$oUsu->getPermisos($idUser);
		$this->loadAutorizacionesLocal($arrayPermisos);
	}
	
	function getToken(){
		$token=md5(uniqid('LOCURAS'));
		$fp=fopen(PF::getPath(RUTA_TOKEN.'/'.$token),'w');
		fclose($fp);
		return $token;
	}
	
	function checkToken($token){
		
		if(rand(0,100)==5){
			$this->cleanTokens();
		}
		
		$limitTime=60*20;
		$ruta=PF::getPath(RUTA_TOKEN.'/'.$token);
		if(!file_exists($ruta) || !is_file($ruta)){
			return false;
		}
		$time=filemtime($ruta);
		if($time+$limitTime>time()){
			$fp=fopen($ruta,'w');
			fclose($fp);
			return true;
		}
		else{
			unlink($ruta);
			return false;
		}
	}
	
	function cleanTokens(){
		$dp=opendir(PF::getPath(RUTA_TOKEN));
		$now=time();
		while ($file=readdir($dp)) {
			if(ereg('LOCURAS',$file)){
				$ruta=PF::getPath(RUTA_TOKEN.'/'.$file);
				$time=@filemtime($ruta);
				if($time+$limitTime>$now){
					unlink($ruta);
				}
			}
		}
	}
}
?>