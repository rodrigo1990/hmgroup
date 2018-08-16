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
	 * Inicializa lo conexión a Base de datos, el menú principal y componentes comunes a todos los módulos
	 * Realiza la verificación de usuarios autorizados
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
		
		
		
				
	}
	
	
	function getProductoDestacado(){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getDestacado();
	}
	
	function getProductosEnPromocion(){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getPromociones();
	}
	
	function getProductosNovedad(){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getNovedades();
	}
	
	function getImagenesProducto($idProd){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getImagenes($idProd);
	}
	
	function getProducto($idProducto){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getRow($idProducto);
	}
	
	function getDatosCategoria($idCat){
		$oCat=new CategoriaManager($this->oDBM);
		return $oCat->getRow($idCat);
	}
	
	function getSubCategorias($idCat){
		$oCat=new CategoriaManager($this->oDBM);
		return $oCat->getSubCategorias($idCat);
	}
	
	function getProductosCategoria($idCat){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->getProductosCategoria($idCat);
	}
	
	function buscarProductos($texto){
		$oPro=new ProductoManager($this->oDBM);
		return $oPro->buscarProductos($texto);
	}
	
	function checkLoginUser($user,$pass){
		$oUsu=new Usuario($this->oDBM);
		$idUser=$oUsu->checkLoginUser($user,$pass);
		if($idUser){
			
			$arrayPermisos=$oUsu->getPermisos($idUser);
			$oAut=new Autorizacion();
			$oAut->loadAutorizaciones($arrayPermisos);
			return $idUser;
		}
		else{
			$this->ERROR=true;
			$this->ERRORS[]='Usuario o Password Incorrecto';
			return false;
		}
	}
	
	function downloadLista(){
		$oAut=new Autorizacion();
		if($oAut->tieneAutorizacion('LISTA_PRECIO','DESCARGADISTRIBUIDOR')){
			return $this->downloadListaPreciosDistrib();
		}
		elseif($oAut->tieneAutorizacion('LISTA_PRECIO','DESCARGAMAYORISTA')){
			return $this->downloadListaPreciosMay();
		}
		return false;
	}
	
	function downloadListaPreciosDistrib(){
		$oObj=new CMSConfig($this->oDBM);
		$ListaDistribuidor=$oObj->getVar('LISTADISTRIBUIDOR');
		if($ListaDistribuidor!=''){
			PF::dowloadFile(PF::getPath(RUTA_CONTENIDO.'/'.$ListaDistribuidor),'Lista_precios');
			exit();
		}
		$this->ERROR=true;
		$this->ERRORS[]='No hay lista de precios disponible para descarga';
		
		
		return false;
	}
	
	function downloadListaPreciosMay(){
		$oObj=new CMSConfig($this->oDBM);
		$ListaMayorista=$oObj->getVar('LISTAMAYORISTA');
		if($ListaMayorista!=''){
			PF::dowloadFile(PF::getPath(RUTA_CONTENIDO.'/'.$ListaMayorista),'Lista_precios');
			exit();
		}
		$this->ERROR=true;
		$this->ERRORS[]='No hay lista de precios disponible para descarga';
		return false;
	}
	/*
	function getMenu(){
		$menu=array(
				0=>array('titulo_1'=>'Ordenar Online','titulo_2'=>'Order Online','link'=>'orderonline.php'),
				1=>array('titulo_1'=>'Downloads','titulo_2'=>'Downloads','link'=>'downloads.php'),
				2=>array('titulo_1'=>'Marketing','titulo_2'=>'Marketing','link'=>'marketing.php'),
				3=>array('titulo_1'=>'Comentarios','titulo_2'=>'Comments','link'=>'comments.php'),
				4=>array('titulo_1'=>'Cerrar Sesión','titulo_2'=>'Log Out','link'=>'close.php')
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
	*/
}
?>