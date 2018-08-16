<? include('panel_encabezado_tpl.php'); ?>
           
              <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
              

<? if($this->show('panelListadoProducto')){ ?>

<script type="text/javascript">
function buscar(inicio){
	PFHTML.rellenarDato('formBuscar','inicio',inicio);
	PFHTML.rellenarDato('formBuscar','accion','listar');
	document.getElementById('formBuscar').submit();
}

function subirPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','subirPos');
	PFHTML.rellenarDato('formBuscar','id_producto',idProd);
	document.getElementById('formBuscar').submit();
}

function bajarPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','bajarPos');
	PFHTML.rellenarDato('formBuscar','id_producto',idProd);
	document.getElementById('formBuscar').submit();
}

</script>

<table class="tabla" width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;" id="set">
  <tr class="encabezadoTabla">
    <td colspan="5" >
        <form id="formBuscar" name="formBuscar" method="post" action="<? echo $this->modulo; ?>">
    		<input type="hidden" name="form" id="form" value="formBuscar" />
	    	<input type="hidden" name="accion" id="accion" value="listar" />
	    	<input type="hidden" name="inicio" id="inicio" />
            <input type="hidden" name="id_producto" id="id_producto" />
    		<span class="tituloListado">Productos</span>
            <select name="id_categoria" class="txtInput" id="id_categoria">
            <option value="-1">Todas</option>
            <? echo $this->lista; ?>
  		      </select>
            <input type="submit" class="boton" value="Filtrar" />
    	</form>	</td>
    <td colspan="4" align="center" ><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevo'); ?>" class="tituloListado">Nuevo Producto</a></td>
    </tr>

    <? foreach($this->arrayItems as $item){	?>
  <tr>
    <td width="275" class="textoListado"><? PF::html($item['titulo']); ?> </td>
	    <td width="150" align="center" valign="middle" class="textoListado"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=imagenes&id_producto='.$item['id_producto']); ?>">Im&aacute;genes del Producto</a></td>
	<td width="25"><? echo ($item['en_promocion']==1)? "<img src='img/promocion.gif' width='16' height='16' border='0' />" : "&nbsp;"; ?></td>
	<td width="25"><? echo ($item['es_novedad']==1)? "<img src='img/novedad.gif' width='16' height='16' border='0' />" : "&nbsp;"; ?></td>
	<td width="25"><? echo ($item['destacado']==1)? "<img src='img/destacado.gif' width='16' height='16' border='0' />" : "&nbsp;"; ?></td>
    <td width="25" align="center" valign="middle" class="textoListado"><a href="#" onclick="subirPos(<? echo $item['id_producto'] ?>)"><img src="img/arriba.gif" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="textoListado"><a href="#" onclick="bajarPos(<? echo $item['id_producto'] ?>)"><img src="img/abajo.gif" alt="" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editar&id_producto='.$item['id_producto']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="25" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminar&id_producto='.$item['id_producto'].'&inicio='. $this->oPaginador->paginaActual ); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro de eliminar el prod <? echo $item['titulo']; ?>?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
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
      
      

	  
<? if($this->show('panelFormProducto')){ ?>
	<form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formProducto" id="formProducto" style="margin:0px; padding:0px;">
	<input type="hidden" name="id_producto" id="id_producto" />
	<input type="hidden" name="accion" id="accion" />
  	<input type="hidden" name="form" id="form"  value="formProducto"/>
		<div class="divDataForm">
			<div class="textoTituloForm">
				<? echo ($this->edicion)? 'Editando':'Nuevo'; ?> Producto:
			</div>
	
    		<div >
		    	<label class="inputText" >T&iacute;tulo:</label>
	    			<input name="titulo" type="text" class="txtInput" id="titulo"  value="" />
			</div> 
            <div > 
		    	<label class="inputText" >Descripci&oacute;n abreviada:</label>
        			<!--<textarea name="descripcion" class="txtInput" id="descripcion"></textarea>-->
                    <? $oHtml=new CMSHtmlEditor("descripcion_abreviada",400,140,(isset($this->DATAFORM['formProducto']['descripcion_abreviada']))? $this->DATAFORM['formProducto']['descripcion_abreviada']:''); ?>
			</div>     
    		<div > 
		    	<label class="inputText" >Descripci&oacute;n :</label>
        			<!--<textarea name="descripcion" class="txtInput" id="descripcion"></textarea>-->
                    <? $oHtml=new CMSHtmlEditor("descripcion",400,200,(isset($this->DATAFORM['formProducto']['descripcion']))? $this->DATAFORM['formProducto']['descripcion']:''); ?>
			</div>
	
			<div >
		    	<label class="inputText" >Descipcion de Promoci&oacute;n:</label>
	    			<input name="descripcion_promocion" type="text" class="txtInput" id="descripcion_promocion"  value="" />
			</div>  
            <div >
		    	<label class="inputText" >Descipcion de Novedad:</label>
	    			<input name="descripcion_novedad" type="text" class="txtInput" id="descripcion_novedad"  value="" />
			</div>      
    	    <div>
    			<label class="inputText">Categoria:</label>
			    	<select name="id_categoria" class="txtInput" id="id_categoria">
            		  	<? echo $this->lista; ?>
			        </select>
		    </div>
			<div>
				<label class="inputText">Producto en promoci&oacute;n?</label>
				<input name="en_promocion" type="checkbox" value="1" id="en_promocion" />
			    <span class="textoListado">(S&oacute;lo se mostrar&aacute;n los primeros 4 productos en promoci&oacute;n)</span></div>
<div>
				<label class="inputText">Novedad?</label>
				<input name="es_novedad" type="checkbox" value="1"  id="es_novedad"/>
			</div>
			<div>
				<label class="inputText">Producto destacado?</label>
				<input name="destacado" type="checkbox" value="1"  id="destacado"/>
			    <span class="textoListado">(S&oacute;lo puede haber un producto destacado)</span></div>
<div>
				<label class="inputText">Producto activo?</label>
				<input name="activo" type="checkbox" value="1"  id="activo"/>
			</div>
			
         <div>
    	   <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
		   <input type="button" class="boton"  value="Cancelar" onclick="document.location.href='<? echo $this->modulo; ?>?<? $this->encodeURL('accion=listar'); ?>';" />
	    </div>
		</div>
		<!--<div  style="height:55px;"> esto es por si hay que poner un archivo asociado a un producto
		    <label class="inputText">Temario:</label>
		    <? /*if(!$this->edicion || trim($this->DATAFORM['formProducto']['temario'])==''){ ?>
			    <input name="temario" type="file" class="inputText" id="temario" />
		    <? }else{ ?>
  				<a class="textoForm" style="cursor:pointer;" onclick="PFHTML.openWindow('<?// echo $this->modulo; ?>?<? $this->encodeURL('accion=verContenido&archivo='.RUTA_CONTENIDO.'/'.$this->DATAFORM['formProducto']['temario']); ?>','logo','400','200');">Ver Temario</a> 
				 <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarArchivo&id_producto='.$this->DATAFORM['formProducto']['id_producto']); ?>"><img src="img/delete.gif" width="16" height="16" border="0" align="top"></a></span> 
		    <? }*/ ?>
     	</div>-->
	  
   
    	<? $this->encodeSessionData(); ?>

	</form>
<? } ?>     

	<!-- 
        ////////////////////////////////  PANEL GALERIA DE IMAGENES  //////////////////// 
        ///////////////////////////////////////////////////////////////////////////////////  
        -->

    <? if($this->show('panelImagenes')){ ?>

	<div style="margin-left:30px;">
		<div class="textoTituloForm" style="float:left; width:400px; height:10px;">Im&aacute;genes del Producto: <? PF::html($this->datosProd['titulo']); ?></div>
		    <input type="button" class="boton" value="Datos del Producto" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=editar&id_producto='.$this->datosProd['id_producto']); ?>'" style="margin-top:10px;"/>    
		    <input type="button" class="boton" value="Volver al Listado" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=listar'); ?>'" style="margin-top:10px;"/>
	</div>
    <div style="clear:both;"></div>
    	 <form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formImg" id="formImg">
		     <div class="divDataForm" style="margin-left:30px;">
        	    <input type="hidden" name="id_producto" id="id_producto" />
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
        		 <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=subirOrdenImagen&id_imagen='.$item['id_imagen'].'&id_producto='.$this->datosProd['id_producto']); ?>"><img src="img/izquierda.gif" width="16" height="16" border="0" /></a></li>
		         <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminaImagenProd&id_imagen='.$item['id_imagen'].'&id_producto='.$this->datosProd['id_producto']); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></li>
    		     <li> <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=bajarOrdenImagen&id_imagen='.$item['id_imagen'].'&id_producto='.$this->datosProd['id_producto']); ?>"><img src="img/derecha.gif" width="16" height="16" border="0" /></a></li>
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
