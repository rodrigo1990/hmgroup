<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Administration</title>
<link href="css/estilos_control.css" rel="stylesheet" type="text/css" />
<link href="panelConfirmacion/estilos_confirmacion.css" rel="stylesheet" type="text/css" />
<!-- Libreria de Mensajes -->
<script type="text/javascript" src="panelConfirmacion/class.confirmacion.js"></script>
<!-- FIN libreria de Mensajes -->
<script type="text/javascript" src="js/class.stdCMS.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<? $this->setJavascript(); ?>
<!-- COMPONENTE CALENDARIO -->
<script type="text/javascript" language="javascript" src="<? echo PF::getPath('control/js/cal.js'); ?>"></script>
<!-- FIN COMPONENTE CALENDARIO -->
</head>

<body>

<div id="documento">
    <div id="header">
    	
        <div id="bannerHeader">
       	<img src="img/banner.gif" border="0" /></div>
        
                
<div id="menuPrincipal">
            <!-- MENU PRINCIPAL -->
                <ul>
                   
             <? 
			 $actualFile    = array_shift(explode('?', basename($_SERVER['PHP_SELF'])));
			 foreach($this->aMenuPrincipal as $ind => $item){ 
			 	$here=false;
				if($actualFile==array_shift(explode('?', basename( $item['link'])))){
					$here=true;
				}
				if($ind==$this->menuPrincipalSelectado){
					$here=true;
				}
			 ?>
            <li><a <? echo ($here)? 'class="menu_on"':''; ?> href="<? echo $item['link']; ?>" title="<? echo $item['alt']; ?>"><? PF::html($item['texto']); ?></a></li>
            <li><a style="font-size:16px; padding-top:2px;">|</a></li>
            <? } ?>
             <!-- FIN MENU PRINCIPAL -->   
               </ul>
            </div>
       
        </div>
        
       
    	

    
    
    <div id="cuerpo">
        <div id="colIzquierda">
                
                         <!-- MENU SECUNDARIO  -->
           <? if(count($this->aMenuSecundario)>0){ ?>
            <div id="marcoSec">
            	<div>
                <span><? PF::html($this->aMenuPrincipal[$this->menuPrincipalSelectado]['texto']); ?></span>
            	<ul>
       
       			 <!-- MENU SECUNDARIO  -->
                      
            <? foreach($this->aMenuSecundario as $item){ ?>
            <li><a href="<? echo $item['link']; ?>" title="<? echo $item['alt']; ?>"><? echo $item['texto']; ?></a></li>
            <? } ?>
                            
               <!-- FIN MENU SECUNDARIO -->            
           
        </ul>
            	</div>
            </div> 
            <? } ?>             
                                         
                         <!-- FIN MENU SECUNDARIO -->            
               
        </div>
            
        <div id="colDerecha">