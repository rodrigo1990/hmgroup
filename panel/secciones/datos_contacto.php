<section role="main" class="content-body">
	<header class="page-header">
		<h2>Contacto - Editar Contenido</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=datos_contacto">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, titulo, descripcion, titulo2, datos_contacto, mapa, mail_admin, logo FROM contacto_contenido";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_contacto.php');
			?>
			<form id="form" action="?s=datos_contacto&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Descripción:</label>
							<div class="col-sm-10">
								<textarea name="descripcion" rows="12" class="form-control"><?php echo $descripcion; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Título 2:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo2" class="form-control" value="<?php echo $titulo2; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Datos de contacto:</label>
							<div class="col-sm-10">
								<textarea name="datos_contacto" rows="12" class="form-control"><?php echo $datos_contacto; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mapa:</label>
							<div class="col-sm-10">
								<textarea name="mapa" rows="12" class="form-control"><?php echo $fila['mapa']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mail admin:</label>
							<div class="col-sm-10">
								<input type="text" name="mail_admin" class="form-control" value="<?php echo $fila['mail_admin']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Logo:</label>
							<div class="col-sm-10">
								<img src="logo/<?php echo($fila['logo']); ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        <b>El tamaño se ajustar&aacute; a 250px de ancho x 120px de alto.</b>
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
		            $titulo = utf8_decode($_POST['titulo']);
                    $descripcion = utf8_decode($_POST['descripcion']);
		            $titulo2 = utf8_decode($_POST['titulo2']);
                    $datos_contacto = utf8_decode($_POST['datos_contacto']);
                    $mapa = $_POST['mapa'];
                    $mail_admin = $_POST['mail_admin'];

                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto1']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto1']['name']);
		                    $extension = $extension['extension'];
		                    $foto1_bd = date("H_i_s") . 'logo.' . $extension;
		                    $foto1 = date("H_i_s") . 'logo';
		                    $handle->file_new_name_body   = $foto1;
		                    $handle->image_resize         = true;
		                    $handle->image_ratio_crop     = true;
		                    $handle->image_x              = 250;
		                    $handle->image_y              = 120;
		                    $handle->jpeg_quality         = 100;
		                    $handle->process('logo/');
		                    if ($handle->processed) {
		                        $handle->clean();
		                    } else {
		                        echo 'error : ' . $handle->error;
		                    }
		                }
		            }
		            else
		            {
		                $foto1_bd = $fila['logo'];
		            }
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE contacto_contenido SET titulo='$titulo', descripcion='$descripcion', titulo2='$titulo2', datos_contacto='$datos_contacto', mapa='$mapa', mail_admin='$mail_admin', logo='$foto1_bd'";
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