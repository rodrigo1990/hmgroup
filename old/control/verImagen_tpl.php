<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<div>
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
  <? $this->setJavascript(); ?>
  <title>Imagen</title>
  </head>
    
  <body onload="window.resizeTo(<? echo $this->imagen['0']; ?>,<? echo $this->imagen['1']; ?>);">
  <div style="text-align:center;"><img src="<? echo $this->imagen['nombre']; ?>" /></div>
  </body>
  </html>
</div>
