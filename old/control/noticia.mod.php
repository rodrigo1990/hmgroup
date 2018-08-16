<?php
require_once('main.php');
class ModNoticia extends Main{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	var $modulo;
	var $arrayItems;
	var $datosProd;
	var $arrayImg;
	

	
	
	/**
	 * Constructor
	 *
	 */
	function ModNoticia(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		$this->menuPrincipalSelectado=6;
		$this->DEFAULT='noticia.tpl.php';
		$this->modulo='noticia.mod.php';	
		$this->aMenuSecundario=array(
			0=>array(
				'texto'=>'Listar Noticias',
				'link'=>'noticia.mod.php?'.$this->encodeURL('accion=listar',true),
				'alt'=>'Listar Noticias'
			),
			1=>array(
				'texto'=>'Nueva Noticia',
				'link'=>'noticia.mod.php?'.$this->encodeURL('accion=nuevo',true),
				'alt'=>'Nueva Noticia'
			)
		);
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
	}
	
	/**
	 * Crear nuevo Item
	 *
	 */
	function crear(){
		
		$this->oParams->addPOST('titulo','string');
		$this->oParams->addPOST('texto','string');
		$this->oParams->addPOST('fecha','string');
		$this->oParams->addPOST('visible','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
				
		$oObj=new NoticiaManager($this->oDBM);
		$id=$oObj->nuevo($this->POST);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->nuevo();
		}else{
			$this->MSG='Noticia Agregada ';
			$this->listar();
		}
		
	}
	
	/**
	 * Actualizar Item
	 *
	 */
	function actualizar(){
		
		$this->oParams->addPOST('id_noticia','integer');
		$this->oParams->addPOST('titulo','string');
		$this->oParams->addPOST('texto','string');
		$this->oParams->addPOST('fecha','string');
		$this->oParams->addPOST('visible','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new NoticiaManager($this->oDBM);
								
		$ok=$oObj->actualizar($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['id_noticia']=$this->POST['id_noticia'];
			$this->editar();
			return;
		}
		
		$this->MSG='Noticia Actualizada';
		$this->listar();
		
	
	}
	
	/**
	 * Elimina un Item
	 *
	 */
	function eliminar(){
		
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->addGET('inicio','integer');
		$this->oParams->checkGET($this->GET);
		$this->POST['inicio']=$this->GET['inicio'];
		
		$oObj=new NoticiaManager($this->oDBM);
		
		if($oObj->eliminar($this->GET['id_noticia'])){
			$oImg=new AdapterImagen($this->oDBM);
			$oImg->eliminarImagenesNoticia($this->GET['id_noticia']);
			$oObj->eliminarVideosNoticia($this->GET['id_noticia']);
			$this->MSG='La Noticia fue eliminada';
		}else{
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
		 }
		$this->listar();
	}
	
	/**
	 * 
	 *
	 */
	function listar(){
				
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->checkPOST($this->POST);
		
		$oObj=new NoticiaManager($this->oDBM);
		$this->arrayItems=$oObj->getListado($this->POST['inicio'],$this->paginado);
		
		$total=$oObj->countTotal();
		
		//Cálculo de las paginaciones con el objeto paginador
		$this->oPaginador->calcularPaginacion($this->paginado,$total,$this->POST['inicio']);
		
		//Activación del panel listado 
		$this->activate('panelListadoNoticia');
		
		//Carga de template
		$this->load('noticia.tpl.php');	
		
	}
	
		
	/**
	 * Publico: Nuevo Item
	 *
	 */
	function nuevo(){
		
		$this->getListasAuxiliares();//en este modulo esto no se usa
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formNoticia','accion','crear');
		
		//Activación del panel del formulario
		$this->activate('panelFormNoticia');
		
		//Carga de template
		$this->load('noticia.tpl.php');		
	
	}
	
	/**
	 * Publico: Formulario de Edición
	 *
	 */
	function editar(){
		
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		
		$this->getListasAuxiliares();// en este modulo esto no se usa
		
		//Carga de datos 
		$oObj=new NoticiaManager($this->oDBM);
		$this->DATAFORM['formNoticia']=$oObj->getRow($this->GET['id_noticia']);
				
		//Pasaje a modo edición
		$this->edicion=true;
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formNoticia','accion','actualizar');
		
		//Activación del panel del formulario
		$this->activate('panelFormNoticia');
		
		//Carga de template
		$this->load('noticia.tpl.php');	
	}
	
		
	function activar(){
		
		$oObj=new NoticiaManager($this->oDBM);
		$oObj->activar($this->POST['id_noticia']);
		$this->listar();
	}
	
	function desactivar(){

		$oObj=new NoticiaManager($this->oDBM);
		$oObj->desactivar($this->POST['id_noticia']);
		$this->listar();
	}
	
	function bajarPos(){
		
		$this->oParams->addPOST('id_noticia','integer');
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new NoticiaManager($this->oDBM);
		$oObj->bajarOrden($this->POST['id_noticia']);//preguntar sobre esto en original del modulo habia post y lo cambié por get
		$this->listar();
	}
	
	function subirPos(){
		
		$this->oParams->addPOST('id_noticia','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new NoticiaManager($this->oDBM);
		$oObj->subirOrden($this->POST['id_noticia']);
		$this->listar();
	}
	
	function getListasAuxiliares(){
		
		
		/*$oLista=new NoticiaManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getData(),'id_noticia','descripcion');*/
		$oLista=new CategoriaManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getDataSelect(),'id_categoria','desc_completa');
		
	}
	
	function imagenes(){
		
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		
		$this->getListasAuxiliares();//en este modulo esto no se usa
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formImg','accion','crearImagenNoticia');
		$this->fillForm('formImg','id_noticia',$this->GET['id_noticia']);
		$oObj=new NoticiaManager($this->oDBM);
		$this->arrayImg=$oObj->getImagenes($this->GET['id_noticia']);
		$this->datosNoticia=$oObj->getRow($this->GET['id_noticia']);
		
		//Activación del panel del formulario
		$this->activate('panelImagenes');
		
		//Carga de template
		$this->load('noticia.tpl.php');		
	
	}
	
	function crearImagenNoticia(){
		
		$this->oParams->addPOST('id_noticia','integer');
		$this->oParams->checkPOST($this->POST);
		
		$oObj=new AdapterImagen($this->oDBM);
		$id=$oObj->nuevaImagenNoticia($this->FILES,$this->POST['id_noticia']);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->listar();
		}
		else{
			$this->GET['id_noticia']=$this->POST['id_noticia'];
			$this->MSG='Imagen Agregada';
			$this->imagenes();
		}
		
	}
		
