<section role="main" class="content-body">
	<header class="page-header">
		<h2>Home - Editar Slider</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g']; 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el slider correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=slider_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, linea1, linea2, link, foto FROM slider_home WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_slider_home.php');
			?>
			<form id="form" action="?s=slider_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Línea 1:</label>
							<div class="col-sm-10">
								<input type="text" name="linea1" class="form-control" value="<?php echo $linea1; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Línea 2:</label>
							<div class="col-sm-10">
								<input type="text" name="linea2" class="form-control" value="<?php echo $linea2; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Link:</label>
							<div class="col-sm-10">
								<input type="text" name="link" class="form-control" value="<?php echo $fila['link']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Imagen:</label>
							<div class="col-sm-10">
								<img src="slider_home/<?php echo($fila['foto']); ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        Tama&ntilde;o recomendado: <b>1915 pixeles x 520 pixeles</b>.
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
		            $linea1 = utf8_decode($_POST['linea1']);
                    $linea2 = utf8_decode($_POST['linea2']);
                    $link = $_POST['link'];

                    $num_random = rand(1, 3000);
                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
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
	                        $handle->image_x              = 1915;
	                        $handle->image_y              = 520;
	                        $handle->jpeg_quality         = 100;
	                        $handle->process('slider_home/');
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
					$query = "UPDATE slider_home SET linea1='$linea1', linea2='$linea2', link='$link', foto='$foto1_bd' WHERE id=$idproducto";
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