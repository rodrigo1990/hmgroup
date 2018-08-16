<?php
class CMSConfig extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Config
	 */
	function CMSConfig($oDBM){
		$this->pref='cms_';
		$this->tabla=$this->pref.'config';
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
/*INSERT INTO ".$this->tabla." (variable,valor) VALUES (NULL,'$arrayData[valor]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (variable,valor) VALUES (NULL,'$arrayData[valor]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($variable){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE variable='$variable'*/
		$sql="DELETE FROM ".$this->tabla." WHERE variable='$variable'";
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
/*UPDATE ".$this->tabla." SET valor='$arrayData[valor]' WHERE variable='$arrayData[variable]'*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET valor='$arrayData[valor]' WHERE variable='$arrayData[variable]'";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($variable){
		/*GETROW*/
/*SELECT 
variable, 
valor 
FROM ".$this->tabla." 
WHERE variable='$variable' */
		$sql="SELECT 
variable, 
valor 
FROM ".$this->tabla." 
WHERE variable='$variable' ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
variable, 
valor 
FROM ".$this->tabla." */
		$sql="SELECT 
variable, 
valor 
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
	
	function getVar($variable){
		$data=$this->getRow($variable);
		//print_r($data);
		return $data['valor'];
	}
	
	function setVar($variable,$valor){
		return $this->update(array('variable'=>$variable,'valor'=>$valor));
	}
	
	function newVar($variable,$valor=''){
		return $this->insert(array('variable'=>$variable,'valor'=>$valor));
	}
	
}
?>