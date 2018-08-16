		</div>
	</div>
 <div class="division"></div>
    
</div>
    
    
<div id="pie">CopyRight &copy; 2008 | Todos los derechos Reservados</div>
  
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
    
    <? $this->PostBack(); ?>
 </body>
</html>