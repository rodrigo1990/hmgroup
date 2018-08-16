<?
//error_reporting(E_ALL);
class Tijera_recuadro{
	//Clase auxiliar para calcular los recortes de imagenes
	
	
	//propiedades publicas
	var $modo;
	var $AltoOrigen;
	var $AnchoOrigen;
	var $AltoMarco;
	var $AnchoMarco;
	var $solucion;
	
	
	//propiedades privadas
	
	
	/**
	 * Constructor
	 *
	*/
	function Tijera_recuadro($AltoOrigen,$AnchoOrigen,$AltoMarco,$AnchoMarco,$modo){
		$this->AltoMarco=$AltoMarco;
		$this->AnchoMarco=$AnchoMarco;
		$this->AltoOrigen=$AltoOrigen;
		$this->AnchoOrigen=$AnchoOrigen;
		$this->modo=$modo;
	}
	
	/**
	 * Publico: calcula el vector solucion
	 *
	 * @return unknown
	 */
	function calcular(){
		switch($this->modo){
			case "EscalaTotal":
				$this->calcularEscalaTotal();
			break;
			case "EscalaModificada":
				$this->calcularEscalaModificada();
			break;
		}
		return $this->solucion;
	}
	
	/**
	 * Privado: calcula el vector solucion para el caso de escala total
	 *
	 */
	function calcularEscalaTotal(){
		//Achica la imagen para que entre en el espacio sin recortar
		$this->solucion['recorteOriginal_Xo']=0;
		$this->solucion['recorteOriginal_Yo']=0;
		$this->solucion['recorteOriginal_Xf']=$this->AnchoOrigen;
		$this->solucion['recorteOriginal_Yf']=$this->AltoOrigen;
		if($this->AnchoMarco>=$this->AnchoOrigen and $this->AltoMarco>=$this->AltoOrigen){
			//echo 'El marco es mayor al original';
			$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$this->AnchoOrigen)/2;
			$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$this->AltoOrigen)/2;
			$this->solucion['posicionMarco_Xf']=$this->AnchoOrigen;
			$this->solucion['posicionMarco_Yf']=$this->AltoOrigen;
			
		}
		else{
			//echo 'Caso marco más chico que origen, debo achicar';
			if($this->AnchoMarco<$this->AnchoOrigen and $this->AltoMarco<$this->AltoOrigen){
				//echo 'Caso sobra de los dos lados';
				$nuevoAltoOrigen=$this->AltoMarco;
				$nuevoAnchoOrigen=$nuevoAltoOrigen*$this->AnchoOrigen/$this->AltoOrigen;
				if($nuevoAnchoOrigen<=$this->AnchoMarco){
					$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$nuevoAnchoOrigen)/2;
					$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$nuevoAltoOrigen)/2;
					$this->solucion['posicionMarco_Xf']=$nuevoAnchoOrigen;
					$this->solucion['posicionMarco_Yf']=$nuevoAltoOrigen;
				}
				else{
					$nuevoAnchoOrigen=$this->AnchoMarco;
					$nuevoAltoOrigen=$nuevoAnchoOrigen*$this->AltoOrigen/$this->AnchoOrigen;
					$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$nuevoAnchoOrigen)/2;
					$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$nuevoAltoOrigen)/2;
					$this->solucion['posicionMarco_Xf']=$nuevoAnchoOrigen;
					$this->solucion['posicionMarco_Yf']=$nuevoAltoOrigen;
				}
			}
			elseif($this->AnchoMarco>$this->AnchoOrigen and $this->AltoMarco<$this->AltoOrigen){
				//echo 'Caso sobra de Altura el original, seteo altura';
				$nuevoAltoOrigen=$this->AltoMarco;
				$nuevoAnchoOrigen=$nuevoAltoOrigen*$this->AnchoOrigen/$this->AltoOrigen;
				$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$nuevoAnchoOrigen)/2;
				$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$nuevoAltoOrigen)/2;
				$this->solucion['posicionMarco_Xf']=$nuevoAnchoOrigen;
				$this->solucion['posicionMarco_Yf']=$nuevoAltoOrigen;
				
			}
			elseif ($this->AnchoMarco<$this->AnchoOrigen and $this->AltoMarco>$this->AltoOrigen){
				//echo 'Caso sobra de Ancho el original';
				$nuevoAnchoOrigen=$this->AnchoMarco;
				$nuevoAltoOrigen=$nuevoAnchoOrigen*$this->AltoOrigen/$this->AnchoOrigen;
				$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$nuevoAnchoOrigen)/2;
				$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$nuevoAltoOrigen)/2;
				$this->solucion['posicionMarco_Xf']=$nuevoAnchoOrigen;
				$this->solucion['posicionMarco_Yf']=$nuevoAltoOrigen;
			}
			
		}
	}
	
	/**
	 * Privado: calcula el vector solucion para el caso de escala modificada
	 *
	 */
	function calcularEscalaModificada(){
		//Achica si es necesario a la imagen y recorta el sobrante
		$this->solucion['recorteOriginal_Xo']=0;
		$this->solucion['recorteOriginal_Yo']=0;
		$this->solucion['recorteOriginal_Xf']=$this->AnchoOrigen;
		$this->solucion['recorteOriginal_Yf']=$this->AltoOrigen;
		if($this->AnchoMarco>=$this->AnchoOrigen and $this->AltoMarco>=$this->AltoOrigen){
			//echo 'El marco es mayor al original';
			$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$this->AnchoOrigen)/2;
			$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$this->AltoOrigen)/2;
			$this->solucion['posicionMarco_Xf']=$this->AnchoOrigen;
			$this->solucion['posicionMarco_Yf']=$this->AltoOrigen;
			
		}
		else{
			
			if($this->AnchoMarco<$this->AnchoOrigen and $this->AltoMarco<$this->AltoOrigen){
				//echo 'Caso de que la imagen supera en ambas medidas al marco';
				$this->solucion['posicionMarco_Xo']=0;
				$this->solucion['posicionMarco_Yo']=0;
				$this->solucion['posicionMarco_Xf']=$this->AnchoMarco;
				$this->solucion['posicionMarco_Yf']=$this->AltoMarco;
				
				if((($this->AnchoOrigen*$this->AltoMarco)/$this->AnchoMarco)<$this->AltoOrigen){
					//echo 'Caso de fijacion por alto';
					$nuevoAnchoRecorte=$this->AnchoOrigen;
					$nuevoAltoRecorte=($nuevoAnchoRecorte*$this->AltoMarco)/$this->AnchoMarco;
					$this->solucion['recorteOriginal_Xo']=0;
					$this->solucion['recorteOriginal_Yo']=($this->AltoOrigen-$nuevoAltoRecorte)/2;
					$this->solucion['recorteOriginal_Xf']=$nuevoAnchoRecorte;
					$this->solucion['recorteOriginal_Yf']=$nuevoAltoRecorte;
				}
				elseif((($this->AltoOrigen*$this->AnchoMarco)/$this->AltoMarco)<$this->AnchoOrigen){
					//echo 'Caso de fijacion por ancho';
					$nuevoAltoRecorte=$this->AltoOrigen;
					$nuevoAnchoRecorte=($nuevoAltoRecorte*$this->AnchoMarco)/$this->AltoMarco;
					$this->solucion['recorteOriginal_Xo']=($this->AnchoOrigen-$nuevoAnchoRecorte)/2;
					$this->solucion['recorteOriginal_Yo']=0;
					$this->solucion['recorteOriginal_Xf']=$nuevoAnchoRecorte;
					$this->solucion['recorteOriginal_Yf']=$nuevoAltoRecorte;
					
				}
				//print_r($this->solucion);
			}
			elseif($this->AnchoMarco>$this->AnchoOrigen and $this->AltoMarco<$this->AltoOrigen){
				//echo 'Caso sobra de Altura el original, pero falta ancho';
				
				$this->solucion['recorteOriginal_Xo']=0;
				$this->solucion['recorteOriginal_Yo']=($this->AltoOrigen-$this->AltoMarco)/2;
				$this->solucion['recorteOriginal_Xf']=$this->AnchoOrigen;
				$this->solucion['recorteOriginal_Yf']=$this->AltoMarco;
				$this->solucion['posicionMarco_Xo']=($this->AnchoMarco-$this->AnchoOrigen)/2;
				$this->solucion['posicionMarco_Yo']=0;
				$this->solucion['posicionMarco_Xf']=$this->AnchoOrigen;
				$this->solucion['posicionMarco_Yf']=$this->AltoMarco;
				
			}
			elseif ($this->AnchoMarco<$this->AnchoOrigen and $this->AltoMarco>$this->AltoOrigen){
				//echo 'Caso sobra de Ancho el original';
				
				$this->solucion['recorteOriginal_Xo']=($this->AnchoOrigen-$this->AnchoMarco)/2;
				$this->solucion['recorteOriginal_Yo']=0;
				$this->solucion['recorteOriginal_Xf']=$this->AnchoMarco;
				$this->solucion['recorteOriginal_Yf']=$this->AltoOrigen;
				$this->solucion['posicionMarco_Xo']=0;
				$this->solucion['posicionMarco_Yo']=($this->AltoMarco-$this->AltoOrigen)/2;
				$this->solucion['posicionMarco_Xf']=$this->AnchoMarco;
				$this->solucion['posicionMarco_Yf']=$this->AltoOrigen;
			}
			
		}
	}
}

