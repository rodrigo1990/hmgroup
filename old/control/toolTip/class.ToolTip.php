<?php
class PFToolTip{
	
	function set($texto,$return=false){
		$contenido=str_replace("'","\\\\'",PF::html($texto,true));
		$string='onmouseover="tooltip.show(\''.$contenido.'\');" onmouseout="tooltip.hide();"';
		if($return){
			return $string;
		}
		echo $string;
	}
	
	function setToolTip($return=false){
		$string='<link rel="stylesheet" type="text/css" href="'.PF::getPath('control/toolTip/toolTip.css').'" />
<script type="text/javascript" language="javascript" src="'.PF::getPath('control/toolTip/toolTip.js').'"></script>';
		if($return){
			return $string;
		}
		echo $string;
	}
}
?>