<?php
class Perfil extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Perfil
	 */
	function Perfil($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'perfil';
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
/*INSERT INTO ".$this->tabla." (id_perfil,nombre,descripcion) VALUES (NULL,'$arrayData[nombre]','$arrayData[descripcion]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_perfil,nombre,descripcion) VALUES (NULL,'$arrayData[nombre]','$arrayData[descripcion]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_perfil){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_perfil=$id_perfil*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_perfil=$id_perfil";
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
/*UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_perfil=$arrayData[id_perfil]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_perfil=$arrayData[id_perfil]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_perfil){
		/*GETROW*/
/*SELECT 
id_perfil, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_perfil=$id_perfil */
		$sql="SELECT 
id_perfil, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_perfil=$id_perfil ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_perfil, 
nombre, 
descripcion 
FROM ".$this->tabla." */
		$sql="SELECT 
id_perfil, 
nombre, 
descripcion 
FROM ".$this->tabla." ";
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
	
	/**
	 * Publico: devuelve todos los permisos que integran el perfil indicado
	 *
	 * @param int $idPerfil
	 * @return array $array
	 */
	function getPermisos($idPerfil){
		$oPerfilPermiso=new Perfil_permiso($this->oDBM);
		return $oPerfilPermiso->getPermisos($idPerfil);
	}
	
	/**
	 * Publico: actualiza los datos de un perfil
	 *
	 * @param array $arrayData
	 * @return bool
	 */
	function actualizarPerfil($arrayData){
		/*
		Debe actualizar los datos del perfil, y actualizar en la tabla control_perfil_permiso los 
		permisos que pertenecen al perfil.
		*/
		$this->update($arrayData);
		$array=$arrayData['permisos'];
		$this->actualizarPermisosPerfil($array,$arrayData['id_perfil']);
		return true;
	}
	
	/**
	 * Privado: actualiza los permisos de un perfil
	 *
	 * @param arraydata $array
	 * @return bool
	 */
	function actualizarPermisosPerfil($array,$idPerfil){
		/*
		Debe actualizar en la tabla control_perfil_permiso los 
		permisos que pertenecen al perfil. Lo ideal es borrar todos los permisos del perfil y volverlos a escribir
		*/
		$oPermisoPerfil=new Perfil_permiso($this->oDBM);
		$oPermisoPerfil->deletePerfil($idPerfil);
		foreach($array as $ind => $permiso){
			$oPermisoPerfil->addPermiso($idPerfil,$permiso);
		}
		return true;
	}
	
	/**
	 * Publico: carga un nuevo perfil
	 *
	 * @param array $arrayData
	 * @return  int $idPerfil
	 */
	function nuevoPerfil($arrayData){
		/*
		Debe cargarse el nuevo perfil, y luego tomar los datos de permisos y actualizarlos
		*/
		$idPerfil=$this->insert($arrayData);
		$array=array();
		if(isset($arrayData['permisos'])){
			$array=$arrayData['permisos'];
		}
		$this->actualizarPermisosPerfil($array,$idPerfil);
		return $idPerfil;
	}
	
	/**
	 * Publico: elimina un perfil
	 *
	 * @param int $idPerfil
	 * @return bool
	 */
	function eliminarPerfil($idPerfil){
		$this->actualizarPermisosPerfil(array(),$idPerfil);
		$this->quitarUsuariosDePerfil($idPerfil);
		return $this->delete($idPerfil);
	}
	
	function quitarUsuariosDePerfil($idPerfil){
		$oPerfilUsu=new Perfil_usuario($this->oDBM);
		$oPerfilUsu->deletePerfil($idPerfil);
	}
	/**
	 * Publico: obtiene el id de un perfil 
	 *
	 * @param int $nombrePerfil
	 * @return bool
	 */
	function getIdPerfil($nombrePerfil){
		$sql="SELECT id_perfil FROM ".$this->tabla." WHERE nombre='$nombrePerfil'";
		return $this->toVar($sql);
	}
}
?>