//Clase tijera: recorta imágenes
class Tijera{
	//propiedades publicas
	
	//propiedades privadas
	var $origen;
	var $destino;
	var $anchoOrig;
	var $altoOrig;
	var $anchoCopia;
	var $altoCopia;
	var $cordXCopia;
	var $cordYCopia;
	var $cordXOrig;
	var $cordYOrig;
	var $anchoOrigRecorte;
	var $altoOrigRecorte;
	var $modo;
	var $bg;
	var $bgSet;
	var $tipo;
	
	//Constructor
	function Tijera(){
		$this->bgSet=false;
		$this->bg=array();
	}
	//fin constructor
	
	//Publico: setea el origen de la imagen
	function setOrigen($ruta){
		$this->origen=$ruta;
	}
	//fin metodo
	
	//Publico: setea el destino de la imagen
	function setDestino($ruta){
		$this->destino=$ruta;
	}
	//fin metodo
	
	//Publico: recorta la imagen
	function recortar(){
		$datos_imagen=pathinfo ($this->origen);
		$datos_imagen['extension']=strtolower(substr($this->destino,strrpos($this->destino,'.'),strlen($this->destino)));
		$descarte="../temporal/temporal".$datos_imagen['extension'];
		//echo "ruta2>:".$descarte." - ".$this->destino;
		if (copy ($this->origen, $descarte)){
			if($datos_imagen['extension']=='.gif'){
				$imagenx = imagecreatefromgif($descarte);
			}
			else{
				$imagenx = imagecreatefromjpeg($descarte);
			}
			$this->anchoOrig= imagesx($imagenx);
			$this->altoOrig= imagesy($imagenx);
			
			///////////INICIO DETERMINACION DE ESCALA  /////////////////////
			$GD2="no";
			if($this->modo=="EscalaAncho"){
				$this->cordXCopia=0;
				$this->cordYCopia=0;
				$this->cordYOrig=0;
				$this->cordXOrig=0;
				$this->anchoOrigRecorte=$this->anchoOrig;
				$this->altoOrigRecorte=$this->altoOrig;
				$this->altoCopia=$this->anchoCopia*$this->altoOrig/$this->anchoOrig;
				if($this->chkgd2()){
					$GD2="si";
					$im_base=imagecreatetruecolor($this->anchoCopia,$this->altoCopia);
				}
				else{
					//para el viejo:
					$im_base = imagecreate ($this->anchoCopia,$this->altoCopia);
				}
				//Se fijan los tamaños absolutos finales para poder aplicar color de fondo
				$anchoFinal=$this->anchoCopia;
				$altoFinal=$this->altoCopia;
			}
			elseif($this->modo=="EscalaAlto"){
				$this->cordXCopia=0;
				$this->cordYCopia=0;
				$this->cordYOrig=0;
				$this->cordXOrig=0;
				$this->anchoOrigRecorte=$this->anchoOrig;
				$this->altoOrigRecorte=$this->altoOrig;
				$this->anchoCopia=$this->anchoOrig*$this->altoCopia/$this->altoOrig;
				if($this->chkgd2()){
					$GD2="si";
					$im_base=imagecreatetruecolor($this->anchoCopia,$this->altoCopia);
				}
				else{
					//para el viejo:
					$im_base = imagecreate ($this->anchoCopia,$this->altoCopia);
				}
				//Se fijan los tamaños absolutos finales para poder aplicar color de fondo
				$anchoFinal=$this->anchoCopia;
				$altoFinal=$this->altoCopia;
			}
			elseif($this->modo=="EscalaTotal"){
				if($this->chkgd2()){
					$GD2="si";
					$im_base=imagecreatetruecolor($this->anchoCopia,$this->altoCopia);
				}
				else{
					//para el viejo:
					$im_base = imagecreate ($this->anchoCopia,$this->altoCopia);
				}
				//Se fijan los tamaños absolutos finales para poder aplicar color de fondo
				$anchoFinal=$this->anchoCopia;
				$altoFinal=$this->altoCopia;
				$solucion=new Tijera_recuadro($this->altoOrig,$this->anchoOrig,$this->altoCopia,$this->anchoCopia,"EscalaTotal");
				$aSol=$solucion->calcular();
				//print_r($aSol);
				$this->cordXCopia=$aSol['posicionMarco_Xo'];
				$this->cordYCopia=$aSol['posicionMarco_Yo'];
				$this->cordXOrig=$aSol['recorteOriginal_Xo'];
				$this->cordYOrig=$aSol['recorteOriginal_Yo'];
				$this->anchoCopia=$aSol['posicionMarco_Xf'];
				$this->altoCopia=$aSol['posicionMarco_Yf'];
				$this->anchoOrig=$aSol['recorteOriginal_Xf'];
				$this->altoOrig=$aSol['recorteOriginal_Yf'];
				
			}
			elseif($this->modo=="EscalaModificada"){
				if($this->chkgd2()){
					$GD2="si";
					$im_base=imagecreatetruecolor($this->anchoCopia,$this->altoCopia);
				}
				else{
					//para el viejo:
					$im_base = imagecreate ($this->anchoCopia,$this->altoCopia);
				}
				//Se fijan los tamaños absolutos finales para poder aplicar color de fondo
				$anchoFinal=$this->anchoCopia;
				$altoFinal=$this->altoCopia;
				$solucion=new Tijera_recuadro($this->altoOrig,$this->anchoOrig,$this->altoCopia,$this->anchoCopia,"EscalaModificada");
				$aSol=$solucion->calcular();
				//print_r($aSol);
				$this->cordXCopia=$aSol['posicionMarco_Xo'];
				$this->cordYCopia=$aSol['posicionMarco_Yo'];
				$this->cordXOrig=$aSol['recorteOriginal_Xo'];
				$this->cordYOrig=$aSol['recorteOriginal_Yo'];
				$this->anchoCopia=$aSol['posicionMarco_Xf'];
				$this->altoCopia=$aSol['posicionMarco_Yf'];
				$this->anchoOrig=$aSol['recorteOriginal_Xf'];
				$this->altoOrig=$aSol['recorteOriginal_Yf'];
				
			}
			elseif($this->modo=="EscalaSimple"){
				$this->cordXCopia=0;
				$this->cordYCopia=0;
				$this->cordXOrig=0;
				$this->cordYOrig=0;
				$this->anchoCopia=$this->anchoCopia;
				$this->altoCopia=$this->altoCopia;
				$this->anchoOrig=$this->anchoOrig;
				$this->altoOrig=$this->altoOrig;
				
				if($this->anchoOrig>$this->altoOrig){
					$this->anchoCopia=$this->anchoCopia;
					$this->altoCopia=($this->altoOrig*$this->anchoCopia)/$this->anchoOrig;
				}
				else{
					$this->altoCopia=$this->altoCopia;
					$this->anchoCopia=($this->anchoOrig*$this->altoCopia)/$this->altoOrig;
				}
				
				$anchoFinal=$this->anchoCopia;
				$altoFinal=$this->altoCopia;
				if($this->chkgd2()){
					$GD2="si";
					$im_base=imagecreatetruecolor($this->anchoCopia,$this->altoCopia);
				}
				else{
					//para el viejo:
					$im_base = imagecreate ($this->anchoCopia,$this->altoCopia);
				}
				
			}
			
			///////////FIN DETERMINACION DE ESCALA  /////////////////////
			/*echo 'Alto Final: '.$this->altoCopia.'<br>';
			echo 'Ancho Final: '.$this->anchoCopia.'<br>';
			echo 'Posicion x de la copia en el final: '.$this->cordXCopia.'<br>';
			echo 'Posicion y de la copia en el final: '.$this->cordYCopia.'<br>';
			echo 'Posicion x del recorte en el original: '.$this->cordXOrig.'<br>';
			echo 'Posicion y del recorte en el original: '.$this->cordYOrig.'<br>';
			echo 'Ancho del recorte: '.$this->anchoOrig.'<br>';
			echo 'Alto del recorte: '.$this->altoOrig.'<br>';*/
			
			////////////INICIO COLOCACION COLOR DE FONDO //////////////////
			
			if($this->bgSet){
				//print_r($this->bg);
				$gdColor = imagecolorallocate($im_base,$this->bg['R'], $this->bg['G'],$this->bg['B']);
				//$gdColor = imagecolorallocate($im_base, 255, 0, 0);
				if(!$gdColor or $gdColor==-1){
					//echo "error: No se almacena el color de fondo (imagecolorallocate)";
					//exit();
				}
				//echo $anchoFinal. "  ";
				//echo $altoFinal. "  ";
				imagefilledrectangle($im_base,0,0,$anchoFinal,$altoFinal,$gdColor);
				imagerectangle ($im_base,0,0,$anchoFinal,$altoFinal,$gdColor);
				imagefill ( $im_base, 0, 0, $gdColor );

			}
			
			////////////FIN COLOCACION COLOR DE FONDO //////////////////
			
			if($GD2=="si"){
						imagecopyresampled ($im_base, $imagenx,
						$this->cordXCopia,
						$this->cordYCopia,
						$this->cordXOrig,
						$this->cordYOrig, 
						$this->anchoCopia,
						$this->altoCopia,
						$this->anchoOrig,
						$this->altoOrig);
					}
					else{
						//para el viejo: 
						imagecopyresized ($im_base, $imagenx,
							$this->cordXCopia,
							$this->cordYCopia,
							$this->cordXOrig,
							$this->cordYOrig, 
							$this->anchoCopia,
							$this->altoCopia,
							$this->anchoOrig,
							$this->altoOrig);
					}
			//exit();
			unlink ($descarte);
			imagedestroy($imagenx);
			if($datos_imagen['extension']=='.gif'){	
				$im=imagegif($im_base, $this->destino);
			}
			else{
				$im=imagejpeg($im_base, $this->destino ,90);
			}
			if(!$im){
					return false;
					echo "error: No se crea la imagen (imagejpeg)";
					exit();
			}
			else{
				imagedestroy($im_base);
				return true;
			}
		}
		else{
			//return false;
			echo "error: copia la imagen (copy)";
			exit();
		}
	
	}
	//fin metodo
	
