<?php
class ProductoManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Producto
	 */
	function ProductoManager($oDBM){
		$this->pref='music_';
		$this->tabla=$this->pref.'producto';
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
/*INSERT INTO ".$this->tabla." (id_producto,titulo,descripcion,descripcion_promocion,id_categoria,en_promocion,es_novedad,destacado,activo,orden) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]','$arrayData[descripcion_promocion]',$arrayData[id_categoria],$arrayData[en_promocion],$arrayData[es_novedad],$arrayData[destacado],$arrayData[activo],$arrayData[orden]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$orden=$this->getNextOrden($arrayData);//esto es un index adicional
		$sql="INSERT INTO ".$this->tabla." (id_producto,titulo,descripcion,descripcion_promocion,id_categoria,en_promocion,es_novedad,destacado,activo,orden, descripcion_novedad,descripcion_abreviada) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]','$arrayData[descripcion_promocion]',$arrayData[id_categoria],$arrayData[en_promocion],$arrayData[es_novedad],$arrayData[destacado],$arrayData[activo],$orden,'$arrayData[descripcion_novedad]','$arrayData[descripcion_abreviada]') ";//array[orden] por $orden
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_producto){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_producto=$id_producto*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_producto=$id_producto";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , descripcion_promocion='$arrayData[descripcion_promocion]' , id_categoria=$arrayData[id_categoria] , en_promocion=$arrayData[en_promocion] , es_novedad=$arrayData[es_novedad] , destacado=$arrayData[destacado] , activo=$arrayData[activo] , orden=$arrayData[orden] WHERE id_producto=$arrayData[id_producto]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , descripcion_promocion='$arrayData[descripcion_promocion]' , id_categoria=$arrayData[id_categoria] , en_promocion=$arrayData[en_promocion] , es_novedad=$arrayData[es_novedad] , destacado=$arrayData[destacado] , activo=$arrayData[activo],descripcion_novedad='$arrayData[descripcion_novedad]' ,descripcion_abreviada='$arrayData[descripcion_abreviada]'  WHERE id_producto=$arrayData[id_producto]";// sacar orden en update
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_producto){
		/*GETROW*/
/*SELECT 
id_producto, 
titulo, 
descripcion, 
descripcion_promocion, 
id_categoria, 
en_promocion, 
es_novedad, 
destacado, 
activo, 
orden 
FROM ".$this->tabla." 
WHERE id_producto=$id_producto */
		$sql="SELECT 
id_producto, 
titulo, 
descripcion, 
descripcion_promocion, 
id_categoria, 
en_promocion, 
es_novedad, 
destacado, 
activo, 
orden,
descripcion_abreviada,
descripcion_novedad
FROM ".$this->tabla." 
WHERE id_producto=$id_producto ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_producto, 
titulo, 
descripcion, 
descripcion_promocion, 
id_categoria, 
en_promocion, 
es_novedad, 
destacado, 
activo, 
orden 
FROM ".$this->tabla." */
		$sql="SELECT 
id_producto, 
titulo, 
descripcion, 
descripcion_promocion, 
id_categoria, 
en_promocion, 
es_novedad, 
destacado, 
activo, 
orden,
descripcion_abreviada,
descripcion_novedad 
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
	
	function eliminar($id_producto){
		return $this->delete($id_producto);
	}
	
	function getListado($from=null,$qty=null,$idcat=null){
		$orderBy="orden";
		$array=array();
		if(!is_null($idcat)){
			$array[]=" id_categoria=$idcat ";
		}
		return $this->getData($from,$qty,$array,$orderBy);
	}
	
	function countTotal($idcat=null){
		if(!is_null($idcat)){
			return $this->countRows(array('id_categoria'=>$idcat));
		}
		return $this->countRows();
	}
	
	function activar($id_producto){
		$sql="UPDATE ".$this->tabla." SET activo=1 WHERE id_producto='$id_producto' ";
		return $this->oDBM->query($sql);
	}
	
	function desactivar($id_producto){
		$sql="UPDATE ".$this->tabla." SET activo=0 WHERE id_producto='$id_producto' ";
		return $this->oDBM->query($sql);
	}

	
	function subirOrden($id){
		$aData=$this->getRow($id);
		//echo $aData['orden'];
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
		$this->updateOrden($arrayData['id_producto'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_producto'],$arrayData['orden']);
	}
	
	function updateOrden($id_producto,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_producto='$id_producto' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." ";
		return $this->toVar($sql)+1;
	}
	
	function destacado ($idProd){
		$sql="UPDATE $this->tabla SET destacado = 0 WHERE id_producto != $idProd";
		$query=$this->oDBM->query($sql);
		
	}
	
	function getImagenes($idProd){
		$oObj=new AdapterImagen($this->oDBM);
		return $array=$oObj->getImagenProd($idProd);
	}
	
	
	function getDestacado(){
		$array=array();
		$array[]=" destacado=1 ";
		$array[]=" activo=1 ";
		$lista= $this->getData(0,1,$array);
		return $lista[0];
	}
	
	function getNovedades(){
		$array=array();
		$array[]=" es_novedad=1 ";
		$array[]=" activo=1 ";
		return $this->getData(0,3,$array,' orden ASC ');
	}
	
	function getPromociones($from=0,$qty=4){
		$array=array();
		$array[]=" en_promocion=1 ";
		$array[]=" activo=1 ";
		return $this->getData($from,$qty,$array,' orden ASC ');
	}
	
	function getCantPromociones(){
		return $this->countRows(array('en_promocion'=>1,'activo'=>1));
	}
	
	function getProductosCategoria($idCat,$from=null,$qty=null){
		$array=array();
		$array[]=" id_categoria=$idCat ";
		$array[]=" activo=1 ";
		return $this->getData($from,$qty,$array,' orden ASC ');
	}
	
	function getCantProductosCategoria($idCat){
		return $this->countRows(array('id_categoria'=>$idCat,'activo'=>1));
	}

	function buscarProductos($texto){
		$array=array();
		$array[]=" ( titulo LIKE '%$texto%' OR descripcion LIKE '%$texto%' OR descripcion_abreviada LIKE '%$texto%' ) ";
		$array[]=" activo=1 ";
		return $this->getData(null,null,$array,' orden ASC ');
	}

}
?>