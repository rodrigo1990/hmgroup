<?php
class Categoria_videoManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Categoria_video
	 */
	function Categoria_videoManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'categoria_video';
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
/*INSERT INTO ".$this->tabla." (id_categoria_video,nombre,id_padre,descripcion,activo,orden,id_usuario,folder) VALUES (NULL,'$arrayData[nombre]',$arrayData[id_padre],'$arrayData[descripcion]',$arrayData[activo],$arrayData[orden],$arrayData[id_usuario],'$arrayData[folder]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$orden=$this->getNextOrden($arrayData);
		$sql="INSERT INTO ".$this->tabla." (id_categoria_video,nombre,id_padre,descripcion,activo,orden) VALUES (NULL,'$arrayData[nombre]',$arrayData[id_padre],'$arrayData[descripcion]',$arrayData[activo],$orden) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_categoria_video){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_categoria_video=$id_categoria_video*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_categoria_video=$id_categoria_video";
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
/*UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , id_padre=$arrayData[id_padre] , descripcion='$arrayData[descripcion]' , activo=$arrayData[activo] , orden=$arrayData[orden] , id_usuario=$arrayData[id_usuario] , folder='$arrayData[folder]' WHERE id_categoria_video=$arrayData[id_categoria_video]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET nombre='$arrayData[nombre]' , id_padre=$arrayData[id_padre] , descripcion='$arrayData[descripcion]' , activo=$arrayData[activo]  WHERE id_categoria_video=$arrayData[id_categoria_video]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_categoria_video){
		/*GETROW*/
/*SELECT 
id_categoria_video, 
nombre, 
id_padre, 
descripcion, 
activo, 
orden, 
id_usuario, 
folder 
FROM ".$this->tabla." 
WHERE id_categoria_video=$id_categoria_video */
		$sql="SELECT 
id_categoria_video, 
nombre, 
id_padre, 
descripcion, 
activo, 
orden
FROM ".$this->tabla." 
WHERE id_categoria_video=$id_categoria_video ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_categoria_video, 
nombre, 
id_padre, 
descripcion, 
activo, 
orden, 
id_usuario, 
folder 
FROM ".$this->tabla." */
		$sql="SELECT 
