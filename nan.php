
<?php include "header.php" ?>
<body class="background-c">
<?php include "menu.php" ?>
<?php 

if($_GET['c']){
if(ctype_digit((string)$_GET['c'])!=false){
echo "<h1>HOLA</h1>";
}else{
     header('Location: index.php');
}
}


 ?>

<div class="container margintop40">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center titsec">PRODUCTOS</h3>
    </div>
  </div>
  <div class="row rowproductos">
    <div class="col-lg-3 col-sm-3">
      <div class="titulo-bloque text-center">PRODUCTOS</div>
      <?php
        $consulta_categorias = "SELECT id, titulo FROM categorias ORDER BY titulo ASC";
        $resultado_categorias = mysql_query($consulta_categorias);
              
        while($fila_categorias = mysql_fetch_array($resultado_categorias))
        {
          $categoria_seleccionada = $fila_categorias['id'];
          $titulo = utf8_encode($fila_categorias['titulo']);
          ?>
          <div class="bloque-opciones">
            <a href="productos.php?c=<?php echo $fila_categorias['id']; ?>"><?php echo $titulo; ?></a>
            <?php
            if($_GET['c'])
            {
              
              $categoria_actual = $_GET['c'];
              if($categoria_seleccionada == $categoria_actual)
              {
                ?>
                <div id="contiene_subcategorias">
                <?php
                  $consulta_subcategoria = "SELECT id, categoria, titulo FROM subcategorias WHERE categoria=$categoria_actual ORDER BY titulo ASC";

                $resultado_subcategoria = mysql_query($consulta_subcategoria );
                        
                  while($fila_subcategoria =  mysql_fetch_array($resultado_subcategoria ))
                  {
                    $subcategoria_actual = $fila_subcategoria['id'];
                    $titulo = utf8_encode($fila_subcategoria['titulo']);
                    ?>
                    <div class="titulos_subcategorias"><a href="productos.php?c=<?php echo $categoria_actual; ?>&s=<?php echo $subcategoria_actual; ?>"><?php echo $titulo; ?></a></div>
                    <?php
                  }
                ?>
                </div>
                <?php
              }
            
            }//if($_GET['c'])
       
            ?>
          </div>
          <?php
        }//while
      ?>
    </div>
    <div class="col-lg-9 col-sm-9">
      <div class="titulo-bloque">
        <?php 
        if(!$_GET['c']) 
        { 
          echo "DESTACADOS"; 
        } 
        if($_GET['c']) 
        {
          $categoria_actual = $_GET['c'];

          $consulta_categoria = "SELECT id, titulo FROM categorias WHERE id = $categoria_actual";
          $resultado_categoria = mysql_query($consulta_categoria);
          $fila_categorias = mysql_fetch_array($resultado_categoria);
          $titulo=utf8_encode($fila_categorias['titulo']);
          echo $titulo;
        }
        if($_GET['s']) 
        {
          $subcategoria_actual = $_GET['s'];

          $consulta_subcategoria = "SELECT id, categoria, titulo FROM subcategorias WHERE id = $subcategoria_actual AND categoria = $categoria_actual";
          $resultado_subcategoria = mysql_query($consulta_subcategoria);
          $fila_subcategoria = mysql_fetch_array($resultado_subcategoria);
          $titulo = utf8_encode($fila_subcategoria['titulo']);
          echo ' - ' . $titulo;
        }
        ?>
      </div>

      <?php
      if(!$_GET['c']) 
      {
        $consulta_productos = "SELECT id, categoria, subcategoria, titulo, descripcion, foto, destacado, recordListingID FROM productos WHERE destacado='si' ORDER BY recordListingID ASC";
      }
      else if($_GET['c'] && $_GET['s'])
      {
        $categoria_actual = $_GET['c'];
        $subcategoria_actual = $_GET['s'];

        $consulta_productos = "SELECT id, categoria, subcategoria, titulo, descripcion, foto, destacado, recordListingID FROM productos WHERE categoria=$categoria_actual AND subcategoria=$subcategoria_actual ORDER BY recordListingID ASC";
      }
      else if($_GET['c'])
      {
        $categoria_actual = $_GET['c'];

        $consulta_productos = "SELECT id, categoria, subcategoria, titulo, descripcion, foto, destacado, recordListingID FROM productos WHERE categoria=$categoria_actual ORDER BY recordListingID ASC";
      }

      $resultado_productos = mysql_query($consulta_productos);
      $cant_productos = mysql_num_rows($resultado_productos);

      if($cant_productos <= 0)
      {
        ?>
        <div class="row margintop-prods">
          <div class="col-lg-12">
            <div class="prod-titulo">No hay productos en esta categoría</div>
          </div>
        </div>
        <?php
      }
            
      while($fila_productos = mysql_fetch_array($resultado_productos))
      {
        $foto = strtolower ($fila_productos['foto']);
        $titulo = utf8_encode($fila_productos['titulo']);
        ?>
        <div class="row margintop-prods">
          <div class="col-lg-3">
            <div class="prod-media">
              <a class="fancybox" href="panel/productos/grande/<?php echo $foto; ?>" data-fancybox-group="gallery"><img src="panel/productos/principal/<?php echo $foto; ?>" class="img-responsive"></a>
            </div>
          </div>
          <div class="col-lg-9 col-sm-9" style="padding-left: 0px;padding-right: 0px;">
            <div class="prod-info">
              <div class="prod-titulo"><?php echo $titulo; ?></div>
              <div class="prod-descripcion">
                <?php echo $descripcion; ?>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>

    </div>
  </div>

  <div class="clear"></div><br /><br /><br />

<!-- FANCYBOX -->
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
      $('.fancybox').fancybox();
    });
</script>