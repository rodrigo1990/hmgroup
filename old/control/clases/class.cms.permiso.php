<?php
class Permiso extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Permiso
	 */
	function Permiso($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'permiso';
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
/*INSERT INTO ".$this->tabla." (id_permiso,id_objeto,tipo,nombre,descripcion) VALUES (NULL,$arrayData[id_objeto],'$arrayData[tipo]','$arrayData[nombre]','$arrayData[descripcion]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_permiso,id_objeto,tipo,nombre,descripcion) VALUES (NULL,$arrayData[id_objeto],'$arrayData[tipo]','$arrayData[nombre]','$arrayData[descripcion]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_permiso){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_permiso=$id_permiso*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_permiso=$id_permiso";
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
/*UPDATE ".$this->tabla." SET id_objeto=$arrayData[id_objeto] , tipo='$arrayData[tipo]' , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_permiso=$arrayData[id_permiso]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET id_objeto=$arrayData[id_objeto] , tipo='$arrayData[tipo]' , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_permiso=$arrayData[id_permiso]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_permiso){
		/*GETROW*/
/*SELECT 
id_permiso, 
id_objeto, 
tipo, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_permiso=$id_permiso */
		$sql="SELECT 
id_permiso, 
id_objeto, 
tipo, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_permiso=$id_permiso ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_permiso, 
id_objeto, 
tipo, 
nombre, 
descripcion 
FROM ".$this->tabla." */
		$sql="SELECT 
id_permiso, 
id_objeto, 
tipo, 
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
	
	function nuevoPermiso($arrayData){
		return $this->insert($arrayData);
	}
	
	function actualizarPermiso($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminarPermiso($idPermiso){
		$this->quitarPermisoDePerfiles($idPermiso);
		return $this->delete($idPermiso);
	}
	
	function quitarPermisoDePerfiles($idPermiso){
		$oPerfilPermiso=new Perfil_permiso($this->oDBM);
		$oPerfilPermiso->deletePermiso($idPermiso);
	}
	
	function getPermisosPorObjeto($idObjeto){
		$sql="SELECT 
		id_permiso, 
		id_objeto, 
		tipo, 
		nombre, 
		descripcion 
		FROM ".$this->tabla." 
		WHERE id_objeto=$idObjeto ";
		return $this->toArray($sql);
	}
	
}
?>