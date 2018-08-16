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
				jConfirm('Haz click en OK para borrarla.', 'Deseas borrar esta categoría?', function(r) 
				{
					if(r == true)
					{
						$.getJSON("secciones/categorias_borrar.php?elemento="+id, function(data){
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
		<h2>Categorías - Seleccionar</h2>
	</header>
					
	<section class="content-with-menu-has-toolbar media-gallery">
		<div class="mg-main">
			<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
				<header class="panel-heading">
					<h2 class="panel-title">Seleccione la categoría que desea editar o eliminar:</h2>
				</header>

				<div class="panel-body">	
					<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Acción</th>
											<th>Categoría</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$consulta = "SELECT id, titulo FROM categorias ORDER BY titulo ASC";
											$resultado = mysql_query($consulta);
											$cant = mysql_num_rows($resultado);
										
											while($fila = mysql_fetch_array($resultado))
											{
												include('includes/acentos_categorias.php');
												?>
												<tr class="gradeC" id="tr_id_<?php echo $fila['id']; ?>">
													<td>
														<a  href="?s=categorias_editar&g=<?php echo($fila['id']); ?>"><img src="assets/images/edit.png" alt="" /></a>
														<img src="assets/images/cancel.png" title="Borrar" border="0" onclick="javascript:borrar_elemento('<?php echo $fila['id']; ?>');" style="cursor:pointer" />
													</td>
													<td><?php echo $titulo; ?></td>
												</tr>
												<?php
											}
										?>
									</tbody>
								</table>
					<div class="clear"></div>

				</div>
			</div>
		</div>
	</section>
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