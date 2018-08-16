<?php
class cmsIdioma_traduccion extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Idioma_traduccion
	 */
	function cmsIdioma_traduccion($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'idioma_traduccion';
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
/*INSERT INTO ".$this->tabla." (id_idioma,clave,traduccion) VALUES ($arrayData[id_idioma],'$arrayData[clave]','$arrayData[traduccion]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		foreach($arrayData as $ind=>$val){
			$arrayData[$ind]=mysql_real_escape_string($val);
		}
		$sql="INSERT INTO ".$this->tabla." (id_idioma,clave,traduccion) VALUES ($arrayData[id_idioma],'$arrayData[clave]','$arrayData[traduccion]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_idioma,$clave){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_idioma=$id_idioma AND clave='$clave'*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_idioma=$id_idioma AND clave='$clave'";
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
/*UPDATE ".$this->tabla." SET traduccion='$arrayData[traduccion]' WHERE id_idioma=$arrayData[id_idioma] AND clave='$arrayData[clave]'*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		foreach($arrayData as $ind=>$val){
			$arrayData[$ind]=mysql_real_escape_string($val);
		}
		$data=$this->getRow($arrayData['id_idioma'],$arrayData['clave']);
		if(count($data)==0){
			return $this->insert($arrayData);
		}
		else{
			$sql="UPDATE ".$this->tabla." SET traduccion='$arrayData[traduccion]' WHERE id_idioma=$arrayData[id_idioma] AND clave='$arrayData[clave]'";
			//echo $sql;
			$query=$this->oDBM->query($sql);
			return $this->oDBM->affected_rows();
		}
		
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_idioma,$clave){
		/*GETROW*/
/*SELECT 
id_idioma, 
clave, 
traduccion 
FROM ".$this->tabla." 
WHERE id_idioma=$id_idioma 
AND clave='$clave' */
		$sql="SELECT 
id_idioma, 
clave, 
traduccion 
FROM ".$this->tabla." 
WHERE id_idioma=$id_idioma 
AND clave='$clave' ";
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
clave, 
traduccion 
FROM ".$this->tabla." */
		$sql="SELECT 
id_idioma, 
clave, 
traduccion 
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
	 * Publico: devuelve todas las traducciones de un idioma determinado
	 *
	 * @param int $idIdioma
	 * @return array
	 */
	function getTraducciones($id_idioma){
		$sql="SELECT 
id_idioma, 
clave, 
traduccion 
FROM ".$this->tabla." 
WHERE id_idioma=$id_idioma";
		return $this->toArray($sql);
	}
	
	function getClave($clave){
		$sql="SELECT 
id_idioma, 
clave, 
traduccion 
FROM ".$this->tabla." 
WHERE clave='$clave'";
		return $this->toArray($sql);
	}
	
	function eliminarClave($clave){
		
		$sql="DELETE FROM ".$this->tabla." WHERE clave='$clave'";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function eliminarIdioma($idIdioma){
		
		$sql="DELETE FROM ".$this->tabla." WHERE id_idioma='$idIdioma'";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
}
?>