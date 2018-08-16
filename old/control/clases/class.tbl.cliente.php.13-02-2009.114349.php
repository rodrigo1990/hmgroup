<?php
class ClienteManager Extends Usuario {
	
	function Cliente($oDBM){
		$this->oDBM=$oDBM;
		parent::Usuario($this->oDBM);
	}
	
	
	
	function nuevoCliente($arrayData){
		
		$arrayData['provincia']='';
		$arrayData['pais']='';
		$arrayData['cp']='';
		$arrayData['empresa']='';
		$arrayData['cargo']='';
		$arrayData['ciudad']='';
		$arrayData['direccion']='';
		$arrayData['id_tipo']=3;
		//$arrayData['id_estado']=1;
		//$arrayData['email']='';
		
		$oPerfil=new Perfil($this->oDBM);
		
		//seteo del id_perfil corresp. 
		$arrayPerfil=array(0=>2);
						
		$oDBV=new PFDBValidator($this->oDBM,'control_usuario');
		$oDBV->codigo='prop:i';
		$oDBV->arrayData=$arrayData;
		$b=$oDBV->validarVector();
		if(!$b){
			$this->ERROR=true;
			$this->ERRORS=$oDBV->arrayErrores;
			$this->nuevo();
			return;
		}
		
		
		return parent::nuevoUsuario($arrayData,$arrayPerfil);
		
	}
	
	function actualizarCliente($arrayData){
		// Datos que no se utilizan por ahora
		$arrayData['provincia']='';
		$arrayData['pais']='';
		$arrayData['cp']='';
		$arrayData['empresa']='';
		$arrayData['cargo']='';
		$arrayData['ciudad']='';
		$arrayData['direccion']='';
		//$arrayData['email']='';
		
		return parent::actualizarUsuario($arrayData);

	}
	
	function getClientes(){
		$arrayData=$this->listarUsuariosTipo('Cliente');
		return $arrayData;
	}
	
	function cambiarPass($idCli,$pass,$user){
		$data=$this->getRow($idCli);
		if(count($data)==0){
			return false;
		}
		$data['user_pass']=$pass;
		$data['user_name']=$user;
		$this->actualizarCliente($data);
	}
}
?>