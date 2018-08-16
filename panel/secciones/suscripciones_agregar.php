<section role="main" class="content-body">
	<header class="page-header">
		<h2>Suscripciones - Agregar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<form id="form" action="?s=suscripciones_agregar" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Complete los campos para agregar la suscripción:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título: <span class="required">*</span></label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" placeholder="Ej. Mensual" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Precio Total:</label>
							<div class="col-sm-10">
								<input type="text" name="precio" class="form-control" placeholder="Ej. 208800"/>
								<b>No incluir signos, sólo números.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Entregas:</label>
							<div class="col-sm-10">
								<input type="text" name="entregas" class="form-control" placeholder="Ej. 4 entregas"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Precio por entrega:</label>
							<div class="col-sm-10">
								<input type="text" name="precio_entrega" class="form-control" placeholder="Ej. 52200"/>
								<b>No incluir signos, sólo números.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Título costo entrega:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo_costo_entrega" class="form-control" placeholder="Ej. Costo por entrega"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Stock:</label>
							<div class="col-sm-10">
								<input type="text" name="stock" class="form-control" placeholder="Ej. 20"/>
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
                    $precio = $_POST['precio'];
                    $entregas = utf8_decode($_POST['entregas']);
                    $precio_entrega = $_POST['precio_entrega'];
                    $titulo_costo_entrega = utf8_decode($_POST['titulo_costo_entrega']);
                    $stock = $_POST['stock'];
    	
    				$query = "INSERT INTO `suscripciones` VALUES (null,'$titulo','$precio','$entregas','$precio_entrega','$titulo_costo_entrega','$stock')";
    				mysql_query($query);
    				mysql_close();
    				?>
    				<div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha ingresado la suscripci&oacute;n correctamente.</div>
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