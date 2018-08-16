<?php
class Perfil_usuario extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Perfil_usuario
	 */
	function Perfil_usuario($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'perfil_usuario';
		$this->oDBM=$oDBM;
		$this->aErrors=array();
		parent::PFTableManager($oDBM,$this->tabla);
	}
	
	
	/**
	 * Publico: inserta los datos en una tabla
	 *
	 * @param array $arrayData
	 */
	function insert($arrayData){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_usuario,id_perfil) VALUES ($arrayData[id_usuario],$arrayData[id_perfil]) */
		/*if(!$this->validate($arrayData,'i')){
			return false;
		}*/
		$sql="INSERT INTO ".$this->tabla." (id_usuario,id_perfil) VALUES ($arrayData[id_usuario],$arrayData[id_perfil]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	/**
	 * Inserta los perfiles de Usuarios luego de la Eliminacion previa
	 * @param unknown_type $idusuario
	 * @param unknown_type $idPerfil
	 * @return unknown
	 */
		
	
	function insertUsuario($idUsuario,$idPerfil){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_usuario,id_perfil) VALUES ($arrayData[id_usuario],$arrayData[id_perfil]) */
		/*if(!$this->validate($arrayData,'i')){
			return false;
		}*/
		if($idPerfil!=0){
			$sql="INSERT INTO ".$this->tabla." (id_usuario,id_perfil) VALUES ($idUsuario,$idPerfil) ";
			$query=$this->oDBM->query($sql);
			return $this->oDBM->last_id();
		}else {
			return true;
		}
		
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_usuario,$id_perfil){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_perfil=$id_perfil*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_perfil=$id_perfil";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	/**
	 * Público: elimina un usuario de la tabla
	 *
	 * @param Primary Key $id
	 */
	function deleteUsuario($id_usuario){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_perfil=$id_perfil*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function deletePerfil($idPerfil){
		$sql="DELETE FROM ".$this->tabla." WHERE id_perfil=$idPerfil";
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
/**/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_usuario,$id_perfil){
		/*GETROW*/
/*SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario 
AND id_perfil=$id_perfil */
		$sql="SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario 
AND id_perfil=$id_perfil ";
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
id_perfil 
FROM ".$this->tabla." */
		$sql="SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." ";
		return $this->toArray($sql);
	}
	
	/**
	 * devuelve los perfiles de un determinado usuario
	 *
	 * @param $id_usuario
	 * @return $array
	 */
	
	function getPerfilesUsuario($id_usuario){
		/*GETDATA*/
/*SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." */
		$sql="SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." WHERE id_usuario=$id_usuario";
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
	
	
}
?>