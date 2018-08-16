<?php
class Rel_categoria_videoManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Rel_categoria_video
	 */
	function Rel_categoria_videoManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'rel_categoria_video';
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
/*INSERT INTO ".$this->tabla." (id_categoria_video,id_video) VALUES ($arrayData[id_categoria_video],$arrayData[id_video]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_categoria_video,id_video) VALUES ($arrayData[id_categoria_video],$arrayData[id_video]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_categoria_video,$id_video){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_categoria_video=$id_categoria_video AND id_video=$id_video*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_categoria_video=$id_categoria_video AND id_video=$id_video";
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
	function getRow($id_categoria_video,$id_video){
		/*GETROW*/
/*SELECT 
id_categoria_video, 
id_video 
FROM ".$this->tabla." 
WHERE id_categoria_video=$id_categoria_video 
AND id_video=$id_video */
		$sql="SELECT 
id_categoria_video, 
id_video 
FROM ".$this->tabla." 
WHERE id_categoria_video=$id_categoria_video 
AND id_video=$id_video ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_categoria_video, 
id_video 
FROM ".$this->tabla." */
		$sql="SELECT 
id_categoria_video, 
id_video 
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