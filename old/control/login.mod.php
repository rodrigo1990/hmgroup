<? 
session_start();

//CONFIG
require_once('../config.php');
require_once('control.config.php');
//PAGE
require_once('PPF/class.ppf.Application.php');

//CUSTOM
require_once('clases/class.cms.objeto.php');
require_once('clases/class.cms.perfil.php');
require_once('clases/class.cms.perfil_permiso.php');
require_once('clases/class.cms.perfil_usuario.php');
require_once('clases/class.cms.permiso.php');
require_once('clases/class.cms.usuario.php');
require_once('clases/class.control.Autorizacion.php');

class Login extends PFApplication {
	
	/*
	Privadas
	*/
	var $oDBM;
	
	
	
	/*
	Publicas
	*/
	var $diaSemana;
	var $meses;
	
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
		
		//JAVASCRIPT y COOKIES DESHABILITADOS
		//$this->setNoJavascriptPath('noJavascript.php');
		//$this->setNoCookiesPath('noCookies.php');
		
		//BASE DE DATOS
		$this->oDBM=PFDBManager::nuevaConexion('mysql',DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		
		//DEFAULT
		$this->DEFAULT='login.tpl.php';	
		
		$this->diaSemana=array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
		$this->meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre');
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
		
		//CUSTOM
		
			
	}
	
	
	
	/**
	 * Publico: Ejecuta el Login de un usuario, y si corresponde, carga los permisos
	 *
	 * @param string $username
	 * @param string $pass
	 * @return bool
	 */
	function checkLoginUser($username,$pass){
		
		$oUsu=new Usuario($this->oDBM);
		$idUser=$oUsu->checkLoginUser($username,$pass);
		if($idUser){
			
			//CARGA DE PERMISOS
			$arrayPermisos=$oUsu->getPermisos($idUser);
			$oAut=new Autorizacion();
			$oAut->loadAutorizaciones($arrayPermisos);
			
			//CARGA DE DATOS DE SESIÖN
			$_SESSION['CONTROL_CLAVE']=SESSION_CLAVE;
			$_SESSION['id_user']=$idUser;
			$_SESSION['user']=$username;
			
			return $idUser;
		}
		else{
			return false;
		}
	}
	
	/**
	 * Publico: permite loguear a un usuario en el sistema
	 *
	 */
	function LoginUser(){
		$username=mysql_real_escape_string($this->POST['user']);
		$pass=mysql_real_escape_string($this->POST['pass']);
		$idUser=$this->checkLoginUser($username,$pass);
		if($idUser){
			header("Location:inicio.mod.php");
			exit();
		}
		else{
			$this->MSG='Error de login, inténtelo de nuevo por favor!';
			$this->load('login.tpl.php');
		}
	}
	
	/**
	 * Publico: cierra la sesión de un usuario
	 *
	 */
	function closeSession(){
		session_destroy();
		header("Location:login.mod.php");
			exit();
	}
	
}

$oLogin=new Login();
?>