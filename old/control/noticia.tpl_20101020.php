<? include('panel_encabezado_tpl.php'); ?>
           
              <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
              

<? if($this->show('panelListadoNoticia')){ ?>

<script type="text/javascript">
function buscar(inicio){
	PFHTML.rellenarDato('formBuscar','inicio',inicio);
	PFHTML.rellenarDato('formBuscar','accion','listar');
	document.getElementById('formBuscar').submit();
}

function subirPos(idNoticia){
	PFHTML.rellenarDato('formBuscar','accion','subirPos');
	PFHTML.rellenarDato('formBuscar','id_noticia',idNoticia);
	document.getElementById('formBuscar').submit();
}

function bajarPos(idNoticia){
	PFHTML.rellenarDato('formBuscar','accion','bajarPos');
	PFHTML.rellenarDato('formBuscar','id_noticia',idNoticia);
	document.getElementById('formBuscar').submit();
}

</script>

<table class="tabla" width="600" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px;" id="set">
  <tr class="encabezadoTabla">
    <td width="275" >
        <form id="formBuscar" name="formBuscar" method="post" action="<? echo $this->modulo; ?>">
    		<input type="hidden" name="form" id="form" value="formBuscar" />
	    	<input type="hidden" name="accion" id="accion" value="listar" />
	    	<input type="hidden" name="inicio" id="inicio" />
            <input type="hidden" name="id_noticia" id="id_noticia" />
    		<span class="tituloListado">Noticias</span>
    	</form>	</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td colspan="4" align="right" ><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevo'); ?>" class="tituloListado">Nueva Noticia</a></td>
    </tr>

    <? foreach($this->arrayItems as $item){	?>
  <tr>
    <td class="textoListado"><? PF::html($item['titulo']); ?> </td>
	    <td width="150" align="center" valign="middle" class="textoListado"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=imagenes&id_noticia='.$item['id_noticia']); ?>">Im&aacute;genes</a></td>
	<td width="25" align="center" valign="middle" class="textoListado"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=videos&id_noticia='.$item['id_noticia']); ?>">Videos</a></td>
	<td width="25">&nbsp;</td>
	<td width="25"><? echo ($item['visible']==1)? "<img src='img/icon_activa.gif' width='16' height='16' border='0' />" : "<img src='img/icon_desactiva.gif' width='16' height='16' border='0' />"; ?></td>
    <td width="25" align="center" valign="middle" class="textoListado"><a href="#" onclick="subirPos(<? echo $item['id_noticia'] ?>)"><img src="img/arriba.gif" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="textoListado"><a href="#" onclick="bajarPos(<? echo $item['id_noticia'] ?>)"><img src="img/abajo.gif" alt="" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editar&id_noticia='.$item['id_noticia']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminar&id_noticia='.$item['id_noticia'].'&inicio='. $this->oPaginador->paginaActual ); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro de eliminar la Noticia <? echo $item['titulo']; ?>?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  
  	<? } ?>
  <tr>
    <td colspan="9"><? if($this->oPaginador->paginaAnterior!==false){ ?>
		<input name="botAnterior" type="button" class="boton" id="botAnterior" onclick="buscar(<? echo $this->oPaginador->paginaAnterior; ?>);" value="&lt;&lt; Anterior" />
					<? } ?>
	&nbsp;
					<? if($this->oPaginador->paginaSiguiente!==false){ ?>
		<input name="botSiguiente" type="button" class="boton" id="botSiguiente" onclick="buscar(<? echo $this->oPaginador->paginaSiguiente; ?>);" value="Siguiente &gt;&gt;"/>
					<? } ?>	</td>
  </tr>
</table>

	
   
   <script type="text/javascript">
	_stdCMS.rayarTabla('set','record_row',1);
	</script>
	
