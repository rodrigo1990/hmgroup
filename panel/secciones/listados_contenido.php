<section role="main" class="content-body">
	<header class="page-header">
		<h2>Listados - Editar</h2>
	</header>
					
	<div class="row">
		<div class="col-md-12">
			<?php 
		    $alert = $_GET['alert']; 
		    if($alert == "si")
		    {
		        ?>
		        <div style="background:#02600F; color: #ffffff; text-align: center; font-size: 13px; padding: 4px 0px;">Se ha editado el contenido correctamente. Refesque la p&aacute;gina para ver los cambios o haga <a href="?s=listados_contenido">click aquí</a>.</div>
		        <?php
		    }
		    ?>
		    <?php	
				$consulta = "SELECT id, precios_m, precios_d, catalogo_m, catalogo_d FROM listados WHERE id=1";
				$resultado = mysql_query($consulta);
				$fila = mysql_fetch_array($resultado);
			?>
			<form id="form" action="?s=listados_contenido&alert=si" method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Edite los campos que desee:</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Lista de Precios<br /><b>MAYORISTA</b>:</label>
							<div class="col-sm-10">
								<input id="archivo1" name="archivo1" type="file" class="form-control" />
		                        Formatos de archivos permitidos: pdf - txt - ppt - pptx - xlsx - xls - doc - docx - jpg - rar - zip - png<br />
		                        <b>Archivo enviado:</b> <?php echo($fila['precios_m']); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Lista de Precios<br /><b>DISTRIBUIDOR</b>:</label>
							<div class="col-sm-10">
								<input id="archivo1" name="archivo2" type="file" class="form-control" />
		                        Formatos de archivos permitidos: pdf - txt - ppt - pptx - xlsx - xls - doc - docx - jpg - rar - zip - png<br />
		                        <b>Archivo enviado:</b> <?php echo($fila['precios_d']); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Catálogo<br /><b>MAYORISTA</b>:</label>
							<div class="col-sm-10">
								<input id="archivo1" name="archivo3" type="file" class="form-control" />
		                        Formatos de archivos permitidos: pdf - txt - ppt - pptx - xlsx - xls - doc - docx - jpg - rar - zip - png<br />
		                        <b>Archivo enviado:</b> <?php echo($fila['catalogo_m']); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Catálogo<br /><b>DISTRIBUIDOR</b>:</label>
							<div class="col-sm-10">
								<input id="archivo1" name="archivo4" type="file" class="form-control" />
		                        Formatos de archivos permitidos: pdf - txt - ppt - pptx - xlsx - xls - doc - docx - jpg - rar - zip - png<br />
		                        <b>Archivo enviado:</b> <?php echo($fila['catalogo_d']); ?>
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
		            //Tratamos el archivo 1
	                $directorio = "archivos/";
	                $nombre_archivo1 = date("H_i_s").($_FILES['archivo1']['name']);
	                $info_archivo1 = pathinfo($_FILES['archivo1']['name']);
	                $destino = $directorio.$nombre_archivo1;            
	                if (is_uploaded_file($_FILES['archivo1']['tmp_name'])) 
	                {    
	                    if($info_archivo1['extension'] == 'pdf' || $info_archivo1['extension'] == 'txt' ||     $info_archivo1['extension'] == 'ppt' ||    $info_archivo1['extension'] == 'pptx' || $info_archivo1['extension'] == 'xlsx' || $info_archivo1['extension'] == 'xls' || $info_archivo1['extension'] == 'doc' || $info_archivo1['extension'] == 'docx'|| $info_archivo1['extension'] == 'jpg'|| $info_archivo1['extension'] == 'rar'|| $info_archivo1['extension'] == 'zip'|| $info_archivo1['extension'] == 'png')
	                    {
	                        if (copy($_FILES['archivo1']['tmp_name'],$destino)) 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td><?php echo("Archivo enviado: <b>".$nombre_archivo1."</b>"); ?></td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                        else 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td>Error al subir el archivo.</td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                    }
	                    else    
	                    {
	                        ?>
	                        <table align="center">
	                            <tr>
	                                <td>Formato de archivo no válido.</td>
	                            </tr>
	                        </table>
	                        <?php
	                    }                
	                }
	                else
					{
						$nombre_archivo1 = $fila['precios_m'];
					}

		            //Tratamos el archivo 2
	                $directorio = "archivos/";
	                $nombre_archivo2 = date("H_i_s").($_FILES['archivo2']['name']);
	                $info_archivo2 = pathinfo($_FILES['archivo2']['name']);
	                $destino = $directorio.$nombre_archivo2;            
	                if (is_uploaded_file($_FILES['archivo2']['tmp_name'])) 
	                {    
	                    if($info_archivo2['extension'] == 'pdf' || $info_archivo2['extension'] == 'txt' ||     $info_archivo2['extension'] == 'ppt' ||    $info_archivo2['extension'] == 'pptx' || $info_archivo2['extension'] == 'xlsx' || $info_archivo2['extension'] == 'xls' || $info_archivo2['extension'] == 'doc' || $info_archivo2['extension'] == 'docx'|| $info_archivo2['extension'] == 'jpg'|| $info_archivo2['extension'] == 'rar'|| $info_archivo2['extension'] == 'zip'|| $info_archivo2['extension'] == 'png')
	                    {
	                        if (copy($_FILES['archivo2']['tmp_name'],$destino)) 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td><?php echo("Archivo enviado: <b>".$nombre_archivo2."</b>"); ?></td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                        else 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td>Error al subir el archivo.</td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                    }
	                    else    
	                    {
	                        ?>
	                        <table align="center">
	                            <tr>
	                                <td>Formato de archivo no válido.</td>
	                            </tr>
	                        </table>
	                        <?php
	                    }                
	                }
	                else
					{
						$nombre_archivo2 = $fila['precios_d'];
					}

		            //Tratamos el archivo 3
	                $directorio = "archivos/";
	                $nombre_archivo3 = date("H_i_s").($_FILES['archivo3']['name']);
	                $info_archivo3 = pathinfo($_FILES['archivo3']['name']);
	                $destino = $directorio.$nombre_archivo3;            
	                if (is_uploaded_file($_FILES['archivo3']['tmp_name'])) 
	                {    
	                    if($info_archivo3['extension'] == 'pdf' || $info_archivo3['extension'] == 'txt' ||     $info_archivo3['extension'] == 'ppt' ||    $info_archivo3['extension'] == 'pptx' || $info_archivo3['extension'] == 'xlsx' || $info_archivo3['extension'] == 'xls' || $info_archivo3['extension'] == 'doc' || $info_archivo3['extension'] == 'docx'|| $info_archivo3['extension'] == 'jpg'|| $info_archivo3['extension'] == 'rar'|| $info_archivo3['extension'] == 'zip'|| $info_archivo3['extension'] == 'png')
	                    {
	                        if (copy($_FILES['archivo3']['tmp_name'],$destino)) 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td><?php echo("Archivo enviado: <b>".$nombre_archivo3."</b>"); ?></td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                        else 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td>Error al subir el archivo.</td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                    }
	                    else    
	                    {
	                        ?>
	                        <table align="center">
	                            <tr>
	                                <td>Formato de archivo no válido.</td>
	                            </tr>
	                        </table>
	                        <?php
	                    }                
	                }
	                else
	                {
						$nombre_archivo3 = $fila['catalogo_m'];
					}

		            //Tratamos el archivo 4
	                $directorio = "archivos/";
	                $nombre_archivo4 = date("H_i_s").($_FILES['archivo4']['name']);
	                $info_archivo4 = pathinfo($_FILES['archivo4']['name']);
	                $destino = $directorio.$nombre_archivo4;            
	                if (is_uploaded_file($_FILES['archivo4']['tmp_name'])) 
	                {    
	                    if($info_archivo4['extension'] == 'pdf' || $info_archivo4['extension'] == 'txt' ||     $info_archivo4['extension'] == 'ppt' ||    $info_archivo4['extension'] == 'pptx' || $info_archivo4['extension'] == 'xlsx' || $info_archivo4['extension'] == 'xls' || $info_archivo4['extension'] == 'doc' || $info_archivo4['extension'] == 'docx'|| $info_archivo4['extension'] == 'jpg'|| $info_archivo4['extension'] == 'rar'|| $info_archivo4['extension'] == 'zip'|| $info_archivo4['extension'] == 'png')
	                    {
	                        if (copy($_FILES['archivo4']['tmp_name'],$destino)) 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td><?php echo("Archivo enviado: <b>".$nombre_archivo4."</b>"); ?></td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                        else 
	                        {
	                            ?>
	                            <table align="center">
	                                <tr>
	                                    <td>Error al subir el archivo.</td>
	                                </tr>
	                            </table>
	                            <?php
	                        }
	                    }
	                    else    
	                    {
	                        ?>
	                        <table align="center">
	                            <tr>
	                                <td>Formato de archivo no válido.</td>
	                            </tr>
	                        </table>
	                        <?php
	                    }                
	                }
	                else
	                {
						$nombre_archivo4 = $fila['catalogo_d'];
					}
					
					include("conexion.php");
					$idproducto = $_GET['g']; 
					$query = "UPDATE listados SET precios_m='$nombre_archivo1', precios_d='$nombre_archivo2', catalogo_m='$nombre_archivo3', catalogo_d='$nombre_archivo4'";
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