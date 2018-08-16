<?php
class Banner_EspacioManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	var $espaciosAutomaticos;
	
	/**
	 * Constructor
	 *
	 * @return Espacio
	 */
	function Banner_EspacioManager($oDBM){
		$this->pref='banner_';
		$this->tabla=$this->pref.'espacio';
		$this->oDBM=$oDBM;
		$this->aErrors=array();
		parent::PFTableManager($oDBM,$this->tabla);
		
		//CONFIGURACION DE ESPACIOS AUTOMATICOS
		
		$this->espaciosAutomaticos=array();
	}
	
	
	/**
	 * Publico: inserta los datos en una tabla
	 *
	 * @param array $arrayData
	 */
	function insert($arrayData){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_espacio,nombre,ancho,alto,activo,id_relacion,id_tipo_espacio) VALUES (NULL,'$arrayData[nombre]',$arrayData[ancho],$arrayData[alto],$arrayData[activo],$arrayData[id_relacion],$arrayData[id_tipo_espacio]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_espacio,nombre,ancho,alto,activo,id_relacion,id_tipo_espacio) VALUES (NULL,'$arrayData[nombre]',$arrayData[ancho],$arrayData[alto],$arrayData[activo],$arrayData[id_relacion],$arrayData[id_tipo_espacio]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_espacio){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_espacio=$id_espacio*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_espacio=$id_espacio";
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
/*UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , ancho=$arrayData[ancho] , alto=$arrayData[alto] , activo=$arrayData[activo] , id_relacion=$arrayData[id_relacion] , id_tipo_espacio=$arrayData[id_tipo_espacio] WHERE id_espacio=$arrayData[id_espacio]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , ancho=$arrayData[ancho] , alto=$arrayData[alto] , activo=$arrayData[activo] , id_relacion=$arrayData[id_relacion] , id_tipo_espacio=$arrayData[id_tipo_espacio] WHERE id_espacio=$arrayData[id_espacio]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_espacio){
		/*GETROW*/
/*SELECT 
id_espacio, 
nombre, 
ancho, 
alto, 
activo, 
id_relacion, 
id_tipo_espacio 
FROM ".$this->tabla." 
WHERE id_espacio=$id_espacio */
		$sql="SELECT 
id_espacio, 
nombre, 
ancho, 
alto, 
activo, 
id_relacion, 
id_tipo_espacio 
FROM ".$this->tabla." 
WHERE id_espacio=$id_espacio ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_espacio, 
nombre, 
ancho, 
alto, 
activo, 
id_relacion, 
id_tipo_espacio 
FROM ".$this->tabla." */
		$sql="SELECT 
id_espacio, 
nombre, 
ancho, 
alto, 
activo, 
id_relacion, 
id_tipo_espacio,
CONCAT(nombre,'  ',ancho,' x ',CASE alto WHEN 0 THEN '(sin limite)' ELSE alto END) as resumen 
FROM ".$this->tabla." ORDER BY nombre";
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
	
	function nuevoEspacio($arrayData){
		return $this->insert($arrayData);
	}
	
	
	
	function eliminarEspacio($idEspacio){
		$oBE=new Banner_BannerEspacioManager($this->oDBM);
		$oBE->eliminarEspacio($idEspacio);
		return $this->delete($idEspacio);
	}
	
	function eliminarEspacioPorRelacion($idRelacion,$tipo){
		$sql="SELECT id_espacio
FROM ".$this->tabla." WHERE id_relacion=$idRelacion AND id_tipo_espacio=$tipo ";
		$array=$this->toArray($sql);
		foreach($array as $item){
			$this->eliminarEspacio($item['id_espacio']);
		}
	}
	
	function actualizarNombreEspacio($idCategoria,$nombre){
		$sql="UPDATE ".$this->tabla." SET  nombre='$nombre' WHERE id_relacion=$idCategoria AND id_tipo_espacio=2";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	
	function getIdEspacio($orden,$idRelacion){
		$sql="SELECT DISTINCT
id_espacio
FROM ".$this->tabla." 
WHERE id_tipo_espacio=2 AND id_relacion=$idRelacion 
ORDER BY id_espacio ASC";
		//echo $sql;
		$arrayData=$this->toArray($sql);
		$indice=$orden-1;
		if(isset($arrayData[$orden])){
			return $arrayData[$orden]['id_espacio'];
		}
		if(isset($arrayData[0])){
			return $arrayData[0]['id_espacio'];
		}
		return 0;
	}
	
}
?>