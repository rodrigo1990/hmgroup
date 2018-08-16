<?php
class Rel_usuario_categoriaManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Rel_usuario_categoria
	 */
	function Rel_usuario_categoriaManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'rel_usuario_categoria';
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
/*INSERT INTO ".$this->tabla." (id_usuario,id_categoria) VALUES ($arrayData[id_usuario],$arrayData[id_categoria]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_usuario,id_categoria) VALUES ($arrayData[id_usuario],$arrayData[id_categoria]) ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_usuario,$id_categoria){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_categoria=$id_categoria*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario AND id_categoria=$id_categoria";
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
	function getRow($id_usuario,$id_categoria){
		/*GETROW*/
/*SELECT 
id_usuario, 
id_categoria 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario 
AND id_categoria=$id_categoria */
		$sql="SELECT 
id_usuario, 
id_categoria 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario 
AND id_categoria=$id_categoria ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_usuario, 
id_categoria 
FROM ".$this->tabla." */
		$sql="SELECT 
id_usuario, 
id_categoria 
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
	
	function add($idUsuario,$idCat){
		$data=$this->getRow($idUsuario,$idCat);
		if(count($data)==0){
			$this->insert(array('id_usuario'=>$idUsuario,'id_categoria'=>$idCat));
		}
	}
	
	function eliminarRelaciones($idCat){
		$sql="DELETE FROM ".$this->tabla." WHERE id_categoria=$idCat";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getRelaciones($idCat){
		$sql="SELECT 
		id_usuario, 
		id_categoria 
		FROM ".$this->tabla." 
		WHERE id_categoria=$idCat ";
		return $this->toArray($sql);
	}
	
}
?>