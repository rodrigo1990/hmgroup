<?
$pathRelativo='';
require_once('include_general.php');
$oEx=new Externa();

if(!isset($_GET['id_producto'])){
	header("Location:index.php");
	exit();
}
settype($_GET['id_producto'],'integer');
$producto=$oEx->getProducto($_GET['id_producto']);
if(count($producto)==0){
	header("Location:index.php");
	exit();
}
$imagenesProducto=$oEx->getImagenesProducto($_GET['id_producto']);
/*$rutaImg=RUTA_CONTENIDO_THUMBS1.'/default.jpg';
if(isset($imagenesProducto[0]) && is_file(RUTA_CONTENIDO_THUMBS1.'/'.$imagenesProducto[0]['nombre'])){
	$rutaImg=RUTA_CONTENIDO_THUMBS1.'/'.$imagenesProducto[0]['nombre'];
}*/
$arrayImgs=array();
$arrayImgsURL=array();
$i=0;
foreach($imagenesProducto as $img){
	if(is_file(RUTA_CONTENIDO_THUMBS1.'/'.$img['nombre'])){
		$arrayImgs[]=$img['nombre'];
		$arrayImgsURL[]=URL_ABSOLUTA.'/'.RUTA_CONTENIDO_ORIGINAL.'/'.$img['nombre'];
		$i++;
	}
}
$arrayImgs=implode('|',$arrayImgs);
$arrayImgsURL=implode('|',$arrayImgsURL);
$cantImg=$i;

$datosSubCat=$oEx->getDatosCategoria($producto['id_categoria']);
if($datosSubCat['id_padre']==0){
	$datosCat=array('id_categoria'=>0,'descripcion'=>'Principal');
}
else{
	$datosCat=$oEx->getDatosCategoria($datosSubCat['id_padre']);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Harmony Music Group S.A. - Productos</title>
<link href="estilos/estilos.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="Scripts/mouseout.js"></script>
<script type="text/javascript" src="control/js/jquery-1.2.6.pack.js"></script>
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
        <td colspan="2" rowspan="3" bgcolor="#202020"><img name="layout_productos_r1_c2" src="img/layout_productos_r1_c2.jpg" width="182" height="104" border="0" id="layout_productos_r1_c2" alt="" /></td>
        <td colspan="5">&nbsp;</td>
        <td><img src="img/spacer.gif" width="1" height="36" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2"><img name="layout_productos_r2_c4" src="img/layout_productos_r2_c4.jpg" width="29" height="68" border="0" id="layout_productos_r2_c4" alt="" /></td>
        <td bgcolor="#D4D0C7"><? include('busqueda_login.panel.php'); ?></td>
        <td rowspan="2" colspan="3"><img name="layout_productos_r2_c6" src="img/layout_productos_r2_c6.jpg" width="118" height="68" border="0" id="layout_productos_r2_c6" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="38" border="0" alt="" /></td>
      </tr>
      <tr>
        <td><img name="layout_productos_r3_c5" src="img/layout_productos_r3_c5.jpg" width="569" height="30" border="0" id="layout_productos_r3_c5" alt="" /></td>
        <td><img src="img/spacer.gif" width="1" height="30" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="7">          <script type="text/javascript">
		  if((navigator.appVersion.indexOf("MSIE") != -1)){
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','898','height','53','src','swf/menu','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','swf/menu','wmode','transparent'); //end AC code
}
else{
	document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="898" height="53">');
	document.write('  <param name="movie" value="swf/menu.swf">');
	document.write('<param name="quality" value="high">');
	document.write('<param name="wmode" value="transparent">');
	document.write('<embed src="swf/menu.swf" width="898" height="53" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>');
	document.write('</object>');
	
}
</script>
          </td>
        <td><img src="img/spacer.gif" width="1" height="53" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3"><img name="layout_productos_r5_c2" src="img/layout_productos_r5_c2.jpg" width="8" height="720" border="0" id="layout_productos_r5_c2" alt="" /></td>
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
                <td align="left" valign="bottom" class="titulos_destacados"><!--<? PF::html($datosCat['descripcion']); ?> / <? PF::html($datosSubCat['descripcion']); ?> / -->
                  <? PF::html($producto['titulo']); ?>
               </td>
              </tr>
            </table></td>
          </tr>
          
        </table></td>
        <td rowspan="3"><img name="layout_productos_r5_c7" src="img/layout_productos_r5_c7.jpg" width="12" height="720" border="0" id="layout_productos_r5_c7" alt="" /></td>
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
                <td height="400" align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="556">
                  <!-- fwtable fwsrc="Sin título" fwbase="foto_layout.jpg" fwstyle="Dreamweaver" fwdocid = "683764494" fwnested="0" -->
                  
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td valign="top">&nbsp;</td>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top"><img name="foto_layout_r1_c1" src="img/foto_layout_r1_c1.jpg" width="23" height="387" border="0" id="foto_layout_r1_c1" alt="" /></td>
                    <td valign="top">
					<script type="text/javascript">
					if((navigator.appVersion.indexOf("MSIE") != -1)){
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','510','height','410','src','swf/galeria','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','swf/galeria','wmode','transparent','FlashVars','cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>'); //end AC code
}
else{
	document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="510" height="410">');
	document.write('  <param name="movie" value="swf/galeria.swf">');
	document.write('<param name="quality" value="high">');
	document.write('<param name="wmode" value="transparent">');
	document.write('<param name="flashvars" value="cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>">');
	document.write(' <embed src="swf/galeria.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="510" height="410" wmode="transparent" flashvars="cantidad=<? echo $cantImg; ?>&ArrayNombres=<? echo $arrayImgs; ?>&ArrayURL=<? echo $arrayImgsURL; ?>"></embed>');
	document.write('</object>');
	
}
</script><br></td>
                    <td valign="top"><img name="foto_layout_r1_c3" src="img/foto_layout_r1_c3.jpg" width="23" height="387" border="0" id="foto_layout_r1_c3" alt="" /></td>
                    <td><img src="img/spacer.gif" width="1" height="387" border="0" alt="" /></td>
                  </tr>
                </table></td>
              </tr>
              
              <tr>
                <td height="30" align="left" valign="middle"><span class="titulos_promociones"><? PF::html($producto['titulo']); ?></span></td>
              </tr>
              <tr>
                <td height="10" align="left" valign="top">
                <span class="texto_negro">
                <? echo $producto['descripcion']; ?>
                </span></td>
              </tr>
            </table></td>
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
            <td width="57%" height="30" align="center" class="pie"><span class="titulos">HARMONY MUSIC GROUP S.A</span>. - Salta 1562 - Gerli - (CP B1869DGH) -  Pcia de Buenos Aires </td>
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