	//Publico: calcula el tamaño que debe tener la copia achicándola a escala tomando un ancho fijo
	function aEscalaAncho($medida){
		$this->modo="EscalaAncho";
		$this->anchoCopia=$medida;
	}
	//fin metodo
	
	//Publico: calcula el tamaño que debe tener la copia achicándola a escala tomando un alto fijo
	function aEscalaAlto($medida){
		$this->modo="EscalaAlto";
		$this->altoCopia=$medida;
	}
	//fin metodo
	
	//Publico: calcula el tamaño que debe tener la copia achicándola a escala hasta que entre en el área indicada
	function aEscalaTotal($ancho,$alto){
		$this->modo="EscalaTotal";
		$this->anchoCopia=$ancho;
		$this->altoCopia=$alto;
	}
	//fin metodo
	
	//Publico: calcula el tamaño que debe tener la copia, recortando de los bordes si sobra
	function aEscalaModificada($ancho,$alto){
		$this->modo="EscalaModificada";
		$this->anchoCopia=$ancho;
		$this->altoCopia=$alto;
	}
	//fin metodo
	
	//Publico: calcula el tamaño que debe tener la copia achicándola a escala hasta que entre en el área indicada, pero sin rellenar los espacios con color de fondo
	function aEscalaSimple($ancho,$alto){
		$this->modo="EscalaSimple";
		$this->anchoCopia=$ancho;
		$this->altoCopia=$alto;
	}
	//fin metodo
	
