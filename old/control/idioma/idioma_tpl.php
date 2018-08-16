<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Idiomas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<link rel="stylesheet" href="idioma.css" type="text/css" />
<? $this->setJavascript('../'); ?>
<script type="text/javascript" src="../js/class.confirmacion.js"></script>

<script type="text/javascript" src="../js/class.stdCMS.js"></script>
<script type="text/javascript" src="../js/class.DBValidator.js"></script>
<!--[if lt IE 7]>
<script defer type="text/javascript" src="../js/pngfix.js"></script>
<![endif]-->

</head>
<body bgcolor="#999966">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td nowrap="nowrap">&nbsp;</td>
	<td height="60" colspan="2" class="logo" nowrap="nowrap"><br />
	ADMINISTRACION DE IDIOMAS</td>
	<td>&nbsp;</td>
  </tr>

	<tr bgcolor="#ffffff">
	<td colspan="4"><img src="img/mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr bgcolor="#a4c2c2">
	<td nowrap="nowrap">&nbsp;</td>
	<td height="36" colspan="2" class="navText" id="navigation">
    <a href="idioma.php">INICIO</a> | 
    <a href="idioma.php?<? $this->encodeURL('accion=listarTraducciones'); ?>">LISTADO DE TRADUCCIONES</a> | 
    <a href="idioma.php?<? $this->encodeURL('accion=nuevaTraduccion'); ?>">NUEVA TRADUCCI&Oacute;N</a> | 
    <a href="idioma.php?<? $this->encodeURL('accion=listarIdiomas'); ?>">LISTADO DE IDIOMAS</a> | 
    <a href="idioma.php?<? $this->encodeURL('accion=nuevoIdioma'); ?>">NUEVO IDIOMA</a> | 
     <a href="idioma.php?<? $this->encodeURL('accion=actualizarDiccionario'); ?>">ACTUALIZAR DICCIONARIO</a></td>
	<td>&nbsp;</td>
  </tr>

	<tr bgcolor="#ffffff">
	<td colspan="4"><img src="img/mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
	</tr>

	<tr bgcolor="#ffffff">
	<td valign="top"><img src="img/mm_spacer.gif" alt="" width="15" height="1" border="0" /></td>
	<td valign="top"><img src="img/mm_spacer.gif" alt="" width="35" height="1" border="0" /></td>
	<td valign="top"><br />
	<table border="0" cellspacing="0" cellpadding="2" width="610">
        <tr>
          <td class="pageName"><? echo $this->seccion; ?></td>
        </tr>
	</table>
	<table width="887" cellpadding="2" cellspacing="1" border="0" id="calendar">
        <tr>
          <td width="100%" class="sidebarText"><? if($this->MSG){ PF::html($this->MSG); }else{ echo '&nbsp;'; } ?></td>
        </tr>
        <tr>
          <td>
          
          
          
          
          
          <? if($this->show('listaIdiomas')){?>
          <table width="351" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="63"><strong>Id_idioma</strong></td>
              <td width="232"><strong>Nombre</strong></td>
              <td width="16">&nbsp;</td>
              <td width="16">&nbsp;</td>
            </tr>
            <? foreach($this->listado as $item){ ?>
            <tr>
              <td class="calendarText"><? echo $item['id_idioma']; ?></td>
              <td class="calendarText"><? PF::html($item['nombre']); ?></td>
              <td class="calendarText"><a href="idioma.php?<? $this->encodeURL('accion=editarIdioma&id_idioma='.$item['id_idioma']); ?>"><img src="img/icon_editar.gif" width="16" height="16" border="0" /></a></td>
              <td class="calendarText"><a href="idioma.php?<? $this->encodeURL('accion=eliminarIdioma&id_idioma='.$item['id_idioma']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro? Si elimina el idioma elimina todas las traducciones de ese idioma');"><img src="img/icon_eliminar.gif" alt="#" width="16" height="16" border="0" /></a></td>
            </tr>
           <? } ?> 
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <br />
          <br />
          <? } ?>
          
          
          
          
          
          
          
          
          
          
          
          
           <? if($this->show('listaTraducciones')){?>
           
         <ul>
         <? foreach($this->listado as $ind => $item){ 
		 		if($item['id_idioma']==$this->GET['id_idioma']){
					$this->selectado=$ind;
				}
		 ?>
         <li><a href="idioma.php?<? $this->encodeURL('accion=listarTraducciones&id_idioma='.$item['id_idioma']); ?>"><? PF::html($item['nombre']); ?></a></li>
         <?  } ?>
         </ul> 
          <table width="600" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="153"><strong>Clave (<? PF::html($this->listado[$this->selectado]['nombre']); ?>)</strong></td>
              <td width="391"><strong>Traducci&oacute;n</strong></td>
              <td width="16">&nbsp;</td>
              <td width="16">&nbsp;</td>
            </tr>
            <? foreach($this->listadoTraducciones as $item){ ?>
            <tr>
              <td class="calendarText"><? PF::html($item['clave']); ?></td>
              <td class="calendarText"><? PF::html($item['traduccion']); ?></td>
              <td class="calendarText"><a href="idioma.php?<? $this->encodeURL('accion=editarTraduccion&id_idioma='.$this->GET['id_idioma'].'&clave='.$item['clave']); ?>"><img src="img/icon_editar.gif" width="16" height="16" border="0" /></a></td>
              <td class="calendarText"><a href="idioma.php?<? $this->encodeURL('accion=eliminarTraduccion&id_idioma='.$this->GET['id_idioma'].'&clave='.$item['clave']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/icon_eliminar.gif" alt="#" width="16" height="16" border="0" /></a></td>
            </tr>
            <? } ?>
            <tr>
              <td class="calendarText">&nbsp;</td>
              <td>&nbsp;</td>
              <td class="calendarText">&nbsp;</td>
              <td class="calendarText">&nbsp;</td>
            </tr>
          </table>
          <br />
          <? } ?>
          
          
          
          
          
          
          <? if($this->show('formIdioma')){ ?>
          <form id="formIdioma" name="formIdioma" method="post" action="idioma.php">
            <table width="351" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td width="63" class="calendarText">Nombre:</td>
                <td width="116" class="calendarText"><input name="nombre" type="text" class="calendarText" id="nombre" /></td>
                <td width="148" class="calendarText"><label>
                  <input name="button" type="submit" class="boton" id="button" value="Confirmar" />
                  <input type="hidden" name="id_idioma" id="id_idioma" />
                  <input type="hidden" name="accion" id="accion" />
                  <input name="form" type="hidden" id="form" value="formIdioma" />
                </label></td>
              </tr>
            </table>
            </form>
          <br />
          <br />
          <? } ?>
          
          
          
          
           <? if($this->show('formTraduccion')){ ?>
          <form id="formTraduccion" name="formTraduccion" method="post" action="idioma.php">
            <table width="500" border="0" cellspacing="0" cellpadding="3">
               
                <tr>
                  <td width="149" class="calendarText">Clave:</td>
                  <td class="calendarText"><input name="clave" type="text" class="calendarText" id="clave" style="width:300px;" <? if($this->edicion){ echo 'readonly="readonly"'; } ?>/></td>
                </tr>
                 <? foreach($this->listado as $item){ ?>
                <tr>
                <td class="calendarText">                  Traducci&oacute;n 
                  <? PF::html($item['nombre']); ?>
                  :</td>
                <td width="333" class="calendarText"><textarea name="traduccion[<? echo $item['id_idioma']; ?>]" class="calendarText" id="traduccion[<? echo $item['id_idioma']; ?>]" style="width:300px;"></textarea></td>
              </tr>
              <? } ?>
              <tr>
                <td colspan="2" class="calendarText"><input name="button" type="submit" class="boton" id="button" value="Confirmar" />
                  <input type="hidden" name="accion" id="accion" />
                  <input name="form" type="hidden" id="form" value="formTraduccion" /></td>
                </tr>
            </table>
            </form>
          <br />
          <? } ?>
          
          
          
          </td>
        </tr>
      </table>
	  <br />
	&nbsp;<br />	</td>
	<td>&nbsp;</td>
	</tr>

	<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
</table>

<? $this->postBack(); ?>
<? include('panel_confirmacion_tpl.php'); ?>
<? include('panel_error_tpl.php'); ?>
<? include('panel_msg_tpl.php'); ?>    

<script type="text/javascript">

	<? if($this->ERROR){ ?>
    
       objConfirmacion.showError('<? echo nl2br(implode("<br>",$this->ERRORS)); ?>');
	 
	<? } ?>   

	<? if($this->MSG){ ?>
	
		objConfirmacion.showMsg('<? PF::html($this->MSG); ?>');
	
	<? } ?>

    </script>
    

</body>
</html>
