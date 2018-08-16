<?php
class Perfil_permiso extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Perfil_permiso
	 */
	function Perfil_permiso($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'perfil_permiso';
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
/*INSERT INTO ".$this->tabla." (id_perfil,id_permiso) VALUES ($arrayData[id_perfil],$arrayData[id_permiso]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_perfil,id_permiso) VALUES ($arrayData[id_perfil],$arrayData[id_permiso]) ";
		
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	/**
	 * Inserta los permisos de Perfiles luego de la Eliminacion previa
	 * @param unknown_type $idPerfil
	 * @param unknown_type $idPermisos
	 * @return unknown
	 */
	
	function addPermiso($idPerfil,$idPermiso){
		$array=array('id_perfil'=>$idPerfil,'id_permiso'=>$idPermiso);
		return $this->insert($array);
	}
	
	function insertUsuario($idPerfil,$idPermisos){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_usuario,id_perfil) VALUES ($arrayData[id_usuario],$arrayData[id_perfil]) */
		/*if(!$this->validate($arrayData,'i')){
			return false;
		}*/
		if(!$idPermisos==0){
			$sql="INSERT INTO ".$this->tabla." (id_perfil,id_permiso) VALUES ($idPerfil,$idPermisos) ";
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
	function delete($id_perfil,$id_permiso){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_perfil=$id_perfil AND id_permiso=$id_permiso*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_perfil=$id_perfil AND id_permiso=$id_permiso";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function deletePerfil($id_perfil){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_perfil=$id_perfil*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_perfil=$id_perfil";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function deletePermiso($idPermiso){
		$sql="DELETE FROM ".$this->tabla." WHERE id_permiso=$idPermiso";
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
	function getRow($id_perfil,$id_permiso){
		/*GETROW*/
/*SELECT 
id_perfil, 
id_permiso 
FROM ".$this->tabla." 
WHERE id_perfil=$id_perfil 
AND id_permiso=$id_permiso */
		$sql="SELECT 
id_perfil, 
id_permiso 
FROM ".$this->tabla." 
WHERE id_perfil=$id_perfil 
AND id_permiso=$id_permiso ";
		return $this->toRow($sql);
	}
	
	function getPermisos($id_perfil){
		
		$sql="SELECT 
		id_permiso
		FROM ".$this->tabla." 
		WHERE id_perfil=$id_perfil ";
		return $this->toArray($sql);
	}
	
	
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_perfil, 
id_permiso 
FROM ".$this->tabla." */
		$sql="SELECT 
id_perfil, 
id_permiso 
FROM ".$this->tabla." ";
		return $this->toArray($sql);
	}
	
	/**
	 * devuelve los permiso de los perfiles
	 *
	 * @param unknown_type $id_perfil
	 * @return unknown
	 */
	
	function getDataPermiso($id_perfil){
		/*GETDATA*/
/*SELECT 
id_usuario, 
id_perfil 
FROM ".$this->tabla." */
		$sql="SELECT 
id_perfil, 
id_permiso 
FROM ".$this->tabla." WHERE id_perfil=$id_perfil";
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