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
/*INSERT INTO ".$this->tabla." (id_articulo,titulo,copete,texto,fecha,id_tipo_articulo,id_procedencia,id_relevancia,activo,tags,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[copete]','$arrayData[texto]',$arrayData[fecha],$arrayData[id_tipo_articulo],$arrayData[id_procedencia],$arrayData[id_relevancia],$arrayData[activo],'$arrayData[tags]',$arrayData[votos],$arrayData[total_votos]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_articulo,titulo,copete,texto,fecha,id_tipo_articulo,id_procedencia,id_relevancia,activo,tags,votos,total_votos) VALUES (NULL,'$arrayData[titulo]','$arrayData[copete]','$arrayData[texto]',$arrayData[fecha],$arrayData[id_tipo_articulo],$arrayData[id_procedencia],$arrayData[id_relevancia],$arrayData[activo],'$arrayData[tags]',$arrayData[votos],$arrayData[total_votos]) ";
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
/*UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , copete='$arrayData[copete]' , texto='$arrayData[texto]' , fecha=$arrayData[fecha] , id_tipo_articulo=$arrayData[id_tipo_articulo] , id_procedencia=$arrayData[id_procedencia] , id_relevancia=$arrayData[id_relevancia] , activo=$arrayData[activo] , tags='$arrayData[tags]' , votos=$arrayData[votos] , total_votos=$arrayData[total_votos] WHERE id_articulo=$arrayData[id_articulo]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET titulo='$arrayData[titulo]' , copete='$arrayData[copete]' , texto='$arrayData[texto]' , fecha=$arrayData[fecha] , id_tipo_articulo=$arrayData[id_tipo_articulo] , id_procedencia=$arrayData[id_procedencia] , id_relevancia=$arrayData[id_relevancia] , tags='$arrayData[tags]' WHERE id_articulo=$arrayData[id_articulo]";
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
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_articulo, 
titulo, 
copete, 
texto, 
fecha, 
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
id_tipo_articulo, 
id_procedencia, 
id_relevancia, 
activo, 
tags, 
votos, 
total_votos 
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
	
	function nuevoArticulo($arrayData){
		$arrayData['votos']=0;
		$arrayData['total_votos']=0;
		$arrayData['activo']=1;
		$idArt=$this->insert($arrayData);
		if(!$idArt){
			return false;
		}
		if(isset($arrayData['categorias']) && is_array($arrayData['categorias'])){
			$oRel=new Rel_categoria_articuloManager($this->oDBM);
			foreach($arrayData['categorias'] as $idCat){
				$oRel->add($idArt,$idCat);
			}
		}
		return $idArt;
	}
	
	function actualizarArticulo($arrayData){
		$ok= $this->update($arrayData);
		if($ok===false){
			return false;
		}
		if(isset($arrayData['categorias']) && is_array($arrayData['categorias'])){
			$oRel=new Rel_categoria_articuloManager($this->oDBM);
			$oRel->eliminarArticulo($arrayData['id_articulo']);
			foreach($arrayData['categorias'] as $idCat){
				$oRel->add($arrayData['id_articulo'],$idCat);
			}
		}
		return $ok;
	}
	
	function eliminarArticulo($id_articulo){
		return $this->delete($id_articulo);
	}
	
	function activarArticulo($id_articulo){
		$sql="UPDATE ".$this->tabla." SET  activo=1  WHERE id_articulo=$id_articulo";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function desactivarArticulo($id_articulo){
		$sql="UPDATE ".$this->tabla." SET  activo=0  WHERE id_articulo=$id_articulo";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getArticulos($from=null,$qty=null,$idCat=null,$soloActivos=false){
		
		if(!is_null($idCat)){
			return $this->getArticulosPorCategoria($from,$qty,$idCat,false);
		}
		else{
			$arrayCond=array();
			if($soloActivos){
				$arrayCond[]=" activo=1 ";
			}
			return $this->getData($from,$qty,$arrayCond);
		}
	}
	
	function getArticulosPorCategoria($from=null,$qty=null,$idCat=null,$soloActivos=false,$orderBy=null){
		$arrayCond=array();
		if(!is_null($idCat)){
			$arrayCond[]=" r.id_categoria=$idCat ";
		}
		if($soloActivos){
			$arrayCond[]=" t.activo=1 ";
		}
		
		$sql="SELECT 
t.id_articulo, 
t.titulo, 
t.copete, 
t.texto, 
t.fecha, 
t.id_tipo_articulo, 
t.id_procedencia, 
t.id_relevancia, 
t.activo, 
t.tags, 
t.votos, 
t.total_votos 
FROM ".$this->tabla." t
INNER JOIN portal_rel_categoria_articulo r ON r.id_articulo=t.id_articulo";
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
	
	
	function countTotal($idCat=null){
		if(!is_null($idCat)){
			$sql="SELECT COUNT(*) as cantidad 
			FROM ".$this->tabla." t 
			INNER JOIN portal_rel_categoria_articulo r ON r.id_articulo=t.id_articulo
			WHERE r.id_categoria=$idCat";
			return $this->toVar($sql);
		}
		else{
			return $this->countRows();
		}
	}
	
	function getCategorias($idArt){
		$oRel=new Rel_categoria_articuloManager($this->oDBM);
		$lista=$oRel->getCategorias($idArt);
		$arrayFinal=array();
		foreach($lista as $item){
			$arrayFinal[]=$item['id_categoria'];
		}
		return $arrayFinal;
	}
	
	/****************** IMAGENES *****************************/
	
	function getImagenes($from=null,$qty=null,$idArticulo=null){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->getImagenesArticulos($from,$qty,$idArticulo);
	}
	
	function nuevaImagenArticulo($arrayData,$arrayFiles){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->nuevaImagenArticulo($arrayData,$arrayFiles);
	}
	
	function updateImagenArticulo($arrayData,$arrayFiles){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->updateImagenArticulo($arrayData,$arrayFiles);
	}
	
	function eliminarImagenArticulo($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->eliminarImagen($idImg);
	}
	
	function activarImagen($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->activarImagen($idImg);
	}
	
	function desactivarImagen($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->desactivarImagen($idImg);
	}
	
	function getImagen($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->getRow($idImg);
	}
	
	function countTotalImagenes($idArticulo=null){
		$oA=new AdapterImagen($this->oDBM);
		$arrayFilter=array();
		$arrayFilter['id_tipo']=1;
		if(!is_null($idArticulo)){
			$arrayFilter['id_relacion']=$idArticulo;
		}
		return $oA->countRows($arrayFilter);
	}
	
	function bajarPosImg($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->bajarOrden($idImg);
	}
	
	function subirPosImg($idImg){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->subirOrden($idImg);
	}
	
	function cargarImagenArticulo($arrayData,$arrayFiles){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->nuevaImagenArticulo($arrayData,$arrayFiles);
	}
	
	function eliminarArchivoImagenArticulo($idImagen){
		$oA=new AdapterImagen($this->oDBM);
		return $oA->eliminarArchivoImagen($idImagen);
	}
	
	function cambiarEstadoImagen($idImg){
		$data=$this->getImagen($idImg);
		$oA=new AdapterImagen($this->oDBM);
		if($data['activa']==1){
			$oA->desactivarImagen($idImg);
		}
		else{
			$oA->activarImagen($idImg);
		}
	}
	/************************* FIN IMAGENES ******************************/
}
?>