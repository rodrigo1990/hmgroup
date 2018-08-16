<script type="text/javascript">
function logIn(){
	$("#accion").attr('value','login');
	$("#formBusqueda").submit();
}
function buscar(){
	$("#accion").attr('value','buscar');
	$("#formBusqueda").submit();
}
</script>
<form name="formBusqueda" id="formBusqueda" style="margin:0px; padding:0px;" method="post" action="resultados.php">
<input type="hidden" name="form" id="form" value="formBusqueda">
<input type="hidden" name="accion" id="accion">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="40%" align="center" valign="middle"><span class="texto_negro">usuario</span>
                      <input name="user" type="text" class="texto_negro" id="user" size="17"></td>
                  <td width="42%" align="center" valign="middle"><span class="texto_negro">contrasena</span>
                      <input name="pass" type="text" class="texto_negro" id="pass" size="17"></td>
                  <td width="18%" align="center" valign="middle"><img src="img/ingresar_img.jpg" width="70" height="21" onClick="logIn();" style="cursor:pointer;"></td>
                </tr>
            </table></td>
            <td width="30%" align="right">
            
            <table width="95%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="87%" align="center" valign="middle"><label>
                    <input name="texto" type="text" class="texto_negro" id="texto">
                  </label></td>
                  <td width="13%" align="center" valign="middle"><img src="img/busqueda_img.jpg" width="22" height="23" onClick="buscar();"  style="cursor:pointer;"></td>
                </tr>
            </table>
            
            </td>
          </tr>
        </table>
        </form>