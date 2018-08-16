<?php
///////////////////CONFIGURACION//////////////////
/**
 * Configuración general del FRAMEWORK
 * No MODIFICAR
 */
require_once('config.ppf.php');

////////////////////LIBRERIAS////////////////////
/**
 * Clase de funciones Generales
 *
 */
require_once('class.ppf.General.php');


/////////////////////DEBUG/////////////////////////
/**
 * Clase de Debug
 *
 */
require_once('class.ppf.Debug.php');


///////////////////BASE DE DATOS////////////////////////
/**
 * Parte del BD MANAGER
 * Manejador de Base de datos
 *
 */
require_once('class.ppf.DBManager.php');

/**
 * Parte del BD MANAGER
 * Manejador de sentencias SQL
 *
 */
require_once('class.ppf.SqlManager.php');

/**
 * Parte del BD MANAGER
 * Manejador de Tablas
 *
 */
require_once('class.ppf.TableManager.php');

/**
 * Parte del BD MANAGER
 * Manejador de Validación de Datos
 *
 */
require_once('class.ppf.DBValidator.php');

////////////////////MANEJO DE ERRORES///////////////////////
/**
 * Clase de Manejo de Errores
 *
 */
require_once('class.ppf.Error.php');

////////////////////// VERIFICACION DE PARAMETROS ///////////////
/**
 * Clase de Restricción y Verificación de parámetros
 *
 */
require_once('class.ppf.Params.php');


class PFApplication {
	
	//INPUT
	/**
	 * Copia del vector, ya decodificado $_GET
	 *
	 * @var array
	 */
	var $GET;
	
	/**
	 * Copia del vector $_POST
	 *
	 * @var array
	 */
	var $POST;
	
	/**
	 * Copia de la matriz $_FILES
	 *
	 * @var array
	 */
	var $FILES;
	
	//OUTPUT
	/**
	 * Almacena un mensaje que el sistema debe entregar al usuario
	 *
	 * @var string
	 */
	var $MSG;
	
	/**
	 * Indica la presencia o no de errores en un proceso.
	 * Permite mostrar o no el panel de aviso de errores en la correspondiente plantilla HTML
	 *
	 * @var bool
	 */
	var $ERROR;
	
	/**
	 * Array de indice numérico que almacena los textos de los errores cometidos en un proceso del sistema.
	 * Serán impresos en la plantilla HTML
	 *
	 * @var array
	 */
	var $ERRORS;
	
	/**
	 * Array que almacena los paneles a activar o desactivar al cargar la plantilla HTML
	 * NO UTILIZAR - VARIABLE DEL FRAMEWORK
	 * 
	 * @var array
	 */
	var $PANELS;
	
	//DEBUG
	/**
	 * Indica si se habilita o no el debug del sistema
	 * Al habilitar el debug, se agregará automáticamente una tabla al final de la plantilla HTML conteniendo datos de:
	 * -Datos enviados por $_POST
	 * -Datos enviados por $_GET
	 * -Datos residentes en $_SESSION
	 * -Tiempo insumido en la ejecución
	 * -Variables que se hayan requerido
	 *
	 * @var bool
	 */
	var $DEBUG;
	
	/**
	 *  Plantilla HTML a cargar por defecto si no se va a ejecutar ningún evento
	 *
	 * @var file
	 */
	var $DEFAULT;
	
	/**
	 *  Método a ejecutar por defecto si no se espeficifica ningún evento. (Prioridad sobre $DEFAULT)
	 *
	 * @var file
	 */
	var $EXEC_DEFAULT;
	
	
	//FUNCIONAL
	/**
	 * Variable interna que indica el archivo a cargar.
	 * NO UTILIZAR - VARIABLE DEL FRAMEWORK
	 *
	 * @var path
	 */
	var $LOAD;
	
	/**
	 * Matriz: Acumula todos aquellos datos que van a rellenar los formularios html de la plantilla a cargar
	 * Sintaxis: $this->DATAFORM['idFormulario']['idInput']='contenidoInput'
	 * Se pueden incorporar o quitar elementos
	 * Por defecto, los datos enviados por POST se cargan automáticamente
	 * Para que los datos se carguen en los formularios HTML, es necesario ejecutar el método postBack() al final de la plantilla HTML
	 *
	 * @var array
	 */
	var $DATAFORM;
	
	//DEBUG
	/**
	 * Contenedor del objeto de debug
	 * NO UTILIZAR - VARIABLE DEL FRAMEWORK
	 *
	 * @var object
	 */
	var $oDebug;
	
	
	//JAVASCRIPT
	/**
	 * Ruta a un archivo HTML a donde derivar al usuario que no tenga habilitado javascript
	 * NO UTILIZAR - VARIABLE DEL FRAMEWORK
	 *
	 * @var path
	 */
	var $NO_JAVASCRIPT_PATH;
	
	//COOKIES
	/**
	 * EN DESARROLLO NO UTILIZAR
	 *
	 * @var path
	 */
	var $NO_COOKIES_PATH;
	
	 /**
	  * Publico: Indica la utilización o no de la funcionalidad de lenguages
	  *
	  * @var bool
	  */
	 var $USE_LANGUAGE;
	 
