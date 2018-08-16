<section role="main" class="content-body">
	<header class="page-header">
		<h2>Productos - Agregar Producto</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<form id="form" action="?s=productos_agregar" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Complete los campos para agregar el slider:</h2>
					</header>
					<div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Destacado: <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="destacado" required class="form-control" > 
                                    <option value="no">No</option>
                                    <option value="si">Si</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Categoría: <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="categoria" id="categoria" required class="form-control" > 
                                    <?php
                                        $consulta = "SELECT id, titulo FROM categorias ORDER BY titulo ASC";
                                        $resultado = mysql_query($consulta);
                                        $cant = mysql_num_rows($resultado);
                                    
                                        while($fila = mysql_fetch_array($resultado))
                                        {
                                            $titulo = utf8_encode($fila['titulo']);
                                            ?>
                                            <option value="<?php echo $fila['id']; ?>"><?php echo $titulo; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Subcategoría: <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="subcategoria" id="subcategoria" required class="form-control" > 
                                    <?php
                                        $consulta = "SELECT id, titulo FROM subcategorias ORDER BY titulo ASC";
                                        $resultado = mysql_query($consulta);
                                        $cant = mysql_num_rows($resultado);
                                    
                                        while($fila = mysql_fetch_array($resultado))
                                        {
                                            $titulo = utf8_encode($fila['titulo']);
                                            ?>
                                            <option value="<?php echo $fila['id']; ?>"><?php echo $titulo; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Título:</label>
                            <div class="col-sm-10">
                                <input type="text" name="titulo" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Imagen: <span class="required">*</span></label>
							<div class="col-sm-10">
								<input type="file" name="foto1" class="large" />
                            	Tama&ntilde;o recomendado: <b>900 pixeles x 590 pixeles</b>.
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
                    $destacado = $_POST['destacado'];
                    $categoria = $_POST['categoria'];
                    $subcategoria = $_POST['subcategoria'];
                    $titulo = utf8_decode($_POST['titulo']);
                    $descripcion = utf8_decode($_POST['descripcion']);

                    $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
                    $handle = new upload($_FILES['foto1']);
                    if ($handle->uploaded) 
                    {
                        $extension = pathinfo($_FILES['foto1']['name']);
                        $extension = $extension['extension'];
                        $foto1_bd = date("H_i") . $num_random . 'producto.' . $extension;
                        $foto1 = date("H_i") . $num_random . 'producto';
                        $handle->file_new_name_body   = $foto1;
                        $handle->image_resize         = true;
                        $handle->image_ratio_crop     = true;
                        $handle->image_x              = 195;
                        $handle->image_y              = 130;
                        $handle->jpeg_quality         = 90;
                        $handle->process('productos/principal/');

                        $handle->file_new_name_body   = $foto1;
                        $handle->image_resize         = true;
                        $handle->image_ratio_crop     = true;
                        $handle->image_x              = 900;
                        $handle->image_y              = 590;
                        $handle->jpeg_quality         = 90;
                        $handle->process('productos/grande/');

                        if ($handle->processed) {
                            $handle->clean();
                        } else {
                            echo 'error : ' . $handle->error;
                        }
                    }
    	
    				$query = "INSERT INTO `productos` VALUES (null,'$categoria','$subcategoria','$titulo','$descripcion','$foto1_bd','$destacado','')";
    				mysql_query($query);
    				mysql_close();
    				?>
    				<div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha ingresado el producto correctamente.</div>
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