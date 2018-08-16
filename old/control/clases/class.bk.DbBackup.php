<?
class bk_Backup{

	//Propiedades privadas
	var $N;
	var $oDBM;
	var $dir;

	/**
	 * Constructor: ejecuta el backup sin necesidad de usar métodos internos
	 *
	 * @return db_backup
	 */
	function bk_Backup($oDB){
		$this->oDBM=$oDB;
		$this->N="\r\n";
		$this->dir="backup";
		$whatToWrite = $this->_getRetrive();
		$this->_saveToFile($whatToWrite);
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
	
	function toArrayNum($sql){
		$query=$this->oDBM->query($sql);
		$a=array();
		while($fila=$this->oDBM->fetch_row($query)){
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
	
	function toRowNum($sql){
		$r=$this->toArrayNum($sql);
		if(isset($r[0])){
			return $r[0];
		}
		else{
			return array();
		}
	}
	
	/**
	 * Privado: Devuelve el listado de todas las tablas de la base de datos
	 *
	 * @return unknown
	 */
	function _getTablas(){
	
		$tablas = array();
		
		$listaTablas = $this->oDBM->toArrayNum("SHOW TABLES");
		foreach($listaTablas as $item){
			$tablas[] = $item[0];
		}
		if(count($tablas)==0){
			return false;
		}
		return $tablas;
	}
	
	/**
	 * Privado: Realiza el backup de una tabla
	 *
	 * @param unknown_type $table
	 * @return unknown
	 */
	function _getDumpTable($table){
	
		$string = "";
		
		$this->oDBM->query("LOCK TABLES ".$table." WRITE");
		
		$string .= "DROP TABLE IF EXISTS ".$table.";".$this->N;
		
		$row = $this->oDBM->toRowNum("SHOW CREATE TABLE ".$table);
		
		
		$string .= "".str_replace("\n", $this->N, $row[1]).";".$this->N;
		$string .= $this->_getInsertsTable($table);
		
		$this->oDBM->query("UNLOCK TABLES");
		
		return $string;
	}
	
	/**
	 * Privado: Devuelve el backup de los inserts de una tabla
	 *
	 * @param unknown_type $table
	 * @return unknown
	 */
	function _getInsertsTable($table){
	
		$stringInsert = "";
		
		$arrayResultados = $this->oDBM->queryToArrayNum("SELECT * FROM ".$table);
		
		foreach($arrayResultados as $item){
			$insert = "";
			foreach($item as $data){
				$insert .="'".$data."', ";
			}
			$insert = substr($insert, 0, -2);
			$stringInsert .= 'INSERT INTO '.$table.' VALUES ('.$getInsertsTables.');'.$this->N;
		}
		
		return $stringInsert;
		
	}
	
	/**
	 * Privado: Acumula los backups de todas las tablas de la base de datos
	 *
	 * @return unknown
	 */
	function _getRetrive(){
		
		$string = "";
		
		$tablas = $this->_getTablas();
		foreach($tablas as $item){
			$string .= $this->_getDumpTable($item);
		}
		return $string;
	}
	
	/**
	 * Privado: Almacena el backup en un archivo
	 *
	 * @param unknown_type $whatToWrite
	 */
	function _saveToFile($whatToWrite){
		$fileName=$this->dir.'/'.'backup_'.date("d_m_Y").'.sql';
		$f_open = fopen($fileName, "w");
		$f_write = fwrite($f_open, $whatToWrite, strlen($whatToWrite));
		fclose($f_open);	 
	}
}
$db=new db_backup();
?>