<section role="main" class="content-body">
	<header class="page-header">
		<h2>Suscripciones - Editar Contenido</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado la categoría correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=suscripciones_contenido">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, titulo1, descripcion1, foto1, titulo2, descripcion2, descripcion3 FROM suscripciones_contenido";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_suscripciones_contenido.php');
			?>
			<form id="form" action="?s=suscripciones_contenido&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título 1:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo1" class="form-control" value="<?php echo $titulo1; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Descripción 1:</label>
							<div class="col-sm-10">
								<textarea name="descripcion1" rows="12" class="form-control"><?php echo $descripcion1; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Foto 1:</label>
							<div class="col-sm-10">
								<img src="suscripciones/<?php echo($fila['foto1']); ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        <b>El tamaño se ajustar&aacute; a 400px de ancho x 300px de alto.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Título 2:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo2" class="form-control" value="<?php echo $titulo2; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Descripción 2:</label>
							<div class="col-sm-10">
								<textarea name="descripcion2" rows="12" class="form-control"><?php echo $descripcion2; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Descripción 3:</label>
							<div class="col-sm-10">
								<textarea name="descripcion3" rows="12" class="form-control"><?php echo $descripcion3; ?></textarea>
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
		            $titulo1 = utf8_decode($_POST['titulo1']);
                    $descripcion1 = utf8_decode($_POST['descripcion1']);

		            $titulo2 = utf8_decode($_POST['titulo2']);
                    $descripcion2 = utf8_decode($_POST['descripcion2']);
                    $descripcion3 = utf8_decode($_POST['descripcion3']);

                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto1']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto1']['name']);
		                    $extension = $extension['extension'];
		                    $foto1_bd = date("H_i_s") . 'suscripcion1.' . $extension;
		                    $foto1 = date("H_i_s") . 'suscripcion1';
		                    $handle->file_new_name_body   = $foto1;
		                    $handle->image_resize         = true;
		                    $handle->image_ratio_crop     = true;
		                    $handle->image_x              = 400;
		                    $handle->image_y              = 300;
		                    $handle->jpeg_quality         = 100;
		                    $handle->process('suscripciones/');
		                    if ($handle->processed) {
		                        $handle->clean();
		                    } else {
		                        echo 'error : ' . $handle->error;
		                    }
		                }
		            }
		            else
		            {
		                $foto1_bd = $fila['foto1'];
		            }
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE suscripciones_contenido SET titulo1='$titulo1', descripcion1='$descripcion1', foto1='$foto1_bd', titulo2='$titulo2', descripcion2='$descripcion2', descripcion3='$descripcion3'";
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