<?php
class PFParam{
	
	var $listaParamsPOST;
	var $listaParamsGET;
	
	
	function PFParam(){
		$this->listaParamsPOST=array();
		$this->listaParamsGET=array();
		
	}
	
	function addPOST($param,$type){
		$this->listaParamsPOST[$param]=$type;
	}
	
	function addGET($param,$type){
		$this->listaParamsGET[$param]=$type;
	}
	
	function checkPOST(&$vector){
		foreach($vector as $ind => $val){
			if(!array_key_exists($ind,$this->listaParamsPOST)){
				$vector[$ind]=null;
				unset($vector[$ind]);
			}
			else{
				settype($vector[$ind],$this->listaParamsPOST[$ind]);
			}
		}
		foreach($this->listaParamsPOST as $variable => $tipo){
			if(!isset($vector[$variable])){
				switch($tipo){
					case 'integer':
						$vector[$variable]=0;
					break;
					case 'double':
						$vector[$variable]=0.0;
					break;
					case 'string':
						$vector[$variable]='';
					break;
				}
			}
		}
	}
	
	function checkGET(&$vector){
		foreach($vector as $ind => $val){
			if(!array_key_exists($ind,$this->listaParamsGET)){
				$vector[$ind]=null;
				unset($vector[$ind]);
			}
			else{
				settype($vector[$ind],$this->listaParamsGET[$ind]);
			}
		}
		foreach($this->listaParamsGET as $variable => $tipo){
			if(!isset($vector[$variable])){
				switch($tipo){
					case 'integer':
						$vector[$variable]=0;
					break;
					case 'double':
						$vector[$variable]=0.0;
					break;
					case 'string':
						$vector[$variable]='';
					break;
				}
			}
		}
	}
	
	
}
?>