	 /**
	  * Publico: Indica la ruta a los archivos de diccionarios
	  *
	  * @var bool
	  */
	 var $LANGUAGE_PATH;
	 
	 /**
	 * Constructor
	 *
	 * @return void
	 */
	function PFApplication(){
		$this->DEBUG=false;
		$this->oDebug=new PFDebug();
		$this->decodeURL();
		$this->DATAFORM=array();
		$this->NO_JAVASCRIPT_PATH=null;
		$this->NO_COOKIES_PATH=null;
		$this->USE_LANGUAGE=false;
		$this->LANGUAGE_PATH='';
		$this->DEFAULT=NULL;
		$this->EXEC_DEFAULT=NULL;
	}
	
	////////////////////METODOS DE FUNCIONAMIENTO INTERNO////////////////////////
	
	/**
	 * Privado: ejecuta los eventos correspondientes a esa instancia de la aplicación
	 *
	 */
	function execEvents(){
		
		///////////// MANEJO DE CHARSET DE ENTRADA  ///////////
		if(PF_INPUT_CHARSET!='DEFAULT'){
			$this->GET=$this->translateCharsetArray($_GET);
			$this->POST=$this->translateCharsetArray($_POST);
			$this->FILES=$this->translateCharsetArray($_FILES);
		}
		else{
			$this->GET=$_GET;
			$this->POST=$_POST;
			$this->FILES=$_FILES;
		}
		//////////// MANEJO DE CHARSET DE SALIDA /////////
		if(PF_OUTPUT_CHARSET!='DEFAULT'){
			switch (PF_OUTPUT_CHARSET){
				case 'LATIN1':
					header('Content-Type: text/html; charset=iso-8859-1');
				break;
				case 'UTF8':
					header('Content-Type: text/html; charset=utf-8');
				break;	
			}
			ob_start();
		}
		$bExec=true;
		////////// EJECUCION DE METODO PUBLICO //////////
		
		if(isset($_GET['accion'])){
				
				if(!method_exists($this,$_GET['accion'])){
					PFError::manage('Ha llamado a un metodo no definido en main:'.$_GET['accion'].'()');
				}
				if(substr($_GET['accion'],0,1)=='_'){
					PFError::manage('Ha llamado a un metodo privado y por ende no permitido en main:'.$_GET['accion'].'()');
				}
				
				$this->{$_GET['accion']}();
		}
		elseif(isset($_POST['accion'])){
			if(!method_exists($this,$_POST['accion'])){
				PFError::manage('Ha llamado a un metodo no definido en main:'.$_POST['accion'].'()');
			}
			if(substr($_POST['accion'],0,1)=='_'){
				PFError::manage('Ha llamado a un metodo privado y por ende no permitido en main:'.$_POST['accion'].'()');
			}
			$this->{$_POST['accion']}();
		}
		else{
			if(!is_null($this->EXEC_DEFAULT)){
				if(!method_exists($this,$this->EXEC_DEFAULT)){
					PFError::manage('Ha llamado a un metodo por defecto no definido en main:'.$this->DEFAULT.'()');
				}
				$this->{$this->EXEC_DEFAULT}();
			}
			elseif(!is_null($this->DEFAULT)){
				$this->load($this->DEFAULT);
			}
		}
		///////////// CARGA DE TEMPLATE ///////////
		if($this->LOAD){
			include($this->LOAD);
		}
		//////////// MANEJO DE OPCION DE DEBUG  /////////////
		if($this->DEBUG){
			$this->dumpDebug();
		}
		///////////  MANEJO DEL BUFFER EN CASO DE MODIFICACION DEL CHARSET //////
		if(PF_OUTPUT_CHARSET!='DEFAULT'){
			$data=$this->translateCharsetOut(ob_get_contents());
			ob_end_clean();
			echo $data;
		}
		
	}
	
	/**
	 * Privado: muestra el resultado del debug
	 *
	 */
	function dumpDebug(){
		$this->oDebug->dumpDebug();
	}
	
	/**
	 * Privado: decodifica una URL GET
	 *
	 * @return void
	 */
	function decodeURL(){
		PF::decodeURL();
	}
	
	////////////// JUEGOS DE CARACTERES   ////////////////////
	
	/**
	 * ATENCION: EN DESARROLLO NO USAR ESTE METODO
	 * Privado: traduce un vector de un juego de caracteres a otro juego
	 *
	 * @param array $data
	 * @return array
	 */
	function translateCharsetArray($data){
		return $data;
		if(!is_array($data)){
			return $this->translateCharsetIn($data);
		}
		else{
			foreach($data as $ind => $item){
				$data[$ind]=$this->translateCharsetArray($item);
			}
			return $data;
		}
	}
	
	/**
	 * ATENCION: EN DESARROLLO NO USAR ESTE METODO
	 * Privado: Traduce un string de un juego de caracteres a otro
	 * 
	 * @param string $data
	 * @return string
	 */
	function translateCharsetIn($data){
		if(PF_INPUT_CHARSET=='UTF8'){
			return PF::toUTF8($data);
		}
		elseif(PF_INPUT_CHARSET!='UTF8'){
			return PF::toLATIN1($data);
		}
	}
	
