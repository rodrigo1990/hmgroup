<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

<style type="text/css">
.select2-chosen, .select2-choice > span:first-child, .select2-container .select2-choices .select2-search-field input
{
	padding: 0px 12px !important;
}
</style>


<link rel="stylesheet" media="screen" type="text/css" href="assets/stylesheets/jquery.alerts.css" />
<script type="text/javascript" src="assets/javascripts/jquery.alerts.js"></script>
<script type="text/javascript">
		function borrar_elemento(id)
		{
			(function($) 
			{
				jConfirm('Haz click en OK para borrarla.', 'Deseas borrar este pedido?', function(r) 
				{
					if(r == true)
					{
						$.getJSON("secciones/pedidos_borrar.php?elemento="+id, function(data){
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
		<h2>Pedidos</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado la categoría correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=nosotros_contenido">click aquí</a>.</div>
		        <?php
		    }
		    ?>
			<form id="form" action="?s=nosotros_contenido&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Listado de Pedidos:</h2>
					</header>
					<section class="panel">
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Acción</th>
											<th>N°</th>
											<th>Pedido</th>
											<th>Total</th>
											<th>Pago</th>
											<th>Forma de Pago</th>
											<th>Fecha</th>
											<th>Nombre</th>
											<th>Ciudad</th>
											<th>CC</th>
											<th>Dirección</th>
											<th>Teléfono</th>
											<th>Mail</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$consulta = "SELECT id, n_pedido, pedido, total, pago, f_pago, codigo_seguridad, fecha, nombre, ciudad, cc, direccion, telefono, mail, vive FROM pedidos ORDER BY fecha DESC";
											$resultado = mysql_query($consulta);
											$cant = mysql_num_rows($resultado);
										
											while($fila = mysql_fetch_array($resultado))
											{
												?>
												<tr class="gradeC" id="tr_id_<?php echo $fila['id']; ?>">
													<td>
														<a  href="?s=pedidos_editar&g=<?php echo($fila['id']); ?>"><img src="assets/images/edit.png" alt="" /></a>
														<img src="assets/images/cancel.png" title="Borrar" border="0" onclick="javascript:borrar_elemento('<?php echo $fila['id']; ?>');" style="cursor:pointer" />
														<a style="display: none;" href="?s=enviar_mail&g=<?php echo($fila['idagencia']); ?>&p=<?php echo($fila['id']); ?>"><img src="assets/images/mail.png" alt="" /></a>
													</td>
													<td><?php echo($fila['n_pedido']); ?></td>
													<td><?php echo($fila['pedido']); ?></td>
													<td><?php echo($fila['total']); ?></td>
													<td><?php echo($fila['pago']); ?></td>
													<td><?php echo($fila['f_pago']); ?></td>
													<td><?php echo($fila['fecha']); ?></td>
													<td><?php echo($fila['nombre']); ?></td>
													<td><?php echo($fila['ciudad']); ?></td>
													<td><?php echo($fila['cc']); ?></td>
													<td><?php echo($fila['direccion']); ?></td>
													<td><?php echo($fila['telefono']); ?></td>
													<td><?php echo($fila['mail']); ?></td>
												</tr>
												<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</section>
				</section>
			</form>
		</div>
	</div>
</section>


		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>