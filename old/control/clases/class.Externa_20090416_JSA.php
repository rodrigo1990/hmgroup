<?php
class Externa extends PFApplication{
	
	////////////Privadas//////////////
	
	/**
	 * Contenedor del objeto DBManager
	 *
	 * @var DBManager
	 */
	var $oDBM; 
	
	/**
	 * Publica: Almacena el id del lenguage selectado en este momento
	 *
	 * @var int
	 */
	var $lan;
	
	////////////Publicas///////////////
	var $MSG;
	var $ERROR;
	var $ERRORS;
	
	/**
	 * Constructor
	 * Inicializa lo conexi�n a Base de datos, el men� principal y componentes comunes a todos los m�dulos
	 * Realiza la verificaci�n de usuarios autorizados
	 *
	 */
	function Externa(){
		/* INICIALIZACION */
		//$this->page();
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
		$this->USE_LANGUAGE=false;
		//$this->LANGUAGE_PATH=PF::getPath('control/idioma/');
		//if(isset($_GET['lan'])){
		//	$this->lan=$this->loadLanguage('CONTROL_LENGUAGE',$_GET['lan']);
		//}
		//else{
		//	$this->lan=$this->loadLanguage('CONTROL_LENGUAGE');
		//}
		
		
		//CUSTOM
		$this->checkUser();
				
	}
	
	function getMenu(){
		$menu=array(
				0=>array('titulo_1'=>'Ordenar Online','titulo_2'=>'Order Online','link'=>'orderonline.php'),
				1=>array('titulo_1'=>'Downloads','titulo_2'=>'Downloads','link'=>'downloads.php'),
				2=>array('titulo_1'=>'Marketing','titulo_2'=>'Marketing','link'=>'marketing.php'),
				3=>array('titulo_1'=>'Comentarios','titulo_2'=>'Comments','link'=>'comments.php'),
				4=>array('titulo_1'=>'Cerrar Sesi�n','titulo_2'=>'Log Out','link'=>'close.php')
		);
		return $menu;
	}
	
	function getOptionsMarketing(){
		$oTipo=new Tipo_marketingManager($this->oDBM);
		$lista=$oTipo->getData();
		return $lista;
	}
	
	function getObjPaginado($paginado,$total,$inicio){
		$oPaginador=new Paginador();
		$oPaginador->calcularPaginacion($paginado,$total,$inicio);
		return $oPaginador;
	}
	
	function getMarketing($idTipo,$from,$qty){
		$oMa=new MarketingManager($this->oDBM);
		$lista= $oMa->getMarketingsActivos($from,$qty,$idTipo);
		foreach($lista as $ind => $item){
			$lista[$ind]['imagen']=$oMa->getImagen($item['id_marketing']);
		}
		return $lista;
	}
	
	function getCantMarketing($idTipo){
		$oMa=new MarketingManager($this->oDBM);
		return $oMa->countTotalActivos($idTipo);
	}
	
	function getProductos(){
		$oPro=new ProductsManager($this->oDBM);
		return $oPro->getProductosActivos();
	}
	
	function getDownloads($idProducto,$from,$qty){
		$oDo=new DownloadsManager($this->oDBM);
		return $oDo->getDownloadsActivos($from,$qty,$idProducto);
	}
	
	function getCantDownloads($idProducto){
		$oDo=new DownloadsManager($this->oDBM);
		return $oDo->countTotalActivos($idProducto);
	}
	
	function getTipoPedidos(){
		$oPe=new Tipo_pedidoManager($this->oDBM);
		return $oPe->getData();
	}
	
		
	function enviarOrden($arrayData){
		if(trim($arrayData['id_producto'])=='' || trim($arrayData['id_tipo_pedido'])==''){
			$this->ERROR=true;
			$this->ERRORS[]='You must select a product and type or order<br>Debe seleccionar un producto y un tipo de pedido';
			return false;
		}
		
		$asunto='PRODUCT ORDER - CLIENT ZONE - KGI';
		$msg='Client Information: '.PF::html($_SESSION['USER']['nombre'],true).' '.PF::html($_SESSION['USER']['apellido'],true).'<br>';
		$msg.='Product: '.PF::html($arrayData['id_producto'],true).'<br>';
		$msg.='Type or Order:'.PF::html($arrayData['id_tipo_pedido'],true).'<br>';
		$msg.='Comments:<br> '.PF::html($arrayData['comentario'],true).'<br>';
		$this->enviarEmail(ADMIN_EMAIL,$asunto,$msg);
		$this->MSG='Your order has been succesfully sent!<br>Su orden ha sido enviada exitosamente!';
		return true;
	}
	
	function enviarComentario($arrayData){
		if(trim($arrayData['comentario'])==''){
			$this->ERROR=true;
			$this->ERRORS[]='You must post a comment<br>Debe enviar un comentario';
			return false;
		}
		
		$asunto='COMMENT - CLIENT ZONE - KGI';
		$msg='Client Information: '.PF::html($_SESSION['USER']['nombre'],true).' '.PF::html($_SESSION['USER']['apellido'],true).'<br>';
		$msg.='Comments:<br> '.PF::html($arrayData['comentario'],true).'<br>';
		$this->enviarEmail(ADMIN_EMAIL,$asunto,$msg);
		$this->MSG='Your comment has been succesfully sent!<br>Su comentario ha sido enviado exitosamente!';
		return true;
	}
	
	function enviarEmail($direccion,$asunto,$mensaje){

		$oMail=new mailHTML();
		$oMail->asunto=$asunto;
		$oMail->origen=ADMIN_EMAIL;
		$oMail->origen_nombre=ADMIN_NAME;
		$oMail->url=URL_ABSOLUTA;
		if(SIMULAR_EMAILS=='1'){
			$oMail->simulado=true;
		}
		$oMail->getPlantilla(PF::getPath('plantillas/plantillaMensaje.html'));
		$oMail->replace('#ASUNTO#',$oMail->asunto);
		$oMail->replace('#MENSAJE#',$mensaje);
		$oMail->replace('#URL#',URL_ABSOLUTA);
		$oMail->to=$direccion;
		$oMail->send();
	}
	
	function checkUser(){
		if(!isset($_SESSION['USER'])){
			if(!isset($_GET['usuario']) || !isset($_GET['pass'])){
				header("Location:error_login.php");
				exit();
			}
			else{
				$oCli=new Cliente($this->oDBM);
				$idCli=$oCli->checkLoginUser($_GET['usuario'],$_GET['pass']);
				if(!$idCli){
					header("Location:error_login.php");
					exit();
				}
				else{
					$_SESSION['USER']=$oCli->getRow($idCli);
				}
			}
		}
	}
}
?>