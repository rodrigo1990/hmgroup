<section role="main" class="content-body">
	<header class="page-header">
		<h2>Marcas - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g']; 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contneido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=marcas_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, descripcion, foto FROM marcas WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_productos.php');

		        $foto = strtolower ($fila['foto']);
			?>
			<form id="form" action="?s=marcas_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
                            <label class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" rows="10" class="form-control"><?php echo $descripcion; ?></textarea>
                            </div>
                        </div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Imagen:</label>
							<div class="col-sm-10">
								<img src="marcas/<?php echo $foto; ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        Tama&ntilde;o recomendado: <b>518 pixeles x 286 pixeles</b>.
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
	                        $handle->image_x              = 518;
	                        $handle->image_y              = 286;
	                        $handle->jpeg_quality         = 90;
	                        $handle->process('marcas/');

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
					$query = "UPDATE marcas SET descripcion='$descripcion', foto='$foto1_bd' WHERE id=$idproducto";
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