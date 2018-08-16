<?php 
///////////////////////////////// CLASS TRAFFIC BD///////////////////////////////////
class TrafficBD extends PFTableManager {
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Trafico
	 */
	function TrafficBD($oDBM){
		$this->pref='cms_';
		$this->tabla=$this->pref.'trafico';
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
/*INSERT INTO ".$this->tabla." (id_trafico,fecha,archivo,procedencia,IP,nav,cantidad) VALUES (NULL,$arrayData[fecha],'$arrayData[archivo]','$arrayData[procedencia]','$arrayData[IP]','$arrayData[nav]',$arrayData[cantidad]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_trafico,fecha,archivo,procedencia,IP,nav,cantidad) VALUES (NULL,$arrayData[fecha],'$arrayData[archivo]','$arrayData[procedencia]','$arrayData[IP]','$arrayData[nav]',$arrayData[cantidad]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_trafico){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_trafico=$id_trafico*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_trafico=$id_trafico";
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
/*UPDATE ".$this->tabla." SET fecha=$arrayData[fecha] , archivo='$arrayData[archivo]' , procedencia='$arrayData[procedencia]' , IP='$arrayData[IP]' , nav='$arrayData[nav]' , cantidad=$arrayData[cantidad] WHERE id_trafico=$arrayData[id_trafico]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET fecha=$arrayData[fecha] , archivo='$arrayData[archivo]' , procedencia='$arrayData[procedencia]' , IP='$arrayData[IP]' , nav='$arrayData[nav]' , cantidad=$arrayData[cantidad] WHERE id_trafico=$arrayData[id_trafico]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_trafico){
		/*GETROW*/
/*SELECT 
id_trafico, 
fecha, 
archivo, 
procedencia, 
IP, 
nav, 
cantidad 
FROM ".$this->tabla." 
WHERE id_trafico=$id_trafico */
		$sql="SELECT 
id_trafico, 
fecha, 
archivo, 
procedencia, 
IP, 
nav, 
cantidad 
FROM ".$this->tabla." 
WHERE id_trafico=$id_trafico ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id_trafico, 
fecha, 
archivo, 
procedencia, 
IP, 
nav, 
cantidad 
FROM ".$this->tabla." */
		$sql="SELECT 
id_trafico, 
fecha, 
archivo, 
procedencia, 
IP, 
nav, 
cantidad 
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
	
	
	/**
	 * Publico: almacena un tráfico
	 *
	 * @param array $arrayData
	 * @return int
	 */
	function save($arrayData){
		$arrayData['fecha']=date("Ymdhis");
		$arrayData['cantidad']=1;
		return $this->insert($arrayData);
	}
	
	function getCantVisitasTotales(){
		$sql="SELECT COUNT(DISTINCT IP, YEAR(fecha),MONTH(fecha),DAY(fecha),HOUR(fecha),archivo) FROM cms_trafico";
		return $this->toVar($sql);
	}
	
}

//////////////////////////////////////CLASS TRAFFIC FILE/////////////////////////////////
class TrafficFile{
	
	var $path;
	var $error;
		
	
	function TrafficFile($path){
		$this->path=$path;		
	}
	
	function save($arrayData){
		$fp=$this->openFileToWrite();
		$string=$this->setString($arrayData);
		fwrite($fp,$string);
		$this->closeFile($fp);
	}
	
	function openFileToWrite(){
		if(!file_exists($this->path)){
			$fp=fopen($this->path,"w");
			fclose($fp);
		}
		return fopen($this->path,"a");
	}
	
	function setString($arrayData){
		$array=array();
		return time().'|'.$arrayData['archivo'].'|'.$arrayData['procedencia'].'|'.$arrayData['IP'].'|'.$arrayData['nav']."\r\n";
	}
	
	function closeFile($fp){
		return fclose($fp);
	}
	
	function getData(){
		if(!file_exists($this->path)){
			return false;
		}
		$aData=file($this->path);
		$aFinal=array();
		foreach($aData as $ind => $linea){
			$aPartes=explode('|',$linea);
			$aFinal[$ind]['fecha']=$aPartes[0];
			$aFinal[$ind]['archivo']=$aPartes[1];
			$aFinal[$ind]['procedencia']=$aPartes[2];
			$aFinal[$ind]['IP']=$aPartes[3];
			$aFinal[$ind]['IP']=$aPartes[4];
		}
		return $aFinal;
	}
	
	function getCantVisitasTotales(){
		
		return 0;
	}
}
///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////CLASS TRAFFIC//////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
class Traffic{
	
	var $mode;
	var $obj;
	
	function Traffic(){
		
	}
	
	function setModeDB($oDBM,$tableName){
		$this->obj=new TrafficBD($oDBM,$tableName);
	}
	
	function setModeFile($path){
		$this->obj=new TrafficFile($path);
	}
	
	function saveTraffic($arrayData){
		$this->obj->save($arrayData);
	}
	
	function getData(){
		return $this->obj->getData();
	}
	
	function captureData($array=NULL){
		if(!is_null($array)){
			if(!isset($array['IP'])){
				$array['IP']=$this->getIP();
			}
			if(!isset($array['nav'])){
				$array['nav']=$_SERVER['HTTP_USER_AGENT'];
			}
			$this->saveTraffic($array);
		}
		elseif(isset($_GET['traffic'])){
			if(!isset($_GET['archivo'])){
				$_GET['archivo']='';
			}
			if(!isset($_GET['procedencia'])){
				$_GET['procedencia']=(isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER']:'';
			}
			if(!isset($_GET['IP'])){
				$_GET['IP']=$this->getIP();
			}
			if(!isset($_GET['nav'])){
				$_GET['nav']=$_SERVER['HTTP_USER_AGENT'];
			}
			$array['IP']=$_GET['IP'];
			$array['nav']=$_GET['nav'];
			$array['archivo']=$_GET['archivo'];
			$array['procedencia']=$_GET['procedencia'];
			$this->saveTraffic($array);
		}
	}
	
	function getIP(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		if(isset($_SERVER['HTTP_X_FORWARDED'])){
			return $_SERVER['HTTP_X_FORWARDED'];
		}
		if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
			return $_SERVER['HTTP_FORWARDED_FOR'];
		}
		if(isset($_SERVER['HTTP_FORWARDED'])){
			return $_SERVER['HTTP_FORWARDED'];
		}
		if(isset($_SERVER['REMOTE_ADDR'])){
			return $_SERVER['REMOTE_ADDR'];
		}
		return 0;
	}
	
	function getCantVisitasTotales(){
		return $this->obj->getCantVisitasTotales();
	}
}
?>