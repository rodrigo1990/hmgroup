<section role="main" class="content-body">
	<header class="page-header">
		<h2>Categorías - Agregar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<form id="form" action="?s=categorias_agregar" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Complete los campos para agregar la categoría:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título: <span class="required">*</span></label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" placeholder="Ej. Bajos" required/>
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
    			if($_POST['submit'] && $_POST['titulo'])
    			{
                    $titulo = utf8_decode($_POST['titulo']);
    	
    				$query = "INSERT INTO `categorias` VALUES (null,'$titulo')";
    				mysql_query($query);
    				mysql_close();
    				?>
    				<div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha ingresado la categor&iacute;a correctamente.</div>
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