<?php
error_reporting(E_ALL);
//ini_set('include_path','.;'.ini_get('include_path'));

//DEFINICION DE TABLA DE VALIDACION
define("TABLA_VALIDACION",'cms_validacion');

//DATOS DE BD


define("DB_USER",'music2');
define("DB_PASS",'Musica22');
define("DB_NAME", 'musicbd');
define("DB_SERVER", '192.168.0.57');

//RUTAS PARA FLEX
define("FLEX_UPLOAD_PATH",'control/upload');
define("FLEX_DEBUG_PATH",'/flex_debug');
define("RUTA_TOKEN",'control/tokens');

//RUTA DE LOS CONTENIDOS para imagenes
define('RUTA_CONTENIDO','contenido');
define('RUTA_CONTENIDO_THUMBS','contenido/thumbs');//115x93
define('RUTA_CONTENIDO_THUMBS1','contenido/thumbs1');//510x387
define('RUTA_CONTENIDO_THUMBS2','fotos');//333x339

define('ANCHO_THUMBS',115);
define('ALTO_THUMBS',93);
define('ANCHO_THUMBS1',510);
define('ALTO_THUMBS1',387);
define('ANCHO_THUMBS2',333);
define('ALTO_THUMBS2',339);

// ruta desde la carpeta publica hasta el config
define('PF_CONFIG_SYSTEM_PATH','');

//EMAIL DE CONTACTO
define('CONTACT_EMAIL','jmartinsardoy@yahoo.com.ar');

//EMAIL DE REMITENTE DE MENSAJES DE LA ADMINISTRACIÓN
define("ADMIN_EMAIL",'jmartinsardoy@yahoo.com.ar');

//EMAIL DE ORIGEN DE LOS CONTACTOS POR WEB
define("ORIGEN_MAIL",'jmartinsardoy@yahoo.com.ar');

//NOMBRE DEL REMITENTE DE MENSAJES DE LA ADMINISTRACIÓN
define("ADMIN_NAME",'Administrador');

//URL ABSOLUTA DEL SITE
//define("URL_ABSOLUTA",'http://localhost');
define("URL_ABSOLUTA",'http://www.harmonymusicgroup.com.ar');

//ACTIVACIÓN DEL ENVIO DE EMAILS para simulacion de envio poner 1
define("SIMULAR_EMAILS",'0');

//MAXIMO TAMANO DE ARCHIVO A SUBIR
define("MAX_UPLOAD_FILESIZE",'2000000');
define("IMAGEN_MAX_UPLOAD_FILESIZE",MAX_UPLOAD_FILESIZE);

//MEDIDAS Y MÁXIMO TAMANO EN BYTES DE FOTOS
define("FOTO_GAL_ANCHO",'640');
define("FOTO_GAL_ALTO",'480');
define("FOTO_GAL_MIN_ANCHO",'169');
define("FOTO_GAL_MIN_ALTO",'127');

?>