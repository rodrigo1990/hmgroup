<?php
class PFTableManager{
	
	var $oSqlM;
	var $oDBM;
	
	/**
	 * Constructor
	 *
	 * @param objeto DBManager $oDBM
	 * @param tabla $table
	 * @return tableManager
	 */
	function PFTableManager($oDBM,$table){
		$this->oSqlM=new PFSqlManager($oDBM,$table);
		$this->oDBM=$oDBM;
	}
	
	/**
	 * Publico: permite la inserción automática a una tabla
	 * $arrayData= Array asociativo con los datos a insertar
	 * Sintaxis: $arrayData['campo']='valor'
	 *
	 * @param array $arrayData
	 * @return primary key
	 */
	function quickInsert($arrayData){
		$sql=$this->oSqlM->quickInsert($arrayData);
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	/**
	 * Publico: permite un borrado rápido a una tabla
	 *
	 * @param primary key $var
	 * @return int filas afectadas
	 */
	function quickDelete($var){
		$sql=$this->oSqlM->quickDelete($var);
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	/**
	 * Publico: permite una actualización rápida a una tabla
	 * $aData=Array de campos a actualizar
	 * Sintaxis: $aData['campo']='valor'
	 * El update se realizará tomando como referencia automáticamente la clave primaria
	 * $ignoreNotField: Indica si se debe suspender la ejecución en caso de campos que no 
	 * coincidan con los de la tabla, o sólo deben ignorarse
	 *
	 * @param array $arrayData
	 * @return int filas afectadas
	 */
	function quickUpdate($arrayData,$ignoreNotField=false){
		$sql=$this->oSqlM->quickUpdate($arrayData,$ignoreNotField);
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	/**
	 * Publico: permite hacer una selección rápida de datos
	 * $aData=Array de campos a leer
	 * Sintaxis: $aData[]='campo'
	 * $aFilter= array de campos a filtrar
	 * Sintaxis: $aFilter['nombreCampo']='valorCondicional' (solo compara igualdades)
	 * $aJoin: array de tablas contra las que realizar un INNER JOIN
	 * Sintaxis: $aJoin[]='tabla'
	 *
	 * @param array datos $aData
	 * @param array filtros $aFilter
	 * @param array tablas inner join $aJoin
	 * @return array
	 */
	function selectData($aData,$aFilter=NULL,$aJoin=NULL){
		$sql=$this->oSqlM->quickInsert($aData,$aFilter,$aJoin);
		return $this->toArray($sql);
	}
	
	/**
	 * Publico: Retorna una sentencia sql en un array de datos
	 * El array es asociativo
	 * Sintaxis: $array[linea]['campo']='valor'
	 * 
	 * @param string sentencia $sql
	 * @return array
	 */
	function toArray($sql){
		$query=$this->oDBM->query($sql);
		$a=array();
		while($fila=$this->oDBM->fetch_assoc($query)){
			$a[]=$fila;
		}
		return $a;
	}
	
	/**
	 * Publico: Retorna una sentencia sql en una variable. 
	 * Para utilizar en casos de requerir un único dato
	 * Ej: COUNT()
	 *
	 * @param string sentencia $sql
	 * @return mixed
	 */
	function toVar($sql){
		$query=$this->oDBM->query($sql);
		if($this->oDBM->num_rows($query)>0){
			return $this->oDBM->result($query,0,0);
		}
		else{
			return false;
		}
	}
	
	/**
	 * Publico: Retorna una sentencia sql en un vector, no devuelve más que el primer registro
	 * si hay más de uno, o array vacío en caso de no devolver nada
	 *
	 * @param string sentencia $sql
	 * @return array 
	 */
	function toRow($sql){
		$r=$this->toArray($sql);
		if(isset($r[0])){
			return $r[0];
		}
		else{
			return array();
		}
	}
	
	/**
	 * Publico: cuenta los registros de una tabla, opcionalmente filtrados por $aFilter
	 * Sintaxis= $aFilter['nombreCampo']='valorCondicional' (solo compara igualdades)
	 *
	 * @param array filtros $aFilter
	 * @return int
	 */
	function countRows($aFilter=NULL){
		$sql="SELECT COUNT(*) FROM ".$this->tabla;
		if(!is_null($aFilter)){
			$sql.=' WHERE '.$this->oSqlM->generateConditions($aFilter);
		}
		return $this->toVar($sql);
	}
	
	
	/**
	 * Publico: Retorna una selección de un solo registro, en forma de vector asociativo
	 * Sólo devolverá el primer registro en caso de que la selección traiga más de uno
	 *
	 * @param sentencia $sql
	 * @return array
	 */
	function toSimpleArray($sql){
		$query=$this->oDBM->query($sql);
		$a=array();
		$cant=$this->oDBM->num_rows($query);
		for($i=0; $i<$cant; $i++){
			$a[]=$this->oDBM->result($query,$i,0);
		}
		return $a;
	}
}
?>