<section role="main" class="content-body">
	<header class="page-header">
		<h2>Productos - Editar Producto</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g']; 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el producto correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=productos_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, categoria, subcategoria, titulo, descripcion, foto, destacado FROM productos WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_productos.php');

		        $foto = strtolower ($fila['foto']);
			?>
			<form id="form" action="?s=productos_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
                            <label class="col-sm-2 control-label">Destacado:</label>
                            <div class="col-sm-10">
                                <select name="destacado" required class="form-control" > 
                                    <option value="no" <?php if($fila['destacado'] == "no") { echo "selected"; } ?>>No</option>
                                    <option value="si" <?php if($fila['destacado'] == "si") { echo "selected"; } ?>>Si</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Categoría: <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <select name="categoria" id="categoria" required class="form-control" > 
                                    <?php
                                        $consulta_cat = "SELECT id, titulo FROM categorias ORDER BY titulo ASC";
                                        $resultado_cat = mysql_query($consulta_cat);
                                    
                                        while($fila_cat = mysql_fetch_array($resultado_cat))
                                        {
                                            $titulo_cat = utf8_encode($fila_cat['titulo']);
                                            ?>
                                            <option value="<?php echo $fila_cat['id']; ?>" <?php if($fila_cat['id'] == $fila['categoria']) { echo "selected"; } ?>><?php echo $titulo_cat; ?></option>
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
                                        $consulta_sub = "SELECT id, titulo FROM subcategorias ORDER BY titulo ASC";
                                        $resultado_sub = mysql_query($consulta_sub);
                                    
                                        while($fila_sub = mysql_fetch_array($resultado_sub))
                                        {
                                            $titulo_sub = utf8_encode($fila_sub['titulo']);
                                            ?>
                                            <option value="<?php echo $fila_sub['id']; ?>" <?php if($fila_sub['id'] == $fila['subcategoria']) { echo "selected"; } ?>><?php echo $titulo_sub; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
							<label class="col-sm-2 control-label">Título:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" />
							</div>
						</div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" rows="10" class="form-control"><?php echo $descripcion; ?></textarea>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Imagen:</label>
							<div class="col-sm-10">
								<img src="productos/principal/<?php echo $foto; ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        Tama&ntilde;o recomendado: <b>900 pixeles x 590 pixeles</b>.
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
		            $destacado = $_POST['destacado'];
		            $categoria = $_POST['categoria'];
                    $subcategoria = $_POST['subcategoria'];
                    $titulo = utf8_decode($_POST['titulo']);
                    $descripcion = utf8_decode($_POST['descripcion']);

                    $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
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
		            }
		            else
		            {
		                $foto1_bd = $fila['foto'];
		            }
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE productos SET destacado='$destacado', categoria='$categoria', subcategoria='$subcategoria', titulo='$titulo', descripcion='$descripcion', foto='$foto1_bd' WHERE id=$idproducto";
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