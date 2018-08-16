<section role="main" class="content-body">
	<header class="page-header">
		<h2>Links Redes Sociales - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=redes_sociales">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, facebook, twitter, instagram, mail_admin FROM redes_sociales";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
			?>
			<form id="form" action="?s=redes_sociales&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Facebook:</label>
							<div class="col-sm-10">
								<input type="text" name="facebook" class="form-control" value="<?php echo $fila['facebook']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Twitter:</label>
							<div class="col-sm-10">
								<input type="text" name="twitter" class="form-control" value="<?php echo $fila['twitter']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Instagram:</label>
							<div class="col-sm-10">
								<input type="text" name="instagram" class="form-control" value="<?php echo $fila['instagram']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Mail Admin:</label>
							<div class="col-sm-10">
								<input type="text" name="mail_admin" class="form-control" value="<?php echo $fila['mail_admin']; ?>" />
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
		            $facebook = $_POST['facebook'];
		            $twitter = $_POST['twitter'];
		            $instagram = $_POST['instagram'];
		            $mail_admin = $_POST['mail_admin'];
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE redes_sociales SET facebook='$facebook', twitter='$twitter', instagram='$instagram', mail_admin='$mail_admin'";
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