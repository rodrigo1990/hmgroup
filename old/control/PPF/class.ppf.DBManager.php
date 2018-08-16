<?
//////////////////////////////////INTERFACE SQL SERVER//////////////////////////
class PFSqlServerInterface{
	/*
	* Propiedades Públicas
	*/
	
	/*
	* Propiedades Privadas
	*/
	var $con;
	var $host;
	var $user;
	var $pass;
	var $base;
	var $error;
	var $cantQueries;
	
	/**
	 * Constructor
	 *
	 * @param int $tipo
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $base
	 * @return mysqlInterface
	 */
	function  PFSqlServerInterface($host,$user,$pass,$base){
		$this->host=$host;
		$this->user=$user;
		$this->pass=$pass;
		$this->base=$base;
		$this->cantQueries=0;
	}
	
	
	/**
	 * Publico: conecta con base de datos
	 *
	 * @return bool
	 */
	function conexion($silent=false){
		if(!$this->con=mssql_connect($this->host,$this->user,$this->pass)){
			if(!$silent){
				$this->error('Error en conexión');
			}
			return false;
		}
		if(!mssql_select_db($this->base,$this->con)){
			if(!$silent){
				$this->error('Error en selección de base de datos');
			}
			return false;
		}
		return true;
	}
	
	/**
	 * Público: efectúa un pedido a la base de datos
	 *
	 * @param string sentencia $sql
	 * @return recurso resource
	 */
	function query($sql){
		$this->cantQueries++;
		$query=mssql_query($sql,$this->con);
		if(!$query){
			$this->error(mssql_error());
			return false;
		}
		return $query;
	}
	
	/**
	 * Publico: ejectuta un fetch asociado
	 *
	 * @param recurso $query
	 * @return array
	 */
	function fetch_assoc($query){
		return mssql_fetch_assoc($query);
	}
	
	/**
	 * Publico: ejecuta un fetch no asociado
	 *
	 * @param recurso $query
	 * @return array
	 */
	function fetch_row($query){
		return mssql_fetch_row($query);
	}
	
	/**
	 * Publico: ejecuta un num_rows
	 *
	 * @param recurso $query
	 * @return int
	 */
	function num_rows($query){
		return mssql_num_rows($query);
	}
	
	/**
	 * Publico: ejecuta un num_fields
	 *
	 * @param recurso $query
	 * @return int
	 */
	function num_fields($query){
		return mssql_num_fields($query);
	}
	
	/**
	 * Publico: ejecuta un field_name
	 *
	 * @param recurso $query
	 * @param int $pos
	 * @return string campo
	 */
	function field_name($query,$pos){
		return mssql_field_name($query,$pos);
	}
	
	/**
	 * Publico: ejectua un result
	 *
	 * @param recurso $query
	 * @param int $row
	 * @param int $field
	 * @return mixed valor
	 */
	function result($query,$row,$field){
		if($this->num_rows($query)==0){
			return false;
		}
		return mssql_result($query,$row,$field);
	}
	
	/**
	 * Publico: devuelve el ultimo id insertado
	 *
	 * @return primary key
	 */
	function last_id(){
		$query=$this->query('SELECT SCOPE_IDENTITY()');
		return $this->result($query,0,0);
	}
	
	/**
	 * Publico: devuelve la cantidad de filas afectadas
	 *
	 * @return int
	 */
	function affected_rows(){
		return mssql_rows_affected($this->con);
	}
	
	/**
	 * Publico: Manejo de errores
	 *
	 * @param string texto error $string
	 */
	function error($string){
		PFError::manage($string);
	}
	
	
}
////////////////////////////////////INTERFACE MYSQL /////////////////////////////////////////
class PFMysqlInterface{
	/*
	* Propiedades Públicas
	*/
	
	/*
	* Propiedades Privadas
	*/
	var $con;
	var $host;
	var $user;
	var $pass;
	var $base;
	var $error;
	var $cantQueries;
	
	/**
	 * Constructor
	 *
	 * @param int $tipo
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $base
	 * @return mysqlInterface
	 */
	function  PFMysqlInterface($host,$user,$pass,$base){
		$this->host=$host;
		$this->user=$user;
		$this->pass=$pass;
		$this->base=$base;
		$this->cantQueries=0;
	}
	
