<section role="main" class="content-body">
	<header class="page-header">
		<h2>Subcategorías - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php
			$idproducto = $_GET['g'];
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado la subcategoría correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=subcategorias_editar&g=<?php echo $idproducto; ?>">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, categoria, titulo FROM subcategorias WHERE id = $idproducto";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
				
		        include('includes/acentos_categorias.php');
			?>
			<form id="form" action="?s=subcategorias_editar&g=<?php echo $fila['id']; ?>&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Categoría: <span class="required">*</span></label>
							<div class="col-sm-10">
								<select name="categoria" id="categoria" required class="form-control" > 
                                    <?php
                                        $consulta_cat = "SELECT id, titulo FROM categorias ORDER BY titulo ASC";
                                        $resultado_cat = mysql_query($consulta_cat);
                                    
                                        while($fila_cat = mysql_fetch_array($resultado_cat))
                                        {
                                            $titulo_cat = utf8_encode($fila_cat['titulo']);
                                            ?>
                                            <option value="<?php echo $fila_cat['id']; ?>" <?php if($fila_cat['id'] == $fila['categoria']) { echo "selected"; } ?>><?php echo $titulo_cat; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Título:</label>
							<div class="col-sm-10">
								<input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" />
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
					$categoria = $_POST['categoria'];
		            $titulo = utf8_decode($_POST['titulo']);
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE subcategorias SET categoria='$categoria', titulo='$titulo' WHERE id=$idproducto";
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