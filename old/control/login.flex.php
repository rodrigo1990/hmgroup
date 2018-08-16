<? 
session_start();

//CONFIG
require_once('../config.php');
require_once('control.config.php');
//PAGE
require_once('PPF/class.ppf.Application.php');

//CONTROL
require_once('clases/class.cms.objeto.php');
require_once('clases/class.cms.perfil.php');
require_once('clases/class.cms.perfil_permiso.php');
require_once('clases/class.cms.perfil_usuario.php');
require_once('clases/class.cms.permiso.php');
require_once('clases/class.cms.usuario.php');
require_once('clases/class.control.Autorizacion.php');
require_once('clases/classMailHTMLv2.php');
require_once('clases/class.ppf.flex.php');
//CUSTOM
require_once('clases/class.tbl.publicidad.php');
require_once('clases/class.tbl.estado_extension.php');
require_once('clases/class.tbl.tipo.php');
require_once('clases/class.tbl.telefono.php');
require_once('clases/class.tbl.carrier.php');
require_once('clases/class.tbl.operario.php');
require_once('clases/class.tbl.empresa.php');
require_once('clases/class.tbl.empresa_carrier.php');
require_once('clases/class.tbl.estado_empresa.php');
require_once('clases/class.tbl.estado_usuario.php');
require_once('clases/class.CarrierTranslation.php');
require_once('clases/class.TelefonoLoader.php');
require_once('clases/class.AdapterAudioExtension.php');
require_once('clases/class.AsteriskAudioManager.php');
require_once('clases/class.AsteriskExtension.php');
require_once('clases/class.AsteriskCall.php');

class Login extends PFApplication {
	
	/*
	Privadas
	*/
	var $oDBM;
	
	
	
	/*
	Publicas
	*/
	
	
	/**
	 * Constructor
	 *
	 */
	function Login(){
		/* INICIALIZACION */
		$this->PFApplication();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		
		//BASE DE DATOS
		$this->oDBM=PFDBManager::nuevaConexion('mysql',DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		
		//DEFAULT
		$this->EXEC_DEFAULT='doNothing';
		
		
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
		
		//CUSTOM
		
			
	}
	
	
	
	/**
	 * Publico: Ejecuta el Login de un usuario, y si corresponde, carga los permisos
	 *
	 * 
	 * @return bool
	 */
	function checkLoginUser(){
		
		$oUsu=new Usuario($this->oDBM);
		$idUser=$oUsu->checkLoginUser($this->GET['username'],$this->GET['pass']);
		
		if($idUser){
			
			//CARGA DE PERMISOS
			$arrayPermisos=$oUsu->getPermisos($idUser);
			$oAut=new Autorizacion();
			$oAut->loadAutorizacionesLocal($arrayPermisos);
			
			
			$this->MSG='Login Correcto';
			$dataUser=$oUsu->getRow($idUser);
			$dataUser['token']=$oAut->getToken();
			
		}
		else{
			$this->ERROR=true;
			$this->ERRORS[]='Login Incorrecto';
			$dataUser=array();
		}
		
		$this->listaToXML($dataUser);
		return;
	}
	
	
	
	/**
	 * Publico: cierra la sesión de un usuario
	 *
	 */
	function closeSession(){
		$oAut=new Autorizacion();
		$oAut->cerrarSesionLocal($this->GET['token']);
		$this->MSG='Sesión Cerrada';
		exit();
	}
	
	
	function doNothing(){
		return;
	}
	
	function listaToXML($array=array(),$retornar=false){
		
		if($retornar){
			return PFlex::listaToXML($array,true,$this->MSG,$this->ERROR,$this->ERRORS);
		}
		PFlex::listaToXML($array,false,$this->MSG,$this->ERROR,$this->ERRORS);
		
	}
	
	function debugFlex($filename='debug.std.txt'){
		PFlex::debugFlex($filename,$this->GET,$this->POST,$this->FILES);
	}
	
	function buildFlexSimulator($filename='simulator.std.html'){
		PFlex::buildFlexSimulator($filename,$this->GET,$this->POST,$this->FILES);
	}
	
	
}

$oLogin=new Login();
?>