	function eliminaImagenNoticia(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		$oObj=new AdapterImagen($this->oDBM);
		$id=$oObj->eliminarImagen($this->GET['id_imagen']);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->listar();
		}
		else{
			$this->MSG='Imagen Eliminada';
			$this->imagenes();
		}
		
	}
	
	function subirOrdenImagen(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
				
		$oImg=new AdapterImagen($this->oDBM);
		$oImg->subirOrdenImg($this->GET['id_imagen']);
		$this->imagenes();
	}
	
	function bajarOrdenImagen(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		
		$oImg=new AdapterImagen($this->oDBM);
		$oImg->bajarOrdenImg($this->GET['id_imagen']);
		$this->imagenes();
	}
	
	///////////////////// METODOS VIDEOS ///////////////////////////////
	
	function videos(){
		
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formVideo','accion','crearVideoNoticia');
		$this->fillForm('formVideo','id_noticia',$this->GET['id_noticia']);
		$oObj=new NoticiaManager($this->oDBM);
		$this->arrayVideo=$oObj->getVideos(null,null,array(" id_relacion = ".$this->GET['id_noticia']));
		$this->datosNoticia=$oObj->getRow($this->GET['id_noticia']);
		
		//Activación del panel del formulario
		$this->activate('panelVideos');
		
		//Carga de template
		$this->load('noticia.tpl.php');		
	
	}
	
	
	function crearVideoNoticia(){
		
		$this->oParams->addPOST('id_noticia','integer');
		$this->oParams->addPOST('descripcion','string');
		$this->oParams->checkPOST($this->POST);
		
		$this->GET['id_noticia']=$this->POST['id_noticia'];
		
		$oObj=new NoticiaManager($this->oDBM);
		$id=$oObj->nuevoVideo($this->POST);
		
		if($id){
			$this->MSG='Video agregado';
		}
		else{
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
		}
		$this->videos();
	}
	
	function eliminarVideo(){
		
		/*$oObj=new NoticiaManager($this->oDBM);
		$oObj->eliminarVideoContenido($this->GET['id_video']);
		$this->GET['contenidoID']=$this->GET['id_contenido'];
		$this->MSG='Video Eliminado';
		$this->editarNoticia();*/
		
		
		$this->oParams->addGET('id_video','integer');
		$this->oParams->addGET('id_noticia','integer');
		$this->oParams->checkGET($this->GET);
		$oObj=new NoticiaManager($this->oDBM);
		$id=$oObj->eliminarVideo($this->GET['id_video']);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->listar();
		}
		else{
			$this->MSG='Video Eliminado';
			$this->videos();
		}
	}
	
	function verVideo(){
		$oObj = new VideoManager($this->oDBM);
		$aData=$oObj->getRow($this->GET['idVideo']);
		$this->video=$aData['descripcion'];
		$this->load('video_tpl.php');
	}
	
	
	///////////////////// FIN METODOS VIDEOS ///////////////////////////
	
}
                    
$ModNoticia=new ModNoticia();
?>

