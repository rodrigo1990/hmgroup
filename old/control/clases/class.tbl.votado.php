<?php
class VotadoManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Votado
	 */
	function VotadoManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'votado';
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
/*INSERT INTO ".$this->tabla." (id_relacion,id_tipo,ip) VALUES ($arrayData[id_relacion],$arrayData[id_tipo],'$arrayData[ip]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_relacion,id_tipo,ip) VALUES ($arrayData[id_relacion],$arrayData[id_tipo],'$arrayData[ip]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_relacion,$id_tipo,$ip){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_relacion=$id_relacion AND id_tipo=$id_tipo AND ip='$ip'*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_relacion=$id_relacion AND id_tipo=$id_tipo AND ip='$ip'";
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
	function getRow($id_relacion,$id_tipo,$ip){
		/*GETROW*/
/*SELECT 
id_relacion, 
id_tipo, 
ip 
FROM ".$this->tabla." 
WHERE id_relacion=$id_relacion 
AND id_tipo=$id_tipo 
AND ip='$ip' */
		$sql="SELECT 
id_relacion, 
id_tipo, 
ip 
FROM ".$this->tabla." 
WHERE id_relacion=$id_relacion 
AND id_tipo=$id_tipo 
AND ip='$ip' ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_relacion, 
id_tipo, 
ip 
FROM ".$this->tabla." */
		$sql="SELECT 
id_relacion, 
id_tipo, 
ip 
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