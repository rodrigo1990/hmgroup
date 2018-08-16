<? 
session_start();

//CONFIG
require_once('../config.php');
require_once('control.config.php');

//PF FRAMEWORK
require_once('PPF/class.ppf.Application.php');

//CMS Y CONTROL
require_once('clases/class.cms.pais.php');
require_once('clases/class.cms.objeto.php');
require_once('clases/class.cms.perfil.php');
require_once('clases/class.cms.perfil_permiso.php');
require_once('clases/class.cms.perfil_usuario.php');
require_once('clases/class.cms.permiso.php');
require_once('clases/class.cms.usuario.php');
require_once('clases/class.cms.tipo_usuario.php');
require_once('clases/class.cms.imagen.php'); //Requiere class.Tijera
require_once('clases/class.cms.tipo_imagen.php');
require_once('clases/class.cms.categoria_imagen.php');
require_once('clases/class.cms.tbl.idioma.php');
require_once('clases/class.control.Autorizacion.php');


//COMPONENTES



//EXTRAS
require_once('clases/classMailHTMLv2.php');
require_once('clases/class.AdapterImagen.php');
require_once('clases/class.Interfaz.php');
require_once('clases/class.Paginador.php');
require_once('clases/class.Tijera.php');
require_once('clases/classTraffic.php');
require_once('clases/class.ppf.flex.php');


//CUSTOM
require_once('clases/class.tbl.articulo.php');
require_once('clases/class.tbl.categoria.php');
require_once('clases/class.tbl.categoria_video.php');
require_once('clases/class.tbl.procedencia.php');
require_once('clases/class.tbl.rel_categoria_articulo.php');
require_once('clases/class.tbl.rel_categoria_video.php');
require_once('clases/class.tbl.relevancia.php');
require_once('clases/class.tbl.tipo_articulo.php');
require_once('clases/class.tbl.video.php');
require_once('clases/class.tbl.comentario.php');
require_once('clases/class.tbl.estado_comentario.php');
require_once('clases/class.tbl.cliente.php');
require_once('clases/class.tbl.rel_usuario_categoria.php');


//Banners
require_once('clases/class.banner.banner.php');
require_once('clases/class.banner.espacio.php');
require_once('clases/class.banner.banner_espacio.php');
require_once('clases/class.banner.click.php');
require_once('clases/class.banner.impresion.php');
require_once('clases/class.banner.tipo_espacio.php');
require_once('clases/class.banner.adapter.espacio.php');

class Ajax extends PFApplication {
	
	////////////Privadas//////////////
	
	/**
	 * Contenedor del objeto DBManager
	 *
	 * @var DBManager
	 */
	var $oDBM; 
	
	/**
	 * Indicador si el usuario es root
	 * NO UTILIZAR
	 *
	 * @var bool
	 */
	var $isRoot;
	
	
	
	var $lan;
	var $edicion;
	var $idUser;
	var $token;

	
	
	////////////Publicas///////////////
	var $oPaginador;
	
	/**
	 * Constructor
	 * Inicializa lo conexión a Base de datos, el menú principal y componentes comunes a todos los módulos
	 * Realiza la verificación de usuarios autorizados
	 *
	 */
	function Ajax(){
		
		/* INICIALIZACION */
		
		$this->PFApplication();
		
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		//JAVASCRIPT y COOKIES DESHABILITADOS
		//$this->setNoJavascriptPath('noJavascript.php');
		//$this->setNoCookiesPath('noCookies.php');
		
		//BASE DE DATOS
		$this->oDBM=PFDBManager::nuevaConexion('mysql',DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		
		//DEFAULT
		//LENGUAGE y TRADUCCIONES
		$this->USE_LANGUAGE=true;
		$this->LANGUAGE_PATH='idioma/';
		$this->lan=$this->loadLanguage('CONTROL_LENGUAGE');
		
			
		//PERMISOS
		$this->edicion=false;
		
		//PAGINADO
		$this->oPaginador=new Paginador();
		
		/* CARGA DE INFORMACION DE USUARIO Y TOKENS */
		$this->initUser();
		
			
	}
	
	function initUser(){
		
		
		$this->idUser=0;
		if(isset($this->GET['id_usuario'])){
			$this->idUser=$this->GET['id_usuario'];
		}
		if(isset($this->POST['id_usuario'])){
			$this->idUser=$this->POST['id_usuario'];
		}
		$this->token='';
		if(isset($this->GET['token'])){
			$this->token=$this->GET['token'];
		}
		if(isset($this->POST['token'])){
			$this->token=$this->POST['token'];
		}
		//FALSO USUARIO
		$this->idUser=3;
		$this->token='x';
		
		$oAut=new Autorizacion();
		$ok=$oAut->initAutorizaciones($this->idUser,$this->token,$this->oDBM);
		
		if($oAut->tieneAutorizacionLocal('CONTROL_TOTAL','TOTAL')){
			$oUsu=new Usuario($this->oDBM);
			$_SESSION['PF_USER']=$oUsu->getRow($this->idUser);
		}
	
	}
	
	function tienePermiso($objeto,$tipo){
		$oAut=new Autorizacion();
		return $oAut->tieneAutorizacionLocal($objeto,$tipo);
	}
	
	function errorPermiso(){
		$this->ERROR=true;
		$this->ERRORS[]='No posee permisos para ejecutar esta acción';
		$this->listaToXML(array());
		exit();
	}
	
	function listaToXML($array=array(),$retornar=false){
		
		if($retornar){
			return PFlex::listaToXML($array,true,$this->MSG,$this->ERROR,$this->ERRORS);
		}
		PFlex::listaToXML($array,false,$this->MSG,$this->ERROR,$this->ERRORS);
		$funciones=debug_backtrace();
		//print_r($funciones);
		$fileName=$funciones[1]['function'].'_'.get_class($this).'.html';
		$this->buildFlexSimulator($fileName);
	}
	
	function listaToJSON($array=array(),$retornar=false){
		
		if($retornar){
			return PFlex::listaToJSON($array,true,$this->MSG,$this->ERROR,$this->ERRORS);
		}
		PFlex::listaToJSON($array,false,$this->MSG,$this->ERROR,$this->ERRORS);
		$funciones=debug_backtrace();
		//print_r($funciones);
		$fileName=$funciones[1]['function'].'_'.get_class($this).'.html';
		$this->buildFlexSimulator($fileName);
	}
	
	function addRuta($array,$field,$ruta){
		return PF::addRuta($array,$field,$ruta);
	}
	
	function debugFlex($filename='debug.std.txt'){
		PFlex::debugFlex($filename,$this->GET,$this->POST,$this->FILES);
	}
	
	function buildFlexSimulator($filename='simulator.std.html'){
		PFlex::buildFlexSimulator($filename,$this->GET,$this->POST,$this->FILES);
	}
	
	

	
}
?>