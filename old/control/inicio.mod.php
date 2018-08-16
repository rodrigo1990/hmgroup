<? 
require_once('main.php');
class ModInicio extends Main{
	
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
	function ModInicio(){
		/* INICIALIZACION */
		$this->Main();
		/* FIN INICIALIZACION */
		
		//DEBUG
		//$this->DEBUG=true;
		
		//CUSTOM
		$this->menuPrincipalSelectado=false;
		$this->DEFAULT='inicio.tpl.php';	
		$this->aMenuSecundario=array();
			
		/* EJECUCION */
		$this->execEvents();
		/* FIN EJECUCION */
	}
	
	
}
                    
$ModInicio=new ModInicio();
?>