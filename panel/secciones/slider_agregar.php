<section role="main" class="content-body">
	<header class="page-header">
		<h2>Home - Agregar Slider</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<form id="form" action="?s=slider_agregar" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Complete los campos para agregar el slider:</h2>
					</header>
					<div class="panel-body">
                        <div class="form-group">
							<label class="col-sm-2 control-label">Imagen: <span class="required">*</span></label>
							<div class="col-sm-10">
								<input type="file" name="foto1" class="large" />
                            	Tama&ntilde;o recomendado: <b>800 pixeles x 455 pixeles</b>.
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
                    $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
                    $handle = new upload($_FILES['foto1']);
                    if ($handle->uploaded) 
                    {
                        $extension = pathinfo($_FILES['foto1']['name']);
                        $extension = $extension['extension'];
                        $foto1_bd = date("H_i") . $num_random . 'slider.' . $extension;
                        $foto1 = date("H_i") . $num_random . 'slider';
                        $handle->file_new_name_body   = $foto1;
                        $handle->image_resize         = true;
                        $handle->image_ratio_crop     = true;
                        $handle->image_x              = 800;
                        $handle->image_y              = 455;
                        $handle->jpeg_quality         = 90;
                        $handle->process('slider_home/');
                        if ($handle->processed) {
                            $handle->clean();
                        } else {
                            echo 'error : ' . $handle->error;
                        }
                    }
    	
    				$query = "INSERT INTO `slider_home` VALUES (null,'$foto1_bd','')";
    				mysql_query($query);
    				mysql_close();
    				?>
    				<div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha ingresado el slider correctamente.</div>
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