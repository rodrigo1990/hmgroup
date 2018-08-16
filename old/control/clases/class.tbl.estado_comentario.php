<?php
class Estado_comentarioManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Estado_comentario
	 */
	function Estado_comentarioManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'estado_comentario';
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
/*INSERT INTO ".$this->tabla." (id_estado_comentario,descripcion) VALUES (NULL,'$arrayData[descripcion]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_estado_comentario,descripcion) VALUES (NULL,'$arrayData[descripcion]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_estado_comentario){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_estado_comentario=$id_estado_comentario*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_estado_comentario=$id_estado_comentario";
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
/*UPDATE ".$this->tabla." SET descripcion='$arrayData[descripcion]' WHERE id_estado_comentario=$arrayData[id_estado_comentario]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET descripcion='$arrayData[descripcion]' WHERE id_estado_comentario=$arrayData[id_estado_comentario]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_estado_comentario){
		/*GETROW*/
/*SELECT 
id_estado_comentario, 
descripcion 
FROM ".$this->tabla." 
WHERE id_estado_comentario=$id_estado_comentario */
		$sql="SELECT 
id_estado_comentario, 
descripcion 
FROM ".$this->tabla." 
WHERE id_estado_comentario=$id_estado_comentario ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_estado_comentario, 
descripcion 
FROM ".$this->tabla." */
		$sql="SELECT 
id_estado_comentario, 
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
	
	
}
?>