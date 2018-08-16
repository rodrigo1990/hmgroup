<?
$pathRelativo='';
require_once('include_general.php');
$oEx=new Externa();

$producto_destacado=$oEx->getProductoDestacado();
$imagenes_producto=array();
if(count($producto_destacado)>0){
	$imagenes_producto=$oEx->getImagenesProducto($producto_destacado['id_producto']);
}
else{
	$producto_destacado=false;
}
$productos_promocion=$oEx->getProductosEnPromocion();
$productos_novedades=$oEx->getProductosNovedad();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Harmony Music Group S.A. - Bienvenidos</title>
<link href="estilos/estilos.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="control/js/jquery-1.2.6.pack.js"></script>
</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="995">
      <!-- fwtable fwsrc="layout_hard_music.png" fwbase="borrar.jpg" fwstyle="Dreamweaver" fwdocid = "787708672" fwnested="0" -->
      <tr>
        <td><img src="img/spacer.gif" width="97" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="8" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="174" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="29" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="140" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="17" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="412" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="11" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="12" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="95" height="1" border="0" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="3" colspan="2"><img name="borrar_r1_c2" src="img/borrar_r1_c2.jpg" width="182" height="104" border="0" id="borrar_r1_c2" alt="" /></td>
        <td colspan="7">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="36" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2"><img name="borrar_r2_c4" src="img/borrar_r2_c4.jpg" width="29" height="68" border="0" id="borrar_r2_c4" alt="" /></td>
        <td colspan="3" bgcolor="#D4D0C7"><? include('busqueda_login.panel.php'); ?></td>
        <td rowspan="2" colspan="3"><img name="borrar_r2_c8" src="img/borrar_r2_c8.jpg" width="118" height="68" border="0" id="borrar_r2_c8" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="38" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3"><img name="borrar_r3_c5" src="img/borrar_r3_c5.jpg" width="569" height="30" border="0" id="borrar_r3_c5" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="30" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="9">
        
       
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','898','height','53','src','swf/menu','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','swf/menu','wmode','transparent' ); //end AC code
</script>
<noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="898" height="53">
          <param name="movie" value="swf/menu.swf">
          <param name="quality" value="high">
          <param name="wmode" value="transparent">
          <embed src="swf/menu.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="898" height="53"></embed>
        </object></noscript>
    
        
        </td>
        <td><img src="img/spacer.gif" width="1" height="53" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="5">&nbsp;</td>
        <td colspan="4" rowspan="2" background="img/borrar_r5_c2.jpg">
         <? 
         if($producto_destacado){ 
         	$arrayImgs=array();
			$arrayImgsURL=array();
         	$i=0;
         	foreach($imagenes_producto as $img){
         		if(is_file(RUTA_CONTENIDO_THUMBS2.'/'.$img['nombre'])){
         			$arrayImgs[]=$img['nombre'];
					$arrayImgsURL[]=URL_ABSOLUTA.'/'.RUTA_CONTENIDO_ORIGINAL.'/'.$img['nombre'];
         			$i++;
         		}
         	}
         	$arrayImgs=implode('|',$arrayImgs);
			$arrayImgsURL=implode('|',$arrayImgsURL);
         	$cantImg=$i;
         ?>
        
        <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','351','height','343','src','swf/destacado','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','swf/destacado','wmode','transparent','FlashVars','cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>&titulo=<? echo rawurlencode(PF::html($producto_destacado['titulo'],true)); ?>&texto=<? echo rawurlencode(PF::html($producto_destacado['descripcion'],true)); ?>&link=producto.php?id_producto=<? echo $producto_destacado['id_producto'];?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="351" height="343">
          <param name="movie" value="swf/destacado.swf">
          <param name="quality" value="high">
          <param name="wmode" value="transparent">
          <param name="FlashVars" value="cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>&titulo=<? echo rawurlencode(PF::html($producto_destacado['titulo'],true)); ?>&texto=<? echo rawurlencode(PF::html($producto_destacado['descripcion'], true)); ?>&link=producto.php?id_producto=<? echo $producto_destacado['id_producto'];?>">
          <embed src="swf/destacado.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="351" height="343" flashvars="cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>&titulo=<? echo rawurlencode(PF::html($producto_destacado['titulo'],true)); ?>&texto=<? echo rawurlencode(PF::html($producto_destacado['descripcion'],true)); ?>&link=producto.php?id_producto=<? echo $producto_destacado['id_producto'];?>"></embed>
        </object></noscript>
        <? } ?>
        
        </td>
        <td colspan="3"><img name="borrar_r5_c6" src="img/borrar_r5_c6.jpg" width="440" height="63" border="0" id="borrar_r5_c6" alt="" /></td>
        <td rowspan="5" valign="top"><img name="borrar_r5_c9" src="img/borrar_r5_c9.jpg" width="12" height="720" border="0" id="borrar_r5_c9" alt="" /></td>
        <td rowspan="5">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="63" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2" background="img/borrar_r6_c6.jpg">&nbsp;</td>
        <td rowspan="2" valign="top" bgcolor="#DADADA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle">
            
             <? 
			foreach($productos_promocion as $prod){ 
				$img=$oEx->getImagenesProducto($prod['id_producto']);
				$rutaImg=RUTA_CONTENIDO_THUMBS.'/default.jpg';
				if(isset($img[0]) && is_file(RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'])){
					$rutaImg=RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'];
				}
			?>
            
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="404">
                   <!-- fwtable fwsrc="ventana_destacado.png" fwbase="ventana_destacado.jpg" fwstyle="Dreamweaver" fwdocid = "1838036807" fwnested="0" -->
                   <tr>
                     <td><img src="img/spacer.gif" width="18" height="1" border="0" alt="" /></td>
                     <td><img src="img/spacer.gif" width="368" height="1" border="0" alt="" /></td>
                     <td><img src="img/spacer.gif" width="18" height="1" border="0" alt="" /></td>
                   </tr>
                   <tr>
                     <td><img name="ventana_destacado_r1_c1" src="img/ventana_destacado_r1_c1.jpg" width="18" height="20" border="0" id="ventana_destacado_r1_c1" alt="" /></td>
                     <td><img name="ventana_destacado_r1_c2" src="img/ventana_destacado_r1_c2.jpg" width="368" height="20" border="0" id="ventana_destacado_r1_c2" alt="" /></td>
                     <td><img name="ventana_destacado_r1_c3" src="img/ventana_destacado_r1_c3.jpg" width="18" height="20" border="0" id="ventana_destacado_r1_c3" alt="" /></td>
                   </tr>
                   <tr>
                     <td colspan="3" valign="top" background="img/ventana_destacado_r2_c1.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="140" rowspan="3" align="center"><img src="<? echo $rutaImg; ?>" alt="" width="115" height="93"></td>
                           <td height="20" valign="top" class="titulos_promociones"><? PF::html($prod['titulo']); ?>
                           </td>
                         </tr>
                         <tr>
                           <td height="50" valign="top" class="texto_negro"><? PF::html($prod['descripcion_promocion']); ?></td>
                         </tr>
                         <tr>
                           <td><table width="92%" border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                 <td align="right"><a href="producto.php?id_producto=<? echo $prod['id_producto']; ?>"><img src="img/ver_detalle.jpg" width="77" height="23" border="0"></a></td>
                               </tr>
                           </table></td>
                         </tr>
                     </table></td>
                   </tr>
                   <tr>
                     <td height="20" valign="top"><img name="ventana_destacado_r3_c1" src="img/ventana_destacado_r3_c1.jpg" width="18" height="18" border="0" id="ventana_destacado_r3_c1" alt="" /></td>
                     <td valign="top"><img name="ventana_destacado_r3_c2" src="img/ventana_destacado_r3_c2.jpg" width="368" height="18" border="0" id="ventana_destacado_r3_c2" alt="" /></td>
                     <td valign="top"><img name="ventana_destacado_r3_c3" src="img/ventana_destacado_r3_c3.jpg" width="18" height="18" border="0" id="ventana_destacado_r3_c3" alt="" /></td>
                   </tr>
                 </table></td>
               </tr>
             </table>
             <? } ?></td>
          </tr>
          <tr>
            <td height="12" align="center" valign="middle">&nbsp;</td>
          </tr>
        </table></td>
        <td rowspan="2" background="img/borrar_r6_c8.jpg">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="280" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="3" valign="top" bgcolor="#D4D0C7"><img name="borrar_r7_c2" src="img/borrar_r7_c2.jpg" width="8" height="377" border="0" id="borrar_r7_c2" alt="" /></td>
        <td colspan="3" rowspan="2" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
            
            <? 
			foreach($productos_novedades as $prod){ 
				$img=$oEx->getImagenesProducto($prod['id_producto']);
				$rutaImg=RUTA_CONTENIDO_THUMBS.'/default.jpg';
				if(isset($img[0]) && is_file(RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'])){
					$rutaImg=RUTA_CONTENIDO_THUMBS.'/'.$img[0]['nombre'];
				}
			?>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="140" align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="335">
                  <!-- fwtable fwsrc="ventana_promo.png" fwbase="ventana_promo.jpg" fwstyle="Dreamweaver" fwdocid = "348418498" fwnested="0" -->
                  <tr>
                    <td><img src="img/spacer.gif" width="17" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="300" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="18" height="1" border="0" alt="" /></td>
                    <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
                  </tr>
                  <tr>
                    <td valign="top"><img name="ventana_promo_r1_c1" src="img/ventana_promo_r1_c1.jpg" width="17" height="134" border="0" id="ventana_promo_r1_c1" alt="" /></td>
                    <td valign="middle" background="img/ventana_promo_r1_c2.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="125" height="130" rowspan="3" align="center" valign="middle"><img src="<? echo $rutaImg; ?>" alt="" width="115" height="93"></td>
                          <td height="25" class="titulos_promociones">NOVEDAD - <? PF::html($prod['titulo']); ?></td>
                        </tr>
                        <tr>
                          <td height="50" class="texto_destacados"><? echo $prod['descripcion_abreviada']; ?></td>
                        </tr>
                        <tr>
                          <td align="right"><a href="producto.php?id_producto=<? echo $prod['id_producto']; ?>"><img src="img/ver_detalle_marron.jpg" width="77" height="23" border="0"></a></td>
                        </tr>
                    </table></td>
                    <td height="0" valign="top"><img name="ventana_promo_r1_c3" src="img/ventana_promo_r1_c3.jpg" width="18" height="134" border="0" id="ventana_promo_r1_c3" alt="" /></td>
                    <td><img src="img/spacer.gif" width="1" height="134" border="0" alt="" /></td>
                  </tr>
                </table></td>
                </tr>
            </table>
            <? } ?></td>
          </tr>
        </table></td>
        <td><img src="img/spacer.gif" width="1" height="278" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3"><img name="borrar_r8_c6" src="img/borrar_r8_c6.jpg" width="440" height="16" border="0" id="borrar_r8_c6" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="16" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="6" valign="top" background="img/borrar_r9_c3.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="57%" height="30" align="center" class="pie"><span class="titulos">HARMONY MUSIC GROUP S.A</span>. - Salta 1562 - Gerli - (CP B1869DGH) -  Pcia de Buenos Aires                                          </td>
            <td width="43%" align="center" class="pie">Tel / Fax: (+5411) 4265-4000 y rotativas - <a href="mailto:info@hmgroup.com.ar" class="tipo1">info@hmgroup.com.ar</a></td>
          </tr>
        </table></td>
        <td><img src="img/spacer.gif" width="1" height="83" border="0" alt="" /></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
