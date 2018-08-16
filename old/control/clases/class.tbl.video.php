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
/*INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,id_youtube,activo,id_articulo,votos,total_votos,thumb) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]',$arrayData[id_categoria_video],$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],'$arrayData[id_youtube]',$arrayData[activo],$arrayData[id_articulo],$arrayData[votos],$arrayData[total_votos],'$arrayData[thumb]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_video,titulo,descripcion,id_categoria_video,duracion,fecha,id_relevancia,id_youtube,activo,id_articulo,votos,total_votos,thumb) VALUES (NULL,'$arrayData[titulo]','$arrayData[descripcion]',$arrayData[id_categoria_video],$arrayData[duracion],$arrayData[fecha],$arrayData[id_relevancia],'$arrayData[id_youtube]',$arrayData[activo],$arrayData[id_articulo],$arrayData[votos],$arrayData[total_votos],'$arrayData[thumb]') ";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , id_categoria_video=$arrayData[id_categoria_video] , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , id_youtube='$arrayData[id_youtube]' , activo=$arrayData[activo] , id_articulo=$arrayData[id_articulo] , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] , thumb='$arrayData[thumb]' WHERE id_video=$arrayData[id_video]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , descripcion='$arrayData[descripcion]' , id_categoria_video=$arrayData[id_categoria_video] , duracion=$arrayData[duracion] , fecha=$arrayData[fecha] , id_relevancia=$arrayData[id_relevancia] , id_youtube='$arrayData[id_youtube]' , activo=$arrayData[activo] , id_articulo=$arrayData[id_articulo] , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] , thumb='$arrayData[thumb]' WHERE id_video=$arrayData[id_video]";
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
id_articulo, 
votos, 
total_votos, 
thumb 
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
id_articulo, 
votos, 
total_votos, 
thumb 
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
	
	function nuevoVideo($arrayData){
		return $this->insert($arrayData);
	}
	
	function actualizarVideo($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminarVideo($id_video){
		return $this->delete($id_video);
	}
	
	function nuevoVideoArticulo($arrayData){
		
		//'http://www.youtube.com/watch?v=8nIZ8qL9-F8';
		$partesID=explode('?v=',$arrayData['id_youtube']);
		if(count($partesID)==2){
			$arrayData['id_youtube']=$partesID[2];
		}
		
		$arrayData['descripcion']=''; 
		$arrayData['id_categoria_video']=0;  
		$arrayData['duracion']=0;  
		$arrayData['fecha']=PF::date('Ymd');  
		$arrayData['id_relevancia']=0;  
		$arrayData['activo']=1;  
		$arrayData['votos']=0;  
		$arrayData['total_votos']=0;  
		$arrayData['thumb']=''; 
		
		return $this->insert($arrayData);
	}
	
	function actualizarVideoArticulo($arrayData){
		
		$partesID=explode('?v=',$arrayData['id_youtube']);
		if(count($partesID)==2){
			$arrayData['id_youtube']=$partesID[2];
		}
		
		$arrayData['descripcion']=''; 
		$arrayData['id_categoria_video']=0;  
		$arrayData['duracion']=0;  
		$arrayData['fecha']=PF::date('Ymd');  
		$arrayData['id_relevancia']=0;  
		$arrayData['activo']=1;  
		$arrayData['votos']=0;  
		$arrayData['total_votos']=0;  
		$arrayData['thumb']=''; 
		return $this->update($arrayData);
	}
	
	function updateThumbVideoArticulo($idYoutube,$thumb){
		$sql="UPDATE ".$this->tabla." SET thumb='$thumb' WHERE id_youtube=$idYoutube";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function eliminarVideoArticulo($idVideo){
		return $this->delete($idVideo);
	}
	
	function getVideosArticulo($idArticulo,$from=null,$qty=null,$soloVisibles=false){
		$arrayCond=array();
		$arrayCond[]=" id_articulo=$idArticulo ";
		if($soloVisibles){
			$arrayCond[]=" activo=1 ";
		}
		return $this->getData($from,$qty,$arrayCond);
	}
	
	
	
}
?>