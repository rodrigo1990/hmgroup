<?php
require_once('main.php');
class ModProducto extends Main{
	
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
	var $lista;

	
	
	/**
	 * Constructor
	 *
	 */
	function ModProducto(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		$this->menuPrincipalSelectado=0;
		$this->DEFAULT='producto.tpl.php';
		$this->modulo='producto.mod.php';	
		$this->aMenuSecundario=array(
			0=>array(
				'texto'=>'Listar Productos',
				'link'=>'producto.mod.php?'.$this->encodeURL('accion=listar',true),
				'alt'=>''
			),
			1=>array(
				'texto'=>'Nuevo Producto',
				'link'=>'producto.mod.php?'.$this->encodeURL('accion=nuevo',true),
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
		
		$this->oParams->addPOST('titulo','string');
		$this->oParams->addPOST('descripcion','string');
		$this->oParams->addPOST('descripcion_abreviada','string');
		$this->oParams->addPOST('descripcion_promocion','string');
		$this->oParams->addPOST('descripcion_novedad','string');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('en_promocion','integer');
		$this->oParams->addPOST('es_novedad','integer');
		$this->oParams->addPOST('destacado','integer');
		$this->oParams->addPOST('activo','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		
		
		$oObj=new ProductoManager($this->oDBM);
		$id=$oObj->nuevo($this->POST);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->nuevo();
		}
		else{
			if ($this->POST['destacado']==1){
				$oObj->destacado($id);
			}
			//$this->MSG='Producto Agregado ';
			$this->listar();
		}
		
	}
	
	/**
	 * Actualizar Item
	 *
	 */
	function actualizar(){
		
		$this->oParams->addPOST('id_producto','integer');
		$this->oParams->addPOST('titulo','string');
		$this->oParams->addPOST('descripcion','string');
		$this->oParams->addPOST('descripcion_abreviada','string');
		$this->oParams->addPOST('descripcion_promocion','string');
		$this->oParams->addPOST('descripcion_novedad','string');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('en_promocion','integer');
		$this->oParams->addPOST('es_novedad','integer');
		$this->oParams->addPOST('destacado','integer');
		$this->oParams->addPOST('activo','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new ProductoManager($this->oDBM);
		
						
		$ok=$oObj->actualizar($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['id_producto']=$this->POST['id_producto'];
			$this->editar();
			return;
		}
		if ($this->POST['destacado']==1){
			$oObj->destacado($this->POST['id_producto']);
		}
		//$this->MSG='Producto Actualizado';
		$this->listar();
		
	
	}
	
	/**
	 * Elimina un Item
	 *
	 */
	function eliminar(){
		
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->addGET('id_categoria','integer');
		$this->oParams->addGET('inicio','integer');
		$this->oParams->checkGET($this->GET);
		$this->POST['inicio']=$this->GET['inicio'];
		
		$oObj=new ProductoManager($this->oDBM);
		
		if($oObj->eliminar($this->GET['id_producto'])){
			$oImg=new AdapterImagen($this->oDBM);
			$oImg->eliminarImagenesProducto($this->GET['id_producto']);
			$this->MSG='El Producto fue eliminado';
		}else{
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
		 }
		 $this->POST['id_categoria']=$this->GET['id_categoria'];
		$this->listar();
	}
	
	/**
	 * 
	 *
	 */
	function listar(){
				
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('qty','integer');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addGET('id_categoria','integer');
		$this->oParams->addPOST('id_categoria_vieja','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		if($this->GET['id_categoria']!=0){
			$this->POST['id_categoria']=$this->GET['id_categoria'];
		}
		
		
		if($this->POST['id_categoria']==0){
			$idcat=null;
		}
		else{
			$idcat=$this->POST['id_categoria'];
		}
		if($this->POST['id_categoria_vieja']!=$this->POST['id_categoria']){
			$this->POST['inicio']=0;
		}
		
		if($this->POST['qty']==0){
			$this->POST['qty']=$this->paginado;
		}
		
		$this->getListasAuxiliares();
		$oObj=new ProductoManager($this->oDBM);
		$this->arrayItems=$oObj->getListado($this->POST['inicio'],$this->paginado,$idcat);
		
		$total=$oObj->countTotal($idcat);
		
		//Cálculo de las paginaciones con el objeto paginador
		$this->oPaginador->calcularPaginacion($this->paginado,$total,$this->POST['inicio']);
		
		//Activación del panel listado 
		$this->activate('panelListadoProducto');
		
		$this->fillForm('formBuscar','id_categoria_vieja',$this->POST['id_categoria']);
		$this->fillForm('formBuscar','id_categoria',$this->POST['id_categoria']);
		
		//Carga de template
		$this->load('producto.tpl.php');	
		
	}
	
		
	/**
	 * Publico: Nuevo Item
	 *
	 */
	function nuevo(){
		
		$this->getListasAuxiliares();//en este modulo esto no se usa
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formProducto','accion','crear');
		
		//Activación del panel del formulario
		$this->activate('panelFormProducto');
		
		//Carga de template
		$this->load('producto.tpl.php');		
	
	}
	
	/**
	 * Publico: Formulario de Edición
	 *
	 */
	function editar(){
		
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->checkGET($this->GET);
		
		$this->getListasAuxiliares();// en este modulo esto no se usa
		
		
		//Carga de datos 
		$oObj=new ProductoManager($this->oDBM);
		$this->DATAFORM['formProducto']=$oObj->getRow($this->GET['id_producto']);
				
		//Pasaje a modo edición
		$this->edicion=true;
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formProducto','accion','actualizar');
		
		//Activación del panel del formulario
		$this->activate('panelFormProducto');
		
		//Carga de template
		$this->load('producto.tpl.php');	
	}
	
		
	function activar(){
		
		
		
		$oObj=new ProductoManager($this->oDBM);
		$oObj->activar($this->POST['id_producto']);
		$this->listar();
	}
	
	function desactivar(){
		
		
		
		$oObj=new ProductoManager($this->oDBM);
		$oObj->desactivar($this->POST['id_producto']);
		$this->listar();
	}
	
	function bajarPos(){
		
		$this->oParams->addPOST('id_producto','integer');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new ProductoManager($this->oDBM);
		$oObj->bajarOrden($this->POST['id_producto']);//preguntar sobre esto en original del modulo habia post y lo cambié por get
		$this->listar();
	}
	
	function subirPos(){
		
		$this->oParams->addPOST('id_producto','integer');
		$this->oParams->addPOST('id_categoria','integer');
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new ProductoManager($this->oDBM);
		$oObj->subirOrden($this->POST['id_producto']);
		$this->listar();
	}
	
	function getListasAuxiliares(){
		
		
		/*$oLista=new ProductoManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getData(),'id_producto','descripcion');*/
		$oLista=new CategoriaManager($this->oDBM);
		//$this->lista=I::arrayToOptions($oLista->getDataSelect(),'id_categoria','desc_completa');
		$this->lista=$oLista->getSelectCategorias(); 
		
	}
	
	function imagenes(){
		
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->checkGET($this->GET);
		
		$this->getListasAuxiliares();//en este modulo esto no se usa
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formImg','accion','crearImagenProd');
		$this->fillForm('formImg','id_producto',$this->GET['id_producto']);
		$oObj=new ProductoManager($this->oDBM);
		$this->arrayImg=$oObj->getImagenes($this->GET['id_producto']);
		$this->datosProd=$oObj->getRow($this->GET['id_producto']);
		
		//Activación del panel del formulario
		$this->activate('panelImagenes');
		
		//Carga de template
		$this->load('producto.tpl.php');		
	
	}
	
	function crearImagenProd(){
		
		$this->oParams->addPOST('id_producto','integer');
		$this->oParams->checkPOST($this->POST);
		
		
		$oObj=new AdapterImagen($this->oDBM);
		$id=$oObj->nuevaImagenProducto($this->FILES,$this->POST['id_producto']);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->listar();
		}
		else{
			$this->GET['id_producto']=$this->POST['id_producto'];
		//	$this->MSG='Imagen Agregada';
			$this->imagenes();
		}
		
	}
		
	function eliminaImagenProd(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->checkGET($this->GET);
		$oObj=new AdapterImagen($this->oDBM);
		$id=$oObj->eliminarImagen($this->GET['id_imagen']);
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->listar();
		}
		else{
		//	$this->MSG='Imagen Eliminada';
			$this->imagenes();
		}
		
	}
	
	function subirOrdenImagen(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->checkGET($this->GET);
				
		$oImg=new AdapterImagen($this->oDBM);
		$oImg->subirOrdenImg($this->GET['id_imagen']);
		$this->imagenes();
	}
	
	function bajarOrdenImagen(){
		
		$this->oParams->addGET('id_imagen','integer');
		$this->oParams->addGET('id_producto','integer');
		$this->oParams->checkGET($this->GET);
		
		$oImg=new AdapterImagen($this->oDBM);
		$oImg->bajarOrdenImg($this->GET['id_imagen']);
		$this->imagenes();
	}
	
}
                    
$ModProducto=new ModProducto();
?>

