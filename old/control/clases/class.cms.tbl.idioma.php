<?php
class cmsIdioma extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Idioma
	 */
	function cmsIdioma($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'idioma';
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
/*INSERT INTO ".$this->tabla." (id_idioma,nombre) VALUES (NULL,'$arrayData[nombre]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		foreach($arrayData as $ind=>$val){
			$arrayData[$ind]=str_replace("'","\'",$arrayData[$ind]);
			$arrayData[$ind]=str_replace("\\'","\'",$arrayData[$ind]);
		}
		$sql="INSERT INTO ".$this->tabla." (id_idioma,nombre) VALUES (NULL,'$arrayData[nombre]') ";
		
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_idioma){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_idioma=$id_idioma*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_idioma=$id_idioma";
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
/*UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' WHERE id_idioma=$arrayData[id_idioma]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		foreach($arrayData as $ind=>$val){
			$arrayData[$ind]=str_replace("'","\'",$arrayData[$ind]);
			$arrayData[$ind]=str_replace("\\'","\'",$arrayData[$ind]);
		}
		$sql="UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' WHERE id_idioma=$arrayData[id_idioma]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_idioma){
		/*GETROW*/
/*SELECT 
id_idioma, 
nombre 
FROM ".$this->tabla." 
WHERE id_idioma=$id_idioma */
		$sql="SELECT 
id_idioma, 
nombre 
FROM ".$this->tabla." 
WHERE id_idioma=$id_idioma ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_idioma, 
nombre 
FROM ".$this->tabla." */
		$sql="SELECT 
id_idioma, 
nombre 
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