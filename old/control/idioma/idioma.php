<? 
session_start();

//CONFIG
require_once('../../config.php');
require_once('../control.config.php');
//PAGE
require_once('../PPF/class.ppf.Application.php');

//CUSTOM
require_once('../clases/class.cms.tbl.idioma.php');
require_once('../clases/class.cms.tbl.idioma_traduccion.php');

class LanguageManager extends PFApplication{
	
	/*
	Privadas
	*/
	var $oDBM;
	
	
	/*
	Publicas
	*/
	var $seccion;
	var $rutaLanguageFiles;
	var $listado;
	var $edicion;
	var $listadoTraducciones;
	var $selectado;
	
	
	
	
	
	/**
	 * Constructor
	 *
	 */
	function LanguageManager(){
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
		$this->seccion='INICIO';
		$this->rutaLanguageFiles='.';
		
		//CUSTOM
		$this->DEFAULT='idioma_tpl.php';	
		$this->edicion=false;
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
	}
	
	/**
	 * Publico: muestra el formulario para cargar un nuevo idioma
	 *
	 */
	function nuevoIdioma(){
		/*
		Recibe: void
		Muestra el formulario para cargar un nuevo idioma
		No olvidar setear el campo acción
		*/
		$this->fillForm('formIdioma','accion','cargarIdioma');
		$this->activate('formIdioma');
		$this->load('idioma_tpl.php');
	}
	
	function cargarIdioma(){
		$oIdioma=new cmsIdioma($this->oDBM);
		$id=$oIdioma->insert($this->POST);
		if($id!==false){
			$this->MSG='Idioma agregado';
			$this->listarIdiomas();
		}
		else{
			$this->ERROR=true;
			$this->ERRORS=$oIdioma->aErrors;
			$this->nuevoIdioma();
		}
	}
	
	/**
	 * Publico: lista todas los idiomas existentes
	 *
	 */
	function listarIdiomas(){
		/*
		Recibe: void
		Muestra el listado de todos los idiomas
		*/
		$oIdioma=new cmsIdioma($this->oDBM);
		$this->listado=$oIdioma->getData();
		$this->activate('listaIdiomas');
		$this->load('idioma_tpl.php');
	}
	
	/**
	 * Publico: muestra el formulario para cargar una nueva traduccion
	 *
	 */
	function nuevaTraduccion(){
		/*
		Recibe: void
		Muestra el formulario para cargar una nueva traduccion
		No olvidar setear el campo acción
		*/
		$oIdioma=new cmsIdioma($this->oDBM);
		$this->listado=$oIdioma->getData();
		$this->fillForm('formTraduccion','accion','cargarTraduccion');
		$this->activate('formTraduccion');
		$this->load('idioma_tpl.php');
	}
	
	function cargarTraduccion(){
	
		$oTra=new cmsIdioma_traduccion($this->oDBM);
		foreach($this->POST['traduccion'] as $ind=> $val){
			$oTra->insert(array('id_idioma'=>$ind,'clave'=>$this->POST['clave'],'traduccion'=>$val));
		}
		$this->MSG='La traducción fue agregada';
		$this->listarTraducciones();
	}
	
	/**
	 * Publico: lista todas las traducciones existentes
	 *
	 */
	function listarTraducciones(){
		/*
		Recibe: void
		Muestra la tabla con todas las traducciones
		*/
		$oIdioma=new cmsIdioma($this->oDBM);
		$this->listado=$oIdioma->getData();
		if(!isset($this->GET['id_idioma'])){
			$this->GET['id_idioma']=$this->listado[0]['id_idioma'];
		}
		$oTra=new cmsIdioma_traduccion($this->oDBM);
		$this->listadoTraducciones=$oTra->getTraducciones($this->GET['id_idioma']);
		$this->activate('listaTraducciones');
		$this->load('idioma_tpl.php');
	}
	
	/**
	 * Publico: permite editar los valores de una traduccion
	 *
	 */
	function editarTraduccion(){
		/*
		Recibe: id_idioma , clave
		Muestra el formulario con los datos que corresponden a esa traduccion
		No olvidar setear el campo acción
		*/
		$oTra=new cmsIdioma_traduccion($this->oDBM);
		$aDatos=$oTra->getClave($this->GET['clave']);
		$this->fillForm('formTraduccion','accion','actualizarTraduccion');
		$this->fillForm('formTraduccion','clave',$aDatos[0]['clave']);
		foreach($aDatos as $item){
			$this->fillForm('formTraduccion','traduccion['.$item['id_idioma'].']',$item['traduccion']);
		}
		$this->edicion=true;
		$oIdioma=new cmsIdioma($this->oDBM);
		$this->listado=$oIdioma->getData();
		$this->activate('formTraduccion');
		$this->load('idioma_tpl.php');
	}
	
