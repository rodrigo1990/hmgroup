<?php
class NoticiaManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Noticia
	 */
	function NoticiaManager($oDBM){
		$this->pref='music_';
		$this->tabla=$this->pref.'noticia';
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
/*INSERT INTO ".$this->tabla." (id_noticia,titulo,descripcion,descripcion_promocion,id_categoria,en_promocion,es_novedad,destacado,activo,orden) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]','$arrayData[descripcion_promocion]',$arrayData[id_categoria],$arrayData[en_promocion],$arrayData[es_novedad],$arrayData[destacado],$arrayData[activo],$arrayData[orden]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$orden=$this->getNextOrden($arrayData);//esto es un index adicional
		$sql="INSERT INTO ".$this->tabla." (id_noticia,titulo,texto,fecha,orden,visible) VALUES (NULL,'$arrayData[titulo]','$arrayData[texto]','$arrayData[fecha]',$orden,$arrayData[visible]) ";//array[orden] por $orden
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_noticia){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_noticia=$id_noticia*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_noticia=$id_noticia";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , descripcion_promocion='$arrayData[descripcion_promocion]' , id_categoria=$arrayData[id_categoria] , en_promocion=$arrayData[en_promocion] , es_novedad=$arrayData[es_novedad] , destacado=$arrayData[destacado] , activo=$arrayData[activo] , orden=$arrayData[orden] WHERE id_noticia=$arrayData[id_noticia]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , texto='$arrayData[texto]' , fecha='$arrayData[fecha]' , visible=$arrayData[visible] WHERE id_noticia=$arrayData[id_noticia]";// sacar orden en update
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_noticia){
		/*GETROW*/
/*SELECT 
id_noticia, 
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
WHERE id_noticia=$id_noticia */
		$sql="SELECT 
id_noticia, 
titulo, 
texto, 
fecha, 
visible,
orden
FROM ".$this->tabla." 
WHERE id_noticia=$id_noticia ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_noticia, 
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
id_noticia, 
titulo, 
texto, 
fecha, 
visible,
orden
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
	
	function eliminar($id_noticia){
		return $this->delete($id_noticia);
	}
	
	function getListado($from=null,$qty=null){
		$orderBy=" orden ";
		$array=null;
		return $this->getData($from,$qty,$array,$orderBy);
	}
	
	function countTotal(){
		return $this->countRows();
	}
	
	function activar($id_noticia){
		$sql="UPDATE ".$this->tabla." SET visible=1 WHERE id_noticia='$id_noticia' ";
		return $this->oDBM->query($sql);
	}
	
	function desactivar($id_noticia){
		$sql="UPDATE ".$this->tabla." SET visible=0 WHERE id_noticia='$id_noticia' ";
		return $this->oDBM->query($sql);
	}

	
	function subirOrden($id){
		$aData=$this->getRow($id);
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
		$this->updateOrden($arrayData['id_noticia'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_noticia'],$arrayData['orden']);
	}
	
	function updateOrden($id_noticia,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_noticia='$id_noticia' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." ";
		return $this->toVar($sql)+1;
	}
	
	function getImagenes($idNoticia){
		$oObj=new AdapterImagen($this->oDBM);
		return $array=$oObj->getImagenNoticia($idNoticia);
	}
	
	function getVideos($inicio=null,$qty=null,$arrayCond=null){
		$oObj=new VideoManager($this->oDBM);
		return $oObj->getData($inicio,$qty,$arrayCond);
	}
	
	function nuevoVideo($arrayData){
		$oObj = new VideoManager($this->oDBM);
		$arrayData['titulo']=uniqid('VIDEO_NOTI');
		$arrayData['id_categoria_video']=0;
		$arrayData['duracion']=0;
		$arrayData['fecha']=PF::date("Ymdhis");
		$arrayData['id_relevancia']=0;
		$arrayData['id_relacion']=$arrayData['id_noticia'];
		$arrayData['id_youtube']='';
		$arrayData['thumb']='';
		$arrayData['fecha_publicacion']=PF::date("Ymdhis");
		return $oObj->insert($arrayData);
	}
	
	function eliminarVideo($idVideo){
		$oObj=new VideoManager($this->oDBM);
		return $oObj->delete($idVideo);
	}
		
	function getVisible(){
		$array=array();
		$array[]=" visible=1 ";
		$lista= $this->getData(0,1,$array);
		return $lista[0];
	}
	
	function eliminarVideosNoticia($idNoticia){
		$listaVideos = $this->getVideos(null,null,array(" id_relacion = ".$idNoticia));
		foreach ($listaVideos as $lista){
			$this->eliminarVideo($lista['id_video']);
		}
	}
	
}
?>