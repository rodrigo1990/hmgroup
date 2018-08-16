<?php
class ClienteManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Cliente
	 */
	function ClienteManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'cliente';
		$this->oDBM=$oDBM;
		$this->aErrors=array();
		parent::PFTableManager($this->oDBM,$this->tabla);
	}
	
	
	/**
	 * Publico: inserta los datos en una tabla
	 *
	 * @param array $arrayData
	 */
	function insert($arrayData){
		/*INSERT*/
/*INSERT INTO portal_cliente (id_usuario,folder) VALUES (NULL,'$arrayData[folder]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO portal_cliente (id_usuario,folder) VALUES (NULL,'$arrayData[folder]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_usuario){
		/*DELETE*/
/*DELETE FROM portal_cliente WHERE id_usuario=$id_usuario*/
		$sql="DELETE FROM portal_cliente WHERE id_usuario=$id_usuario";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: actualiza los registros de una tabla
	 *
	 * @param array $arrayData
	 */
	function update($arrayData){
		/*UPDATE*/
/*UPDATE portal_cliente SET folder='$arrayData[folder]' WHERE id_usuario=$arrayData[id_usuario]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE portal_cliente SET folder='$arrayData[folder]' WHERE id_usuario=$arrayData[id_usuario]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_usuario){
		/*GETROW*/
/*SELECT 
id_usuario, 
folder 
FROM portal_cliente 
WHERE id_usuario=$id_usuario */
		$sql="SELECT 
		t.id_usuario, 
		t.email, 
		t.user_pass, 
		t.user_name, 
		t.nombre, 
		t.apellido, 
		t.direccion, 
		t.ciudad, 
		t.provincia, 
		t.pais, 
		t.cp, 
		t.empresa, 
		t.cargo,
		t.id_tipo,
		t.id_estado,
		c.folder
		FROM control_usuario t 
		INNER JOIN portal_cliente c ON c.id_usuario=t.id_usuario
		WHERE id_tipo=3 AND t.id_usuario=$id_usuario";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_usuario, 
folder 
FROM portal_cliente */
		$sql="SELECT 
id_usuario, 
folder 
FROM portal_cliente ";
		return $this->toArray($sql);
	}
	
	/**
	 * Privado: Valida el ingreso de datos a una tabla
	 *
	 * @param array datos $arrayData
	 * @return bool
	 */
	function validate($arrayData,$codigo=false){
		$oDBV=new PFDBValidator($this->oDBM,$this->tabla);
		$oDBV->codigo=$codigo;
		$oDBV->arrayData=$arrayData;
		$b=$oDBV->validarVector();
		if($b){
			return true;
		}
		else{
			$this->aErrors=$oDBV->arrayErrores;
			return false;
		}
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
		
		
		$oPerfil=new Perfil($this->oDBM);
		
		//seteo del id_perfil corresp. 
		$arrayPerfil=array(0=>2);

		$oUsu=new Usuario($this->oDBM);
		$id=$oUsu->nuevoUsuario($arrayData,$arrayPerfil);
		if(!$id){
			$this->aErrors=$oUsu->aErrors;
			return false;
		}
		$array=array('id_usuario'=>$id,'folder'=>$arrayData['folder']);
		return $this->insert($array);
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
		$arrayData['id_tipo']=3;
				
		$oUsu=new Usuario($this->oDBM);
		$ok=$oUsu->actualizarUsuario($arrayData);
		if($ok===false){
			$this->aErrors=$oUsu->aErrors;
			return false;
		}
		$array=array('id_usuario'=>$arrayData['id_usuario'],'folder'=>$arrayData['folder']);
		return $this->update($array);
	}
	
	function getClientes(){
		$sql="SELECT 
		t.id_usuario, 
		t.email, 
		t.user_pass, 
		t.user_name, 
		t.nombre, 
		t.apellido, 
		t.direccion, 
		t.ciudad, 
		t.provincia, 
		t.pais, 
		t.cp, 
		t.empresa, 
		t.cargo,
		t.id_tipo,
		t.id_estado,
		c.folder
		FROM control_usuario t 
		INNER JOIN portal_cliente c ON c.id_usuario=t.id_usuario
		WHERE id_tipo=3";
		$arrayData=$this->toArray($sql);
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