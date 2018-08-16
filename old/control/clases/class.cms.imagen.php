<?php
class CMSImagen extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return CMSImagen
	 */
	function CMSImagen($oDBM){
		$this->pref='cms_';
		$this->tabla=$this->pref.'imagen';
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
/*INSERT INTO ".$this->tabla." (id_imagen,id_relacion,id_tipo,nombre,descripcion,fecha,activa,orden,id_categoria) VALUES (NULL,$arrayData[id_relacion],$arrayData[id_tipo],'$arrayData[nombre]','$arrayData[descripcion]',$arrayData[fecha],$arrayData[activa],$arrayData[orden],$arrayData[id_categoria]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$arrayData['orden']=$this->getNextOrden($arrayData);
		$sql="INSERT INTO ".$this->tabla." (id_imagen,id_relacion,id_tipo,nombre,descripcion,fecha,activa,orden,id_categoria) VALUES (NULL,$arrayData[id_relacion],$arrayData[id_tipo],'$arrayData[nombre]','$arrayData[descripcion]',$arrayData[fecha],$arrayData[activa],$arrayData[orden],$arrayData[id_categoria]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_imagen){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_imagen=$id_imagen*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_imagen=$id_imagen";
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
/*UPDATE ".$this->tabla." SET id_relacion=$arrayData[id_relacion] , id_tipo=$arrayData[id_tipo] , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' , fecha=$arrayData[fecha] , activa=$arrayData[activa] , orden=$arrayData[orden] , id_categoria=$arrayData[id_categoria] WHERE id_imagen=$arrayData[id_imagen]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET id_relacion=$arrayData[id_relacion] , id_tipo=$arrayData[id_tipo] , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' , fecha=$arrayData[fecha] , activa=$arrayData[activa] , orden=$arrayData[orden] , id_categoria=$arrayData[id_categoria] WHERE id_imagen=$arrayData[id_imagen]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_imagen){
		/*GETROW*/
/*SELECT 
id_imagen, 
id_relacion, 
id_tipo, 
nombre, 
descripcion, 
fecha, 
activa, 
orden, 
id_categoria 
FROM ".$this->tabla." 
WHERE id_imagen=$id_imagen */
		$sql="SELECT 
id_imagen, 
id_relacion, 
id_tipo, 
nombre, 
descripcion, 
fecha, 
activa, 
orden, 
id_categoria 
FROM ".$this->tabla." 
WHERE id_imagen=$id_imagen ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_imagen, 
id_relacion, 
id_tipo, 
nombre, 
descripcion, 
fecha, 
activa, 
orden, 
id_categoria 
FROM ".$this->tabla." */
		$sql="SELECT 
id_imagen, 
id_relacion, 
id_tipo, 
nombre, 
descripcion, 
fecha, 
activa, 
orden, 
id_categoria 
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
	
	function getImagenes($idTipo,$idRelacion=null,$idCat=null,$soloActivas=false,$from=null,$qty=null){
		
		$arrayCondiciones=array();
		$sql="SELECT 
id_imagen, 
id_relacion, 
id_tipo, 
nombre, 
descripcion, 
fecha, 
activa, 
orden, 
id_categoria 
FROM ".$this->tabla." ";
		
		$arrayCondiciones[]=" id_tipo=$idTipo ";
		
		if(!is_null($idRelacion)){
			$arrayCondiciones[]=" id_relacion=$idRelacion ";
		}
		if(!is_null($idCat)){
			$arrayCondiciones[]=" id_categoria=$idCat ";
		}
		if($soloActivas){
			$arrayCondiciones[]=" activa=1 ";
		}
		
		if(count($arrayCondiciones)>0){
			$sql.=" WHERE ".implode(' AND ',$arrayCondiciones);
		}
		$sql.=" ORDER BY orden ASC ";
		if(!is_null($from)){
			$sql.= " LIMIT $from, $qty ";
		}
		//echo $sql;
		return $this->toArray($sql);
	}
	
	function activarImagen($idImagen){
		$sql="UPDATE ".$this->tabla." SET activa=1 WHERE id_imagen=$idImagen";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function desactivarImagen($idImagen){
		$sql="UPDATE ".$this->tabla." SET activa=0 WHERE id_imagen=$idImagen";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
		
	function eliminarImagen($idImagen){
		$data=$this->getRow($idImagen);
		if(count($data)==0){
			return true;
		}
		return $this->delete($idImagen);
	}
	
		
	function cargarImagen($file,$fileName,$ancho,$alto,$tipo='aEscalaTotal'){
		$img=new Tijera();
		$img->setOrigen($file);
		$img->setBackGround('0x000000');
		$img->setDestino($fileName);
		switch($tipo){
			case 'aEscalaTotal':
				$img->aEscalaTotal($ancho,$alto);
			break;
			case 'aEscalaAncho':
				$img->aEscalaAncho($ancho);
			break;
			case 'aEscalaAlto':
				$img->aEscalaAlto($alto);
			break;
			case 'aEscalaModificada':
				$img->aEscalaModificada($ancho,$alto);
			break;
			case 'aEscalaSimple':
				$img->aEscalaSimple($ancho,$alto);
			break;
		}
		$rec1=$img->recortar();
		return basename($fileName);
	}
	
	function subirOrden($idImg){
		$aData=$this->getRow($idImg);
		//echo $aFotoData['orden'];
		$nextData=$this->getNextUp($aData);
		//echo '-'.$nextFotoData['orden'];
		if(count($nextData)!=0){
			$this->switchPosicion($aData,$nextData);
		}
	}
	
	function bajarOrden($idImg){
		$aData=$this->getRow($idImg);
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
		AND id_tipo=$data[id_tipo] 
		AND id_relacion=$data[id_relacion] 
		AND id_categoria=$data[id_categoria]
		ORDER BY orden DESC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function getNextDown($data){
		$sql="SELECT 
		* 
		FROM $this->tabla 
		WHERE orden>$data[orden] 
		AND id_tipo=$data[id_tipo] 
		AND id_relacion=$data[id_relacion] 
		AND id_categoria=$data[id_categoria]
		ORDER BY orden ASC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function switchPosicion($arrayData, $arrayData2){
		$this->updateOrden($arrayData['id_imagen'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_imagen'],$arrayData['orden']);
	}
	
	function updateOrden($idImg,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_imagen=$idImg";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." WHERE id_tipo=$data[id_tipo] AND id_relacion=$data[id_relacion] AND id_categoria=$data[id_categoria] ";
		return $this->toVar($sql)+1;
	}
	
}
?>