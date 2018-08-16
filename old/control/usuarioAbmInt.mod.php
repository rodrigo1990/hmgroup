<? 
require_once('main.php');
class ModUsuario extends Main{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	var $actualiza;
	var $perfiles;
	var $permisos;
	var $perfilSeteado;
	var $aPerfilUsuario;
	var $aPerfilPermiso;
	var $modulo;
	var $objetos;

	
	
	
	
	
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
		$this->menuPrincipalSelectado=0;
		$this->DEFAULT='usuariosAbmInt_inicio_tpl.php';
		$this->modulo='usuarioAbmInt.mod.php';	
		$this->aMenuSecundario=array(
		0=>array(
			'texto'=>'Nuevo Usuario',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=nuevoUsuario',true),
			'alt'=>''
			),
		1=>array(
			'texto'=>'Usuarios',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=verListadoUsuarios',true),
			'alt'=>''
			),
		2=>array(
			'texto'=>'Nuevo Perfil',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=nuevoPerfil',true),
			'alt'=>''
			),
		3=>array(
			'texto'=>'Perfiles',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=verListadoPerfiles',true),
			'alt'=>''
			),
		4=>array(
			'texto'=>'Nuevo Permiso',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=nuevoPermiso',true),
			'alt'=>'Permisos'
			),
		5=>array(
			'texto'=>'Permisos',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=verPermisos',true),
			'alt'=>'Permisos'
			),
		6=>array(
			'texto'=>'Nuevo Objeto',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=nuevoObjeto',true),
			'alt'=>'Objetos'
			),
		7=>array(
			'texto'=>'Objetos',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=verObjetos',true),
			'alt'=>'Objetos'
			),
		8=>array(
			'texto'=>'Testeo de Permisos',
			'link'=>'usuarioAbmInt.mod.php?'.$this->encodeURL('accion=testeoPermiso',true),
			'alt'=>'Testeo'
			)
		);
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
	}
	
	
	
	///////////////////////////////  USUARIOS ///////////////////////////////////////////////
	
	/**
	 * Publico: Permite desplegar el formulario para ingresar un nuevo usuario
	 *
	 */
	function nuevoUsuario(){
		/*
		Debe desplegar un formulario para ingresar los datos de un nuevo usuario
		Reocordar colocar contraseña y repetir contraseña
		*/
		$oPerfil= new Perfil($this->oDBM);
		$this->perfiles=$oPerfil->getData();
		$this->activate('panelUsuario');
		$this->fillForm('formNuevoUsuario','accion','crearUsuario');
		$this->load('usuarioAbmInt.tpl.php');	
	}
	
	function crearUsuario(){
		
		
		
		$oUsu=new Usuario($this->oDBM);
		if(!isset($this->POST['perfiles'])){
			$this->POST['perfiles']=array();
		}
		$idUsuario=$oUsu->nuevoUsuario($this->POST,$this->POST['perfiles']);
		if(!$idUsuario){
			$this->ERROR=true;
			$this->ERRORS=$oUsu->aErrors;
			$this->nuevoUsuario();
			return;
		}
		$this->MSG='Usuario Creado';
		$this->verListadoUsuarios();
	}
	
	
	
	/**
	 * Publico: muestra el listado de usuarios
	 *
	 */
	function verListadoUsuarios(){
		/*
		Debe mostrar el listado de usuarios con la opción de editar y eliminar cada uno
		*/
		$oUsu=new Usuario($this->oDBM);
		$this->usuarios=$oUsu->getData();
		$this->activate('panelListadoUsuarios');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
		
	
		
		
	/**
	 * Publico: Permite editar los datos de un usuario
	 *
	 */
	function editarUsuario(){
		
		/*
		Mostrar un formulario con todos los datos del usuario para editarlos
		Recordar colocar contraseña y repetir contraseña
		*/
		$this->activate('panelUsuario');
		$this->actualiza=true;
		$oUsu=new Usuario($this->oDBM);
		$this->aPerfilUsuario=$oUsu->getPerfiles($this->GET['id_usuario']);
		$this->DATAFORM['formNuevoUsuario']=$oUsu->getRow($this->GET['id_usuario']);
		$oPerfil= new Perfil($this->oDBM);
		$this->perfiles=$oPerfil->getData();
		$this->fillForm('formNuevoUsuario','user_pass2',$this->DATAFORM['formNuevoUsuario']['user_pass']);
		$this->fillForm('formNuevoUsuario','perfiles',$this->aPerfilUsuario);
		$this->fillForm('formNuevoUsuario','accion','actualizarUsuario');
		$this->load('usuarioAbmInt.tpl.php');
		
	}
	
	/**
	 * Publico: Actualiza los datos de un usuario
	 *
	 */
	function actualizarUsuario(){
		/* Recibe por POST los datos del usuario a partir de editarUsuario() y actualiza
		Recordar validar que no sea una contraseña o nombre de usuario ya utilizados
		Recordar validar que contraseña sea igual a repetir contraseña
		*/
		$oUsu=new Usuario($this->oDBM);
		if(!isset($this->POST['perfiles'])){
			$this->POST['perfiles']=array();
		}
		
		$okUpdate=$oUsu->actualizarUsuario($this->POST,$this->POST['perfiles']);
		if($okUpdate===false){
			$this->ERROR=true;
			$this->ERRORS[]="El Usuario o la Clave ya existen, elija otra";
			$this->GET['id_usuario']=$this->POST['id_usuario'];
			$this->editarUsuario();
			return;
		}
		$this->MSG='Los datos fueron actualizados';
		$this->verListadoUsuarios();
		
	}
	
	/**
	 * Publico: Permite eliminar un usuario
	 *
	 */
	function eliminarUsuario(){
		
		$oUsu=new Usuario($this->oDBM);
		if($oUsu->eliminarUsuario($this->GET['id_usuario'])){
			$this->MSG='El usuario ha sido borrado';
			$this->verListadoUsuarios();
		}//hay que poner un else con caso error??
	}
	
	////////////////////////////////  FIN USUARIOS /////////////////////////////////////
	
	/////////////////////////////////  PERFILES /////////////////////////////////
	
	/**
	 * Publico: Muestra el formulario necesario para ingresar un nuevo perfil
	 *
	 */
	function nuevoPerfil(){
		
		/*
		Debe mostrarse un formulario para cargar los datos del nuevo perfil
		Deben mostrarse el listado de permisos para poder indicar cuáles pertenecen al perfil
		*/
		$oPermiso= new Permiso($this->oDBM);
		$this->permisos=$oPermiso->getData();
		$this->fillForm('formPerfil','accion','cargarPerfil');
		$this->activate('panelNuevoPerfil');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	function cargarPerfil(){
		$oPerfil= new Perfil($this->oDBM);
		if(!isset($this->POST['permisos'])){
			$this->POST['permisos']=array();
		}
		if($idPerfil=$oPerfil->nuevoPerfil($this->POST)){
				$this->MSG='El perfil fue creado';
				$this->verListadoPerfiles();
		}else{
			$this->ERROR=true;
			$this->ERRORS=$oPerfil->aErrors;
			$this->nuevoPerfil();
		}
	}
	
	/**
	 * Publico: muestra el listado de perfiles en el sistema
	 *
	 */
	function verListadoPerfiles(){
		/*
		Debe mostrar el listado de perfiles con la opción de editar y eliminar cada uno
		*/
		$oPerfil=new Perfil($this->oDBM);
		$this->perfiles=$oPerfil->getData();
		$this->activate('panelListadoPerfiles');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	/**
	 * Publico: permite ver y editar los datos de un perfil
	 *
	 */
	function editarPerfil(){
		/*
		Deben obtenerse los datos del perfil y editarlos en un formulario
		También deben mostrarse todos los permisos y cuáles están asociados al perfil 
		mediante checkboxes
		*/
		$this->activate('panelNuevoPerfil');
		$this->actualiza=true;
		$oPerfil=new Perfil($this->oDBM);
		$this->DATAFORM['formPerfil']=$oPerfil->getRow($this->GET['id_perfil']);
		$oPermiso= new Permiso($this->oDBM);
		
		$this->permisos=$oPermiso->getData();
		$this->aPerfilPermiso=$oPerfil->getPermisos($this->GET['id_perfil']);
		$this->fillForm('formPerfil','accion','actualizarPerfil');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	/**
	 * Publico: Actualiza los datos de un perfil
	 *
	 */
	function actualizarPerfil(){
		/* Recibe datos por Post y actualiza el perfil
		 Se actualizan los datos del perfil y todos los permisos que lo integran
		*/
		$oPerfil=new Perfil($this->oDBM);
		$oPermiso=new Permiso($this->oDBM);
		if(!isset($this->POST['permisos'])){
			$this->POST['permisos']=array();
		}
		$idPerfil=$oPerfil->actualizarPerfil($this->POST);
		if($idPerfil===false){
			$this->ERROR=true;
			$this->ERRORS=$oPerfil->aErrors;
			$this->nuevoPerfil();
		}
		else{
			$this->MSG='Los datos fueron actualizados';
			$this->verListadoPerfiles();
		}
	}
	
	
	/**
	 * Publico: Permite eliminar un usuario
	 *
	 */
	function eliminarPerfil(){
		
		$oPerfil=new Perfil($this->oDBM);
		if($oPerfil->eliminarPerfil($this->GET['id_perfil'])){
			$this->MSG='El Perfil ha sido borrado';
			$this->verListadoPerfiles();
		}
	}
	
	//////////////////////////////  FIN PERFILES  //////////////////////////////////
	
	
	//////////////////////////////  PERMISOS //////////////////////////////////
	
	function nuevoPermiso(){
		$oObjeto=new Objeto($this->oDBM);
		$this->objetos=$oObjeto->getData();
		$this->fillForm('formPermiso','accion','cargarPermiso');
		$this->activate('panelFormPermiso');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	function cargarPermiso(){
		$oPermiso=new Permiso($this->oDBM);
		$idPermiso=$oPermiso->nuevoPermiso($this->POST);
		if($idPermiso===false){
			$this->ERROR=true;
			$this->ERRORS=$oPermiso->aErrors;
			$this->nuevoPermiso();
		}
		else{
			$this->MSG='El permiso fue creado';
			$this->verPermisos();
		}
	}
	
	function verPermisos(){
		$oPermiso=new Permiso($this->oDBM);
		$this->permisos=$oPermiso->getData();
		$this->activate('panelListadoPermisos');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	function editarPermiso(){
		$oObjeto=new Objeto($this->oDBM);
		$this->objetos=$oObjeto->getData();
		
		$oPermiso=new Permiso($this->oDBM);
		$this->DATAFORM['formPermiso']=$oPermiso->getRow($this->GET['id_permiso']);
		$this->actualiza=true;
		$this->fillForm('formPermiso','accion','actualizarPermiso');
		$this->activate('panelFormPermiso');
		$this->load('usuarioAbmInt.tpl.php');
		
	}
	
	function actualizarPermiso(){
		$oPermiso=new Permiso($this->oDBM);
		$ok=$oPermiso->actualizarPermiso($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oPermiso->aErrors;
			$this->GET['id_permiso']=$this->POST['id_permiso'];
			$this->editarPermiso();
		}
		else{
			$this->MSG='El permiso fue actualizado';
			$this->verPermisos();
		}
	}
	
	function eliminarPermiso(){
		$oPermiso=new Permiso($this->oDBM);
		$oPermiso->eliminarPermiso($this->GET['id_permiso']);
		$this->MSG='El permiso fue eliminado';
			$this->verPermisos();
	}
	
	////////////////////////////// FIN  PERMISOS //////////////////////////////////
	
	
	//////////////////////////////   OBJETOS  /////////////////////////////////////
	
	
	function nuevoObjeto(){
		$oObjeto=new Objeto($this->oDBM);
		$this->objetos=$oObjeto->getData();
		$this->fillForm('formObjeto','accion','cargarObjeto');
		$this->activate('panelFormObjeto');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	function cargarObjeto(){
		$oObjeto=new Objeto($this->oDBM);
		$idObjeto=$oObjeto->nuevoObjeto($this->POST);
		if($idObjeto===false){
			$this->ERROR=true;
			$this->ERRORS=$idObjeto->aErrors;
			$this->nuevoObjeto();
		}
		else{
			$this->MSG='El Objeto fue creado';
			$this->verObjetos();
		}
	}
	
	function verObjetos(){
		$oObjeto=new Objeto($this->oDBM);
		$this->objetos=$oObjeto->getData();
		$this->activate('panelListadoObjetos');
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	function editarObjeto(){
		$oObjeto=new Objeto($this->oDBM);
		
		$this->DATAFORM['formObjeto']=$oObjeto->getRow($this->GET['id_objeto']);
		$this->actualiza=true;
		$this->fillForm('formObjeto','accion','actualizarObjeto');
		$this->activate('panelFormObjeto');
		$this->load('usuarioAbmInt.tpl.php');
		
	}
	
	function actualizarObjeto(){
		$oObjeto=new Objeto($this->oDBM);
		$ok=$oObjeto->actualizarObjeto($this->POST);
		if($ok===false){
			$this->ERROR=true;
			$this->ERRORS=$oObjeto->aErrors;
			$this->GET['id_objeto']=$this->POST['id_objeto'];
			$this->editarObjeto();
		}
		else{
			$this->MSG='El objeto fue actualizado';
			$this->verObjetos();
		}
	}
	
	function eliminarObjeto(){
		$oObjeto=new Objeto($this->oDBM);
		$oObjeto->eliminarObjeto($this->GET['id_objeto']);
		$this->MSG='El objeto fue eliminado';
		$this->verObjetos();
	}
	
	
	//////////////////////////////  FIN OBJETOS /////////////////////////////////////
	
	
	//////////////////////////////  TESTEO DE PERMISOS   ////////////////////////////
	
	function testeoPermiso(){
		
		if($this->tienePermiso('USUARIO','CARGA')){
			$this->MSG='Tiene Permiso';
		}
		else{
			$this->MSG='NO Tiene Permiso';
		}
		$this->load('usuarioAbmInt.tpl.php');
	}
	
	
	//////////////////////////////  FIN TESTEO DE PERMISOS  ////////////////////////
	
	//////////////////////////////  POR IMPLEMENTAR ////////////////////////////////////
	
	/**
	 * Publico: Muestra los perfiles a los cuales pertenece el usuario
	 *
	 */
	function verPerfilesDeUsuario(){
		
		/*
		Debe mostrar los datos del usuario y un listado con todos los perfiles
		Con checkboxes se indica a cuáles perfiles pertenece el usuario
		*/
		
	}
	
	/**
	 * Publico: actualiza la pertenencia del usuario a distintos perfiles
	 *
	 */
	function actualizarPerfilesDeUsuario(){
		
		/*
		Viene de verPerfilesUsuario(), debe actualizar el listado de perfiles
		a los que pertenece el usuario
		*/
		
		
	}
	
	
	////////////////////////////////  FIN POR IMPLEMENTAR ///////////////////////////////////
	
}
                    
$modUsuario=new ModUsuario();
?>