	//Publico: le asigna un color de fondo a la imagen
	function setBackGround($colorHex){
		$this->bgSet=true;
		$aColores=$this->hexrgb($colorHex);
		$this->bg['R']=$aColores['red'];
		$this->bg['G']=$aColores['green'];
		$this->bg['B']=$aColores['blue'];
	}
	//fin metodo	
	
	//Privado: chequea la biblioteca disponible
	function chkgd2(){
		static $gd_version_number = null; 
		if ($gd_version_number === null) { 
			   // Use output buffering to get results from phpinfo() 
			   // without disturbing the page we're in.  Output 
			   // buffering is "stackable" so we don't even have to 
			   // worry about previous or encompassing buffering. 
			ob_start(); 
			phpinfo(8); 
			$module_info = ob_get_contents(); 
			ob_end_clean(); 
			if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", 
				 $module_info,$matches)) { 
				$gd_version_number = $matches[1]; 
			} else { 
				$gd_version_number = 0; 
			} 
		} 
		if( $gd_version_number>=2){
			return true;
		}
		else{
			return false;
		} 
	}
	//fin metodo
	
	//Privado: traduce valores hexa de color a decimal
	function hexrgb ($hexstr)
	{
  		$int = hexdec($hexstr);
  		return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);
	}
	//fin metodo
}
?>
