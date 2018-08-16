<?php
class Banner_Manager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	var $id_imagen;
	var $id_swf;
	var $id_html;
	var $default;
	var $bouncer;
	var $rightLimit;
	var $leftLimit;
	
	/**
	 * Constructor
	 *
	 * @return Banner
	 */
	function Banner_Manager($oDBM){
		$this->pref='banner_';
		$this->tabla=$this->pref.'banner';
		$this->oDBM=$oDBM;
		$this->aErrors=array();
		parent::PFTableManager($oDBM,$this->tabla);
		$this->id_imagen=1;
		$this->id_swf=2;
		$this->id_html=3;
		$this->default='NO BANNER';
		$this->bouncer='bouncer.php';
		$this->rightLimit=date("d");
		$this->leftLimit=date("h");
	}
	
	
	/**
	 * Publico: inserta los datos en una tabla
	 *
	 * @param array $arrayData
	 */
	function insert($arrayData){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_banner,contenido,tipo,nombre,descripcion,activo,impresiones,max_impresiones,clicks,max_clicks,fecha_caducidad,fecha_inicio,id_cliente) VALUES (NULL,'$arrayData[contenido]',$arrayData[tipo],'$arrayData[nombre]','$arrayData[descripcion]',$arrayData[activo],$arrayData[impresiones],$arrayData[max_impresiones],$arrayData[clicks],$arrayData[max_clicks],$arrayData[fecha_caducidad],$arrayData[fecha_inicio],$arrayData[id_cliente]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_banner,contenido,tipo,nombre,descripcion,activo,impresiones,max_impresiones,clicks,max_clicks,fecha_caducidad,fecha_inicio,id_cliente,url) VALUES (NULL,'$arrayData[contenido]',$arrayData[tipo],'$arrayData[nombre]','$arrayData[descripcion]',$arrayData[activo],$arrayData[impresiones],$arrayData[max_impresiones],$arrayData[clicks],$arrayData[max_clicks],$arrayData[fecha_caducidad],$arrayData[fecha_inicio],$arrayData[id_cliente],'$arrayData[url]') ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_banner){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_banner=$id_banner*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_banner=$id_banner";
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
/*UPDATE ".$this->tabla." SET contenido='$arrayData[contenido]' , tipo=$arrayData[tipo] , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' , activo=$arrayData[activo] , impresiones=$arrayData[impresiones] , max_impresiones=$arrayData[max_impresiones] , clicks=$arrayData[clicks] , max_clicks=$arrayData[max_clicks] , fecha_caducidad=$arrayData[fecha_caducidad] , fecha_inicio=$arrayData[fecha_inicio] , id_cliente=$arrayData[id_cliente] WHERE id_banner=$arrayData[id_banner]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET contenido='$arrayData[contenido]' , tipo=$arrayData[tipo] , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' , activo=$arrayData[activo] , impresiones=$arrayData[impresiones] , max_impresiones=$arrayData[max_impresiones] , clicks=$arrayData[clicks] , max_clicks=$arrayData[max_clicks] , fecha_caducidad=$arrayData[fecha_caducidad] , fecha_inicio=$arrayData[fecha_inicio] , id_cliente=$arrayData[id_cliente], url='$arrayData[url]' WHERE id_banner=$arrayData[id_banner]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_banner){
		/*GETROW*/
/*SELECT 
id_banner, 
contenido, 
tipo, 
nombre, 
descripcion, 
activo, 
impresiones, 
max_impresiones, 
clicks, 
max_clicks, 
fecha_caducidad, 
fecha_inicio, 
id_cliente 
FROM ".$this->tabla." 
WHERE id_banner=$id_banner */
		$sql="SELECT 
b.id_banner, 
b.contenido, 
b.tipo, 
b.nombre, 
b.descripcion, 
b.activo, 
b.impresiones, 
b.max_impresiones, 
b.clicks, 
b.max_clicks, 
b.fecha_caducidad, 
b.fecha_inicio, 
b.id_cliente,
e.id_espacio,
e.id_idioma,
i.nombre as idioma,
es.nombre as espacio,
b.url
FROM ".$this->tabla." b
INNER JOIN ".$this->pref."banner_espacio e ON e.id_banner=b.id_banner
INNER JOIN ".$this->pref."espacio es ON es.id_espacio=e.id_espacio
INNER JOIN control_idioma i ON e.id_idioma=i.id_idioma
WHERE b.id_banner=$id_banner ";
		//echo $sql;
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
contenido, 
tipo, 
nombre, 
descripcion, 
activo, 
impresiones, 
max_impresiones, 
clicks, 
max_clicks, 
fecha_caducidad, 
fecha_inicio, 
id_cliente 
FROM ".$this->tabla." */
		$sql="SELECT 
id_banner, 
contenido, 
tipo, 
nombre, 
descripcion, 
activo, 
impresiones, 
max_impresiones, 
clicks, 
max_clicks, 
fecha_caducidad, 
fecha_inicio, 
id_cliente,
url 
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
	
	function nuevoBanner($arrayData,$arrayFiles){
		$arrayData['impresiones']=0;
		$arrayData['clicks']=0;
		if(!isset($arrayData['fecha_inicio'])){
			$arrayData['fecha_inicio']=date("Ymd");
		}
		if(!isset($arrayData['activo'])){
			$arrayData['activo']=0;
		}
		if(!isset($arrayData['fecha_caducidad'])){
			$arrayData['fecha_caducidad']=11111111;
		}
		if($arrayData['tipo']==$this->id_imagen || $arrayData['tipo']==$this->id_swf){
			if(!file_exists($arrayFiles['contenido']['tmp_name'])){
				$this->aErrors[]='El archivo no existe';
				return false;
			}
			if($arrayData['tipo']==$this->id_swf && PF::extension($arrayFiles['contenido']['name'])!='swf'){
				$this->aErrors[]='El archivo no es del tipo correcto';
				return false;
			}
			if($arrayData['tipo']==$this->id_imagen && (
			PF::extension($arrayFiles['contenido']['name'])!='jpeg' &&
			PF::extension($arrayFiles['contenido']['name'])!='jpg' &&
			PF::extension($arrayFiles['contenido']['name'])!='gif' &&
			PF::extension($arrayFiles['contenido']['name'])!='png')){
				$this->aErrors[]='El archivo no es del tipo correcto';
				return false;
			}
			$file=$this->loadFile($arrayFiles['contenido'],$arrayData['tipo']);
			if(!$file){
				return false;
			}
			$arrayData['contenido']=$file;
		}
		$id=$this->insert($arrayData);
		if(!$id){
			$this->deleteFile($arrayData['contenido']);
			return false;
		}
		//Asignación a Espacio
		$oBaE=new Banner_BannerEspacioManager($this->oDBM);
		$oBaE->asignar($id,$arrayData['id_espacio'],$arrayData['id_idioma']);
		return $id;
		
	}
	
	function loadFile($arrayFile,$tipo){
		$fileName=uniqid('BAN').'.'.PF::extension($arrayFile['name']);
		$ok=copy($arrayFile['tmp_name'],PF::getPath(BANNER_RUTA_CONTENIDO.'/'.$fileName));
		if($ok){
			return $fileName;
		}
		else{
			$this->aErrors[]='El archivo no se pudo copiar';
			return false;
		}
	}
	
	function deleteFile($fileName){
		$ruta=PF::getPath(BANNER_RUTA_CONTENIDO.'/'.$fileName);
		if(file_exists($ruta) && is_file($ruta)){
			return unlink($ruta);
		}
	}
	
	function updateParcial($arrayData){
		if(!$this->validate($arrayData,'up')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET contenido='$arrayData[contenido]' , tipo=$arrayData[tipo] , nombre='$arrayData[nombre]' , descripcion='$arrayData[descripcion]' , activo=$arrayData[activo] , max_impresiones=$arrayData[max_impresiones] , max_clicks=$arrayData[max_clicks] , fecha_caducidad=$arrayData[fecha_caducidad] , id_cliente=$arrayData[id_cliente], url='$arrayData[url]' WHERE id_banner=$arrayData[id_banner]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function actualizarBanner($arrayData,$arrayFiles){
		
		//print_r($arrayData);
		$data=$this->getRow($arrayData['id_banner']);
		
		if(!isset($arrayData['activo'])){
			$arrayData['activo']=$data['activo'];
		}
		if(!isset($arrayData['fecha_caducidad'])){
			$arrayData['fecha_caducidad']=$data['fecha_caducidad'];
		}
		if(!isset($arrayData['max_impresiones'])){
			$arrayData['max_impresiones']=$data['max_impresiones'];
		}
		if(!isset($arrayData['max_clicks'])){
			$arrayData['max_clicks']=$data['max_clicks'];
		}
		if(!isset($arrayData['url'])){
			$arrayData['url']=$data['url'];
		}
		if(!isset($arrayData['tipo'])){
			$arrayData['tipo']=$data['tipo'];
		}
		$arrayData['contenido']=$data['contenido'];
		
		if($arrayData['tipo']==$this->id_imagen || $arrayData['tipo']==$this->id_swf){
			if(isset($arrayFiles['contenido']) && file_exists($arrayFiles['contenido']['tmp_name'])){
				$file=$this->loadFile($arrayFiles['contenido'],$arrayData['tipo']);
				if(!$file){
					return false;
				}
				$arrayData['contenido']=$file;
				$this->deleteFile($data['contenido']);
			}
		}

		
		$ok=$this->updateParcial($arrayData);
		if($ok===false){
			$this->deleteFile($arrayData['contenido']);
			return false;
		}
		
		$oBaE=new Banner_BannerEspacioManager($this->oDBM);
		$oBaE->desasignar($arrayData['id_banner']);
		$oBaE->asignar($arrayData['id_banner'],$arrayData['id_espacio'],$arrayData['id_idioma']);
		
		return $ok;
	}
	
	function listaBanners($from=null,$qty=null,$idUser=null){
		$sql="SELECT 
id_banner, 
contenido, 
tipo, 
nombre, 
descripcion, 
activo, 
impresiones, 
max_impresiones, 
clicks, 
max_clicks, 
fecha_caducidad, 
fecha_inicio, 
id_cliente,
url 
FROM ".$this->tabla." ";
		if(!is_null($idUser)){
			$sql.=" WHERE id_cliente=$idUser ";
		}
		if(!is_null($from)){
			$sql.=" LIMIT $from, $qty ";
		}
		return $this->toArray($sql);
	}
	
	function getBanners($idEspacio){
		$oBE=new Banner_BannerEspacioManager($this->oDBM);
		return $oBE->getBanners($idEspacio,true);
	}
	
		
	function getEspacios($idBanner){
		$oBE=new Banner_BannerEspacioManager($this->oDBM);
		return $oBE->getEspacios($idBanner,true);
	}
	
	function selectBanner($idEspacio,$random=true,$idIdioma=1){
		$oBE=new Banner_BannerEspacioManager($this->oDBM);
		$arrayBanners=$oBE->getBanners($idEspacio,false,$idIdioma);
		
		if(count($arrayBanners)==0){
			return array();
		}
		if($random){
			$cant=count($arrayBanners);
			$cant--;
			$elegido=rand(0,$cant);
			return $arrayBanners[$elegido];
		}
		else{
			$banner=$arrayBanners[0];
		}
		
		return $banner;
	}
	
	function showBanner($idEspacio,$ruta=false,$random=true,$return=false,$noDevolverSiVacio=false,$idioma=1){
		
		
		$banner=$this->selectBanner($idEspacio,$random,$idioma);
		if(count($banner)==0){
			if($noDevolverSiVacio){
				$content='';
			}
			else{
				$content=PF::getPath($this->default);
			}
			if($return){
				return $content;
			}
			else{
				echo $content;
				return;
			}
		}
		
		$oE=new Banner_EspacioManager($this->oDBM);
		$medidasEspacio=$oE->getRow($idEspacio);
		$limiteAncho='';
		$limiteAlto='';
		if($medidasEspacio['ancho']!=0){
			$limiteAncho='width:'.$medidasEspacio['ancho'].'px;';
		}
		if($medidasEspacio['alto']!=0){
			$limiteAncho='height:'.$medidasEspacio['alto'].'px;';
		}
		$limite=$limiteAlto.$limiteAncho;
		if(trim($limite)!=''){
			$limite='<div style="'.$limite.'overflow:hidden;">';
		}
		else{
			$limite='<div>';
		}
		
		if(!$ruta){
			$ruta=PF::getPath(BANNER_RUTA_CONTENIDO);
		}
		$this->impresion($banner['id_banner']);
		$href=$this->bouncer.'?h='.urlencode(base64_encode($this->leftLimit.$banner['id_banner'].$this->rightLimit));
		$href=URL_ABSOLUTA.PF_CONFIG_SYSTEM_PATH.'/'.$href;
		switch($banner['tipo']){
			case $this->id_imagen:
				$content=$limite.'<a href="'.$href.'" target="_blank"><img src="'.$ruta.'/'.$banner['contenido'].'" border="0"></a></div>';
			break;
			case $this->id_swf:
				$medidas=getimagesize($ruta.'/'.$banner['contenido']);
				$content=$limite.'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="'.$medidas[0].'" height="'.$medidas[1].'">
  <param name="movie" value="'.$ruta.'/'.$banner['contenido'].'" />
  <param name="quality" value="high" />
   <param name="wmode" value="transparent" />
  <param name="flashvars" value="link='.$href.'" />
  <embed src="'.$ruta.'/'.$banner['contenido'].'" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="'.$medidas[0].'" height="'.$medidas[1].'" flashvars="link='.$href.'" wmode="transparent"></embed>
</object><a href="'.$href.'" style="position:relative;top:-'.$medidas[1].'px;left:0px;"><img src="'.I::getPath('img/transp.gif').'" style="height:'.$medidas[1].'px;width:'.$medidas[0].'px;"></a></div>';
			break;
			case $this->id_html:
				$content=$banner['contenido'];
			break;
		}
		
		if($return){
			return $content;
		}
		else{
			echo $content;
			return;
		}
		
	}
	
	function impresion($idBanner){
		
		$oImpresion=new Impresion($this->oDBM);
		$oImpresion->add($idBanner);
		
		$sql="UPDATE ".$this->tabla." SET impresiones=impresiones+1 WHERE id_banner=$idBanner";
		return $this->oDBM->query($sql);
	}
	
	function click($idBanner){
		
		$oClick=new Banner_Click($this->oDBM);
		$oClick->add($idBanner);
		
		$sql="UPDATE ".$this->tabla." SET clicks=clicks+1 WHERE id_banner=$idBanner";
		return $this->oDBM->query($sql);
	}
	
	function bounce($param){
		$cadena=base64_decode(urldecode($param));
		$cadena=ereg_replace('^'.$this->leftLimit,'',$cadena);
		$cadena=ereg_replace($this->rightLimit.'$','',$cadena);
		$this->click($cadena);
		$data=$this->getRow($cadena);
		return $data['url'];
	}
	
	function eliminarImagenBanner($idBanner){
		$data=$this->getRow($idBanner);
		$this->deleteFile($data['contenido']);
		$data['contenido']='';
		return $this->updateParcial($data);	
	}
	
	function eliminarBanner($idBanner){
		
		$data=$this->getRow($idBanner);
		$this->deleteFile($data['contenido']);
		
		$oBE=new Banner_BannerEspacioManager($this->oDBM);
		$oBE->eliminarBanner($idBanner);
		
		$oI=new Banner_ImpresionManager($this->oDBM);
		$oI->eliminarImpresionesBanners($idBanner);
		
		$oCli=new Banner_Click($this->oDBM);
		$oCli->eliminarClicksBanner($idBanner);
		
		return $this->delete($idBanner);
	}
	
	function getEspacio($orden,$idCategoria){
		$oE=new Banner_EspacioManager($this->oDBM);
		return $oE->getIdEspacio($orden,$idCategoria);
	}
	
	function getEstadisticasGenerales($idBanner,$fechaInicio=NULL,$fechaFin=NULL){
		$sql="SELECT 
		fecha, 
		SUM(impresiones) as impresiones, 
		SUM(clicks) as clicks 
		FROM (
		SELECT
		fecha,
		0 as impresiones,
		cantidad as clicks
		FROM banner_click
		WHERE id_relacion=$idBanner AND id_tipo=1 ";
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha>='$fechaInicio' ";	
		}
		if(!is_null($fechaFin)){ 
			$sql.=" AND fecha<='$fechaFin' ";	
		}
		$sql.="
		UNION
		SELECT
		fecha,
		cantidad as impresiones,
		0 as clicks
		FROM banner_impresion
		WHERE id_relacion=$idBanner AND id_tipo=1 
		";
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha>='$fechaInicio' ";	
		}
		if(!is_null($fechaFin)){ 
			$sql.=" AND fecha<='$fechaFin' ";	
		}
		$sql.="
		)t
		GROUP BY fecha";
		
		//echo $sql;
		return $this->toArray($sql);
	}
	
	
}
?>