<?php include "header.php" ?>
<body class="background-f">
<?php include "menu.php" ?>
<div class="container margintop40">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center titsec">MARCAS</h3>
    </div>
  </div>
  <div class="row rowproductos">
    <?php
      $consulta_marcas = "SELECT id, descripcion, foto, recordListingID FROM marcas ORDER BY recordListingID ASC";
      $resultado_marcas = mysql_query($consulta_marcas);
      $contador = 1;

      while($fila_productos = mysql_fetch_array($resultado_marcas))
      {
        $foto = strtolower ($fila_productos['foto']);
        include('includes/acentos_productos.php');
        ?>
        <div class="col-lg-6 margintop-prods">
          <div class="col-lg-4">
            <div class="marcas-media"> <img src="panel/marcas/<?php echo $foto; ?>" class="img-responsive"> </div>
          </div>
          <div class="col-lg-8 col-sm-8">
            <div class="marcas-info">
              <div class="marcas-descripcion">
                <p><?php echo $descripcion; ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php
        if($contador == 2)
        {
          ?><div class="clear"></div><?php
          $contador = 1;
        }
        else
        {
          $contador++;
        }
      }
    ?>
  </div>

  <div class="clear"></div><br /><br /><br />
  <?php include "footer.php" ?>
