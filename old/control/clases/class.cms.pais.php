<?php
class Pais extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Pais
	 */
	function Pais($oDBM){
		$this->pref='cms_';
		$this->tabla=$this->pref.'pais';
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
/*INSERT INTO ".$this->tabla." (iso,name,printable_name,iso3,numcode) VALUES (NULL,'$arrayData[name]','$arrayData[printable_name]','$arrayData[iso3]',$arrayData[numcode]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (iso,name,printable_name,iso3,numcode) VALUES (NULL,'$arrayData[name]','$arrayData[printable_name]','$arrayData[iso3]',$arrayData[numcode]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($iso){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE iso='$iso'*/
		$sql="DELETE FROM ".$this->tabla." WHERE iso='$iso'";
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
/*UPDATE ".$this->tabla." SET name='$arrayData[name]' , printable_name='$arrayData[printable_name]' , iso3='$arrayData[iso3]' , numcode=$arrayData[numcode] WHERE iso='$arrayData[iso]'*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET name='$arrayData[name]' , printable_name='$arrayData[printable_name]' , iso3='$arrayData[iso3]' , numcode=$arrayData[numcode] WHERE iso='$arrayData[iso]'";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($iso){
		/*GETROW*/
/*SELECT 
iso, 
name, 
printable_name, 
iso3, 
numcode 
FROM ".$this->tabla." 
WHERE iso='$iso' */
		$sql="SELECT 
iso, 
name, 
printable_name, 
iso3, 
numcode 
FROM ".$this->tabla." 
WHERE iso='$iso' ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
iso, 
name, 
printable_name, 
iso3, 
numcode 
FROM ".$this->tabla." */
		$sql="SELECT 
iso, 
name, 
printable_name, 
iso3, 
numcode 
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