id_categoria_video, 
nombre, 
id_padre, 
descripcion, 
activo, 
orden
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
	
	function getListaCategorias($idCat=0,$soloVisibles=false){
		$aCat=$this->getCategorias($idCat,$soloVisibles);
		foreach($aCat as $ind => $item){
			if($this->tieneSubCats($item['id_categoria_video'])!=0){
				$aCat[$ind]['subcats']=$this->getListaCategorias($item['id_categoria_video'],$soloVisibles);
			}
		}
		return $aCat;
	}
	
	function getCategorias($idPadre,$soloVisibles=false){
		$sql="SELECT 
		id_categoria_video, 
		nombre, 
		id_padre, 
		descripcion, 
		activo, 
		orden
		FROM ".$this->tabla." WHERE id_padre=$idPadre ";
		if($soloVisibles){
			$sql.= " AND activo=1 ";
		}
		$sql.=" ORDER BY orden ";
		return $this->toArray($sql);
	}
	
	function tieneSubCats($idCat){
		$sql="SELECT 
		COUNT(*) 
		FROM ".$this->tabla." WHERE id_padre=$idCat";
		return $this->toVar($sql);
	}
	
	function getSelectCategorias($banned=-1,$withoutMain=true){
		
		if(!$withoutMain){
			$this->cadena='<option value="0">Categoría Principal</a>';
		}
		else{
			$this->cadena='';
		}
		
		$this->getOptionValues(0,$banned,'');
		return $this->cadena;
	}
	
	function getOptionValues($idCat,$banned,$relleno){
		$aCat=$this->getCategorias($idCat);
		$relleno.='&nbsp;>>';
		foreach($aCat as $ind => $item){
			if($item['id_categoria_video']!=$banned){
				$this->cadena.='<option value="'.$item['id_categoria_video'].'">'.$relleno.$item['nombre'].'</option>';
			}
			$this->getOptionValues($item['id_categoria_video'],$banned,$relleno);
		}
	}
	
	function actualizarCategoria($arrayData){
		//$arrayData['descripcion']='';
		/*if(isset($arrayData['habilitar']) && $arrayData['id_padre']==0){
			$this->actualizarRelaciones($arrayData['id_categoria_video'],$arrayData['habilitar']);
		}*/
		return $this->update($arrayData);
	}
	
	function nuevaCategoria($arrayData){
		//$arrayData['descripcion']='';
		$idCat=$this->insert($arrayData);
		if(!$idCat){
			return false;
		}
		/*if(isset($arrayData['habilitar']) && $arrayData['id_padre']==0){
			$this->actualizarRelaciones($idCat,$arrayData['habilitar']);
		}*/
		return $idCat;
	}
	
	/*function actualizarRelaciones($idCat,$array){
		$oRel=new Rel_usuario_categoriaManager($this->oDBM);
		$oRel->eliminarRelaciones($idCat);
		foreach($array as $idUsuario){
			$oRel->add($idUsuario,$idCat);
		}
	}*/
	
	/*function getRelaciones($idCat){
		$oRel=new Rel_usuario_categoriaManager($this->oDBM);
		return $oRel->getRelaciones($idCat);
	}*/
	
	function eliminarCategoria($idCat){
		if($this->tieneSubCats($idCat)>0){
			$this->aErrors[0]='La categoría tiene sub-categorías y por lo tanto no puede ser eliminada, elimine primero las sub-categorías';
			return false;
		}
		else{
			/*$oRel=new Rel_usuario_categoriaManager($this->oDBM);
			$oRel->eliminarRelaciones($idCat);*/
			return $this->delete($idCat);
		}
	}
	
	function activarCategoria($idCategoria){
		$sql="UPDATE ".$this->tabla." SET activo=1 WHERE id_categoria_video=$idCategoria";
		return $this->oDBM->query($sql);
	}
	
	function desactivarCategoria($idCategoria){
		$sql="UPDATE ".$this->tabla." SET activo=0 WHERE id_categoria_video=$idCategoria";
		return $this->oDBM->query($sql);
	}
	
	function getSubCategorias($idCat){
		$sql="SELECT 
		id_categoria_video, 
		nombre, 
		id_padre, 
		descripcion,
		activo
		FROM ".$this->tabla." WHERE id_padre=$idCat ";
		$sql.= " ORDER BY orden ";
		return $this->toArray($sql);
	}
	
	function subirOrden($idFaq){
		$aData=$this->getRow($idFaq);
		//echo $aFotoData['orden'];
		$nextData=$this->getNextUp($aData);
		//echo '-'.$nextFotoData['orden'];
		if(count($nextData)!=0){
			$this->switchPosicion($aData,$nextData);
		}
	}
	
	function bajarOrden($idFaq){
		$aData=$this->getRow($idFaq);
		$previousData=$this->getNextDown($aData);
		if(count($previousData)!=0){
			$this->switchPosicion($aData,$previousData);
		}
	}
	
	function getNextUp($data){
		$sql="SELECT
		*
		FROM $this->tabla 
		WHERE orden<$data[orden] AND  id_padre=$data[id_padre] 
		ORDER BY orden DESC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function getNextDown($data){
		$sql="SELECT 
		* 
		FROM $this->tabla 
		WHERE orden>$data[orden] AND  id_padre=$data[id_padre]
		ORDER BY orden ASC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function switchPosicion($arrayData, $arrayData2){
		$this->updateOrden($arrayData['id_categoria_video'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_categoria_video'],$arrayData['orden']);
	}
	
	function updateOrden($idCategoria,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_categoria_video=$idCategoria";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." WHERE id_padre=$data[id_padre]";
		return $this->toVar($sql)+1;
	}
}
?>