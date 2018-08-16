<?php include "header.php" ?>

<style type="text/css">
.form-control
{
  border: 1px solid #ffffff !important;
  color: #ffffff !important;
}

#btn_ingresar
{
  background: #ffffff;
  color: #000000;
  border: 0px;
}
</style>

<script type="text/javascript">
function validacion_login() {
    username_login = document.getElementById("username_login").value;
    pass_login = document.getElementById("pass_login").value;

    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if( username_login == null || username_login.length == 0 || /^\s+$/.test(username_login) || pass_login == null || pass_login.length == 0 || /^\s+$/.test(pass_login)) {
        alert("Debe completar todos los campos.");
        return false;
    }
    
    return true;
}
</script>

<body class="background-a">
<?php include "menu.php" ?>
<div class="container margintop">
  <div class="row rowblack">
    <div class="col-md-12">
          <?php
          if(($_POST['username']) && ($_POST['pass']))
          {
            $usuario = $_POST['username'];
            $contrasenia = $_POST['pass'];

            $consulta_cliente = "SELECT id, usuario, nombre, codigo, contrasenia FROM clientes WHERE codigo='$usuario' AND contrasenia='$contrasenia'";
            $resultado_cliente = mysql_query($consulta_cliente);
            $cant_cliente = mysql_num_rows($resultado_cliente);
            $fila_cliente = mysql_fetch_array($resultado_cliente);

            $titulo = utf8_encode($fila_cliente['nombre']);
            $titulo = html_entity_decode($titulo);
            $titulo = str_replace("Ã¡", "á",$titulo);
            $titulo = str_replace("Ã©", "é",$titulo);
            $titulo = str_replace("Ã*", "í",$titulo);
            $titulo = str_replace("Ã³", "ó",$titulo);
            $titulo = str_replace("Ãº", "ú",$titulo);
            $titulo = str_replace("Ã", "Á",$titulo);
            $titulo = str_replace("Ã‰", "É",$titulo);
            $titulo = str_replace("Ã", "Í",$titulo);
            $titulo = str_replace("Ã“", "Ó",$titulo);
            $titulo = str_replace("Ãš", "Ú",$titulo);
            $titulo = str_replace("Ã±", "ñ",$titulo);
            $titulo = str_replace("Ã‘", "Ñ",$titulo);
            $titulo = str_replace("Â¿", "¿",$titulo);
            $titulo = str_replace("Â«", "'",$titulo);
            $titulo = str_replace("Â»", "'",$titulo);
            $titulo = str_replace("Â¡", "¡",$titulo);

            if($cant_cliente <= 0)
            {
              ?>
              <div class="col-md-8 col-md-offset-2" style="text-align: center;">
                <div style="text-align: center;">Datos incorrectos. Haga <a href="descarga_archivo.php" style="color:Red;">click aquí</a> para intentar nuevamente.</div>
              </div>
              <?php
            }
            else
            {
              $consulta_archivos = "SELECT id, precios_m, precios_d, catalogo_m, catalogo_d FROM listados WHERE id=1";
              $resultado_archivos = mysql_query($consulta_archivos);
              $fila_archivos = mysql_fetch_array($resultado_archivos);

              $tipo_usuario = $fila_cliente['usuario'];

              if($tipo_usuario == "minorista")
              {
                $listado_precio = $fila_archivos['precios_m'];
                $catalogo = $fila_archivos['catalogo_m'];
              }
              else if($tipo_usuario == "distribuidor")
              {
                $listado_precio = $fila_archivos['precios_d'];
                $catalogo = $fila_archivos['catalogo_d'];
              }

              ?>
              <div class="col-md-8 col-md-offset-2" style="text-align: center;">
                <div style="text-align: center;">
                  Hola <?php echo $titulo; ?>,<br />
                  Podes descargar los archivos haciendo click en los siguientes botones:<br /><br />
                  <a class="btn_descarga" href="panel/archivos/<?php echo $listado_precio; ?>" style="color:#ffffff;">Lista de precios</a>
                  <br /><br />
                  <a class="btn_descarga" href="panel/archivos/<?php echo $catalogo; ?>" style="color:#ffffff;">Catálogo</a>
                </div>
              </div>
              <?php
            }
          }
          else 
          {
          ?>
          <div style="text-align: center;">Para poder descargar los archivos ingresa tu usuario y contraseña.</div>
          <br />
          <div class="col-md-4 col-md-offset-4" style="text-align: center;">
          <form action="descarga_archivo.php" method="post" onsubmit="return validacion_login()">
            <div class="form-group form-group-icon-left">
                <input class="form-control" placeholder="USUARIO" type="text" name="username" id="username_login" value="<?php echo $_POST['username']; ?>" />
            </div>
            <div class="form-group form-group-icon-left">
                <input class="form-control" placeholder="CONTRASEÑA" type="password" name="pass" id="pass_login" value="<?php echo $_POST['pass']; ?>" />
            </div>
            <input class="btn btn-primary" id="btn_ingresar" type="submit" name="submit2" value="INGRESAR" />
          </form>
          </div>
          <?php
        }
        ?>
    </div>
  </div>
  <div class="clear"></div><br /><br /><br />
  <?php include "footer.php" ?>