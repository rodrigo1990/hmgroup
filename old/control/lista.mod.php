<?php
require_once('main.php');
class ModLista extends Main{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	var $modulo;
	var $arrayItems;
	var $arrayLista;
	var $ListaMayorista;
	var $ListaDistribuidor;
	

	
	
	/**
	 * Constructor
	 *
	 */
	function ModLista(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		$this->menuPrincipalSelectado=5;
		$this->DEFAULT='lista.tpl.php';
		$this->modulo='lista.mod.php';	
		$this->aMenuSecundario=array(
			0=>array(
				'texto'=>'Listar Listas de Precios',
				'link'=>'lista.mod.php?'.$this->encodeURL('accion=listar',true),
				'alt'=>''
			),
			/*1=>array(
				'texto'=>'Nueva Lista',
				'link'=>'lista.mod.php?'.$this->encodeURL('accion=nuevo',true),
				'alt'=>''
			)*/
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
		
		$this->oParams->addPOST('variable','string');
		$this->oParams->addPOST('archivo','string');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
				
		$oObj=new CMSConfig($this->oDBM);
		$arrayFiles=$this->FILES['archivo'];
		
		$filesize=filesize($arrayFiles['tmp_name']);
		if( $filesize>MAX_UPLOAD_FILESIZE){
			$this->aErrors[]='El archivo supera el tamaño máximo permitido';
			return false;
		}
		//print_r($arrayFiles);
		$fileName=uniqid('PRECIOS').'.'.PF::extension($arrayFiles['name']);
		$ok=move_uploaded_file($arrayFiles['tmp_name'],PF::getPath(RUTA_CONTENIDO.'/'.$fileName));
				
		if(!$ok){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['variable']=$this->POST['variable'];
			$this->nuevo();
		}
		else{
			$oObj->setVar($this->POST['variable'],$fileName);
			$this->MSG='Lista Agregada';
			$this->listar();
		}
		
	}
	
	/**
	 * Actualizar Item
	 *
	 */
	function actualizar(){// no usada
		
		
		
		$oObj=new ListaManager($this->oDBM);
		
						
		$ok=$oObj->actualizar($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['id_lista']=$this->POST['id_lista'];
			$this->editar();
			return;
		}
		
		
		
		$this->MSG='Lista Actualizada';
		$this->listar();
		
	
	}
	
	/**
	 * Elimina un Item
	 *
	 */
	function eliminar(){
		
		$this->oParams->addGET('ruta','string');
		$this->oParams->addGET('variable','string');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);	
	
		
		PF::deleteFile(PF::getPath($this->GET['ruta']));
		$oObj = new CMSConfig($this->oDBM);
		$ok=PF::isfile(PF::getPath($this->GET['ruta']));
		if(!$ok){
			$oObj->setVar($this->GET['variable'],null);
			$this->MSG='La Lista fue eliminada';
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
		$this->oParams->checkPOST($this->POST);
				
		
		$oObj=new CMSConfig($this->oDBM);
		$this->ListaMayorista=$oObj->getVar('LISTAMAYORISTA');
		$this->ListaDistribuidor=$oObj->getVar('LISTADISTRIBUIDOR');
		/*$this->arrayItems=$oObj->getListado($this->POST['inicio'],$this->paginado);
		
		$oLis=new AdapterImagen($this->oDBM);
		if (count($this->arrayItems)>0){
			$this->arrayLista=$oLis->getListaPrecios($this->arrayItems[0]['id_lista']);
		}		
		$total=$oObj->countTotal();*/
		
		//Cálculo de las paginaciones con el objeto paginador
		$this->oPaginador->calcularPaginacion($this->paginado,0,$this->POST['inicio']);
		
		//Activación del panel listado 
		$this->activate('panelListadoLista');
		
		//Carga de template
		$this->load('lista.tpl.php');	
		
	}
	
		
	/**
	 * Publico: Nuevo Item
	 *
	 */
	function nuevo(){
		
		$this->getListasAuxiliares();
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formLista','accion','crear');
		$this->fillForm('formLista','variable',$this->GET['variable']);
		
		//Activación del panel del formulario
		$this->activate('panelFormLista');
		
		//Carga de template
		$this->load('lista.tpl.php');		
	
	}
	
	/**
	 * Publico: Formulario de Edición
	 *
	 */
	function editar(){
		
		$this->getListasAuxiliares();
		
		//Carga de datos 
		$oObj=new ListaManager($this->oDBM);
		$this->DATAFORM['formLista']=$oObj->getRow($this->GET['id_lista']);
				
		//Pasaje a modo edición
		$this->edicion=true;
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formLista','accion','actualizar');
		
		//Activación del panel del formulario
		$this->activate('panelFormLista');
		
		//Carga de template
		$this->load('lista.tpl.php');	
	}
	
		
	function activar(){
		
		
		
		$oObj=new ListaManager($this->oDBM);
		$oObj->activar($this->POST['id_lista']);
		$this->listar();
	}
	
	function desactivar(){
		
		
		
		$oObj=new ListaManager($this->oDBM);
		$oObj->desactivar($this->POST['id_lista']);
		$this->listar();
	}
	
	function bajarPos(){
		
		
		
		$oObj=new ListaManager($this->oDBM);
		$oObj->bajarOrden($this->POST['id_lista']);
		$this->listar();
	}
	
	function subirPos(){
		
		
		
		$oObj=new ListaManager($this->oDBM);
		$oObj->subirOrden($this->POST['id_lista']);
		$this->listar();
	}
	
	function getListasAuxiliares(){
		
		/*
		$oLista=new ListaManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getData(),'id_lista','descripcion');
		*/
	}
	
		
	
}
                    
$ModLista=new ModLista();
?>