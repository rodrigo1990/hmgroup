<? include('panel_encabezado_tpl.php'); ?>
           
              <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
              

<? if($this->show('panelListadoLista')){ ?>

<script type="text/javascript">
function buscar(inicio){
	PFHTML.rellenarDato('formBuscar','inicio',inicio);
	PFHTML.rellenarDato('formBuscar','accion','listar');
	document.getElementById('formBuscar').submit();
}

function subirPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','subirPos');
	PFHTML.rellenarDato('formBuscar','id_lista',idProd);
	document.getElementById('formBuscar').submit();
}

function bajarPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','bajarPos');
	PFHTML.rellenarDato('formBuscar','id_lista',idProd);
	document.getElementById('formBuscar').submit();
}

</script>

<table class="tabla" width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;" id="set">
  <tr class="encabezadoTabla">
    <td width="400" >
        <form id="formBuscar" name="formBuscar" method="post" action="<? echo $this->modulo; ?>">
    		<input type="hidden" name="form" id="form" value="formBuscar" />
	    	<input type="hidden" name="accion" id="accion" value="listar" />
	    	<input type="hidden" name="inicio" id="inicio" />
            <input type="hidden" name="id_lista" id="id_lista" />
    		<span class="tituloListado">Lista de Precios</span>
    	</form>
	</td>
    <td colspan="2" align="center" >
    	<a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevo'); ?>" class="tituloListado">Nueva Lista de Precios</a>
    </td>
  </tr>

    <? foreach($this->arrayItems as $item){	?>
  <tr>
    <td class="textoListado"><? echo $item['archivo'] ?></td>
	<td width="100" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=verContenido&archivo='.RUTA_CONTENIDO.'/'.$this->arrayLista[0]['nombre']); ?>">Ver Lista</a></td>
    <td width="100" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminar&id_lista='.$item['id_lista'].'&inicio='. $this->oPaginador->paginaActual ); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro de eliminar la Lista de Precios?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  
  	<? } ?>
  <tr>
    <td colspan="8"><? if($this->oPaginador->paginaAnterior!==false){ ?>
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
      
      

	  
<? if($this->show('panelFormLista')){ ?>
	<form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formLista" id="formLista" style="margin:0px; padding:0px;">
	<input type="hidden" name="id_lista" id="id_lista" />
	<input type="hidden" name="accion" id="accion" />
  	<input type="hidden" name="form" id="form"  value="formLista"/>
		<div class="divDataForm">
			<div class="textoTituloForm">
				<? echo ($this->edicion)? 'Editando':'Nueva'; ?> Lista de Precios
			</div>
	
    		
			<div  style="height:55px;">
		    <label class="textoForm">Lista de Precios:</label>
		       <input name="archivo" type="file" id="archivo" />
		</div>
       <div>
    	   <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
		   <input type="button" class="boton"  value="Cancelar" onclick="document.location.href='<? echo $this->modulo; ?>?<? $this->encodeURL('accion=listar'); ?>';" />
	    </div>
		</div>
		
	    
   
    	<? $this->encodeSessionData(); ?>

	</form>
<? } ?>     

	
      <!--FIN CONTENIDO DINÄMICO -->
              
      <? include('panel_pie_tpl.php'); ?>