	/**
	 * Publico: actualiza los datos de una traduccion
	 *
	 */
	function actualizarTraduccion(){
		/*
		Recibe: POST de datos de una traduccion
		Debe validar los datos de la traducción (clave y traduccion no vacía) y actualizar en
		la tabla
		*/
		$oTra=new cmsIdioma_traduccion($this->oDBM);
		foreach($this->POST['traduccion'] as $ind=> $val){
			$oTra->update(array('id_idioma'=>$ind,'clave'=>$this->POST['clave'],'traduccion'=>$val));
		}
		$this->MSG='La traducción fue actualizada';
		$this->listarTraducciones();
		
	}
	
	/**
	 * Publico: permite la edición de un idioma
	 *
	 */
	function editarIdioma(){
		/*
		Recibe: id_idioma 
		Muestra el formulario con los datos que corresponden a ese idioma
		No olvidar setear el campo acción
		*/
		$oIdioma=new cmsIdioma($this->oDBM);
		$this->DATAFORM['formIdioma']=$oIdioma->getRow($this->GET['id_idioma']);
		$this->fillForm('formIdioma','accion','actualizarIdioma');
		$this->edicion=true;
		$this->activate('formIdioma');
		$this->load('idioma_tpl.php');
	}
	
	/**
	 * Publico: actualiza los cambios realizados en un idioma
	 *
	 */
	function actualizarIdioma(){
		/*
		Recibe: POST de datos de un idioma
		Debe validar los datos del idioma (nombre no vacío) y actualizar la tabla
		*/
		$oIdioma=new cmsIdioma($this->oDBM);
		$ok=$oIdioma->update($this->POST);
		if($ok!==false){
			$this->MSG='Idioma actualizado';
			$this->listarIdiomas();
		}
		else{
			$this->ERROR=true;
			$this->ERRORS=$oIdioma->aErrors;
			$this->GET['id_idioma']=$this->POST['id_idioma'];
			$this->editarIdioma();
		}
	}
	
	/**
	 * Publico: permite eliminar una traduccion
	 *
	 */
	function eliminarTraduccion(){
		/*
		Recibe: id_idioma, clave
		Debe eliminar la traducción que corresponde
		*/
		$oTra=new cmsIdioma_traduccion($this->oDBM);
		$oTra->eliminarClave($this->GET['clave']);
		$this->MSG='La clave fue eliminada';
		$this->listarTraducciones();
	}
	
	/**
	 * Publico: permite eliminar un idioma
	 *
	 */
	function eliminarIdioma(){
		/*
		Recibe: id_idioma
		Debe eliminar el idioma si y solo si no hay traducciones dependientes del 
		*/
		$oTrad=new cmsIdioma_traduccion($this->oDBM);
		$oTrad->eliminarIdioma($this->GET['id_idioma']);
		$oIdioma=new cmsIdioma($this->oDBM);
		$oIdioma->delete($this->GET['id_idioma']);
		$this->MSG='Idioma eliminado';
		$this->listarIdiomas();
	}
	
	/**
	 * Publico: actualiza los archivos del diccionario del sistema,
	 * pasa los datos almacenados en las tablas a archivos de acceso rápido para el sistema
	 *
	 */
	function actualizarDiccionario(){
		$oIdioma=new cmsIdioma($this->oDBM);
		$oTrad=new cmsIdioma_traduccion($this->oDBM);
		$aIdiomas=$oIdioma->getData();
		foreach($aIdiomas as $item){
			$fp=fopen('lan_'.$item['id_idioma'].'.php','w');
			$aTrad=array();
			$aTrad=$oTrad->getTraducciones($item['id_idioma']);
			fwrite($fp,"<?php\r\n");
			foreach($aTrad as $itemTrad){
				fwrite($fp,'define("LAN_'.$itemTrad['clave'].'","'.str_replace('\\\\"','\\"',str_replace('"','\"',$itemTrad['traduccion'])).'");'."\r\n");
			}
			fwrite($fp,"?>");
			fclose($fp);
		}
		$this->MSG='Idiomas Actualizados';
		$this->load('idioma_tpl.php');
	}
	
}
                        
$oLM=new LanguageManager();
?>