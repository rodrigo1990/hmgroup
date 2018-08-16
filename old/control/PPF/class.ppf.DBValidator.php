<?php
class PFDBValidator{

	//Propiedades publicas
	var $tabla;
	var $codigo;
	var $validacionCompleta;
	var $arrayData;
	var $arrayErrores;
	var $diccionarioActivado;
	
		
	//Propiedades privadas
	var $oDBM;
	var $tablaRef;
	var $tablaDiccionario;
	var $campoReferenciaDiccionario;
		
	/**
	 * Constructor
	 *
	 * @param string tabla $tabla
	 * @return bdValidator
	 */
	function PFDBValidator($oDBM,$tabla){
		$this->oDBM=$oDBM;
		$this->tablaRef=TABLA_VALIDACION;
		$this->tabla=$tabla;
		$this->validacionCompleta=true;
		$this->arrayData=array();
		$this->arrayErrores=array();
		$this->diccionarioActivado=false;
		$this->codigo=false;
	}
	
	
	
	/**
	 * Publico: valida un array de datos
	 *
	 * @return bool
	 */
	function validarVector(){
		$errores=false;
		
		foreach($this->arrayData as $campo => $valor){
			$sql="SELECT 
			validar, 
			parametro, 
			mensaje 
			FROM ".$this->tablaRef." 
			WHERE tabla='".$this->tabla."' AND campo='".$campo."'";
			if($this->codigo){
				$sql.=" AND codigo='".$this->codigo."'";
			}
			$query=$this->oDBM->query($sql);
			
			while($validacion=$this->oDBM->fetch_assoc($query)){
				$ok=$this->validar($valor,$validacion['validar'],$validacion['parametro']);
				if(!$ok and !$this->validacionCompleta){
					$this->setError($validacion['mensaje']);
					return false;
				}
				if(!$ok and $this->validacionCompleta){
					$this->setError($validacion['mensaje']);
					$errores=true;
				}
				
			}
		}
		if($errores){
			return false;
		}
		else{
			return true;
		}
	}
	
	
	
