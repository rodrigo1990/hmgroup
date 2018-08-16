<? include('panel_encabezado_tpl.php'); ?>
        	
            <!-- ///////////////  ZONA DE CAMBIOS //////////////////// -->
       		
            
            <!-- SECCION -->
        	<div class="textoTitulo" id="seccion">
        	<? if($this->show('panelUsuario')){
        		echo ($this->actualiza)? 'Datos de Usuario ':'Nuevo Usuario '; ?>
			<? } ?>
			<? if($this->show('panelNuevoPerfil')){
        		echo ($this->actualiza)? 'Datos de Perfil ':'Nuevo Perfil '; ?>
			<? } ?>
        	</div>
            <!--FIN SECCION -->
        
        
        	
          
          
           
           
           
            <!-- CONTENIDO DINÄMICO -->
            <div id="zonaDinamica">
            <? if ($this->show('panelUsuario')){?>
            <form action="<? echo $this->modulo; ?>" method="post" name="formNuevoUsuario" id="formNuevoUsuario">
				<input name="form" id="form" type="hidden" value="formNuevoUsuario">
				<input name="accion" id="accion" type="hidden" value="">
				<input name="id_usuario" id="id_usuario" type="hidden" value="">
				<table width="400" border="0" cellspacing="3" cellpadding="3">
<tr>
    					<td class="textoForm">Nombre</td>
   					  <td><input name="nombre" type="text" class="inputText" id="nombre" size="30" maxlength="30"></td>
				  </tr>
  					<tr>
    					<td class="textoForm">Apellido</td>
   					  <td><input name="apellido" id="apellido" type="text" class="inputText" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Email</td>
   					  <td><input name="email" id="email" type="text" class="inputText" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Nombre de Usuario</td>
   					  <td><input name="user_name" id="user_name" type="text" class="inputText" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Password</td>
   					  <td><input name="user_pass" id="user_pass" class="inputText" type="password" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Repetir Password</td>
   					  <td><input name="user_pass2" id="user_pass2" class="inputText" type="password" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Direccion</td>
   					  <td><input name="direccion" id="direccion" class="inputText" type="text" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Ciudad</td>
   					  <td><input name="ciudad" type="text" class="inputText" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Provincia</td>
   					  <td><input name="provincia" id="provincia" class="inputText" type="text" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Pais</td>
   					  <td><input name="pais" id="pais" class="inputText" type="text" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">CP</td>
   					  <td><input name="cp" id="cp" type="text" class="inputText" size="10" maxlength="10"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Empresa</td>
   					  <td><input name="empresa" id="empresa" class="inputText" type="text" size="30" maxlength="30"></td>
  					</tr>
    				<tr>
    					<td class="textoForm">Cargo</td>
   					  <td><input name="cargo" id="cargo" class="inputText" type="text" size="30" maxlength="30"></td>
  					</tr>
    				<tr>
    				  <td class="textoForm">id_tipo</td>
    				  <td><input name="id_tipo" id="id_tipo" class="inputText" type="text" size="30" maxlength="30" /></td>
  				  </tr>
    				<tr>
    				  <td class="textoForm">id_estado</td>
    				  <td><input name="id_estado" id="id_estado" class="inputText" type="text" size="30" maxlength="30" /></td>
  				  </tr>
  					
  					<? foreach ($this->perfiles as $item){ ?>
  					<tr>
    					<td colspan="2"><input name="perfiles[]" type="checkbox" value="<? echo $item['id_perfil']; ?>"	 class="inputText" >
   					    <span class="textoForm">Incluir en Perfil <? PF::html($item['nombre'])?></span></td>
				  </tr>
  					<? } ?>
				</table>
			  <input name="enviar" type="submit" class="boton" value="Confirmar" onclick="showProcesando();"/>
            </form>
            <? } ?>
			</div>
			
			<? if ($this->show('panelNuevoPerfil')){?>
            <form action="<? echo $this->modulo; ?>" method="post" name="formPerfil" id="formPerfil">
		    <input name="form" id="form" type="hidden" value="formPerfil">
				<input name="accion" id="accion" type="hidden" value="">
				<input name="id_perfil" id="id_perfil" type="hidden" value="">
				<table width="400" border="0" cellspacing="0" cellpadding="3">
			  <tr>
    					<td class="textoForm">Nombre del Perfil</td>
   					  <td><input name="nombre" type="text" class="inputText" id="nombre" size="30" maxlength="30"></td>
  					</tr>
  					<tr>
    					<td class="textoForm">Descripcion</td>
   					  <td><input name="descripcion" type="text" class="inputText" id="descripcion" size="40" maxlength="40"></td>
  					</tr>
  					
  					
  					<? foreach ($this->permisos as $item){ ?>
  					<tr>
    					<td colspan="2" class="textoForm"><input name="permisos[]" id="permisos<? echo $item['id_permiso']; ?>" type="checkbox" value="<? echo $item['id_permiso']; ?>"
    					<? 
						if(isset($this->aPerfilPermiso)){
								foreach ($this->aPerfilPermiso as $item2){
									if($item2['id_permiso']==$item['id_permiso']){
										echo "checked=\"checked\"";
									}
								}
						}
						?>
    					> Incluir Permiso <? PF::html($item['nombre'])?></td>
				  </tr>
  					<? } ?>
				</table>
				<input name="enviar" type="submit" class="boton" value="Confirmar">
            </form>
            <? } ?>
            
            <? if ($this->show('panelFormPermiso')){?>
            <form action="<? echo $this->modulo; ?>" method="post" name="formPermiso" id="formPermiso">
		    <input name="form" id="form" type="hidden" value="formPermiso">
				<input name="accion" id="accion" type="hidden" value="">
				<input name="id_permiso" id="id_permiso" type="hidden" value="">
			  <table width="400" border="0" cellspacing="0" cellpadding="3">
			  <tr>
    					<td width="119" class="textoForm">Nombre del Permiso</td>
   					    <td width="269"><input name="nombre" type="text" class="inputText" id="nombre" size="30" maxlength="30"></td>
				  </tr>
  					<tr>
    					<td class="textoForm">Descripcion</td>
   					  <td><input name="descripcion" type="text" class="inputText" id="descripcion" size="40" maxlength="40"></td>
  					</tr>
  					<tr>
  					  <td class="textoForm">Objeto</td>
  					  <td><label>
  					    <select name="id_objeto" class="inputText" id="id_objeto">
                        <? echo I::arrayToOptions($this->objetos,'id_objeto','clave'); ?>
				            </select>
  					  </label></td>
			    </tr>
  					<tr>
  					  <td class="textoForm">Tipo de Permiso</td>
  					  <td><input name="tipo" type="text" class="inputText" id="tipo" size="30" maxlength="30" /></td>
			    </tr>
				</table>
				<input name="enviar" type="submit" class="boton" value="Confirmar">
            </form>
            <? } ?>
            
            
             <? if ($this->show('panelFormObjeto')){?>
             
            <form action="<? echo $this->modulo; ?>" method="post" name="formObjeto" id="formObjeto">
		    <input name="form" id="form" type="hidden" value="formObjeto">
				<input name="accion" id="accion" type="hidden" value="">
				<input name="id_objeto" id="id_objeto" type="hidden" value="">
			  <table width="400" border="0" cellspacing="0" cellpadding="3">
			  <tr>
    					<td width="119" class="textoForm">Nombre del Objeto</td>
   					    <td width="269"><input name="nombre" type="text" class="inputText" id="nombre" size="30" maxlength="30"></td>
				  </tr>
  					<tr>
    					<td class="textoForm">Descripci&oacute;n</td>
   					  <td><input name="descripcion" type="text" class="inputText" id="descripcion" size="40" maxlength="40"></td>
  					</tr>
  					<tr>
  					  <td class="textoForm">Clave</td>
  					  <td><input name="clave" type="text" class="inputText" id="clave" size="30" maxlength="30" /></td>
			    </tr>
				</table>
				<input name="enviar" type="submit" class="boton" value="Confirmar">
            </form>
            
            <? } ?>
			
			
			
			
			
			
			
			
			
			
			
	<? if($this->show('panelListadoUsuarios')){ ?>
    
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

<table width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;">
  <tr>
    <td width="426" class="textoTitulo">Usuarios</td>
    <td colspan="3" class="etiquetas"><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevoUsuario'); ?>" class="linkMenuOver">Nuevo Usuario</a></td>
  </tr>
    <? 
	$b=true;
	foreach($this->arrayItems as $item){
		if($b){
			$b=false;
			$color='bgcolor="#FFFFFF"';
		}
		else{
			$color='';
		} 
	?>
  <tr>
    <td class="inputText" <? echo $color; ?>><? PF::html($item['nombre']); ?> <? PF::html($item['apellido']); ?> (<? PF::html($item['user_name']); ?>)</td>
    <td class="inputText" <? echo $color; ?>>&nbsp;</td>
    <td width="30" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editarUsuario&id_usuario='.$item['id_usuario']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="31" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarUsuario&id_usuario='.$item['id_usuario']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

    
   
   	<? } ?>
    
    
    <? if($this->show('panelListadoPermisos')){ ?>
    

<table width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;">
  <tr>
    <td width="426" class="textoTitulo">Permisos</td>
    <td colspan="3" class="etiquetas"><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevoPermiso'); ?>" class="linkMenuOver">Nuevo Permiso</a></td>
  </tr>
    <? 
	$b=true;
	foreach($this->permisos as $item){
		if($b){
			$b=false;
			$color='bgcolor="#FFFFFF"';
		}
		else{
			$color='';
		} 
	?>
  <tr>
    <td class="inputText" <? echo $color; ?>><? PF::html($item['nombre']); ?> </td>
    <td class="inputText" <? echo $color; ?>>&nbsp;</td>
    <td width="30" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editarPermiso&id_permiso='.$item['id_permiso']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="31" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarPermiso&id_permiso='.$item['id_permiso']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

    
   
   	<? } ?>
    
    
     <? if($this->show('panelListadoPerfiles')){ ?>
    

<table width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;">
  <tr>
    <td width="426" class="textoTitulo">Perfiles</td>
    <td colspan="3" class="etiquetas"><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevoPerfil'); ?>" class="linkMenuOver">Nuevo Perfil</a></td>
  </tr>
    <? 
	$b=true;
	foreach($this->perfiles as $item){
		if($b){
			$b=false;
			$color='bgcolor="#FFFFFF"';
		}
		else{
			$color='';
		} 
	?>
  <tr>
    <td class="inputText" <? echo $color; ?>><? PF::html($item['nombre']); ?> </td>
    <td class="inputText" <? echo $color; ?>>&nbsp;</td>
    <td width="30" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editarPerfil&id_perfil='.$item['id_perfil']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="31" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarPerfil&id_perfil='.$item['id_perfil']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro?');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

    
   
   	<? } ?>
    
    
    <? if($this->show('panelListadoObjetos')){ ?>
    

<table width="600" border="0" cellspacing="0" cellpadding="3" style="margin-left:20px;">
  <tr>
    <td width="426" class="textoTitulo">Objetos</td>
    <td colspan="3" class="etiquetas"><a href="<? echo $this->modulo; ?>?<?  $this->encodeURL('accion=nuevoObjeto'); ?>" class="linkMenuOver">Nuevo Objeto</a></td>
  </tr>
    <? 
	$b=true;
	foreach($this->objetos as $item){
		if($b){
			$b=false;
			$color='bgcolor="#FFFFFF"';
		}
		else{
			$color='';
		} 
	?>
  <tr>
    <td class="inputText" <? echo $color; ?>><? PF::html($item['clave']); ?> </td>
    <td class="inputText" <? echo $color; ?>>&nbsp;</td>
    <td width="30" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=editarObjeto&id_objeto='.$item['id_objeto']); ?>"><img src="img/editar.gif" width="16" height="16" border="0" /></a></td>
    <td width="31" align="center" <? echo $color; ?> class="menu_categorias"><a href="<? echo $this->modulo; ?>?<? $this->encodeURL('accion=eliminarObjeto&id_objeto='.$item['id_objeto']); ?>" onClick="return objConfirmacion.requerirConfirmacion(this,'Está seguro? Esta acción ejecutará en cascada la eliminación de los permisos involucrados');"><img src="img/delete.gif" width="16" height="16" border="0" /></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

    
   
   	<? } ?>
			
			
			
    <!--FIN CONTENIDO DINÄMICO -->
            
<? include('panel_pie_tpl.php'); ?>
