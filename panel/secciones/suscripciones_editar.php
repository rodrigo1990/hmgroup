<section role="main" class="content-body">
	<header class="page-header">
		<h2>Suscripciones - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g']; 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado la suscripción correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=suscripciones_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, titulo, precio, entregas, precio_entrega, titulo_costo, stock FROM suscripciones WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_suscripciones.php');
			?>
			<form id="form" action="?s=suscripciones_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" placeholder="Ej. Mensual" value="<?php echo $titulo; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Precio Total:</label>
							<div class="col-sm-10">
								<input type="text" name="precio" class="form-control" placeholder="Ej. 208800" value="<?php echo $fila['precio']; ?>" />
								<b>No incluir signos, sólo números.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Entregas:</label>
							<div class="col-sm-10">
								<input type="text" name="entregas" class="form-control" placeholder="Ej. 4 entregas" value="<?php echo $entregas; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Precio por entrega:</label>
							<div class="col-sm-10">
								<input type="text" name="precio_entrega" class="form-control" placeholder="Ej. 52200" value="<?php echo $fila['precio_entrega']; ?>" />
								<b>No incluir signos, sólo números.</b>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Título costo entrega:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo_costo_entrega" class="form-control" placeholder="Ej. Costo por entrega" value="<?php echo $titulo_costo; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Stock:</label>
							<div class="col-sm-10">
								<input type="text" name="stock" class="form-control" placeholder="Ej. 20" value="<?php echo $fila['stock']; ?>" />
								<b>No incluir signos, sólo números.</b>
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
                    $precio = $_POST['precio'];
                    $entregas = utf8_decode($_POST['entregas']);
                    $precio_entrega = $_POST['precio_entrega'];
                    $titulo_costo_entrega = utf8_decode($_POST['titulo_costo_entrega']);
                    $stock = $_POST['stock'];
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE suscripciones SET titulo='$titulo', precio='$precio', entregas='$entregas', precio_entrega='$precio_entrega', titulo_costo='$titulo_costo_entrega', stock='$stock' WHERE id=$idproducto";
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