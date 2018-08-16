<?php

class PFSqlManager{

	

	var $table;

	var $aTable;

	var $oDBM;

	

	

	/**

	 * Constructor

	 *

	 * @param object DBManager $oDatabase

	 * @param tabla $table

	 * @return void

	 */

	function PFSqlManager($oDatabase,$table){

		$this->table=$table;

		$this->oDBM=$oDatabase;

		$this->readTable($table);

	}

	

	

	

	/**

	 * Publico: Permite selecciones personalizadas de datos

	 *

	 * @param array campos seleccionados $aData

	 * @param array campos a filtrar $aFilter

	 * @param array inner joins a realizar $aJoin

	 * @return string

	 */

	function selectData($aData,$aFilter=NULL,$aJoin=NULL){

		$sql[1]="SELECT \r\nCOLS \r\nFROM ".$this->table;

		$sql[1]=str_replace('COLS',$this->generateFields($aData),$sql[1]);

		if(!is_null($aJoin)){

			$sql[3]=" \r\n".$this->generateInnerJoins($aJoin);

		}

		if(!is_null($aFilter)){

			$sql[2]=" \r\nWHERE CONDITION ";

			$sql[2]=str_replace('CONDITION',$this->generateConditions($aFilter),$sql[2]);

		}

		$sql=implode('',$sql);

		return $sql;

	}

	

	

	/**

	 * Publico: obtiene una sentencia modelo insert para table

	 *

	 * @param string $modelo

	 * @return string

	 */

	function getInsert($modelo='$arrayData[x]'){

		$sql="INSERT INTO ".$this->table." (COLS) VALUES (DATA) ";

		$aCols=$this->getCols($this->table);

		$sql=str_replace('COLS',implode(',',$aCols),$sql);

		$aVals=array();

		$cantKeys=$this->countKeys($this->table);

		foreach($aCols as $item){

			$model=$modelo;

			if($this->needsQuotes($item)){

				$model="'".$modelo."'";

			}

			if($this->isKey($item,$this->table) && $cantKeys==1){

				$model='NULL';

			}

			$aVals[]=str_replace('x',$item,$model);

		}

		$sql=str_replace('DATA',implode(',',$aVals),$sql);

		return $sql;

	}

	

	

	/**

	 * Publico: devuelve una sentencia delete modelo para table

	 *

	 * @param string $modelo

	 * @return string

	 */

	function getDelete($modelo='$arrayData[x]'){

		$sql="DELETE FROM ".$this->table." WHERE ";

		$aCols=$this->getCols($this->table);

		$array=array();

		foreach($aCols as $item){

			$model=$modelo;

			if($this->isKey($item,$this->table)){

				if($this->needsQuotes($item)){

					$model="'".$modelo."'";

				}

				$array[]=$item.'='.str_replace('x',$item,$model);;

			}

		}

		$sql.=implode(' AND ',$array);

		return $sql;

	}

	

	

	/**

	 * Publico: obtiene una sentencia update modelo para table

	 *

	 * @param string $modelo

	 * @return string

	 */

	function getUpdate($modelo='$arrayData[x]'){

		$sql="UPDATE ".$this->table." SET DATA WHERE CONDITION";

		$aCols=$this->getCols($this->table);

		$array=array();

		$aKeys=array();

		foreach($aCols as $item){

			$value=str_replace('x',$item,$modelo);

			if($this->needsQuotes($item)){

				$value="'".$value."'";

			}

			if($this->isKey($item,$this->table)){

				$aKeys[]=$item."=".$value;

			}

			else{

				$array[]=$item."=".$value;

			}

		}

		if(count($array)==0 || count($aKeys)==0){

			return '';

		}

		$sql=str_replace('DATA',implode(' , ',$array),$sql);

		$sql=str_replace('CONDITION',implode(' AND ',$aKeys),$sql);

		return $sql;

	}

	

	/**

	 * Publico: Retorna una sentencia sql completa de seleccion

	 *

	 * @return string sentencia sql

	 */

