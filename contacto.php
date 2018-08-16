<?php include "header.php" ?>
<body class="background-d">
<?php include "menu.php" ?>

<div class="container margintop40">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center titsec">CONTACTO</h3>
    </div>
  </div>
  <div class="row rowblack">
    <?php
        if (($_POST['nombre']) && ($_POST['mail']) && ($_POST['mensaje']))
        {

            require("class.phpmailer.php");
            $mail = new PHPMailer();
            $mail->Host = "localhost";
            $mail->IsHTML(true);
      
            $cuerpo .= "<b>Nombre:</b> " . $_POST["nombre"] . "<br>";
            $cuerpo .= "<b>Email:</b> " . $_POST["mail"] . "<br>";
            $cuerpo .= "<b>Mensaje:</b> " . $_POST["mensaje"] . "<br>";
                    
            $mail->From = " " . $_POST["mail"];
            $mail->FromName = "" . $_POST["nombre"];
            $mail->Subject = "Formulario de contacto";
            $mail->AddAddress("info@hmgroup.com.ar","HMG");
            $mail->Body = $cuerpo;
            $mail->AltBody = "";
            $mail->Send();
          
            
            echo "<div style=\"clear:both; color: #ffffff; margin-top: 40px; font-weight: 700; margin-left: 20px; font-size: 16px; line-height:200px; text-align:center; \">El formulario se ha enviado correctamente.</div>";
        }
        else 
        {
            ?>
            <form class="form-horizontal" action="contacto.php" method="post" onsubmit="return validacion()">
              <div class="col-md-6">
                <input id="nombre_form" name="nombre" placeholder="NOMBRE/" class="form-control input-md" type="text">
              </div>
              <div class="col-md-6">
                <input id="mail_form" name="mail" placeholder="EMAIL/" class="form-control input-md" type="text">
              </div>
              <div class="col-md-12">
                <textarea class="form-control" id="mensaje_form" name="mensaje" rows="15" placeholder="MENSAJE/"></textarea>
              </div>
              <div class="col-md-12 text-right">
                <button id="enviar" name="enviar" class="btn btn-default">Enviar</button>
              </div>
            </form>
            <?php
        }
    ?>
    <div class="col-lg-12"><br>
    </div>
    <div class="contactoinfo">
      <div class="col-lg-12 text-center">
        <h4>Harmony Music Group S.A. (HMG)</h4>
      </div>
      <div class="col-lg-6 col-md-6" style="font-family: Helvetica, sans-serif !important; padding-right:20px; border-right: 1px solid #ccc;"> <img src="media/ubicacion.png">Salta 1562 (B1869DGH) – Gerli, Buenos Aires, Argentina<br>
        <br>
        <img src="media/telefono.png">(+5411) 4265 – 4000 y rotativas<br>
        <br>
        <img src="media/whats.png">+ 54-9-11-61632996 // + 54-9-11-61632993 </div>
      <div class="col-lg-6 col-md-6" style="font-family: Helvetica, sans-serif !important; padding-left:60px;"> <img src="media/email.png">acliente@hmgroup.com.ar<br>
        <br>
        <img src="media/skype.png">acliente@hmgroup.com.ar  -  (live: acliente)<br>
        <br>
        <img src="media/facebook.png">www.facebook.com/hmg.argentina </div>
    </div>
  </div>
  <div class="clear"></div><br /><br /><br />
  <?php include "footer.php" ?>

  <script type="text/javascript">
function validacion() {
  nombre_form = document.getElementById("nombre_form").value;
  mail_form = document.getElementById("mail_form").value;
  mensaje_form = document.getElementById("mensaje_form").value;

  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

  if( nombre_form == null || nombre_form.length == 0 || /^\s+$/.test(nombre_form) || mensaje_form == null || mensaje_form.length == 0 || /^\s+$/.test(mensaje_form) ) {
    alert("Debe completar todos los campos.");
    return false;
  }
  else
  {
    if(mail_form.search(patron)!=0)
    {
      alert("E-mail incorrecto");
      return false;
    }
  }
  
  return true;
}
</script>