<section role="main" class="content-body">
	<header class="page-header">
		<h2>Home - Editar Bloque madera</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=home_bloque">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, titulo1, titulo2, foto1, titulo3, titulo4, foto2 FROM home_bloque";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_home_bloque.php');
			?>
			<form id="form" action="?s=home_bloque&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque izquierda<br />Título línea 1:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo1" class="form-control" value="<?php echo $titulo1; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque izquierda<br />Título línea 2:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo2" class="form-control" value="<?php echo $titulo2; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque izquierda<br />Foto:</label>
							<div class="col-sm-10">
								<img src="home_bloque/<?php echo($fila['foto1']); ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto1" class="large"  />
		                        <b>El tamaño se ajustar&aacute; a 570px de ancho x 196px de alto.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque derecha<br />Título línea 1:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo3" class="form-control" value="<?php echo $titulo3; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque derecha<br />Título línea 2:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo4" class="form-control" value="<?php echo $titulo4; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Bloque derecha<br />Foto:</label>
							<div class="col-sm-10">
								<img src="home_bloque/<?php echo($fila['foto2']); ?>" alt="" style="width: 160px;" /><br /><br />
		                        <input type="file" name="foto2" class="large"  />
		                        <b>El tamaño se ajustar&aacute; a 570px de ancho x 196px de alto.</b>
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
		            $titulo2 = utf8_decode($_POST['titulo2']);
		            $titulo3 = utf8_decode($_POST['titulo3']);
		            $titulo4 = utf8_decode($_POST['titulo4']);

                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto1']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto1']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto1']['name']);
		                    $extension = $extension['extension'];
		                    $foto1_bd = date("H_i_s") . 'nosotros1.' . $extension;
		                    $foto1 = date("H_i_s") . 'nosotros1';
		                    $handle->file_new_name_body   = $foto1;
		                    $handle->image_resize         = true;
		                    $handle->image_ratio_crop     = true;
		                    $handle->image_x              = 570;
		                    $handle->image_y              = 196;
		                    $handle->jpeg_quality         = 100;
		                    $handle->process('home_bloque/');
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

                    @require_once("secciones/class.upload.php");
		            if(is_uploaded_file($_FILES['foto2']['tmp_name']))
		            {
		                $handle = new upload($_FILES['foto2']);
		                if ($handle->uploaded) 
		                {
		                    $extension = pathinfo($_FILES['foto2']['name']);
		                    $extension = $extension['extension'];
		                    $foto2_bd = date("H_i_s") . 'nosotros2.' . $extension;
		                    $foto2 = date("H_i_s") . 'nosotros2';
		                    $handle->file_new_name_body   = $foto2;
		                    $handle->image_resize         = true;
		                    $handle->image_ratio_crop     = true;
		                    $handle->image_x              = 570;
		                    $handle->image_y              = 196;
		                    $handle->jpeg_quality         = 100;
		                    $handle->process('home_bloque/');
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
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE home_bloque SET titulo1='$titulo1', titulo2='$titulo2', foto1='$foto1_bd', titulo3='$titulo3', titulo4='$titulo4', foto2='$foto2_bd'";
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