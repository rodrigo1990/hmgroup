<?php
class Banner_BannerEspacioManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	var $tablaPpal;
	var $pref;
	
	/**
	 * Constructor
	 *
	 * @return Banner_espacio
	 */
	function Banner_BannerEspacioManager($oDBM){
		$this->pref='banner_';
		$this->tabla=$this->pref.'banner_espacio';
		$this->tablaPpal=$this->pref.'banner';
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
/*INSERT INTO ".$this->tabla." (id_banner,id_espacio) VALUES ($arrayData[id_banner],$arrayData[id_espacio]) */
		
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_banner,id_espacio, id_idioma) VALUES ($arrayData[id_banner],$arrayData[id_espacio],$arrayData[id_idioma]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_banner,$id_espacio,$id_idioma){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_banner=$id_banner AND id_espacio=$id_espacio*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_banner=$id_banner AND id_espacio=$id_espacio AND id_idioma=$id_idiomad";
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
/**/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_banner,$id_espacio,$id_idioma){
		/*GETROW*/
/*SELECT 
id_banner, 
id_espacio 
FROM ".$this->tabla." 
WHERE id_banner=$id_banner 
AND id_espacio=$id_espacio */
		$sql="SELECT 
id_banner, 
id_espacio,
id_idioma 
FROM ".$this->tabla." 
WHERE id_banner=$id_banner 
AND id_espacio=$id_espacio 
AND id_idioma=$id_idioma";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_banner, 
id_espacio 
FROM ".$this->tabla." */
		$sql="SELECT 
id_banner, 
id_espacio,
id_idioma
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
	
	function getBanners($idEspacio,$todos=false,$idIdioma=NULL){
		$sql="SELECT 
		".$this->tablaPpal.".id_banner, 
		".$this->tablaPpal.".contenido, 
		".$this->tablaPpal.".tipo, 
		".$this->tablaPpal.".nombre, 
		".$this->tablaPpal.".descripcion, 
		".$this->tablaPpal.".activo, 
		".$this->tablaPpal.".impresiones, 
		".$this->tablaPpal.".max_impresiones, 
		".$this->tablaPpal.".clicks, 
		".$this->tablaPpal.".max_clicks, 
		".$this->tablaPpal.".fecha_caducidad, 
		".$this->tablaPpal.".fecha_inicio, 
		".$this->tablaPpal.".id_cliente,
		".$this->tablaPpal.".url,
		".$this->tabla.".id_idioma 
		FROM ".$this->tabla." 
		INNER JOIN ".$this->tablaPpal." ON ".$this->tablaPpal.".id_banner=".$this->tabla.".id_banner 
		WHERE id_espacio=$idEspacio ";
		if(!$todos){
			$sql.=" AND activo=1 AND (max_clicks>clicks OR max_clicks=-1) AND (max_impresiones>impresiones OR max_impresiones=-1) AND (fecha_caducidad>'".date("Ymd")."' OR fecha_caducidad='11111111')";
		}
		if(!is_null($idIdioma)){
			$sql.=" AND ".$this->tabla.".id_idioma=$idIdioma ";
		}
		$sql.=" ORDER BY clicks ASC ";
		//echo $sql;
		return $this->toArray($sql);
	}
	
	function getEspacios($idBanner){
		$sql="SELECT 
id_espacio 
FROM ".$this->tabla." WHERE id_banner=$idBanner ";
		return $this->toArray($sql);
	}
	
	/*function asignarBanner($idBanner,$idEspacio,$idIdioma){
		$data=$this->getRow($idBanner,$idEspacio,$idIdioma);
		if(!$data || count($data)==0){
			$array=array('id_banner'=>$idBanner,'id_espacio'=>$idEspacio,'id_idioma'=>$idIdioma);
			return $this->insert($array);
		}
		return true;
	}*/
	
	function eliminarBanner($id_banner){
		$sql="DELETE FROM ".$this->tabla." WHERE id_banner=$id_banner";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function eliminarEspacio($id_espacio){
		$sql="DELETE FROM ".$this->tabla." WHERE id_espacio=$id_espacio";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function asignar($idBanner,$idEspacio,$idIdioma){
		$data=$this->getRow($idBanner,$idEspacio,$idIdioma);
		if(count($data)==0){
			return $this->insert(array('id_banner'=>$idBanner,'id_espacio'=>$idEspacio,'id_idioma'=>$idIdioma));
		}
		return 0;
	}
	
	function desasignar($idBanner){
		return $this->eliminarBanner($idBanner);
	}
	
}
?>