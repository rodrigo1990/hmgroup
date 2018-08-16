<?php
class CategoriaManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Categoria
	 */
	function CategoriaManager($oDBM){
		$this->pref='music_';
		$this->tabla=$this->pref.'categoria';
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
/*INSERT INTO ".$this->tabla." (id_categoria,descripcion,id_padre) VALUES (NULL,'$arrayData[descripcion]',$arrayData[id_padre]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_categoria,descripcion,id_padre) VALUES (NULL,'$arrayData[descripcion]',$arrayData[id_padre]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_categoria){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_categoria=$id_categoria*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_categoria=$id_categoria";
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
/*UPDATE ".$this->tabla." SET descripcion='$arrayData[descripcion]' , id_padre=$arrayData[id_padre] WHERE id_categoria=$arrayData[id_categoria]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET descripcion='$arrayData[descripcion]' , id_padre=$arrayData[id_padre] WHERE id_categoria=$arrayData[id_categoria]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_categoria){
		/*GETROW*/
/*SELECT 
id_categoria, 
descripcion, 
id_padre 
FROM ".$this->tabla." 
WHERE id_categoria=$id_categoria */
		$sql="SELECT 
id_categoria, 
descripcion, 
id_padre 
FROM ".$this->tabla." 
WHERE id_categoria=$id_categoria ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_categoria, 
descripcion, 
id_padre 
FROM ".$this->tabla." */
		$sql="SELECT 
id_categoria, 
descripcion, 
id_padre 
FROM ".$this->tabla." ";
		if(count($arrayCond)>0){
			$sql.=" WHERE ".implode(' AND ',$arrayCond)." ";
		}
		if(!is_null($orderBy)){
			$sql.=" ORDER BY $orderBy ";
		}
		if(!is_null($from)){
			$sql.= " LIMIT $from, $qty ";
		}
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
	
	function nuevo($arrayData){
		return $this->insert($arrayData);
	}
	
	function actualizar($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminar($id_categoria){
		return $this->delete($id_categoria);
	}
	
	function getListado($from=null,$qty=null){
		return $this->getData($from,$qty);
	}
	
	function countTotal(){
		return $this->countRows();
	}
	
	function activar($id_categoria){
		$sql="UPDATE ".$this->tabla." SET activa=1 WHERE id_categoria='$id_categoria' ";
		return $this->oDBM->query($sql);
	}
	
	function desactivar($id_categoria){
		$sql="UPDATE ".$this->tabla." SET activa=0 WHERE id_categoria='$id_categoria' ";
		return $this->oDBM->query($sql);
	}

	
	function subirOrden($id){
		$aData=$this->getRow($id);
		//echo $aFotoData['orden'];
		$nextData=$this->getNextUp($aData);
		//echo '-'.$nextFotoData['orden'];
		if(count($nextData)!=0){
			$this->switchPosicion($aData,$nextData);
		}
	}
	
	function bajarOrden($id){
		$aData=$this->getRow($id);
		$previousData=$this->getNextDown($aData);
		if(count($previousData)!=0){
			$this->switchPosicion($aData,$previousData);
		}
	}
	
	function getNextUp($data){
		$sql="SELECT
		*
		FROM $this->tabla 
		WHERE orden<$data[orden] 
		ORDER BY orden DESC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function getNextDown($data){
		$sql="SELECT 
		* 
		FROM $this->tabla 
		WHERE orden>$data[orden] 
		ORDER BY orden ASC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function switchPosicion($arrayData, $arrayData2){
		$this->updateOrden($arrayData['id_categoria'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_categoria'],$arrayData['orden']);
	}
	
	function updateOrden($id_categoria,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_categoria='$id_categoria' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." ";
		return $this->toVar($sql)+1;
	}
	
	
	
	
}
?>