	/**
	 * Publico: conecta con base de datos
	 *
	 * @return unknown
	 */
	function conexion($silent=false){
		if(!$this->con=@mysql_connect($this->host,$this->user,$this->pass)){
			if(!$silent){
				$this->error('Error en conexión');
			}
			return false;
		}
		if(!@mysql_select_db($this->base,$this->con)){
			if(!$silent){
				$this->error('Error en selección de base de datos');
			}
			return false;
		}
		return true;
	}
	
	/**
	 * Público: efectúa un pedido a la base de datos
	 *
	 * @param unknown_type $sql
	 * @return unknown
	 */
	function query($sql){
		$this->cantQueries++;
		$query=mysql_query($sql,$this->con);
		if(!$query){
			$this->error(mysql_error());
			return false;
		}
		return $query;
	}
	
	/**
	 * Publico: ejectuta un fetch asociado
	 *
	 * @param recurso $query
	 * @return array
	 */
	function fetch_assoc($query){
		return mysql_fetch_assoc($query);
	}
	
	/**
	 * Publico: ejecuta un fetch no asociado
	 *
	 * @param recurso $query
	 * @return array
	 */
	function fetch_row($query){
		return mysql_fetch_row($query);
	}
	
	/**
	 * Publico: ejecuta un num_rows
	 *
	 * @param recurso $query
	 * @return int
	 */
	function num_rows($query){
		return mysql_num_rows($query);
	}
	
	/**
	 * Publico: ejecuta un num_fields
	 *
	 * @param recurso $query
	 * @return int
	 */
	function num_fields($query){
		return mysql_num_fields($query);
	}
	
	/**
	 * Publico: ejecuta un field_name
	 *
	 * @param recurso $query
	 * @param int $pos
	 * @return string campo
	 */
	function field_name($query,$pos){
		return mysql_field_name($query,$pos);
	}
	
	/**
	 * Publico: ejectua un result
	 *
	 * @param recurso $query
	 * @param int $row
	 * @param int $field
	 * @return mixed valor
	 */
	function result($query,$row,$field){
		if($this->num_rows($query)==0){
			return false;
		}
		return mysql_result($query,$row,$field);
	}
	
	/**
	 * Publico: devuelve el ultimo id insertado
	 *
	 * @return primary key
	 */
	function last_id(){
		$query=$this->query('SELECT LAST_INSERT_ID()');
		return $this->result($query,0,0);
	}
	
	/**
	 * Publico: devuelve la cantidad de filas afectadas
	 *
	 * @return int
	 */
	function affected_rows(){
		return mysql_affected_rows();
	}
	
	/**
	 * Publico: Manejo de errores
	 *
	 * @param string texto error $string
	 */
	function error($string){
		PFError::manage($string);
	}
	
	
}
//////////////////////////////// CONEXION GENERICA ////////////////////////////////////////////
class PFDBManager{
	/*
	* Propiedades Públicas
	*/
	var $error;
	
	
	/*
	 * Estático: Devuelve un objeto de interacción con la base
	 * de datos que corresponda
	 *
	 * @param int $tipo
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $base
	 * @return object
	 */
	function nuevaConexion($tipo,$host,$user,$pass,$base,$silent=false){
		switch($tipo){
			case 'mysql':
				$obj=new PFMysqlInterface($host,$user,$pass,$base);
			break;
			case 'sqlserver':
				$obj=new PFSqlServerInterface($host,$user,$pass,$base);
				break;
			default:
				$obj=false;
			break;
		}
		if(!$obj->conexion($silent)){
			$this->error=$obj->error;
			$obj=false;
		}
		return $obj;
	}
	
	/**
	 * Publico: testea una conexion y una sentencia sql
	 *
	 *@param int $tipo
	 * @param string $host
	 * @param string $user
	 * @param string $pass
	 * @param string $base
	 * @param string $sql
	 * @return bool
	 */
	function testearConexion($tipo,$host,$user,$pass,$base,$sql){
		$con=$this->nuevaConexion($tipo,$host,$user,$pass,$base,true);
		if(!$con){
			return false;
		}
		if(!$con->query($sql)){
			return false;
		}
		return true;
	}
	
	
}
?>
