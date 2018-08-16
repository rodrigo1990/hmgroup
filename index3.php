<?php include "header.php" ?>
<body class="background-intro">
<div id="bandera_intro"><img src="media/bandera.png" alt="" /></div>

<div id="logo_intro"><a href="inicio.php"><img src="media/logo_intro.png" alt="" /></a></div>

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

</body>
</html>