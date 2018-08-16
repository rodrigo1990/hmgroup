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
require_once('clases/class.cms.video.php'); //Requiere class.Tijera
require_once('clases/class.cms.tipo_imagen.php');
require_once('clases/class.cms.categoria_imagen.php');
require_once('clases/class.cms.tbl.idioma.php');
require_once('clases/class.cms.config.php');
require_once('clases/class.control.Autorizacion.php');
require_once('clases/class.cms.HtmlEditor.php');


//EXTRAS
require_once('clases/classMailHTMLv2.php');
require_once('clases/class.AdapterImagen.php');
require_once('clases/class.Interfaz.php');
require_once('clases/class.Paginador.php');
require_once('clases/class.Tijera.php');
require_once('clases/classTraffic.php');

//CUSTOM
require_once('clases/class.tbl.producto.php');
require_once('clases/class.tbl.categoria.php');
require_once('clases/class.tbl.usuario.php');
require_once('clases/class.tbl.lista.php');
require_once('clases/class.tbl.noticia.php');


class Main extends PFApplication {
	
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
	
	/**
	 * Array de datos del menu principal
	 * Se cargan en la instancia del main
	 *
	 * @var array
	 */
	var $aMenuPrincipal;
	
	/**
	 * Array de datos del menu secundario
	 * Se cargan en la instancia del módulo que corresponda
	 *
	 * @var array
	 */
	var $aMenuSecundario;
	
	/**
	 * Indicador del indice del menu principal que se está navegando actualmente
	 * Se carga desde la instancia del módulo que corresponda
	 *
	 * @var int
	 */
	var $menuPrincipalSelectado;
	
	/**
	 * Indicador del indice del menu secundario que se está navegando actualmente
	 * Se carga desde la instancia del módulo que corresponda
	 *
	 * @var int
	 */
	var $menuSecundarioSelectado;	
	
	/**
	 * Publica: Almacena el id del lenguage selectado en este momento
	 *
	 * @var int
	 */
	var $lan;
	
	var $paginado;
	var $oPaginador;
	var $edicion;
	var $oParams;
		
	////////////Publicas///////////////
	
	/**
	 * Constructor
	 * Inicializa lo conexión a Base de datos, el menú principal y componentes comunes a todos los módulos
	 * 
	 *
	 */
	function Main(){
		
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
		$this->lan=$this->loadLanguage('CONTROL_LENGUAGE',1);
		
		//PAGINADO
		$this->oPaginador=new Paginador();
		$this->paginado=10;
		
		//PERMISOS
		$this->isRoot=false;
		$this->edicion=false;
		
		//VERIFICACION DE PARAMETROS
		$this->oParams=new PFParam();
		
		//MENUES
		$this->menuPrincipalSelectado=false;
		$this->menuSecundarioSelecatdo=false;
		
		$this->aMenuSecundario=array();
		$this->aMenuPrincipal=array();
		
		
		$this->aMenuPrincipal[0]=array(
			'texto'=>'Productos',
			'link'=>'producto.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Productos'
			);
		$this->aMenuPrincipal[6]=array(
			'texto'=>'Noticias',
			'link'=>'noticia.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Noticias'
			);
			
		$this->aMenuPrincipal[1]=array(
			'texto'=>'Categorias',
			'link'=>'categoria.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Categorias'
			);
			
		$this->aMenuPrincipal[3]=array(
			'texto'=>'Administradores',
			'link'=>'usuarioAdm.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Administradores'
			);
			
		$this->aMenuPrincipal[4]=array(
			'texto'=>'Usuarios Registrados',
			'link'=>'usuarioReg.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Usuarios Registrados'
			);
			
		$this->aMenuPrincipal[5]=array(
			'texto'=>'Lista de Precios',
			'link'=>'lista.mod.php?'.$this->encodeURL('accion=listar',true),
			'alt'=>'Lista de Precios'
			);
		
		$this->aMenuPrincipal[2]=array(
			'texto'=>'Close Session',
			'link'=>'login.mod.php?'.$this->encodeURL('accion=closeSession',true),
			'alt'=>'Close Session'
			);
		$this->checkIsUser();
		
		//CUSTOM
			
	}
	
