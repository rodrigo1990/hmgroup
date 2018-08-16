<?php
require_once('main.php');
class ModCategoria extends Main{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	var $modulo;
	var $arrayItems;
	

	
	
	/**
	 * Constructor
	 *
	 */
	function ModCategoria(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		$this->menuPrincipalSelectado=1;
		$this->DEFAULT='categoria.tpl.php';
		$this->modulo='categoria.mod.php';	
		$this->aMenuSecundario=array(
			0=>array(
				'texto'=>'Listar Categorias',
				'link'=>'categoria.mod.php?'.$this->encodeURL('accion=listar',true),
				'alt'=>''
			),
			1=>array(
				'texto'=>'Nuevo Categoria',
				'link'=>'categoria.mod.php?'.$this->encodeURL('accion=nuevo',true),
				'alt'=>''
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
		
		$this->oParams->addPOST('descripcion','string');
		$this->oParams->addPOST('id_padre','integer');//se pasa el id padre ya que el id categoria lo crea automatico
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
				
		$oObj=new CategoriaManager($this->oDBM);
		$id=$oObj->nuevo($this->POST);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->nuevo();
		}
		else{
			
			
			$this->MSG='Categoria Agregada';
			$this->listar();
		}
		
	}
	
	/**
	 * Actualizar Item
	 *
	 */
	function actualizar(){
		
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('descripcion','string');
		$this->oParams->addPOST('id_padre','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new CategoriaManager($this->oDBM);
		
						
		$ok=$oObj->actualizar($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['id_categoria']=$this->POST['id_categoria'];
			$this->editar();
			return;
		}
		
		
		
		$this->MSG='Categoria Actualizada';
		$this->listar();
		
	
	}
	
	/**
	 * Elimina un Item
	 *
	 */
	function eliminar(){
		
		$this->oParams->addGET('id_categoria','integer');
		$this->oParams->addGET('inicio','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		$this->POST['inicio']=$this->GET['inicio'];
		
		$oObj=new CategoriaManager($this->oDBM);
		
		if($oObj->eliminar($this->GET['id_categoria'])){
			$this->MSG='La Categoria fue eliminada';
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
		
		$this->getListasAuxiliares();//esto crea las listas para los menues con las categorias principales
		
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('id_padre','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->checkPOST($this->POST);
		
		
		
		
		$oObj=new CategoriaManager($this->oDBM);
		/*if($this->POST['id_categoria']!=0){
			$dataCat=$oObj->getRow($this->POST['id_categoria']);
			$this->POST['id_padre']=$dataCat['id_padre'];
		}*/
		
		$this->arrayItems=$oObj->getListado($this->POST['inicio'],$this->paginado,$this->POST['id_padre']);
		//genera el listado con todas las categorias que coinciden con el id padre
		
		$total=$oObj->countTotal($this->POST['id_padre']);//cuenta las filas que coinciden con el id padre
		
		//Cálculo de las paginaciones con el objeto paginador
		$this->oPaginador->calcularPaginacion($this->paginado,$total,$this->POST['inicio']);
		
		//Activación del panel listado 
		$this->activate('panelListadoCategoria');
		
		//Carga de template
		$this->load('categoria.tpl.php');	
		
	}
	
		
	/**
	 * Publico: Nuevo Item
	 *
	 */
	function nuevo(){
		
		$this->getListasAuxiliares();
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formCategoria','accion','crear');
		
		//Activación del panel del formulario
		$this->activate('panelFormCategoria');
		
		//Carga de template
		$this->load('categoria.tpl.php');		
	
	}
	
	/**
	 * Publico: Formulario de Edición
	 *
	 */
	function editar(){
		
		$this->getListasAuxiliares();
		
		//Carga de datos 
		$oObj=new CategoriaManager($this->oDBM);
		$this->DATAFORM['formCategoria']=$oObj->getRow($this->GET['id_categoria']);
				
		//Pasaje a modo edición
		$this->edicion=true;
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formCategoria','accion','actualizar');
		
		//Activación del panel del formulario
		$this->activate('panelFormCategoria');
		
		//Carga de template
		$this->load('categoria.tpl.php');	
	}
	
		
	function activar(){
		
		
		
		$oObj=new CategoriaManager($this->oDBM);
		$oObj->activar($this->POST['id_categoria']);
		$this->listar();
	}
	
	function desactivar(){
		
		
		
		$oObj=new CategoriaManager($this->oDBM);
		$oObj->desactivar($this->POST['id_categoria']);
		$this->listar();
	}
	
	function bajarPos(){
		
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('id_padre','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new CategoriaManager($this->oDBM);
		$oObj->bajarOrden($this->POST['id_categoria']);
		$this->listar();
	}
	
	function subirPos(){
		
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('id_padre','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new CategoriaManager($this->oDBM);
		$oObj->subirOrden($this->POST['id_categoria']);
		$this->listar();
	}
	
	function getListasAuxiliares(){
		
		
		$oLista=new CategoriaManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getSubcategorias(0),'id_categoria','descripcion');
		
	}
	
	
	
	
}
                    
$ModCategoria=new ModCategoria();
?>