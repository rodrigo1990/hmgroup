<? 
require_once('flex.php');
class ModUpload extends Flex{
	
	/*
	Privadas
	*/
	
	
	
	/*
	Publicas
	*/
	

	
	
	/**
	 * Constructor
	 *
	 */
	function ModUpload(){
		/* INICIALIZACION */
		$this->Flex();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		
		//CUSTOM
		
		$this->uploadFiles();	
		
	}
	
	function uploadFiles(){
		foreach($_FILES as $file){
			move_uploaded_file($file['tmp_name'],PF::getPath(FLEX_UPLOAD_PATH.'/'.$file['name']));
		}
	}	
}
                    
$ModUpload=new ModUpload();
?>