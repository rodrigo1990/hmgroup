<?php
class Banner_ImpresionManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Impresion
	 */
	function Banner_ImpresionManager($oDBM){
		$this->pref='banner_';
		$this->tabla=$this->pref.'impresion';
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
/*INSERT INTO ".$this->tabla." (id,fecha,id_tipo,id_relacion,cantidad) VALUES (NULL,$arrayData[fecha],$arrayData[id_tipo],$arrayData[id_relacion],$arrayData[cantidad]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id,fecha,id_tipo,id_relacion,cantidad) VALUES (NULL,$arrayData[fecha],$arrayData[id_tipo],$arrayData[id_relacion],$arrayData[cantidad]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id=$id*/
		$sql="DELETE FROM ".$this->tabla." WHERE id=$id";
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
/*UPDATE ".$this->tabla." SET fecha=$arrayData[fecha] , id_tipo=$arrayData[id_tipo] , id_relacion=$arrayData[id_relacion] , cantidad=$arrayData[cantidad] WHERE id=$arrayData[id]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET fecha=$arrayData[fecha] , id_tipo=$arrayData[id_tipo] , id_relacion=$arrayData[id_relacion] , cantidad=$arrayData[cantidad] WHERE id=$arrayData[id]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id){
		/*GETROW*/
/*SELECT 
id, 
fecha, 
id_tipo, 
id_relacion, 
cantidad 
FROM ".$this->tabla." 
WHERE id=$id */
		$sql="SELECT 
id, 
fecha, 
id_tipo, 
id_relacion, 
cantidad 
FROM ".$this->tabla." 
WHERE id=$id ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData(){
		/*GETDATA*/
/*SELECT 
id, 
fecha, 
id_tipo, 
id_relacion, 
cantidad 
FROM ".$this->tabla." */
		$sql="SELECT 
id, 
fecha, 
id_tipo, 
id_relacion, 
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
	
	function add($idBanner){
		$fecha=PF::date("Ymd");
		$idTipo=1;
		$data=$this->getRegistro($idBanner,$idTipo,$fecha);
		if(count($data)==0){
			$data=array('fecha'=>$fecha,'id_tipo'=>$idTipo,'id_relacion'=>$idBanner,'cantidad'=>1);
			return $this->insert($data);
		}
		$data['cantidad']++;
		$data['fecha']=str_replace("-",'',$data['fecha']);
		return $this->update($data);
	}
	
	function getRegistro($idRelacion,$idTipo,$fecha){
		$sql="SELECT 
		id,
		fecha,
		id_tipo,
		id_relacion,
		cantidad 
		FROM ".$this->tabla."
		WHERE id_tipo=$idTipo AND id_relacion=$idRelacion AND fecha='$fecha'";
		return $this->toRow($sql); 
	}
	
	function getCantidad($idBanner,$fechaInicio=NULL,$fechaFin=NULL){
		$sql="SELECT 
		COALESCE(SUM(cantidad),0) as cantidad
		FROM ".$this->tabla."
		WHERE id_tipo=1 AND id_relacion=$idBanner";
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha>='$fechaInicio' ";	
		}
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha<='$fechaFin' ";	
		}
		//echo $sql;
		return $this->toVar($sql); 
	}
	

	
	function getTendencia($idBanner,$cantCols=5,$fechaInicio=NULL,$fechaFin=NULL){
		$sql="SELECT 
		fecha,
		cantidad
		FROM ".$this->tabla."
		WHERE id_tipo=1 AND id_relacion=$idBanner";
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha>='$fechaInicio' ";	
		}
		if(!is_null($fechaInicio)){ 
			$sql.=" AND fecha<='$fechaFin' ";	
		}
		$sql.=" ORDER BY fecha ASC ";
		$arrayDatos=$this->toArray($sql);
		
		
		
		$arrayFechas=array();
		$fecha=mktime(1,1,1,substr($fechaInicio,4,2),substr($fechaInicio,6,2),substr($fechaInicio,0,4));
		$fin=mktime(1,1,1,substr($fechaFin,4,2),substr($fechaFin,6,2),substr($fechaFin,0,4));
		
		while($fecha<$fin){
			$arrayFechas[date("Ymd",$fecha)]=0;
			$fecha=mktime(1,1,1,date("m",$fecha),date("d",$fecha)+1,date("Y",$fecha));
		}
		foreach($arrayDatos as $item){
			$arrayFechas[str_replace("-",'',$item['fecha'])]=$item['cantidad'];
		}
		
		
		
		if(count($arrayFechas)<=5){
			
			$arrayFinal=array();
			
			foreach($arrayFechas as $ind => $item){
				$arrayFinal[]=array('fecha'=>$ind,'cantidad'=>$item);
				
			}
			return $arrayFinal;
		}
		else{
		
			$divisor=$cantCols-1;
			$salto=floor(count($arrayFechas)/$divisor);
			if($salto==0){
				$salto=1;
			}
			$arrayFinal=array();
			$i=0;
			foreach($arrayFechas as $ind => $item){
				//echo $i,'%'.$salto.'='.$i%$salto.'-';
				if($i%$salto!=0){
					$i++;
					continue;
				}
				$arrayFinal[]=array('fecha'=>$ind,'cantidad'=>$item);
				$i++;
			}
			return $arrayFinal;
		}
	}
	
	function eliminarImpresionesBanners($idBanner){
		$sql="DELETE FROM ".$this->tabla." WHERE id_relacion=$idBanner AND id_tipo=1";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
}
?>