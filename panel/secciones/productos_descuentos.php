<section role="main" class="content-body">
	<header class="page-header">
		<h2>Descuento en total de la compra</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=productos_descuentos">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, descuento FROM productos_descuentos";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
			?>
			<form id="form" action="?s=productos_descuentos&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Descuento:</label>
							<div class="col-sm-10">
								<input type="text" name="descuento" class="form-control" value="<?php echo($fila['descuento']); ?>" />
								Insertar sólo el número del %.
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
		            $descuento = $_POST['descuento'];
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE productos_descuentos SET descuento='$descuento'";
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