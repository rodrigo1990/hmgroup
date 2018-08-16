<?php
require_once('main.php');
class ModUsuario extends Main{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	var $modulo;
	var $arrayItems;
	var $tipo;
	

	
	
	/**
	 * Constructor
	 *
	 */
	function ModUsuario(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		$this->menuPrincipalSelectado=3;
		$this->DEFAULT='usuario.tpl.php';
		$this->modulo='usuarioAdm.mod.php';	
		$this->aMenuSecundario=array(
			0=>array(
				'texto'=>'Listar Administradores',
				'link'=>'usuarioAdm.mod.php?'.$this->encodeURL('accion=listar',true),
				'alt'=>''
			),
			1=>array(
				'texto'=>'Nuevo Administrador',
				'link'=>'usuarioAdm.mod.php?'.$this->encodeURL('accion=nuevo',true),
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
		
		//$this->oParams->addPOST('id_usuario','integer');
		$this->oParams->addPOST('email','string');//
		$this->oParams->addPOST('user_pass','string');//
		$this->oParams->addPOST('user_name','string');//
		$this->oParams->addPOST('nombre','string');//
		$this->oParams->addPOST('apellido','string');//
		/*$this->oParams->addPOST('direccion','string');
		$this->oParams->addPOST('ciudad','string');
		$this->oParams->addPOST('provincia','string');
		$this->oParams->addPOST('pais','string');
		$this->oParams->addPOST('cp','string');
		$this->oParams->addPOST('empresa','string');
		$this->oParams->addPOST('cargo','string');*/
		$this->oParams->addPOST('id_tipo','integer');
		$this->oParams->addPOST('id_estado','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		//$oPerfil = new Perfil($this->oDBM);
		$arrayPerfil=array(0=>1);
		
		//print_r($this->POST);
		
		$oObj=new UsuarioManager($this->oDBM);
		$id=$oObj->nuevo($this->POST,$arrayPerfil);
		
		
		if(!$id){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->nuevo();
			return false;
		}
		else{
			
			
			$this->MSG='Usuario Agregado';
			$this->listar();
		}
		
	}
	
	/**
	 * Actualizar Item
	 *
	 */
	function actualizar(){
		
		$this->oParams->addPOST('id_usuario','string');//
		$this->oParams->addPOST('email','string');//
		$this->oParams->addPOST('user_pass','string');//
		$this->oParams->addPOST('user_name','string');//
		$this->oParams->addPOST('nombre','string');//
		$this->oParams->addPOST('apellido','string');//
		$this->oParams->addPOST('id_tipo','integer');
		$this->oParams->addPOST('id_estado','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		
		$oObj=new UsuarioManager($this->oDBM);
		$arrayPerfil=array(0=>1);
						
		$ok=$oObj->actualizar($this->POST,$arrayPerfil);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObj->aErrors;
			$this->GET['id_usuario']=$this->POST['id_usuario'];
			$this->editar();
			return;
		}
		
		
		
		$this->MSG='Usuario Actualizado';
		$this->listar();
		
	
	}
	
	/**
	 * Elimina un Item
	 *
	 */
	function eliminar(){
		
		$this->oParams->addGET('id_usuario','integer');
		$this->oParams->addGET('inicio','integer');
		$this->oParams->checkPOST($this->POST);
		$this->oParams->checkGET($this->GET);
		$this->POST['inicio']=$this->GET['inicio'];
		
		$oObj=new UsuarioManager($this->oDBM);
		
		if($oObj->eliminar($this->GET['id_usuario'])){
			$this->MSG='El Usuario fue eliminado';
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
		
		
		$this->oParams->addPOST('form','string');
		$this->oParams->addPOST('inicio','integer');
		$this->oParams->checkPOST($this->POST);
		$this->tipo=1;
		
		
		$oObj=new UsuarioManager($this->oDBM);
		$where[] = "id_tipo = 2";
		$this->arrayItems=$oObj->getListado($this->POST['inicio'],$this->paginado,$where);
		
		
		$total=$oObj->countTotal(1);
		
		//Cálculo de las paginaciones con el objeto paginador
		$this->oPaginador->calcularPaginacion($this->paginado,$total,$this->POST['inicio']);
		
		//Activación del panel listado 
		$this->activate('panelListadoUsuarios');
		
		//Carga de template
		$this->load('usuario.tpl.php');	
		
	}
	
		
	/**
	 * Publico: Nuevo Item
	 *
	 */
	function nuevo(){
		
		$this->getListasAuxiliares();
		
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formUsuario','accion','crear');
		$this->fillForm('formUsuario','id_tipo','2');
		$this->tipo=1;
		
		//Activación del panel del formulario
		$this->activate('panelFormUsuario');
		
		//Carga de template
		$this->load('usuario.tpl.php');		
	
	}
	
	/**
	 * Publico: Formulario de Edición
	 *
	 */
	function editar(){
		
		$this->getListasAuxiliares();
		
		//Carga de datos 
		$oObj=new UsuarioManager($this->oDBM);
		$this->DATAFORM['formUsuario']=$oObj->getRow($this->GET['id_usuario']);
				
		//Pasaje a modo edición
		$this->edicion=true;
		$this->tipo=1;
		
		//Completado de la acción a realizar al enviar los datos
		$this->fillForm('formUsuario','accion','actualizar');
		
		//Activación del panel del formulario
		$this->activate('panelFormUsuario');
		
		//Carga de template
		$this->load('usuario.tpl.php');	
	}
	
		
	function activar(){
		
		
		
		$oObj=new UsuarioManager($this->oDBM);
		$oObj->activar($this->POST['id_usuario']);
		$this->listar();
	}
	
	function desactivar(){
		
		
		
		$oObj=new UsuarioManager($this->oDBM);
		$oObj->desactivar($this->POST['id_usuario']);
		$this->listar();
	}
	
	function bajarPos(){
		
		
		
		$oObj=new UsuarioManager($this->oDBM);
		$oObj->bajarOrden($this->POST['id_usuario']);
		$this->listar();
	}
	
	function subirPos(){
		
		
		
		$oObj=new UsuarioManager($this->oDBM);
		$oObj->subirOrden($this->POST['id_usuario']);
		$this->listar();
	}
	
	function getListasAuxiliares(){
		
		/*
		$oLista=new UsuarioManager($this->oDBM);
		$this->lista=I::arrayToOptions($oLista->getData(),'id_usuario','descripcion');
		*/
	}
	
	
	
	
}
                    
$ModUsuario=new ModUsuario();
?>