<?php include "header.php" ?>
<body class="background-a">
<?php include "menu.php" ?>

<?php
  $consulta_home = "SELECT id, foto1, foto2, foto3 FROM home_contenido WHERE id=1";
  $resultado_home = mysql_query($consulta_home);
  $fila_home = mysql_fetch_array($resultado_home);
  $foto1 = strtolower ($fila_home['foto1']);
  $foto2 = strtolower ($fila_home['foto2']);
  $foto3 = strtolower ($fila_home['foto3']);
?>
<div class="container margintop40">
  <div style="padding: 0px 15px;">
  <div class="row contiene_bloque_home">
    <div class="col-md-4">
      <div class="bloque-novedades">
        <div class="descripcion-novedades">NOVEDADES</div>
        <div class="media-novedades"><a class="fancybox" href="panel/home_contenido/grandes/<?php echo $foto1; ?>"><img src="panel/home_contenido/chicas/<?php echo $foto1; ?>" class="img_full" /></a></div>
      </div>
      <div class="bloque-novedades">
        <div class="descripcion-novedades">NOVEDADES</div>
        <div class="media-novedades"><a class="fancybox" href="panel/home_contenido/grandes/<?php echo $foto2; ?>"><img src="panel/home_contenido/chicas/<?php echo $foto2; ?>" class="img_full" /></a></div>
      </div>
      <div class="bloque-novedades">
        <div class="descripcion-novedades">PROMOCION</div>
        <div class="media-novedades"><a class="fancybox" href="panel/home_contenido/grandes/<?php echo $foto3; ?>"><img src="panel/home_contenido/chicas/<?php echo $foto3; ?>" class="img_full" /></a></div>
      </div>
    </div>
    <div class="col-md-8" style="padding-left: 0px;"> 
      <ul class="rslides" id="slider4">
        <?php
        $consulta_home = "SELECT id, foto, recordListingID FROM slider_home ORDER BY recordListingID ASC";
        $resultado_home = mysql_query($consulta_home);
            
        while($fila_home = mysql_fetch_array($resultado_home))
        {
          $foto = strtolower ($fila_home['foto']);
          ?>
          <li><img src="panel/slider_home/<?php echo $foto; ?>" alt="" /></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
  </div>
  <br>
  <br>

  <div class="row">
    <div class="col-md-12">
      <div class="well-none">
        <div id="sliderMarcas" class="carousel slide">
          <div class="carousel-inner">
            
                <?php
                $consulta_marcas_home = "SELECT id, foto, recordListingID FROM marcas_home ORDER BY recordListingID ASC";
                $resultado_marcas_home = mysql_query($consulta_marcas_home);
                $contador = 1;
                $contador_inicial = 1;
                    
                while($fila_marcas_home = mysql_fetch_array($resultado_marcas_home))
                {
                  $foto_marca = strtolower ($fila_marcas_home['foto']);
                  
                  if($contador == 1)
                  {
                    ?>
                    <div class="item <?php if($contador_inicial == 1) { echo "active"; } ?>">
                    <div class="row">
                    <?php
                  }
                  ?>
                  <div class="col-sm-2 col-xs-2"><a><img src="panel/marcas_home/<?php echo $foto_marca; ?>" class="img-responsive"></a> </div>
                  <?php
                  if($contador == 6)
                  {
                    ?>
                      </div>
                    </div>
                    <?php
                    $contador = 1;
                  }
                  else
                  {
                    $contador++;
                  }
                  $contador_inicial++;
                }
                ?>
          </div>
        </div>
      </div>
          <a class="left carousel-control" href="#sliderMarcas" data-slide="prev"><i class="fa fa-chevron-left fa-4" style="color:#F1F1F2;"></i></a> 
          <a class="right carousel-control" href="#sliderMarcas" data-slide="next"><i class="fa fa-chevron-right fa-4" style="color:#F1F1F2;"></i></a> </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>

  <div class="container">
  <?php
    $consulta_bloques_inferiores = "SELECT id, foto1, video1, foto2, video2, foto3, video3 FROM bloques_inferiores WHERE id=1";
    $resultado_bloques_inferiores = mysql_query($consulta_bloques_inferiores);
    $fila_bloques_inferiores = mysql_fetch_array($resultado_bloques_inferiores);
    $foto1_bloque = strtolower ($fila_bloques_inferiores['foto1']);
    $foto2_bloque = strtolower ($fila_bloques_inferiores['foto2']);
    $foto3_bloque = strtolower ($fila_bloques_inferiores['foto3']);

    $video1_bloque = $fila_bloques_inferiores['video1'];
    $video2_bloque = $fila_bloques_inferiores['video2'];
    $video3_bloque = $fila_bloques_inferiores['video3'];
  ?>
  <div class="row">
    <div class="col-sm-4 col-xs-6"><?php if($video1_bloque != "") { ?> <iframe width="100%" height="365" src="https://www.youtube.com/embed/<?php echo $video1_bloque; ?>?rel=0" frameborder="0" allowfullscreen></iframe> <?php } else { ?><img class="img-responsive portfolio-item" src="panel/bloques_inferiores/<?php echo $foto1_bloque; ?>" alt=""><?php } ?></div>
    <div class="col-sm-4 col-xs-6"><?php if($video2_bloque != "") { ?> <iframe width="100%" height="365" src="https://www.youtube.com/embed/<?php echo $video2_bloque; ?>?rel=0" frameborder="0" allowfullscreen></iframe> <?php } else { ?><img class="img-responsive portfolio-item" src="panel/bloques_inferiores/<?php echo $foto2_bloque; ?>" alt=""><?php } ?></div>
    <div class="col-sm-4 col-xs-6"><?php if($video3_bloque != "") { ?> <iframe width="100%" height="365" src="https://www.youtube.com/embed/<?php echo $video3_bloque; ?>?rel=0" frameborder="0" allowfullscreen></iframe> <?php } else { ?><img class="img-responsive portfolio-item" src="panel/bloques_inferiores/<?php echo $foto3_bloque; ?>" alt=""><?php } ?></div>
  </div>
</div>
  
  <footer style="position: relative; width: 100%; background: none; padding-bottom: 20px;">
  <div class="row">
    <div class="col-lg-12">
      <p>Tel. / Fax: (+5411) 4265 – 4000 y rotativas / acliente@hmgroup.com.ar</p>
    </div>
  </div>
</footer>

</div>
<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>
<script>
$('.responsive-tabs').responsiveTabs({
    accordionOn: ['xs', 'sm']
    
});
</script>

<link rel="stylesheet" href="css/responsiveslides.css">
  <link rel="stylesheet" href="css/demo.css">
  <script src="js/responsiveslides.min.js"></script>
  <script>
    $(function () {

      $("#slider4").responsiveSlides({
        auto: true,
        pager: false,
        nav: false,
        speed: 500,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });

    });
  </script>

  <!-- FANCYBOX -->
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
      $('.fancybox').fancybox();
    });
</script>

<script type='text/javascript'>
    $(document).ready(function() {
         $('.carousel').carousel({
             interval: 3000
         })
    });    
</script>

</body>
</html>