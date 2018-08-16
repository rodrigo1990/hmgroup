<?
$pathRelativo='';
require_once('include_general.php');
$oEx=new Externa();


$listado_productos=array();
if(isset($_POST['accion']) && $_POST['accion']=='buscar'){
	$listado_productos=$oEx->buscarProductos($_POST['texto']);
}
elseif(isset($_POST['accion']) && $_POST['accion']=='login'){
	$ok=$oEx->checkLoginUser($_POST['user'],$_POST['pass']);
	if($ok){
		$ok=$oEx->downloadListaPrecios();
		if(!$ok){
			$MSG=$oEx->MSG;
			$ERROR=$oEx->ERROR;
			$ERRORS=$oEx->ERRORS;
		}
	}
	else{
		$MSG=$oEx->MSG;
		$ERROR=$oEx->ERROR;
		$ERRORS=$oEx->ERRORS;
	}
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Harmony Music Group S.A. - Productos</title>
<link href="estilos/estilos.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="control/js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="Scripts/mouseout.js"></script>
<script type="text/javascript" src="panelConfirmacion/class.confirmacion.js"></script>
<script type="text/javascript" src="control/PPF/class.ppf.HTML.js"></script>
<link href="panelConfirmacion/estilos_confirmacion.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="995">
      <!-- fwtable fwsrc="layout_porductos_hard_music.png" fwbase="layout_productos.jpg" fwstyle="Dreamweaver" fwdocid = "787708672" fwnested="0" -->
      <tr>
        <td><img src="img/spacer.gif" width="97" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="8" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="174" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="29" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="569" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="11" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="12" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="95" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="4"><img name="layout_productos_r1_c1" src="img/layout_productos_r1_c1.jpg" width="97" height="157" border="0" id="layout_productos_r1_c1" alt="" /></td>
        <td rowspan="3" colspan="2"><img name="layout_productos_r1_c2" src="img/layout_productos_r1_c2.jpg" width="182" height="104" border="0" id="layout_productos_r1_c2" alt="" /></td>
        <td colspan="5">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="36" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2"><img name="layout_productos_r2_c4" src="img/layout_productos_r2_c4.jpg" width="29" height="68" border="0" id="layout_productos_r2_c4" alt="" /></td>
        <td bgcolor="#D4D0C7">
        
        <? include('busqueda_login.panel.php'); ?>
        
        </td>
        <td rowspan="2" colspan="3"><img name="layout_productos_r2_c6" src="img/layout_productos_r2_c6.jpg" width="118" height="68" border="0" id="layout_productos_r2_c6" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="38" border="0" alt="" /></td>
      </tr>
      <tr>
        <td><img name="layout_productos_r3_c5" src="img/layout_productos_r3_c5.jpg" width="569" height="30" border="0" id="layout_productos_r3_c5" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="30" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="7"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','898','height','53','src','swf/menu','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','swf/menu','wmode','transparent' ); //end AC code
        </script>
          <noscript>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="898" height="53">
            <param name="movie" value="swf/menu.swf">
            <param name="quality" value="high">
            <param name="wmode" value="transparent">
            <embed src="swf/menu.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="898" height="53"></embed>
          </object>
          </noscript>
          </td>
        <td><img src="img/spacer.gif" width="1" height="53" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td colspan="4" background="img/layout_productos_r5_c3.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="187"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" align="center" valign="bottom" class="titulos_destacados">Productos</td>
              </tr>
            </table></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="30" align="center" valign="bottom" class="titulos_destacados">&nbsp;</td>
                <td align="left" valign="bottom" class="titulos_destacados">
               Resultados de la B&uacute;squeda
                </td>
              </tr>
            </table></td>
          </tr>
          
        </table></td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="42" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="190" align="center" valign="top" bgcolor="#FFFFFF">
            
            <? include('menu_productos.panel.php'); ?>
            
            </td>
            <td align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="10" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="300" align="center" valign="top">
                
                 <? 
			foreach($listado_productos as $prod){ 
				$img=$oEx->getImagenesProducto($prod['id_producto']);
				$rutaImg=RUTA_CONTENIDO_THUMBS.'/default.jpg';
				if(isset($img[0]) && is_file(RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'])){
					$rutaImg=RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'];
				}
			?>
                
                <table border="0" cellpadding="0" cellspacing="0" width="499">
                  <!-- fwtable fwsrc="producto_item.png" fwbase="producto_item.jpg" fwstyle="Dreamweaver" fwdocid = "874822856" fwnested="0" -->
                  <tr>
                    <td><img src="img/spacer.gif" width="16" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="463" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="20" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
                  </tr>
                  <tr>
                    <td><img name="producto_item_r1_c1" src="img/producto_item_r1_c1.jpg" width="16" height="131" border="0" id="producto_item_r1_c1" alt="" /></td>
                    <td valign="top" background="img/producto_item_r1_c2.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="125" height="131" rowspan="3" align="center" valign="middle"><img src="<? echo $rutaImg; ?>" width="115" height="93"></td>
                        <td height="30" valign="bottom"><span class="titulos_promociones"><? PF::html($prod['titulo']); ?></span></td>
                      </tr>
                      <tr>
                        <td height="60"><span class="texto_negro"><? echo $prod['descripcion']; ?></span></td>
                      </tr>
                      
                      <tr>
                        <td height="41" align="right" valign="middle"><a href="producto.php?id_producto=<? echo $prod['id_producto']; ?>"><img src="img/ver_detalle.jpg" alt="" width="77" height="23" border="0"></a></td>
                      </tr>
                    </table></td>
                    <td><img name="producto_item_r1_c3" src="img/producto_item_r1_c3.jpg" width="20" height="131" border="0" id="producto_item_r1_c3" alt="" /></td>
                    <td><img src="img/spacer.gif" width="1" height="131" border="0" alt="" /></td>
                  </tr>
                </table>
              <?
			  }
			  ?>
                </td>
              </tr>
            </table>
            
            
            
            </td>
          </tr>
        </table></td>
        <td><img src="img/spacer.gif" width="1" height="595" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4" valign="top" background="img/layout_productos_r7_c3.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="center" class="pie"><span class="titulos">HARMONY MUSIC GROUP S.A</span>. - Salta 1562 - Gerli - Pcia de Buenos Aires </td>
            <td width="50%" align="center" class="pie">Tel / Fax: (+5411) 4265-4000 y rotativas - <a href="mailto:info@hmgroup.com.ar" class="tipo1">info@hmgroup.com.ar</a></td>
          </tr>
        </table></td>
        <td><img src="img/spacer.gif" width="1" height="83" border="0" alt="" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<? include('panelConfirmacion/panel_confirmacion_tpl.php'); ?>
<? include('panelConfirmacion/panel_error_tpl.php'); ?>
<? include('panelConfirmacion/panel_msg_tpl.php'); ?>    

<script type="text/javascript">

	<? if($ERROR){ ?>
    
       objConfirmacion.showError('<? echo nl2br(implode("<br>",$ERRORS)); ?>');
	 
	<? } ?>   

	<? if($MSG){ ?>
	
		objConfirmacion.showMsg('<? PF::html($MSG); ?>');
	
	<? } ?>

    </script>
    
</body>
</html>
