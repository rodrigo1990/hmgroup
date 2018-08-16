<section role="main" class="content-body">
	<header class="page-header">
		<h2>Home - Editar Bloques Inferiores</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=home_bloques_inferiores">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, foto1, video1, foto2, video2, foto3, video3 FROM bloques_inferiores";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        $foto1 = strtolower ($fila['foto1']);
		        $foto2 = strtolower ($fila['foto2']);
		        $foto3 = strtolower ($fila['foto3']);
			?>
			<form id="form" action="?s=home_bloques_inferiores&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Foto Bloque 1:</label>
							<div class="col-sm-10">
								<img src="bloques_inferiores/<?php echo $foto1; ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        Tama&ntilde;o recomendado: <b>360px x 360px</b>.
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Video YOUTUBE Bloque 1:</label>
							<div class="col-sm-10">
<input type="text" name="video1" class="form-control" value="<?php echo $fila['video1']; ?>" />
								Ingresar únicamente el ID del video de youtube, es lo que se encuentra después de la v=<br />
								Ejemplo: https://www.youtube.com/watch?v=<a style="color: red; font-weight: bold;">DVg2EJvvlF8</a><br />
								<i>* Si se especifica video para el bloque la imagen no se mostrará.</i>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Foto Bloque 2:</label>
							<div class="col-sm-10">
								<img src="bloques_inferiores/<?php echo $foto2; ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto2" class="large"  />
		                        Tama&ntilde;o recomendado: <b>360px x 360px</b>.
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Video YOUTUBE Bloque 2:</label>
							<div class="col-sm-10">
								<input type="text" name="video2" class="form-control" value="<?php echo $fila['video2']; ?>" />
								Ingresar únicamente el ID del video de youtube, es lo que se encuentra después de la v=<br />
								Ejemplo: https://www.youtube.com/watch?v=<a style="color: red; font-weight: bold;">DVg2EJvvlF8</a><br />
								<i>* Si se especifica video para el bloque la imagen no se mostrará.</i>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Foto Bloque 3:</label>
							<div class="col-sm-10">
								<img src="bloques_inferiores/<?php echo $foto3; ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto3" class="large"  />
		                        Tama&ntilde;o recomendado: <b>360px x 360px</b>.
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Video YOUTUBE Bloque 3:</label>
							<div class="col-sm-10">
								<input type="text" name="video3" class="form-control" value="<?php echo $fila['video3']; ?>" />
								Ingresar únicamente el ID del video de youtube, es lo que se encuentra después de la v=<br />
								Ejemplo: https://www.youtube.com/watch?v=<a style="color: red; font-weight: bold;">DVg2EJvvlF8</a><br />
								<i>* Si se especifica video para el bloque la imagen no se mostrará.</i>
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
					$video1 = utf8_decode($_POST['video1']);
		            $video2 = utf8_decode($_POST['video2']);
		            $video3 = utf8_decode($_POST['video3']);

		            $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto1']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto1']['name']);
	                        $extension = $extension['extension'];
	                        $foto1_bd = date("H_i") . $num_random . 'bloque1.' . $extension;
	                        $foto1 = date("H_i") . $num_random . 'bloque1';
	                        $handle->file_new_name_body   = $foto1;
	                        $handle->image_resize         = true;
	                        $handle->image_ratio_crop     = true;
	                        $handle->image_x              = 360;
	                        $handle->image_y              = 360;
	                        $handle->jpeg_quality         = 90;
	                        $handle->process('bloques_inferiores/');

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

		            $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto2']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto2']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto2']['name']);
	                        $extension = $extension['extension'];
	                        $foto2_bd = date("H_i") . $num_random . 'bloque2.' . $extension;
	                        $foto2 = date("H_i") . $num_random . 'bloque2';
	                        $handle->file_new_name_body   = $foto2;
	                        $handle->image_resize         = true;
	                        $handle->image_ratio_crop     = true;
	                        $handle->image_x              = 360;
	                        $handle->image_y              = 360;
	                        $handle->jpeg_quality         = 90;
	                        $handle->process('bloques_inferiores/');

		                    if ($handle->processed) {
		                        $handle->clean();
		                    } else {
		                        echo 'error : ' . $handle->error;
		                    }
		                }
		            }
		            else
		            {
		                $foto2_bd = $fila['foto2'];
		            }

		            $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto3']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto3']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto3']['name']);
	                        $extension = $extension['extension'];
	                        $foto3_bd = date("H_i") . $num_random . 'bloque2.' . $extension;
	                        $foto3 = date("H_i") . $num_random . 'bloque2';
	                        $handle->file_new_name_body   = $foto3;
	                        $handle->image_resize         = true;
	                        $handle->image_ratio_crop     = true;
	                        $handle->image_x              = 360;
	                        $handle->image_y              = 360;
	                        $handle->jpeg_quality         = 90;
	                        $handle->process('bloques_inferiores/');

		                    if ($handle->processed) {
		                        $handle->clean();
		                    } else {
		                        echo 'error : ' . $handle->error;
		                    }
		                }
		            }
		            else
		            {
		                $foto3_bd = $fila['foto3'];
		            }
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE bloques_inferiores SET foto1='$foto1_bd', video1='$video1', foto2='$foto2_bd', video2='$video2', foto3='$foto3_bd', video3='$video3'";
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