	/**
	 * Privado: A partir de un vector o de una matriz, efectúa la traducción a un
	 * archivo xml, y agrega los errores y mensajes pertinentes
	 *
	 * @param array $array
	 * @param boolean $retornar
	 * @return string
	 */
	function listaToXML($array=array(),$retornar=false){
		
		$esMultiple=false;
		$cadena='';
		$string=array();
		
		$string[]='<?xml version="1.0" encoding="utf-8"?>';
		$string[]='<contenido>';
		$string[]='<mensaje>';
		if($this->MSG){
			$string[]=$this->CDATA($this->MSG);
		}
		$string[]='</mensaje>';
		$string[]='<errores>';
		if($this->ERROR){
			foreach($this->ERRORS as $error){
				$string[]=$this->CDATA($error);
			}
		}
		$string[]='</errores>';
		$string[]='<data>';
		foreach($array as $ind => $item){
			if(is_array($item)){
				/*$string[]='<item>';
				foreach($item as $variable => $valor){
					$string[]='<'.$variable.'>';
					$string[]=$this->CDATA($valor);
					$string[]='</'.$variable.'>';
				}
				$string[]='</item>';*/
				$esMultiple=true;
				$cadena='';
				foreach($item as $variable => $valor){
					$cadena.=$variable.'="'.$valor.'" ';
				}
				$string[]='<item '.$cadena.'></item>';
				
			}
			else{
				/*$string[]='<'.$ind.'>';
				$string[]=$this->CDATA($item);
				$string[]='</'.$ind.'>';*/
				$cadena.=$ind.'="'.$item.'" ';
			}
		}
		
		if(!$esMultiple){
			$string[]='<item '.$cadena.'></item>';
		}
		
		$string[]='</data>';
		$string[]='</contenido>';
		
		$stringFinal=implode("\n",$string);
		if($retornar){
			return $stringFinal;
		}
		echo $stringFinal;
	}
	
	/**
	 * Privado: encierra una cadena en caracteres CDATA para evitar conflictos con la nomenclatura XML
	 *
	 * @param unknown_type $string
	 * @return unknown
	 */
	function CDATA($string){
		return '<![CDATA['.$string.']]';
	}
	
	/**
	 * Privado: Chequea si el cliente es usuario, si lo es carga su perfil de usuario, si no lo es lo saca del control
	 *
	 */
	function checkIsUser(){
		if(!isset($_SESSION['CONTROL_CLAVE']) || $_SESSION['CONTROL_CLAVE']!=SESSION_CLAVE){
			$this->rejectUser();
		}
		
		if (!$this->tienePermiso('CONTROL_TOTAL','TOTAL')){
			$this->rejectUser();
		}
		
		if(isset($_SESSION['CONTROL_ROOT']) && $_SESSION['CONTROL_ROOT']==SESSION_ROOT){
			$this->isRoot=true;
		}
	}
	
	/**
	 * Publico: dirije al cliente no identificado a una gráfica determinada
	 *
	 */
	function rejectUser(){
		include('error_autenticacion.tpl.php');
		exit();
	}
	
	/**
	 * Publico: indica si un usuario tiene autorizacion para ejecutar cierta acción sobre cierto objeto
	 *
	 * @param string $objeto
	 * @param string $tipo
	 * @return bool
	 */
	function tienePermiso($objeto,$tipo){
		if($this->isRoot){
			return true;
		}
		$oAut=new Autorizacion();
		return $oAut->tieneAutorizacion($objeto,$tipo);
	}
	
	
	function verContenido(){
		$extension=trim(strtolower(PF::extension($this->GET['archivo'])));
		$arrayImg=array('jpeg','jpg','png','gif');
		
		if(in_array($extension,$arrayImg)){
			$this->imagen=getimagesize(PF::getPath($this->GET['archivo']));
			$this->imagen['nombre']=PF::getPath($this->GET['archivo']);
			$this->imagen['0']+=50;
			$this->imagen['1']+=100;
			$this->load('verImagen_tpl.php');
			return;
		}
		elseif($extension=='flv'){
			$this->imagen['nombre']=PF::getPath($this->GET['archivo']);
			$this->load('verVideo_tpl.php');
			return;
		}
		else{
			header("Location: ".PF::getPath($this->GET['archivo']));
			exit();
		}
	}
	
	function encodeSessionData(){
		$data=base64_encode(serialize($_SESSION));
		return '<input type="hidden" name="sesdata" id="sesdata" value="'.$data.'"/>';
	}
	
	function decodeSessionData(){
		if(isset($this->POST['sesdata'])){
			$data=unserialize(base64_decode($this->POST['sesdata']));
			if(is_array($data)){
				$_SESSION=$data;
			}
		}
	}
	
	
}
?>