<? } ?>
      
      

	  
<? if($this->show('panelFormNoticia')){ ?>
	<form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formNoticia" id="formNoticia" style="margin:0px; padding:0px;">
	<input type="hidden" name="id_noticia" id="id_noticia" />
	<input type="hidden" name="accion" id="accion" />
  	<input type="hidden" name="form" id="form"  value="formNoticia"/>
		<div class="divDataForm">
			<div class="textoTituloForm">
				<? echo ($this->edicion)? 'Editando':'Nueva'; ?> Noticia:
			</div>
	
    		<div >
		    	<label class="inputText" >T&iacute;tulo:</label>
	    			<input name="titulo" type="text" class="txtInput" id="titulo"  value="" />
			</div>      
    		<div > 
		    	<label class="inputText" >Descripci&oacute;n :</label>
        			<!--<textarea name="descripcion" class="txtInput" id="descripcion"></textarea>-->
                    <? $oHtml=new CMSHtmlEditor("texto",400,200,(isset($this->DATAFORM['formNoticia']['texto']))? $this->DATAFORM['formNoticia']['texto']:''); ?>
			</div>
			
			 <div>
			 <label>Fecha:</label>
			 <? 
			 if(isset($this->POST['fecha'])){
			 	$this->DATAFORM['formNoticia']['fecha']=$this->POST['fecha'];
			 }
			 if(isset($this->DATAFORM['formNoticia']['fecha'])){
			 	$this->DATAFORM['formNoticia']['fecha']=PF::traducirDate($this->DATAFORM['formNoticia']['fecha'],'Y/m/d');
			 }
			 I::inputCalendar('formNoticia','fecha');
			 ?>
			 </div>
	
			<div>
				<label class="inputText">Noticia Visible:</label>
				<input name="visible" type="checkbox" value="1" id="visible" />
			</div>
         <div>
    	   <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
		   <input type="button" class="boton"  value="Cancelar" onclick="document.location.href='<? echo $this->modulo; ?>?<? $this->encodeURL('accion=listar'); ?>';" />
	    </div>
		</div>
    	<? $this->encodeSessionData(); ?>
	</form>
<? } ?>     

	<!-- 
        ////////////////////////////////  PANEL GALERIA DE IMAGENES  //////////////////// 
        ///////////////////////////////////////////////////////////////////////////////////  
        -->

    <? if($this->show('panelImagenes')){ ?>

	<div style="margin-left:30px;">
		<div class="textoTituloForm" style="float:left; width:400px; height:10px;">Im&aacute;genes de la Noticia: <? PF::html($this->datosProd['titulo']); ?></div>
		    <input type="button" class="boton" value="Datos de la Noticia" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=editar&id_noticia='.$this->datosNoticia['id_noticia']); ?>'" style="margin-top:10px;"/>    
		    <input type="button" class="boton" value="Volver al Listado" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=listar'); ?>'" style="margin-top:10px;"/>
	</div>
    <div style="clear:both;"></div>
    	 <form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formImg" id="formImg">
		     <div class="divDataForm" style="margin-left:30px;">
        	    <input type="hidden" name="id_noticia" id="id_noticia" />
		        <input type="hidden" name="accion" id="accion" />
        		<input type="hidden" name="form" id="form"  value="formImg"/>
				<div>
				    <label>Nueva Imagen:</label>
			        <input name="imagen" type="file" class="textoForm" id="imagen" />
			   </div>
       		   <div>
				    <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
         	   </div>
         	</div>
	    </form>
     <hr />
     <div id="contenedorImg">
    	 <? 
		     foreach($this->arrayImg as $item){ 
	 	 ?>
   		<div class="container">
	      <img src="<? echo PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$item['nombre']); ?>" width="<? echo FOTO_GAL_MIN_ANCHO; ?>" height="<? echo FOTO_GAL_MIN_ALTO; ?>" border="0"/>
    	     <ul>
        		 <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=subirOrdenImagen&id_imagen='.$item['id_imagen'].'&id_noticia='.$this->datosNoticia['id_noticia']); ?>"><img src="img/izquierda.gif" width="16" height="16" border="0" /></a></li>
		         <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminaImagenNoticia&id_imagen='.$item['id_imagen'].'&id_noticia='.$this->datosNoticia['id_noticia']); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></li>
    		     <li> <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=bajarOrdenImagen&id_imagen='.$item['id_imagen'].'&id_noticia='.$this->datosNoticia['id_noticia']); ?>"><img src="img/derecha.gif" width="16" height="16" border="0" /></a></li>
       	  </ul>
     	</div>
     
     	<? } ?>
    
    	<div style="clear:both;"></div> 
     </div> 
    
     	<div style="height:10px;"></div>   
	<? } ?>

<!-- 
        ////////////////////////////////  FIN PANEL GALERIA DE IMAGENES  //////////////////// 
        ///////////////////////////////////////////////////////////////////////////////////  
        -->     


			<!-- 
        ////////////////////////////////  PANEL GALERIA DE IMAGENES  //////////////////// 
        ///////////////////////////////////////////////////////////////////////////////////  
        -->

    <? if($this->show('panelVideos')){ ?>

	<div style="margin-left:30px;">
		<div class="textoTituloForm" style="float:left; width:400px; height:10px;">Videos de la Noticia: <? PF::html($this->datosProd['titulo']); ?></div>
		    <input type="button" class="boton" value="Datos de la Noticia" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=editar&id_noticia='.$this->datosNoticia['id_noticia']); ?>'" style="margin-top:10px;"/>    
		    <input type="button" class="boton" value="Volver al Listado" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=listar'); ?>'" style="margin-top:10px;"/>
	</div>
    <div style="clear:both;"></div>
    	 <form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formVideo" id="formVideo">
		     <div class="divDataForm" style="margin-left:30px;">
        	    <input type="hidden" name="id_noticia" id="id_noticia" />
		        <input type="hidden" name="accion" id="accion" />
        		<input type="hidden" name="form" id="form"  value="formVideo"/>
				<div>
				    <label>Nuevo Video:</label>
			        <textarea name="descripcion" id="descripcion" rows="10" cols="50"></textarea>
			   </div>
       		   <div>
				    <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
         	   </div>
         	</div>
	    </form>
     <hr />
     <div id="contenedorImg">
    	 <? 
		     foreach($this->arrayVideo as $item){ 
	 	 ?>
   		<div class="container">
	      <a style="cursor:pointer;" onclick="PFHTML.openWindow('<? echo $this->modulo; ?>?<? $this->encodeURL('accion=verVideo&idVideo='.$item['id_video']); ?>','Video',650,400);" target="_blank" ><span class="textoForm">Ver Video</span></a>
    	     <ul>
        		 <li>&nbsp;</li>
				<br>
		         <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarVideo&id_video='.$item['id_video'].'&id_noticia='.$this->datosNoticia['id_noticia']); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></li>
    		     <li>&nbsp;</li>
       	  </ul>
     	</div>
     
     	<? } ?>
		
    
    	<div style="clear:both;"></div> 
     </div> 
    
     	<div style="height:10px;"></div>   
	<? } ?>

<!-- 
        ////////////////////////////////  FIN PANEL GALERIA DE IMAGENES  //////////////////// 
        ///////////////////////////////////////////////////////////////////////////////////  
        -->     

      <!--FIN CONTENIDO DINÄMICO -->
              
      <? include('panel_pie_tpl.php'); ?>