	/**
	 * Privado : valida de acuerdo a los datos de tabla
	 *
	 * @param string dato $dato
	 * @param string tipo validacion $validacion
	 * @param string $parametro
	 * @return bool
	 */
	function validar($dato,$validacion,$parametro){
		$correcto=true;
		switch($validacion){
			case 'SOLO_CARACTERES':
				if(ereg("[0-9]",$dato)){
					$correcto=false;
				}
			break;
			case 'OBLIGATORIO':
				if(trim($dato)==''){ $correcto=false; }
			break;
			case 'SOLO_NUMEROS':
				if(!is_numeric($dato)){ $correcto=false; }
			break;
			case 'EMAIL':
				if(!$this->checkmail($dato)){ $correcto=false; }
			break;
			case 'IDENTICO':
				foreach($this->arrayData as $campo => $valor){
					$correcto=false;
					if($campo==$parametro){
						if($valor==$dato){
							$correcto=true;
						}
						break;
					}
				}
			break;
			case 'DISTINTO_DE':
				if($dato==$parametro){ $correcto=false; }
			break;
			case 'EDAD':
				if($dato<1 or $dato>100){ $correcto=false; }
			break;
			case 'FECHA':
				if(!checkdate(substr($dato,4,2),substr($dato,6,2),substr($dato,0,4))){
					$correcto=false;
				}
			break;
			case 'SOLO_CARS_OBLIGATORIO':
				if(trim($dato)=='' || ereg("[0-9]",$dato)){
					$correcto=false;
				}
			break;
			case 'REGEX':
				if(preg_match('/'.$parametro.'/',$dato)==0){ $correcto=false; }
			break;
		}
		if($correcto){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	
	/**
	 * Privado: Chequea una dirección de email
	 *
	 * @param string email $email
	 * @return bool
	 */
	function checkmail($email){
		if(!eregi("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", $email)) {
		 	return false;
		}
		else{
			return true;
		}
	}
	
	
	
	/**
	 * Privada : filtra los datos contra inyecciones sql
	 *
	 * @param string sentencia sql $cadena
	 * @return string sentencia sql
	 */
	function filtroSQL($cadena){
		if(get_magic_quotes_gpc()) {
            $cadena=stripslashes($cadena);
        }
		
		if(function_exists('mysql_real_escape_string')){
			$cadena=mysql_real_escape_string($cadena,$this->con->con);
		}
		elseif(function_exists('mysql_escape_string')){
			$cadena=mysql_escape_string($cadena);
		}
		else{
			$cadena=addslashes($cadena);
		}
		return $cadena;
	}
	
	
	
	/**
	 * Publico: filtra por SQL un vector
	 *
	 */
	function filtrarVectorSQL(){
		foreach($this->arrayData as $variable => $valor){
			$filtrado=$this->filtroSQL($valor);
			$this->arrayData[$variable]=$filtrado;
		}
	}
	
	
	
	/**
	 * Publico: activa el diccionario indicando de qué tabla se deben traducir los mensajes de error
	 *
	 * @param string $columna
	 */
	function activarDiccionario($columna){
		$this->diccionarioActivado=$columna;
	}
	
	
	
	
	/**
	 * Privado: setea el vector de errores y si es necesario los busca en el diccionario
	 *
	 * @param string texto $error
	 */
	function setError($error){
		if(!$this->diccionarioActivado){
			$this->arrayErrores[]=$error;
		}
		else{
			/*$sql="SELECT ".$this->diccionarioActivado." FROM ".$this->tablaDiccionario." WHERE ".$this->campoReferenciaDiccionario."='$error'";
			$query=$this->oDBM->query($sql);*/
			if(!defined($error) || is_null(constant($error))){
				$this->arrayErrores[]=$error;
			}
			else{
				$this->arrayErrores[]=constant($error);
			}
		}
	}
	
	/**
	 * Publico Estático: permite añadir validación Javascript instantánea a un formulario
	 * asociando el DBValidator
	 *
	 * @param hmlt id form $form
	 * @param nombre funcion javascript manejadora del error $funcionErrorJS
	 * @param tabla validacion $tabla
	 * @param codigo validacion $codigo
	 * @return string
	 */
	function addJsValidation($form,$funcionErrorJS,$tabla,$codigo=''){
		$oDBV=new PFDBValidator($this->oDBM,$tabla);
		return $oDBV->validarJS($form,$funcionErrorJS,$tabla,$codigo);
	}
	
	
	/**
	 * Publico: devuelve una rutina JAVASCRIPT para validar los datos de un form
	 *
	 * @param form id html $form
	 * @param rutina javascript para manejar el error $funcionErrorJS
	 * @param tabla de validacion $tabla
	 * @param codigo de validacion $codigo
	 * @param bool $retornar
	 * @return string
	 */
	function validarJS($form,$funcionErrorJS,$tabla,$codigo='',$retornar=false){
		$sql="SELECT 
		campo,
		validar, 
		parametro, 
		mensaje 
		FROM ".$this->tablaRef." 
		WHERE tabla='".$tabla."'";
		
		if($codigo!=''){
			$sql.=" AND codigo='".$codigo."'";
		}
		
		$query=$this->oDBM->query($sql);
		
		$cadena=array();
		$i=0;
		
		while($item=$this->oDBM->fetch_assoc($query)){
			$cadena[$i]="$i:{'nombre':'$item[campo]', 'tipo':'$item[validar]','param':'$item[parametro]','mensaje':'$item[mensaje]'}";
			$i++;
		}
		
		if(count($cadena)==0){
			return '';
		}
		$cadena=implode(",\r\n",$cadena);
		$cadena="
		<script type=\"text/javascript\">
		function validate_$form(){
				var data={
					$cadena
				}
				
				var res=window.PFDBValidator.checkData(data,'$form');
				if(!res){
					 $funcionErrorJS(PFDBValidator.getAllErrors('<br>'));
					 //alert(window.PFDBValidator.getAllErrors('\\n'));
					 window.PFDBValidator.clean();
					 return false;
				 }
				 else{
					return true;
				 }
		}
		PFHTML.addFormOnSubmitEvent('$form','validate_$form');
		</script>";
		if($retornar){
			return $cadena;
		}
		else{
			echo $cadena;
		}
		
	}
	
	
	/**
	 * Estático: Método general de validación de variables vacías
	 *
	 * @param sucesión de variables
	 * @return bool
	 */
	function anyEmpty(){
		$arguments=func_get_args();
		foreach($arguments as $item){
			if(trim($item)==''){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Estático: Método general de validación de variables no enteras
	 *
	 * @param sucesión de variables
	 * @return bool
	 */
	function anyNotInteger(){
		$arguments=func_get_args();
		foreach($arguments as $item){
			if(!is_numeric(trim($item))){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Estático: Método general de validación de variables no numéricas
	 *
	 * @param sucesión de variables
	 * @return bool
	 */
	function anyNotNumeric(){
		$arguments=func_get_args();
		foreach($arguments as $item){
			$item=str_replace(',','.',$item);
			if(!is_numeric(trim($item))){
				return true;
			}
		}
		return false;
	}
	
}
?>