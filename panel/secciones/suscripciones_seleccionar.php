<link rel="stylesheet" media="screen" type="text/css" href="assets/stylesheets/jquery.alerts.css" />
<script type="text/javascript" src="assets/javascripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="assets/javascripts/jquery.alerts.js"></script>
<script type="text/javascript">
		function borrar_elemento(id)
		{
			(function($) 
			{
				jConfirm('Haz click en OK para borrarla.', 'Deseas borrar esta categoría?', function(r) 
				{
					if(r == true)
					{
						$.getJSON("secciones/suscripciones_borrar.php?elemento="+id, function(data){
						$('#tr_id_'+id).remove();
						});
					}
					else
					{
						return false;
					}
				});
			})(jQuery);
		}
</script>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Suscripciones - Seleccionar</h2>
	</header>
					
	<section class="content-with-menu-has-toolbar media-gallery">
		<div class="mg-main">
			<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
				<header class="panel-heading">
					<h2 class="panel-title">Seleccione la suscripción que desea editar o eliminar:</h2>
				</header>

				<div class="panel-body">	
					<?php
						$consulta = "SELECT id, titulo, precio FROM suscripciones ORDER BY id ASC";
						$resultado = mysql_query($consulta);
						$cant = mysql_num_rows($resultado);
					
						while($fila = mysql_fetch_array($resultado))
						{
							$nombre = utf8_encode($fila['titulo']);
							?>
							<div id="tr_id_<?php echo $fila['id']; ?>">
								<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
									<div class="thumbnail text_center">
										<div style="position: absolute;">
											<a href="?s=suscripciones_editar&g=<?php echo $fila['id']; ?>" style="width: 30px; float: left;"><img src="assets/images/edit.png" title="Editar" border="0" style="cursor:pointer;" /></a>
											<img src="assets/images/cancel.png" title="Borrar" border="0" onclick="javascript:borrar_elemento('<?php echo $fila['id']; ?>');" style="cursor:pointer" />
										</div>
										<br />
										<a href="?s=suscripciones_editar&g=<?php echo $fila['id']; ?>"><h5 class="mg-title text-weight-semibold"><?php echo $nombre; ?></h5></a>
										<br />
										$<?php echo $fila['precio']; ?>
										<br /><br />
									</div>
								</div>
							</div>
							<?php
						}
					?>
					<div class="clear"></div>

				</div>
			</div>
		</div>
	</section>
</section>