	function getSelectData(){

		$aCols=$this->getCols($this->table);

		return $this->selectData($aCols);

	}

	

	/**

	 * Publico: retorna una sentencia sql completa de selección de registro

	 *

	 * @return string sentencia sql

	 */

	function getSelectRow(){

		$aCols=$this->getCols($this->table);

		$aKeys=array();

		foreach($aCols as $item){

			if($this->isKey($item,$this->table)){

				$aKeys[$item]='$'.$item;

			}

		}

		return $this->selectData($aCols,$aKeys);

	}

	

	

	/**

	 * Publico: devuelve una sentencia rápida de insert

	 *

	 * @param array $aData

	 * @return string

	 */

	function quickInsert($aData){

		$sql="INSERT INTO ".$this->table." (COLS) VALUES (DATA)";

		$aCols=array();

		$aValues=array();

		foreach($aData as $ind => $value){

			if(!isset($this->aTable[$this->table][$ind])){

				$this->error('El campo '.$ind.' no corresponden a la tabla:'.$this->table);

			}

			$aCols[]=$ind;

			if($this->needsQuotes($ind)){

				$value="'".$value."'";

			}

			$aValues[]=$value;

		}

		$sql=str_replace('COLS',implode(' , ',$aCols),$sql);

		$sql=str_replace('DATA',implode(' , ',$aValues),$sql);

		return $sql;

	}

	

	

	/**

	 * Publico: devuelve una sentencia rápida de update

	 * 

	 * 

	 * @param array $aData  datos a utilizar

	 * @param bool $ignoreNotField  indica si se deben ignorar datos que no corresponden a la tabla

	 * @return string

	 */

	function quickUpdate($aData,$ignoreNotField=false){

		$sql="UPDATE ".$this->table." SET DATA WHERE CONDITION";

		$array=array();

		$aKeys=array();

		foreach($aData as $col => $value){

			if(!isset($this->aTable[$this->table][$col])){

				if($ignoreNotField){

					continue;

				}

				$this->error('El campo '.$col.' no corresponden a la tabla:'.$this->table);

			}

			if($this->needsQuotes($col)){

				$value="'".$value."'";

			}

			if($this->isKey($col,$this->table)){

				$aKeys[]=$col."=".$value;

			}

			else{

				$array[]=$col."=".$value;

			}

		}

		if(count($array)==0 || count($aKeys)==0){

			$this->error('No hay información suficiente para generar UPDATE a la tabla:'.$this->table);

		}

		$sql=str_replace('DATA',implode(' , ',$array),$sql);

		$sql=str_replace('CONDITION',implode(' AND ',$aKeys),$sql);

		return $sql;

	}

	

	/**

	 * Publico: devuelve una sentencia rápida de delete

	 *

	 * @param mixed $var

	 * @return string

	 */

	function quickDelete($var){

		if(is_array($var)){

			$array=array();

			foreach($var as $field => $value){

				if(!isset($this->aTable[$this->table][$field])){

					$this->error('El campo '.$field.' no corresponden a la tabla:'.$this->table);

				}

				if($this->needsQuotes($field)){

					$value="'".$value."'";

				}

				$array[]=$field.'='.$value;

			}

			$sql="DELETE FROM ".$this->table." WHERE CONDITION";

			$sql=str_replace('CONDITION',implode(' AND ',$array),$sql);

			return $sql;

		}

		else{

			$aCols=$this->getCols($this->table);

			$aKeys=array();

			foreach($aCols as $item){

				if($this->isKey($item,$this->table)){

					$aKeys[]=$item;	

				}

			}

			if(count($aKeys)!=1){

				$this->error('No coincide la cantidad de claves de la tabla:'.$this->table);

			}

			if($this->needsQuotes($aKeys[0])){

				$var="'".$var."'";

			}

			$sql="DELETE FROM ".$this->table." WHERE $aKeys[0]=$var";

			return $sql;

		}

	}

	

	//////////////////////////METODOS PRIVADOS//////////////////////////////////

	

	/**

	 * Privado: Obtiene las características de los campos de una tabla

	 *

	 * @param tabla $table

	 * @return bool

	 */

