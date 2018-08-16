<?php
class ListaManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Lista
	 */
	function ListaManager($oDBM){
		$this->pref='music_';
		$this->tabla=$this->pref.'lista';
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
/*INSERT INTO ".$this->tabla." (id_lista,archivo) VALUES (NULL,'$arrayData[archivo]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_lista,archivo) VALUES (NULL,'$arrayData[name]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
		
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_lista){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_lista=$id_lista*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_lista=$id_lista";
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
/*UPDATE ".$this->tabla." SET archivo='$arrayData[archivo]' WHERE id_lista=$arrayData[id_lista]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET archivo='$arrayData[archivo]' WHERE id_lista=$arrayData[id_lista]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_lista){
		/*GETROW*/
/*SELECT 
id_lista, 
archivo 
FROM ".$this->tabla." 
WHERE id_lista=$id_lista */
		$sql="SELECT 
id_lista, 
archivo 
FROM ".$this->tabla." 
WHERE id_lista=$id_lista ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_lista, 
archivo 
FROM ".$this->tabla." */
		$sql="SELECT 
id_lista, 
archivo 
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
	
	function nuevo($arrayData,$arrayFiles){
		$id=$this->insert($arrayFiles['archivo']);
		if (!$id){
			return false;
		}
		if (is_file($arrayFiles['archivo']['tmp_name'])){
			$oA = new AdapterImagen($this->oDBM);
			$oA->nuevaListaPrecios($arrayFiles,$id);
		}
		return $id;
	}
	
	/*function nuevo($arrayData){
		return $this->insert($arrayData);
	}*/
	
	function actualizar($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminar($id_lista){
		return $this->delete($id_lista);
	}
	
	function getListado($from=null,$qty=null){
		return $this->getData($from,$qty);
	}
	
	function countTotal(){
		return $this->countRows();
	}
	
	function activar($id_lista){
		$sql="UPDATE ".$this->tabla." SET activa=1 WHERE id_lista='$id_lista' ";
		return $this->oDBM->query($sql);
	}
	
	function desactivar($id_lista){
		$sql="UPDATE ".$this->tabla." SET activa=0 WHERE id_lista='$id_lista' ";
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
		$this->updateOrden($arrayData['id_lista'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_lista'],$arrayData['orden']);
	}
	
	function updateOrden($id_lista,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_lista='$id_lista' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." ";
		return $this->toVar($sql)+1;
	}
	
	
	function getListaPrecios(){
		$lista=$this->getListado();
		if(isset($lista[0])){
			$oA = new AdapterImagen($this->oDBM);
			$lista2= $oA->getListaPrecios($lista[0]['id_lista']);
			if(isset($lista2[0])){
				return $lista2[0];
			}
			else{
				return false;
			}
		}
		return false;
	}
	
}
?>