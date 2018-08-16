<?php
class Objeto extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Objeto
	 */
	function Objeto($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'objeto';
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
/*INSERT INTO ".$this->tabla." (id_objeto,clave,nombre,descripcion) VALUES (NULL,'$arrayData[clave]','$arrayData[nombre]','$arrayData[descripcion]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_objeto,clave,nombre,descripcion) VALUES (NULL,'$arrayData[clave]','$arrayData[nombre]','$arrayData[descripcion]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_objeto){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_objeto=$id_objeto*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_objeto=$id_objeto";
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
/*UPDATE ".$this->tabla." SET clave='$arrayData[clave]' , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_objeto=$arrayData[id_objeto]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET clave='$arrayData[clave]' , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' WHERE id_objeto=$arrayData[id_objeto]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_objeto){
		/*GETROW*/
/*SELECT 
id_objeto, 
clave, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_objeto=$id_objeto */
		$sql="SELECT 
id_objeto, 
clave, 
nombre, 
descripcion 
FROM ".$this->tabla." 
WHERE id_objeto=$id_objeto ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_objeto, 
clave, 
nombre, 
descripcion 
FROM ".$this->tabla." */
		$sql="SELECT 
id_objeto, 
clave, 
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
	
	function nuevoObjeto($arrayData){
		return $this->insert($arrayData);
	}
	
	function actualizarObjeto($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminarObjeto($idObjeto){
		$this->eliminarPermisosDeObjeto($idObjeto);
		return $this->delete($idObjeto);
	}
	
	function eliminarPermisosDeObjeto($idObjeto){
		$oPermiso=new Permiso($this->oDBM);
		$arrayPermisos=$oPermiso->getPermisosPorObjeto($idObjeto);
		foreach($arrayPermisos as $item){
			$oPermiso->eliminarPermiso($item['id_permiso']);
		}
	}
	
	
}
?>