	function readTable($table){

		$sql="SHOW COLUMNS FROM ".$table;

		$query=$this->oDBM->query($sql);

		$this->aTable[$table]=array();

		while($fila=$this->oDBM->fetch_assoc($query)){

			$this->aTable[$table][$fila['Field']]=$fila;

		}

		return true;

	}

	

	/**

	 * Privado: genera una sucesión de campos para un sql

	 *

	 * @param array $aData

	 * @return string

	 */

	function generateFields($aData){

		foreach($aData as $ind=>$item){

			if(ereg('\.',$item)){

				$aData[$ind].=" as '$item'";

			}

		}

		return implode(", \r\n",$aData);

	}

	

	/**

	 * Privado: genera un inner join

	 *

	 * @param array $aJoin

	 * @return string

	 */

	function generateInnerJoins($aJoin){

		$array=array();

		foreach($aJoin as $tabla => $field){

			$this->readTable($tabla);

			$array[]=' INNER JOIN '.$tabla.' ON '.$this->table.'.'.$field.'='.$tabla.'.'.$field;

		}

		return implode(" \r\n",$array);

	}

	

	/**

	 * Privado: Genera un string de condiciones para un sql

	 *

	 * @param unknown_type $aCondition

	 * @return unknown

	 */

	function generateConditions($aCondition){

		$array=array();

		foreach($aCondition as $field => $value){

			if($this->needsQuotes($field)){

				$value="'".$value."'";

			}

			$array[]=$field.'='.$value;

		}

		return implode( " \r\nAND " ,$array);

	}

	

	/**

	 * Privado: manejo de errores

	 *

	 * @param string $string

	 */

	function error($string){

		Error::manage($string);

	}

	

	/**

	 * Privado: indica si el valor de un campo necesita comillas

	 *

	 * @param campo $field

	 * @return bool

	 */

	function needsQuotes($field){

		$tabla=$this->table;

		if(!isset($this->aTable[$tabla][$field])){

			Error::manage('No existe ese campo en la tabla '.$tabla);

		}

		if(preg_match('/\./i',$field)){

			$p=explode('.',$field);

			$field=$p[1];

			$tabla=$p[0];

		}

		if(preg_match('/int/i',$this->aTable[$tabla][$field]['Type']) 

			|| eregi('decimal',$this->aTable[$tabla][$field]['Type']) 

			|| eregi('float',$this->aTable[$tabla][$field]['Type']) 

			|| eregi('date',$this->aTable[$tabla][$field]['Type'])

			|| eregi('time',$this->aTable[$tabla][$field]['Type'])

			|| eregi('year',$this->aTable[$tabla][$field]['Type'])

			|| eregi('double',$this->aTable[$tabla][$field]['Type'])){

			return false;

		}

		else{

			return true;

		}

	}

		

	

	

	/**

	 * Privado: obtiene los campos de una tabla

	 *

	 * @param table $table

	 * @return array

	 */

	function getCols($table){

		$array=array();

		foreach($this->aTable[$table] as $item){

			$array[]=$item['Field'];

		}

		return $array;

	}

	

	/**

	 * Privado: cuenta la cantidad de claves primarias de una tabla

	 *

	 * @param string tabla $table

	 * @return int cantidad de claves

	 */

	function countKeys($table){

		$i=0;

		foreach($this->aTable[$table] as $item){

			if($item['Key']=='PRI'){

				$i++;

			}

		}

		return $i;

	}

	

	/**

	 * Privado: Indica si un campo es parte de la clave primaria

	 *

	 * @param campo $field

	 * @param tabla $table

	 * @return bool

	 */

	function isKey($field,$table){

		if(ereg('\.',$field)){

			$p=explode('.',$field);

			$field=$p[1];

		}

		if(!isset($this->aTable[$table][$field]['Key'])){

			return false;

		}

		if($this->aTable[$table][$field]['Key']=='PRI'){

			return true;

		}

		else{

			return false;

		}

	}

	



}

?>