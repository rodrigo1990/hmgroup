<? include('panel_encabezado_tpl.php'); ?>
           
              <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
              

<? if($this->show('panelListadoCategoria')){ ?>

<script type="text/javascript">
function buscar(inicio){
	PFHTML.rellenarDato('formBuscar','inicio',inicio);
	PFHTML.rellenarDato('formBuscar','accion','listar');
	document.getElementById('formBuscar').submit();
}

function subirPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','subirPos');
	PFHTML.rellenarDato('formBuscar','id_categoria',idProd);
	document.getElementById('formBuscar').submit();
}

function bajarPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','bajarPos');
	PFHTML.rellenarDato('formBuscar','id_categoria',idProd);
	document.getElementById('formBuscar').submit();
}

</script>

<table class="tabla" width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;" id="set">
  <tr class="encabezadoTabla">
    <td width="440" >
        <form id="formBuscar" name="formBuscar" method="post" action="<? echo $this->modulo; ?>">
    		<input type="hidden" name="form" id="form" value="formBuscar" />
	    	<input type="hidden" name="accion" id="accion" value="listar" />
	    	<input type="hidden" name="inicio" id="inicio" />
            <input type="hidden" name="id_categoria" id="id_categoria" />
    		<span class="tituloListado">Categor&iacute;as</span>
    	    <select name="id_padre" class="txtInput" id="id_padre">
			<option value="0">Principales</option>
			<? echo $this->lista; ?>
  	        </select>
            <input name="" type="button" value="Filtrar" class="boton" onclick="buscar(0)"/>
    	    </form>
	</td>
    <td colspan="4" align="right" >
    	<a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevo'); ?>" class="tituloListado">Nueva Categor&iacute;a</a>
    </td>
  </tr>

    <? foreach($this->arrayItems as $item){	?>
  <tr>
    <td class="textoListado"><? PF::html($item['descripcion']); ?> </td>
    <td width="30" align="center" valign="middle" class="textoListado"><a href="#" onclick="subirPos(<? echo $item['id_categoria'] ?>)"><img src="img/arriba.gif" width="16" height="16" border="0" /></a></td>
    <td width="23" align="center" valign="middle" class="textoListado"><a href="#" onclick="bajarPos(<? echo $item['id_categoria'] ?>)"><img src="img/abajo.gif" alt="" width="16" height="16" border="0" /></a></td>
    <td width="23" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editar&id_categoria='.$item['id_categoria']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="42" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminar&id_categoria='.$item['id_categoria'].'&inicio='. $this->oPaginador->paginaActual); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro de eliminar el prod <? echo $item['titulo']; ?>?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  
  	<? } ?>
  <tr>
    <td colspan="5"><? if($this->oPaginador->paginaAnterior!==false){ ?>
		<input name="botAnterior" type="button" class="boton" id="botAnterior" onclick="buscar(<? echo $this->oPaginador->paginaAnterior; ?>);" value="&lt;&lt; Anterior" />
					<? } ?>
	&nbsp;
					<? if($this->oPaginador->paginaSiguiente!==false){ ?>
		<input name="botSiguiente" type="button" class="boton" id="botSiguiente" onclick="buscar(<? echo $this->oPaginador->paginaSiguiente; ?>);" value="Siguiente &gt;&gt;"/>
					<? } ?>
	</td>
  </tr>
</table>

	
   
   <script type="text/javascript">
	_stdCMS.rayarTabla('set','record_row',1);
	</script>
	
<? } ?>
      
      

	  
<? if($this->show('panelFormCategoria')){ ?>
	<form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formCategoria" id="formCategoria" style="margin:0px; padding:0px;">
	<input type="hidden" name="id_categoria" id="id_categoria" />
	<input type="hidden" name="accion" id="accion" />
    <input type="hidden" name="form" id="form"  value="formCategoria"/>
		<div class="divDataForm">
			<div class="textoTituloForm">
				<? echo ($this->edicion)? 'Editando':'Nuevo'; ?> Categoria:
			</div>
	
    		<div >
		    	<label class="inputText" >Descripci&oacute;n:</label>
	    			<input name="descripcion" type="text" class="txtInput" id="descripcion"  value="" />
			</div>      
    		<div>
    			<label class="inputText">Categor&iacute;a:</label>
			    	<select name="id_padre" class="txtInput" id="id_padre">
            		  <option value="0">Principal</option>
		              <? echo $this->lista; ?>
			        </select>
		    </div>
			
			
       
		</div>
		<!--<div  style="height:55px;"> esto es por si hay que poner un archivo asociado a un Categoria
		    <label class="inputText">Temario:</label>
		    <? /*if(!$this->edicion || trim($this->DATAFORM['formCategoria']['temario'])==''){ ?>
			    <input name="temario" type="file" class="inputText" id="temario" />
		    <? }else{ ?>
  				<a class="textoForm" style="cursor:pointer;" onclick="PFHTML.openWindow('<?// echo $this->modulo; ?>?<? $this->encodeURL('accion=verContenido&archivo='.RUTA_CONTENIDO.'/'.$this->DATAFORM['formCategoria']['temario']); ?>','logo','400','200');">Ver Temario</a> 
				 <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarArchivo&id_categoria='.$this->DATAFORM['formCategoria']['id_categoria']); ?>"><img src="img/delete.gif" width="16" height="16" border="0" align="top"></a></span> 
		    <? } */?>
     	</div>-->
	    <div>
    	   <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
		   <input type="button" class="boton"  value="Cancelar" onclick="document.location.href='<? echo $this->modulo; ?>?<? $this->encodeURL('accion=listar'); ?>';" />
	    </div>
   
    	
	     <? $this->encodeSessionData(); ?>
    	
	</form>
<? } ?>          

      <!--FIN CONTENIDO DINÄMICO -->
              
      <? include('panel_pie_tpl.php'); ?>
