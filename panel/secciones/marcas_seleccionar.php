<?php
	$idproyecto = $_GET['galeria']; 
?>
<link rel="stylesheet" media="screen" type="text/css" href="assets/stylesheets/jquery.alerts.css" />
<script type="text/javascript" src="assets/javascripts/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="assets/javascripts/jquery.alerts.js"></script>
<script type="text/javascript">
		function borrar_elemento(id)
		{
			(function($) 
			{
				jConfirm('Haz click en OK para borrarla.', 'Deseas borrar este contenido?', function(r) 
				{
					if(r == true)
					{
						$.getJSON("secciones/marcas_borrar.php?elemento="+id, function(data){
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

<style>
#contentLeft li {
	list-style: none;
	padding: 10px;
	color:#000000;
	background: #ffffff;
	display: inline-block;
	width: 260px;
	margin: 0px 10px 10px 0px;
	text-align: left;
	vertical-align: top;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){ 
							   
		$(function() {
			$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
				var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
				$.post("updateDB_marcas.php", order, function(theResponse){
					$("#contentRight").html(theResponse);
				}); 															 
			}								  
			});
		});

	});	
</script>

<section role="main" class="content-body">
	<header class="page-header">
		<h2>Marcas - Editar/Eliminar</h2>
	</header>
					
	<section class="content-with-menu-has-toolbar media-gallery">
		<div class="mg-main">
			<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
				<div id="contentLeft">
		        	<ul>
						<?php
						$query  = "SELECT id, descripcion, foto, recordListingID FROM marcas ORDER BY recordListingID ASC";
						$result = mysql_query($query);
						
						while($fila = mysql_fetch_array($result, MYSQL_ASSOC))
						{
							$foto = strtolower ($fila['foto']);
							?>
							<li id="recordsArray_<?php echo $fila['id']; ?>">
								<div id="tr_id_<?php echo $fila['id']; ?>">
									<div style="position: absolute; margin-left: 5px;">
										<a href="?s=marcas_editar&g=<?php echo $fila['id']; ?>"><img src="assets/images/edit.png" title="Editar" border="0" style="cursor:pointer;" /></a>
										<img src="assets/images/cancel.png" title="Borrar" border="0" onclick="javascript:borrar_elemento('<?php echo $fila['id']; ?>');" style="cursor:pointer" />
									</div>
									<img src="marcas/<?php echo $foto; ?>" style="width: 240px;" /><br />
								</div>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
</section>