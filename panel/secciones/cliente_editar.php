<section role="main" class="content-body">
	<header class="page-header">
		<h2>Clientes - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g']; 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el cliente correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=cliente_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, usuario, nombre, codigo, contrasenia FROM clientes WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        $titulo_categoria = utf8_encode($fila['nombre']);
										        $titulo_categoria = html_entity_decode($titulo_categoria);
										        $titulo_categoria = str_replace("Ã¡", "á",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã©", "é",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã*", "í",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã³", "ó",$titulo_categoria);
										        $titulo_categoria = str_replace("Ãº", "ú",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã", "Á",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã‰", "É",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã", "Í",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã“", "Ó",$titulo_categoria);
										        $titulo_categoria = str_replace("Ãš", "Ú",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã±", "ñ",$titulo_categoria);
										        $titulo_categoria = str_replace("Ã‘", "Ñ",$titulo_categoria);
										        $titulo_categoria = str_replace("Â¿", "¿",$titulo_categoria);
										        $titulo_categoria = str_replace("Â«", "'",$titulo_categoria);
										        $titulo_categoria = str_replace("Â»", "'",$titulo_categoria);
										        $titulo_categoria = str_replace("Â¡", "¡",$titulo_categoria);
			?>
			<form id="form" action="?s=cliente_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
                            <label class="col-sm-2 control-label">Tipo de usuario:</label>
                            <div class="col-sm-10">
                                <select name="usuario" class="form-control" > 
                                    <option value="distribuidor" <?php if($fila['usuario'] == "distribuidor") { echo "selected"; } ?>>Distribuidor</option>
                                    <option value="minorista" <?php if($fila['usuario'] == "minorista") { echo "selected"; } ?>>Mayorista</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
							<label class="col-sm-2 control-label">Nombre:</label>
							<div class="col-sm-10">
								<input type="text" name="nombre" class="form-control" value="<?php echo $titulo_categoria; ?>" />
							</div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Código<br />(nombre de usuario): </label>
                            <div class="col-sm-10">
                                <input type="text" name="codigo" class="form-control" value="<?php echo $fila['codigo']; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="text" name="contrasenia" class="form-control" value="<?php echo $fila['contrasenia']; ?>" />
                            </div>
                        </div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-sm-10 col-sm-offset-2">
								<input type="submit" name="submit" class="btn btn-primary" value="Editar" />
							</div>
						</div>
					</footer>
				</section>
			</form>
			<?php
				if($_POST['submit'])
				{
		            $usuario = $_POST['usuario'];
                    $nombre = utf8_decode($_POST['nombre']);
                    $codigo = $_POST['codigo'];
                    $contrasenia = $_POST['contrasenia'];
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE clientes SET usuario='$usuario', nombre='$nombre', codigo='$codigo', contrasenia='$contrasenia' WHERE id=$idproducto";
					mysql_query($query);
					mysql_close();
				}
				else if ($_POST['submit'])
				{
					echo("Faltan ingresar datos.");
				}
			?>
		</div>
	</div>
</section>