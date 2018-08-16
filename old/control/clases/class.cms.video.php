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
		$this->pref='cms_';
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
/*INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,id_youtube,activo,id_articulo,votos,total_votos,thumb) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]',$arrayData[id_categoria_video],$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],'$arrayData[id_youtube]',$arrayData[activo],$arrayData[id_articulo],$arrayData[votos],$arrayData[total_votos],'$arrayData[thumb]') */
		/*if(!$this->validate($arrayData,'i')){
			return false;
		}*/
		$orden=$this->getNextOrden($arrayData);
		$sql="INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,id_youtube,activo,id_relacion,votos,total_votos,thumb,orden,fecha_publicacion) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]','$arrayData[id_categoria_video]',$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],'$arrayData[id_youtube]',1,$arrayData[id_relacion],0,0,'$arrayData[thumb]',$orden,$arrayData[fecha_publicacion]) ";
		//echo $sql;
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
		//echo $sql;
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , id_categoria_video=$arrayData[id_categoria_video] , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , id_youtube='$arrayData[id_youtube]' , activo=$arrayData[activo] , id_articulo=$arrayData[id_articulo] , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] , thumb='$arrayData[thumb]' WHERE id_video=$arrayData[id_video]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , id_youtube='$arrayData[id_youtube]' , thumb='$arrayData[thumb]', fecha_publicacion=$arrayData[fecha_publicacion] WHERE id_video=$arrayData[id_video]";
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
id_youtube, 
activo, 
id_articulo, 
votos, 
total_votos, 
thumb 
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
id_youtube, 
activo, 
id_relacion, 
votos, 
total_votos, 
thumb,
orden,
fecha_publicacion 
FROM ".$this->tabla." 
WHERE id_video=$id_video ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
id_youtube, 
activo, 
id_articulo, 
votos, 
total_votos, 
thumb 
FROM ".$this->tabla." */
		$sql="SELECT 
