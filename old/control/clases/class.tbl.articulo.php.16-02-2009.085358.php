<?php
class ArticuloManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Articulo
	 */
	function ArticuloManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'articulo';
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
/*INSERT INTO ".$this->tabla." (id_articulo,titulo,copete,texto,fecha,id_categoria,id_tipo_articulo,id_procedencia,id_relevancia,activo,tags,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[copete]','$arrayData[texto]',$arrayData[fecha],$arrayData[id_categoria],$arrayData[id_tipo_articulo],$arrayData[id_procedencia],$arrayData[id_relevancia],$arrayData[activo],'$arrayData[tags]',$arrayData[votos],$arrayData[total_votos]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_articulo,titulo,copete,texto,fecha,id_categoria,id_tipo_articulo,id_procedencia,id_relevancia,activo,tags,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[copete]','$arrayData[texto]',$arrayData[fecha],$arrayData[id_categoria],$arrayData[id_tipo_articulo],$arrayData[id_procedencia],$arrayData[id_relevancia],$arrayData[activo],'$arrayData[tags]',$arrayData[votos],$arrayData[total_votos]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_articulo){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_articulo=$id_articulo*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_articulo=$id_articulo";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , copete='$arrayData[copete]' , texto='$arrayData[texto]' , fecha=$arrayData[fecha] , id_categoria=$arrayData[id_categoria] , id_tipo_articulo=$arrayData[id_tipo_articulo] , id_procedencia=$arrayData[id_procedencia] , id_relevancia=$arrayData[id_relevancia] , activo=$arrayData[activo] , tags='$arrayData[tags]' , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] WHERE id_articulo=$arrayData[id_articulo]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , copete='$arrayData[copete]' , texto='$arrayData[texto]' , fecha=$arrayData[fecha] , id_categoria=$arrayData[id_categoria] , id_tipo_articulo=$arrayData[id_tipo_articulo] , id_procedencia=$arrayData[id_procedencia] , id_relevancia=$arrayData[id_relevancia] , activo=$arrayData[activo] , tags='$arrayData[tags]' , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] WHERE id_articulo=$arrayData[id_articulo]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_articulo){
		/*GETROW*/
/*SELECT 
id_articulo, 
titulo, 
copete, 
texto, 
fecha, 
id_categoria, 
id_tipo_articulo, 
id_procedencia, 
id_relevancia, 
activo, 
tags, 
votos, 
total_votos 
FROM ".$this->tabla." 
WHERE id_articulo=$id_articulo */
		$sql="SELECT 
id_articulo, 
titulo, 
copete, 
texto, 
fecha, 
id_categoria, 
id_tipo_articulo, 
id_procedencia, 
id_relevancia, 
activo, 
tags, 
votos, 
total_votos 
FROM ".$this->tabla." 
WHERE id_articulo=$id_articulo ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_articulo, 
titulo, 
copete, 
texto, 
fecha, 
id_categoria, 
id_tipo_articulo, 
id_procedencia, 
id_relevancia, 
activo, 
tags, 
votos, 
total_votos 
FROM ".$this->tabla." */
		$sql="SELECT 
id_articulo, 
titulo, 
copete, 
texto, 
fecha, 
id_categoria, 
id_tipo_articulo, 
id_procedencia, 
id_relevancia, 
activo, 
tags, 
votos, 
total_votos 
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