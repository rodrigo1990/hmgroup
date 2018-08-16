<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración</title>

<link href="css/estilos_control.css" rel="stylesheet" type="text/css" />
<link href="panelConfirmacion/estilos_confirmacion.css" rel="stylesheet" type="text/css" />
<!-- Libreria de Mensajes -->
<script type="text/javascript" src="panelConfirmacion/class.confirmacion.js"></script>
<!-- FIN libreria de Mensajes -->
<script type="text/javascript" src="js/class.stdCMS.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<? $this->setJavascript(); ?>
</head>

<body>

<div id="documento">
    <div id="header">
    	
        <div id="bannerHeader">
        	<img src="img/banner.gif" />
        </div>
                
        <div id="menuPrincipal">
            <!-- MENU PRINCIPAL -->
                <ul>
                  
            		<li><a href="login.mod.php" title="">Login</a></li>
                   
            
             <!-- FIN MENU PRINCIPAL -->   
               </ul>
        </div>
       
       
    </div>
        
       
    	

    
    
    <div id="cuerpo">
        <div id="colIzquierda">
        
        </div>
        <div id="colDerecha">
<form action="login.mod.php" name="formLogin" id="formLogin" method="post">
<div id="login_cuerpo">
 
        <div id="marcoLogin">
       		 
            
        	 <div class="divFormLogin">
             <label class="login_label"><span class="textoForm">User: </span></label>
             <input name="user" type="text" class="textoForm" id="user" />
             </div>
             <div class="divFormLogin">
              <label class="login_label"><span class="textoForm">Password: </span></label>
             <input name="pass" type="password" class="textoForm" id="pass" />
             </div>
             
                 <div id="login_divBoton">
                 <input type="submit" class="boton" value="Confirm" />
                 </div>
            
        </div>
   
</div>
<input type="hidden" name="accion" value="LoginUser" />
</form> 


		</div>
	</div>
    <div class="division"></div>
    
</div>
<div id="pie">
CopyRight &copy; 2008 | Todos los derechos Reservados
</div>

<? include('panelConfirmacion/panel_confirmacion_tpl.php'); ?>
<? include('panelConfirmacion/panel_error_tpl.php'); ?>
<? include('panelConfirmacion/panel_msg_tpl.php'); ?>
<script type="text/javascript">

	<? if($this->ERROR){ ?>
    
       objConfirmacion.showError('<? echo nl2br(implode("<br>",$this->ERRORS)); ?>');
	 
	<? } ?>   

	<? if($this->MSG){ ?>
	
		objConfirmacion.showMsg('<? PF::html($this->MSG); ?>');
	
	<? } ?>

    </script>
</body>
</html>