id_video, 
titulo, 
descripcion, 
id_categoria_video, 
duracion, 
fecha, 
id_relevancia, 
id_youtube, 
activo, 
id_relacion, 
votos, 
total_votos, 
thumb,
orden,
fecha_publicacion
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
		//echo $sql;
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
	
	function nuevoVideo($arrayData){
		$yt=new YouTubeVideo($arrayData['id_youtube']);
		if(!$yt->isOk()){
			$this->aErrors[]='No existe el ID en YouTube de ese video';
			return false;
		}
		$arrayData['duracion']=$yt->getDuration();
		$arrayData['thumb']=$yt->getUrlThumbnail();
		$idVideo= $this->insert($arrayData);
		if(!$idVideo){
			return false;
		}
		/*Esta parte es por si hay una tabla con categorias de videos*/
		/*if(isset($arrayData['categorias']) && is_array($arrayData['categorias'])){
			$oRel=new Rel_categoria_videoManager($this->oDBM);
			foreach($arrayData['categorias'] as $idCat){
				$oRel->add($idVideo,$idCat);
			}
		}*/
		return $idVideo;
	}
	
	function actualizarVideo($arrayData){
		$yt=new YouTubeVideo($arrayData['id_youtube']);
		if(!$yt->isOk()){
			$this->aErrors[]='No existe el ID en YouTube de ese video';
			return false;
		}
		$arrayData['duracion']=$yt->getDuration();
		$arrayData['thumb']=$yt->getUrlThumbnail();
		if(isset($arrayData['categorias']) && is_array($arrayData['categorias'])){
			$oRel=new Rel_categoria_videoManager($this->oDBM);
			$oRel->eliminarVideo($arrayData['id_video']);
			foreach($arrayData['categorias'] as $idCat){
				$oRel->add($arrayData['id_video'],$idCat);
			}
		}
		return $this->update($arrayData);
	}
	
	function eliminarVideo($id_video){
		$oRel=new Rel_categoria_videoManager($this->oDBM);
		$oRel->eliminarVideo($id_video);
		return $this->delete($id_video);
	}
	
	
	
	function getVideosActivos($from=null,$qty=null,$idCat=null){
		return $this->getVideos($from,$qty,$idCat,true);
	}
	
	function activar($idVideo){
		$sql="UPDATE ".$this->tabla." SET  activo=1  WHERE id_video=$idVideo";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function desactivar($idVideo){
		$sql="UPDATE ".$this->tabla." SET  activo=0  WHERE id_video=$idVideo";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getCategorias($idVideo){
		$oRel=new Rel_categoria_videoManager($this->oDBM);
		$lista=$oRel->getCategorias($idVideo);
		$arrayFinal=array();
		foreach($lista as $item){
			$arrayFinal[]=$item['id_categoria_video'];
		}
		return $arrayFinal;
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
		WHERE orden<$data[orden] AND id_relacion=$data[id_relacion]
		ORDER BY orden DESC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function getNextDown($data){
		$sql="SELECT 
		* 
		FROM $this->tabla 
		WHERE orden>$data[orden] AND id_relacion=$data[id_relacion]
		ORDER BY orden ASC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function switchPosicion($arrayData, $arrayData2){
		$this->updateOrden($arrayData['id_video'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_video'],$arrayData['orden']);
	}
	
	function updateOrden($id_noticia,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_video='$id_noticia' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." WHERE id_relacion=$data[id_relacion]";
		return $this->toVar($sql)+1;
	}
	
		
	function countTotal($idCat=null,$soloActivo=false){
		if(!is_null($idCat)){
			$sql="SELECT COUNT(*) as cantidad 
			FROM ".$this->tabla." t 
			INNER JOIN portal_rel_categoria_video r ON r.id_video=t.id_video
			WHERE r.id_categoria_video=$idCat AND ISNULL(id_articulo) ";
			if($soloActivo){
				$sql.=" AND activo=1 AND fecha_publicacion<= ".PF::date("Ymdhis")." ";
			}
			//echo $sql;
			return $this->toVar($sql);
		}
		else{
			$sql="SELECT COUNT(*) as cantidad
		FROM ".$this->tabla." t
		WHERE ISNULL(id_articulo) ";
			return $this->toVar($sql);
		}
	}
	
	function getVideos($from=null,$qty=null,$idCat=null,$soloVisibles=false){
		$arrayCond=array();
		$arrayCond[]=" ISNULL(id_relacion) ";
		if(!is_null($idCat)){
			return $this->getVideosPorCategoria($from,$qty,$idCat,$soloVisibles);
		}
		if($soloVisibles){
			$arrayCond[]=" activo=1 ";
			$arrayCond[]=" fecha_publicacion<= ".PF::date("Ymdhis")." ";
		}
		return $this->getData($from,$qty,$arrayCond,' fecha DESC ');
	}
	
	function getVideosPorCategoria($from=null,$qty=null,$idCat=null,$soloActivos=false,$orderBy=null){
		$arrayCond=array();
		$arrayCond[]=" ISNULL(id_articulo) ";
		if(!is_null($idCat)){
			$arrayCond[]=" r.id_categoria_video=$idCat ";
		}
		if($soloActivos){
			$arrayCond[]=" t.activo=1 ";
			$arrayCond[]=" t.fecha_publicacion<= ".PF::date("Ymdhis")." ";
		}
		
		$sql="SELECT 
t.id_video, 
t.titulo, 
t.descripcion, 
t.id_categoria_video, 
t.duracion, 
t.fecha, 
t.id_relevancia, 
t.id_youtube, 
t.activo, 
t.id_articulo, 
t.votos, 
t.total_votos, 
t.thumb,
t.orden 
FROM ".$this->tabla." t
LEFT JOIN portal_rel_categoria_video r ON r.id_video=t.id_video";
		if(count($arrayCond)>0){
			$sql.=" WHERE ".implode(' AND ',$arrayCond)." ";
		}
		if(!is_null($orderBy)){
			$sql.=" ORDER BY $orderBy ";
		}
		else{
			$sql.=" ORDER BY fecha DESC ";
		}
		if(!is_null($from)){
			$sql.= " LIMIT $from, $qty ";
		}
		//echo $sql;
		return $this->toArray($sql);
	}
	
	function countTotalVideos($idRel=null,$idCat=null){
		$array=array();
		$array['activo']=1;
		if(!is_null($idRel)){
			$array['id_relacion']=$idRel;
		}
		if(!is_null($idCat)){
			$array['id_categoria_video']=$idCat;
		}
		return $this->countRows($array);
	}
	
	
	
}
?>