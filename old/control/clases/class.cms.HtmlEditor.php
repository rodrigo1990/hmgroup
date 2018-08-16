<?php
require_once(PF::getPath('control/fckeditor/fckeditor.php'));

class CMSHtmlEditor{
	
	function CMSHtmlEditor($nombre,$ancho,$alto,$valor=''){
		$oFCKeditor = new FCKeditor($nombre) ;
		$oFCKeditor->BasePath = 'fckeditor/' ;
		$oFCKeditor->Value =$valor; 
		$oFCKeditor->Width  = $ancho ;
		$oFCKeditor->Height = $alto ;
		$oFCKeditor->ToolbarSet = 'Basic';
		$sBasePath = $_SERVER['PHP_SELF'] ;
		$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "control" ) ) ;
		$oFCKeditor->Config['SkinPath']=$sBasePath . 'control/fckeditor/editor/skins/silver/';
		$oFCKeditor->Config['AutoDetectLanguage']='true';
		$oFCKeditor->Config['DefaultLanguage']='es';
		$oFCKeditor->Create() ;
	}
}
?>