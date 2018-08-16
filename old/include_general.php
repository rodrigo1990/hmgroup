<?php
@session_start();
//CONFIG
require_once($pathRelativo.'config.php');
require_once($pathRelativo.'control/control.config.php');
//PAGE
require_once($pathRelativo.'control/PPF/class.ppf.Application.php');

//CMS Y CONTROL
require_once($pathRelativo.'control/clases/class.cms.pais.php');
require_once($pathRelativo.'control/clases/class.cms.objeto.php');
require_once($pathRelativo.'control/clases/class.cms.perfil.php');
require_once($pathRelativo.'control/clases/class.cms.perfil_permiso.php');
require_once($pathRelativo.'control/clases/class.cms.perfil_usuario.php');
require_once($pathRelativo.'control/clases/class.cms.permiso.php');
require_once($pathRelativo.'control/clases/class.cms.usuario.php');
require_once($pathRelativo.'control/clases/class.cms.tipo_usuario.php');
require_once($pathRelativo.'control/clases/class.cms.imagen.php'); //Requiere class.Tijera
require_once($pathRelativo.'control/clases/class.cms.video.php');
require_once($pathRelativo.'control/clases/class.cms.tipo_imagen.php');
require_once($pathRelativo.'control/clases/class.cms.categoria_imagen.php');
require_once($pathRelativo.'control/clases/class.cms.tbl.idioma.php');
require_once($pathRelativo.'control/clases/class.cms.config.php');
require_once($pathRelativo.'control/clases/class.control.Autorizacion.php');



//EXTRAS
require_once($pathRelativo.'control/clases/classMailHTMLv2.php');
require_once($pathRelativo.'control/clases/class.AdapterImagen.php');
require_once($pathRelativo.'control/clases/class.Interfaz.php');
require_once($pathRelativo.'control/clases/class.Paginador.php');
require_once($pathRelativo.'control/clases/class.Tijera.php');
require_once($pathRelativo.'control/clases/classTraffic.php');

//CUSTOM
require_once($pathRelativo.'control/clases/class.tbl.producto.php');
require_once($pathRelativo.'control/clases/class.tbl.categoria.php');
require_once($pathRelativo.'control/clases/class.tbl.usuario.php');
require_once($pathRelativo.'control/clases/class.tbl.lista.php');
require_once($pathRelativo.'control/clases/class.tbl.noticia.php');

require_once($pathRelativo.'control/clases/class.Externa.php');

$MSG=false;
$ERROR=false;
$ERRORS=array();


?>