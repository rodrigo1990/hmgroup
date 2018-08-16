<?php
class Rel_categoria_articuloManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Rel_categoria_articulo
	 */
	function Rel_categoria_articuloManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'rel_categoria_articulo';
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
/*INSERT INTO ".$this->tabla." (id_categoria,id_articulo) VALUES ($arrayData[id_categoria],$arrayData[id_articulo]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_categoria,id_articulo) VALUES ($arrayData[id_categoria],$arrayData[id_articulo]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_categoria,$id_articulo){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_categoria=$id_categoria AND id_articulo=$id_articulo*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_categoria=$id_categoria AND id_articulo=$id_articulo";
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
	function getRow($id_categoria,$id_articulo){
		/*GETROW*/
/*SELECT 
id_categoria, 
id_articulo 
FROM ".$this->tabla." 
WHERE id_categoria=$id_categoria 
AND id_articulo=$id_articulo */
		$sql="SELECT 
id_categoria, 
id_articulo 
FROM ".$this->tabla." 
WHERE id_categoria=$id_categoria 
AND id_articulo=$id_articulo ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_categoria, 
id_articulo 
FROM ".$this->tabla." */
		$sql="SELECT 
id_categoria, 
id_articulo 
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
	
	function add($idArt,$idCat){
		$array=array('id_articulo'=>$idArt,'id_categoria'=>$idCat);
		return $this->insert($array);
	}
	
	function eliminarArticulo($idArt){
		$sql="DELETE FROM ".$this->tabla." WHERE id_articulo=$idArt";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getCategorias($idArt){
		$sql="SELECT 
		id_categoria, 
		id_articulo 
		FROM ".$this->tabla." 
		WHERE id_articulo=$idArt ";
		return $this->toArray($sql);
	}
	
}
?>