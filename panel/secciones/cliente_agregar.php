<section role="main" class="content-body">
	<header class="page-header">
		<h2>Clientes - Agregar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<form id="form" action="?s=cliente_agregar" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Complete los campos para agregar el cliente:</h2>
					</header>
					<div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tipo de usuario:</label>
                            <div class="col-sm-10">
                                <select name="usuario" class="form-control" > 
                                    <option value="distribuidor">Distribuidor</option>
                                    <option value="minorista">Mayorista</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" name="nombre" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Código<br />(nombre de usuario): </label>
                            <div class="col-sm-10">
                                <input type="text" name="codigo" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="text" name="contrasenia" class="form-control" />
                            </div>
                        </div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-sm-10 col-sm-offset-2">
								<input type="submit" name="submit" class="btn btn-primary" value="Agregar" />
							</div>
						</div>
					</footer>
				</section>
			</form>
			<?php
    			include("conexion.php");
    			if($_POST['submit'])
    			{
                    $usuario = $_POST['usuario'];
                    $nombre = utf8_decode($_POST['nombre']);
                    $codigo = $_POST['codigo'];
                    $contrasenia = $_POST['contrasenia'];
    	
    				$query = "INSERT INTO `clientes` VALUES (null,'$usuario','$nombre','$codigo','$contrasenia')";
    				mysql_query($query);
    				mysql_close();
    				?>
    				<div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha ingresado el contenido correctamente.</div>
    				<?php
    			}
    			else if ($_POST['submit'])
    			{
    				echo("Faltan ingresar datos.");
    			}
    		?>	
		</div>
	</div>
</section>