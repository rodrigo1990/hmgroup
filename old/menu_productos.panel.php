<? $listaCat=$oEx->getSubCategorias(0); ?>
<script type="text/javascript">
$(document).ready(function() {
 	subsubmenu_hide();
	submenu_hide();
	$('.listaCat a').hover( 
		function(){$(this).parent().attr("style","background-color:#CCCCCC;");},
		function(){$(this).parent().attr("style","");
	});
	
	$('div.itemMenu a').hover( 
		function(){$(this).parent().attr("style","background-color:#CCCCCC;");},
		function(){$(this).parent().attr("style","");
	});
});
</script>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="300" valign="top" bgcolor="#DBDBDB" id="lc">
                
                <? 
				$arraySubCats=array();
				foreach($listaCat as $categoria){ 
					$idCat=$categoria['id_categoria'];
					$arraySubCats[$idCat]=$oEx->getSubCategorias($idCat);
					$cantProds=$oEx->getCantProductosCategoria($idCat);
					$link='#';
					if($cantProds>0){
						$link='productos.php?id_categoria='.$idCat;
					}
				?>
                <div class="listaCat" id="ll<? echo $idCat; ?>" >
                <a href="<? echo $link; ?>" <? echo (count($arraySubCats[$idCat])>0)? 'onmouseover="menu_show(\'sc'.$idCat.'\',\'ll'.$idCat.'\');" onmouseout="leave_link();"':''; ?>><img src="img/vineta.jpg" width="7" height="7" border="0"> <? PF::html($categoria['descripcion']); ?></a>                
               </div>
               <? } ?>
              
               <? 
			   foreach($arraySubCats as $idCat => $cats){ 
			   	if(count($cats)>0){
			   ?>
                
                <div class="listaSubCat" id="sc<? echo $idCat; ?>" style="position:absolute; top:0px; left:0px;">
                	<img src="img/sub_menu_r1_c1.gif" style="margin:0px; padding:0px; border:0px none;"/>
                    <div class="itemFondoMenu">
                    <? 
					foreach($cats as $subCat){ 
						
					?>
                     <div class="itemMenu"><a href="productos.php?id_categoria=<? echo $subCat['id_categoria']; ?>"><img src="img/vineta.jpg" width="7" height="7" border="0"> <? PF::html($subCat['descripcion']); ?></a></div>
                   <? } ?>
                    </div>
                  <img src="img/sub_menu_r3_c1.gif" alt="" width="187" height="37"></div>
              <? } 
			  
			  }
			  ?>
                  
                   <!--<div class="listaSubCat" id="sc2" style="position:absolute; top:0px; left:0px;">
                	<img src="img/sub_menu_r1_c1.jpg"/>
                     <a href="#" onClick="sub_menu_show('sc3','sc2');"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 21</a>
                    <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 22</a>
                  <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 23</a>
                  <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 24</a>
                  <img src="img/sub_menu_r3_c1.jpg" alt="" width="187" height="37"></div>
                  
                    <div class="listaSubSubCat" id="sc3" style="position:absolute; top:0px; left:0px;">
                	<img src="img/sub_menu_r1_c1.jpg"/>
                     <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 21</a>
                    <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 22</a>
                  <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 23</a>
                  <a href="#"><img src="img/vineta.jpg" width="7" height="7" border="0"> SCategoría 24</a>
                  <img src="img/sub_menu_r3_c1.jpg" alt="" width="187" height="37"></div>-->
                
                </td>
              </tr>
              <tr>
                <td height="10" valign="middle" bgcolor="#DBDBDB"><img src="img/sub_menu_r3_c1.jpg" width="187" height="37"></td>
              </tr>
            </table>