	function translateCharsetOut($data){
		if(PF_OUTPUT_CHARSET=='UTF8'){
			return PF::toUTF8($data);
		}
		elseif(PF_OUTPUT_CHARSET=='LATIN1'){
			return PF::toLATIN1($data);
		}
	}
	
	////////////// FIN JUEGOS DE CARACTERES   ////////////////////

	
	/**
	 * Protegido: carga una interfaz grafica
	 *
	 * @param string ruta de archivo $path
	 */
	function load($path){
		$this->LOAD=$path;
	}
	
	/**
	 * Protegido: activa un panel para ser visible
	 *
	 * @param string panel $panel
	 */
	function activate($panel){
		if(!isset($this->PANELS[$panel])){
			$this->PANELS[$panel]=true;
		}
		$this->PANELS[$panel]=true;
	}
	
	/**
	 * Protegido: desactiva un panel para no ser visible
	 *
	 * @param string panel $panel
	 */
	function deActivate($panel){
		if(!isset($this->PANELS[$panel])){
			$this->PANELS[$panel]=false;
		}
		$this->PANELS[$panel]=false;
	}
	
	/**
	 * Publico: Acumula datos a rellenar en forms 
	 *
	 * @param form $form
	 * @param variable $data
	 * @param valor $value
	 */
	function fillForm($form,$data,$value){
		$this->DATAFORM[$form][$data]=$value;
	}
	
	/**
	 * Publico: Genera un script para desviar a los usuarios que no tengan habilitado soporte de Javascript
	 *
	 * @param path $path
	 */
	function setNoJavascriptPath($path){
		$this->NO_JAVASCRIPT_PATH=$path;
	}
	
	/**
	 * ATENCION: EN DESARROLLO NO USAR ESTE METODO
	 * Publico: Genera un script para desviar a los usuarios que no tengan habilitado soporte para cookies
	 *
	 * @param path $path
	 */
	function setNoCookiesPath($path){
		$this->NO_COOKIES_PATH=$path;
	}
	
	/////////////////////METODOS DE UNA SOLA LLAMADA DESDE EL TEMPLATE///////////////////
	
	/**
	 * Publico: imprime el javascript necesario para el funcionamiento de la clase
	 *
	 */
	function setJavascript($path=''){
		
		if(!is_null($this->NO_JAVASCRIPT_PATH)){
			echo '<noscript><meta http-equiv="refresh" content="0;'.$this->NO_JAVASCRIPT_PATH.'/></noscript>';
		}
		if(!is_null($this->NO_COOKIES_PATH)){
			echo "
			<script type=\"text/javascript\">\n
			<!--//--><![CDATA[<!--\n
			if (!navigator.cookieEnabled) {\n
				document.location.href='".$this->NO_COOKIES_PATH."';\n
			}\n
			//--><!]]>\n
			</script>\n";
		}
		echo '<script type="text/javascript" src="'.$path.'PPF/class.ppf.HTML.js"></script>'."\r\n";
		echo '<script type="text/javascript" src="'.$path.'PPF/class.ppf.DBValidator.js"></script>'."\r\n";
	}
	
	/**
	 * Publico: produce el postback de un formulario
	 *
	 */
	function postBack(){
		if(isset($this->POST['form'])){
			PF::postBack($this->POST['form'],$this->POST);
		}
		foreach($this->DATAFORM as $form => $data){
			PF::postBack($form,$data);
		}
	}
	
	/////////////////////METODOS A UTILIZAR DESDE EL TEMPLATE///////////////////////////
	
	/**
	 * Publico: codifica una url GET
	 *
	 * @param string $string
	 * @return string
	 */
	function encodeURL($string,$retorno=NULL){
		return PF::encodeURL($string,$retorno);
	}
	
	/**
	 * Publico: indica si un panel esta habilitado o no 
	 *
	 * @param string $panel
	 * @return bool
	 */
	function show($panel){
		if(isset($this->PANELS[$panel]) && $this->PANELS[$panel]===true){
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * Publico: permite debugguear una variable
	 *
	 * @param string $texto
	 * @param var $obj
	 */
	function debug($texto,$obj){
		if($this->DEBUG){
			$this->oDebug->debugVar($texto,$obj);
		}
	}	 
	
	/**
	 * Publico: carga el diccionario que corresponda de acuerdo a los datos
	 * varSession: nombre de la variable de sesión que almacena el lenguage
	 * idIdioma:forzamiento del idioma
	 * Retorna el id del idioma selectado
	 *
	 * @param string $varSession
	 * @param int $idIdioma
	 * @return int $idIdioma
	 */
	function loadLanguage($varSession,$idIdioma=NULL){
		if(is_null($idIdioma)){
			if(!isset($_SESSION[$varSession])){
				$_SESSION[$varSession]=1;
			}
			$idIdioma=$_SESSION[$varSession];
		}
		$_SESSION[$varSession]=$idIdioma;
		require_once($this->LANGUAGE_PATH.'lan_'.$idIdioma.'.php');
		return $idIdioma;
	}
	
	
	
}
?>