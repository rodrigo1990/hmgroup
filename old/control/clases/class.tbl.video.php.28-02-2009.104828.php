<?php
class VideoManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Video
	 */
	function VideoManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'video';
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
/*INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,yt,activo,id_articulo,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]',$arrayData[id_categoria_video],$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],$arrayData[yt],$arrayData[activo],$arrayData[id_articulo],$arrayData[votos],$arrayData[total_votos]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,yt,activo,id_articulo,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]',$arrayData[id_categoria_video],$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],$arrayData[yt],$arrayData[activo],$arrayData[id_articulo],$arrayData[votos],$arrayData[total_votos]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_video){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_video=$id_video*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_video=$id_video";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , id_categoria_video=$arrayData[id_categoria_video] , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , yt=$arrayData[yt] , activo=$arrayData[activo] , id_articulo=$arrayData[id_articulo] , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] WHERE id_video=$arrayData[id_video]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , id_categoria_video=$arrayData[id_categoria_video] , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , yt=$arrayData[yt] , activo=$arrayData[activo] , id_articulo=$arrayData[id_articulo] , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] WHERE id_video=$arrayData[id_video]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_video){
		/*GETROW*/
/*SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
yt, 
activo, 
id_articulo, 
votos, 
total_votos 
FROM ".$this->tabla." 
WHERE id_video=$id_video */
		$sql="SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
yt, 
activo, 
id_articulo, 
votos, 
total_votos 
FROM ".$this->tabla." 
WHERE id_video=$id_video ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
yt, 
activo, 
id_articulo, 
votos, 
total_votos 
FROM ".$this->tabla." */
		$sql="SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
yt, 
activo, 
id_articulo, 
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