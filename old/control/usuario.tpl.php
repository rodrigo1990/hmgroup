<? include('panel_encabezado_tpl.php'); ?>
           
              <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
              

<? if($this->show('panelListadoUsuarios')){ ?>

<script type="text/javascript">
function buscar(inicio){
	PFHTML.rellenarDato('formBuscar','inicio',inicio);
	PFHTML.rellenarDato('formBuscar','accion','listar');
	document.getElementById('formBuscar').submit();
}

function subirPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','subirPos');
	PFHTML.rellenarDato('formBuscar','id_usuario',idProd);
	document.getElementById('formBuscar').submit();
}

function bajarPos(idProd){
	PFHTML.rellenarDato('formBuscar','accion','bajarPos');
	PFHTML.rellenarDato('formBuscar','id_usuario',idProd);
	document.getElementById('formBuscar').submit();
}

</script>

<table class="tabla" width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;" id="set">
  <tr class="encabezadoTabla">
    <td width="424" >
        <form id="formBuscar" name="formBuscar" method="post" action="<? echo $this->modulo; ?>">
    		<input type="hidden" name="form" id="form" value="formBuscar" />
	    	<input type="hidden" name="accion" id="accion" value="listar" />
	    	<input type="hidden" name="inicio" id="inicio" />
            <input type="hidden" name="id_usuario" id="id_usuario" />
    		<span class="tituloListado"><? echo($this->tipo==1)?"Administradores":"Usuarios Registrados"; ?></span>
    	</form>
	</td>
    <td colspan="2" align="center" >
    	<a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevo'); ?>" class="tituloListado"><? echo($this->tipo==1)?"Nuevo Administrador":"Nuevo Usuario Registrado"; ?></a>
    </td>
  </tr>

    <? foreach($this->arrayItems as $item){	?>
  <tr>
    <td class="textoListado"><? PF::html($item['nombre']); ?> <? PF::html($item['apellido']); ?> (<? PF::html($item['user_name']); ?>) </td>
	<td width="73" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editar&id_usuario='.$item['id_usuario']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="83" align="center" valign="middle" class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminar&id_usuario='.$item['id_usuario'].'&inicio='. $this->oPaginador->paginaActual ); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro de eliminar el usuario <? echo $item['user_name']; ?>?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
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
      
      

	  
<? if($this->show('panelFormUsuario')){ ?>
	<form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formUsuario" id="formUsuario" style="margin:0px; padding:0px;">
	<input type="hidden" name="id_usuario" id="id_usuario" />
	<input type="hidden" name="accion" id="accion" />

  	<input type="hidden" name="form" id="form"  value="formUsuario"/>
		<div class="divDataForm">
			<div class="textoTituloForm">
				<? echo ($this->edicion)? 'Editando':'Nuevo'; ?> <? echo($this->tipo==1)?"Administrador:":"Usuario Registrado:"; ?>
			</div>
	
    		<div >
		    	<label class="inputText" >Nombre:</label>
	    			<input name="nombre" type="text" class="txtInput" id="nombre"  value="" />
			</div>      
    		<div >
		    	<label class="inputText" >Apellido:</label>
	    			<input name="apellido" type="text" class="txtInput" id="apellido"  value="" />
			</div>      
    	    <div >
		    	<label class="inputText" >Email:</label>
	    			<input name="email" type="text" class="txtInput" id="email"  value="" />
			</div>
			<div >
		    	<label class="inputText" >Nombre de Usuario:</label>
	    			<input name="user_name" type="text" class="txtInput" id="user_name"  value="" />
			</div>
			<div>
				<? if($this->tipo==1){?>
				<input type="hidden" name="id_tipo" id="id_tipo" />
				<? }else{ ?>
				<label class="inputText" >Tipo de Usuario:</label>
          			<select name="id_tipo" id="id_tipo" name="id_tipo" >
			            <option value="2">Mayorista</option>
            			<option value="3" selected="selected">Distribuidor</option>
			        </select>
				<? } ?>
		  
        </div>
			<div >
		    	<label class="inputText" >Clave:</label>
	    			<input name="user_pass" type="password" class="txtInput" id="user_pass"  value="" />
			</div>
			<div >
		    	<label class="inputText" >Repita Clave:</label>
	    			<input name="user_pass2" type="password" class="txtInput" id="user_pass2"  value="" />
			</div>
			<div>
				<label class="inputText">Usuario activo?</label>
				<input name="id_estado" type="checkbox" value="1"  id="id_estado"/>
			</div>
			
       
		</div>
		<!--<div  style="height:55px;"> esto es por si hay que poner un archivo asociado a un Usuario
		    <label class="inputText">Temario:</label>
		    <? /*if(!$this->edicion || trim($this->DATAFORM['formUsuario']['temario'])==''){ ?>
			    <input name="temario" type="file" class="inputText" id="temario" />
		    <? }else{ ?>
  				<a class="textoForm" style="cursor:pointer;" onclick="PFHTML.openWindow('<?// echo $this->modulo; ?>?<? $this->encodeURL('accion=verContenido&archivo='.RUTA_CONTENIDO.'/'.$this->DATAFORM['formUsuario']['temario']); ?>','logo','400','200');">Ver Temario</a> 
				 <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarArchivo&id_usuario='.$this->DATAFORM['formUsuario']['id_usuario']); ?>"><img src="img/delete.gif" width="16" height="16" border="0" align="top"></a></span> 
		    <? }*/ ?>
     	</div>-->
	    <div>
    	   <input name="Submit"  type="submit" class="boton"  value="Confirmar" />
		   <input type="button" class="boton"  value="Cancelar" onclick="document.location.href='<? echo $this->modulo; ?>?<? $this->encodeURL('accion=listar'); ?>';" />
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
		<div class="textoTituloForm" style="float:left; width:400px; height:10px;">Im&aacute;genes del Crucero: <? PF::html($this->datosBarco['titulo']); ?></div>
		    <input type="button" class="boton" value="Datos del Crucero" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=editar&id_barco='.$this->datosBarco['id_barco']); ?>'" style="margin-top:10px;"/>    
		    <input type="button" class="boton" value="Volver al Listado" onclick="document.location.href='<? echo $this->modulo; ?>?<? PF::encodeURL('accion=listar'); ?>'" style="margin-top:10px;"/>
	</div>
    <div style="clear:both;"></div>
    	 <form action="<? echo $this->modulo; ?>" method="post" enctype="multipart/form-data" name="formImg" id="formImg">
		     <div class="divDataForm" style="margin-left:30px;">
        	    <input type="hidden" name="id_barco" id="id_barco" />
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
        		 <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=subirOrdenImagen&id_imagen='.$item['id_imagen'].'&id_barco='.$this->datosBarco['id_barco']); ?>"><img src="img/izquierda.gif" width="16" height="16" border="0" /></a></li>
		         <li><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarImagenBarco&id_imagen='.$item['id_imagen'].'&id_barco='.$this->datosBarco['id_barco']); ?>" onclick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></li>
    		     <li> <a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=bajarOrdenImagen&id_imagen='.$item['id_imagen'].'&id_barco='.$this->datosBarco['id_barco']); ?>"><img src="img/derecha.gif" width="16" height="16" border="0" /></a></li>
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
