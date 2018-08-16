<?php

class PF{





	/************************** FLASH */

	

	function cleanContentForFlashXML($contenido){

		$contenido=str_replace('\\"','"',$contenido);

		$contenido=PF::replaceTag('strong','b',$contenido);

		$contenido=PF::replaceTag('em','i',$contenido);

		$arrayPermitidos=array('<a>','<i>','<b>','<font>','<p>','<u>','<br>','<img>','<li>','<span>','<textformat>');

		$contenido=strip_tags($contenido, implode('',$arrayPermitidos));



		$contenido=PF::toUTF8(html_entity_decode(PF::toLATIN1($contenido), ENT_QUOTES, 'ISO-8859-1'));



		return $contenido;

	}



	/*************************** FIN FLASH */



	/**************************** CODIFICACION */



	function toUTF8($string){

		if(function_exists('mb_convert_encoding')){

			return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));

		}

		if(function_exists('iconv')){

			return iconv("ISO-8859-1","UTF-8",$string);

		}

		return utf8_encode($string);

	}



	function toLATIN1($string){

		if(function_exists('mb_convert_encoding')){

			return mb_convert_encoding($string, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));

		}

		if(function_exists('iconv')){

			return iconv("UTF-8","ISO-8859-1",$string);

		}

		return utf8_decode($string);

	}



	/******************************* FIN CODIFICACION */



	/******************************** HTML PARSER */



	function replaceInitTag($tag,$replace,$content){

		return preg_replace( "/<( \t\n\r)*$tag(>|[^>]*>)/i", $replace,$content);

	}



	function replaceFinishTag($tag,$replace,$content){

		return preg_replace( "/<( \t\n\r)*\/( \t\n\r)*$tag(>|[^>]*>)/i", $replace,$content );

	}



	function replaceTag($tag,$replace,$content){

		$content=PF::replaceInitTag($tag,'<'.$replace.'>',$content);

		$content=PF::replaceFinishTag($tag,'</'.$replace.'>',$content);

		return $content;

	}



	/*********************************** FIN HTML PARSER */





	/*********************************  JAVASCRIPT */



	/**

	 * Genera el relleno de un formulario

	 *

	 * @param string $idForm

	 * @param string $array

	 * @return javascript

	 */

	function postBack($idForm,$array){

		if(count($array)==0){

			return true;

		}

		$string=array();

		$string[]= '<script type="text/javascript">';

		$string[]='<!--//--><![CDATA[<!--';

		foreach($array as $variable=>$valor){

			if(is_array($valor)){

				foreach($valor as $item2){

					$string[]="PFHTML.rellenarDato('$idForm','$variable".'[]'."','".rawurlencode($item2)."');";

				}

			}

			else{

				$string[]="PFHTML.rellenarDato('$idForm','$variable','".rawurlencode($valor)."');";

			}

		}

		$string[]='//--><!]]>';

		$string[]='</script>';

		echo implode("\r\n",$string);



	}



	/**

	 * Chequea que el navegador del usuario tenga habilitado javascript y si 

	 * no lo tiene redirecciona al navegador

	 * 

	 * @param url $destino

	 */

	function checkJavascript($destino){

		echo '<noscript><meta http-equiv="refresh" content="0;'.$destino.'/></noscript>';

	}





	/**************************** FIN JAVASCRIPT */





	/***************************** TRATAMIENTO GET POST */



	/*

	code

	Recibe: un vector de variables, globales (get o post)

	Devuelve: una cadena codificada con todos los valores

	Tarea: codifica el vector GET o POST para volver al mismo ambiente anterior

	*/

	function code($array){

		return base64_encode(serialize($array));

	}



	/*

	decode

	Recibe: un string codificado con code

	Devuelve: el vector correspondiente

	Tarea: Regenera el vector GET o POST para volver al mismo ambiente anterior

	*/

	function decode($string){

		return unserialize(base64_decode($string));

	}



	/********************************* FIN TRATAMIENTO GET POST */







	/********************************* ARCHIVOS  */



	/*

	* extension

	* recibe: una cadena de archivo

	* devuelve:la extensiÃ³n del archivo

	*/

	function extension($cadena){

		return substr($cadena,strrpos($cadena,'.')+1,strlen($cadena));

	}



	/*

	* duplicar

	* Recibe: un path de una carpeta y un path destino

	* Devuelve: nada

	* Copia recursivamente una estructura de directorios y archivos

	*/

	function duplicarDir($folder,$folderDest){

		if(!file_exists($folderDest) || !is_dir($folderDest)){

			mkdir($folderDest);

		}

		$dp=opendir($folder);

		while($elem=readdir($dp)){

			//echo $elem.'<br>';

			if(is_dir($folder.'/'.$elem) && $elem!='.' && $elem!='..'){

				duplicarDir($folder.'/'.$elem,$folderDest.'/'.$elem);

			}

			elseif(!is_dir($folder.'/'.$elem)){

				copy($folder.'/'.$elem,$folderDest.'/'.$elem);

			}

		}

	}



	/*

	* eraseDir

	* Recibe: un path de una carpeta

	* Devuelve: nada

	* Elimina recursivamente una estructura de directorios y archivos

	*/

	function eraseDir($folder){

		if(!file_exists($folder) || !is_dir($folder)){

			return false;

		}

		$dp=opendir($folder);

		while($elem=readdir($dp)){

			//echo $elem.'<br>';

			if(is_dir($folder.'/'.$elem) && $elem!='.' && $elem!='..'){

				eraseDir($folder.'/'.$elem);

			}

			elseif(!is_dir($folder.'/'.$elem)){

				unlink($folder.'/'.$elem);

			}

		}

		closedir($dp);

		rmdir($folder);

	}



	/**

	 * Publico: descarga un archivo

	 *

	 * @param path $ruta

	 * @param string $nombreFile

	 */

	function dowloadFile($ruta,$nombreFile){

		$filename=$nombreFile.'.'.PF::extension(basename($ruta));

		$size = filesize($ruta);

		header("Pragma: public");

		header("Expires: 0");

		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		header("Cache-Control: private",false);

		header("Content-Type: application/octet-stream");

		header("Content-Disposition: attachment; filename=\"".$filename."\";");

		header("Content-Transfer-Encoding: binary");

		header("Content-Length: ".$size);

		echo PF::readFile($ruta);

		exit();

	}

	

	/**

	 * Publico: devuelve el contenido de un archivo

	 *

	 * @param path $ruta

	 * @return string

	 */

	function readFile($ruta){

		$fp=fopen($ruta,'rb');

		$content=fread($fp,filesize($ruta));

		fclose($fp);

		return $content;

	}

	

	/**

	 * Publico: elimina un archivo en caso de existir

	 *

	 * @param path $ruta

	 */

	function deleteFile($ruta){

		if(PF::isFile($ruta)){

			chmod($ruta, 0777);

			unlink($ruta);

		}

	}

	

	/**

	 * Publico: indica si un archivo existe

	 *

	 * @param path $ruta

	 * @return bool

	 */

	function isFile($ruta){

		if(file_exists($ruta) && is_file($ruta)){

			return true;

		}

		return false;

	}

	/********************************** FIN ARCHIVOS */





	/************************************ VALIDACION */

	/*

	* checkFileType

	* Recibe: array de tipos correctos, un type de archivo

	* Devuelve: bool

	* Indica si el archivo se encuentra dentro de los types especificados

	*/

	function checkFileType($aTypes,$fileType){

		$ok=false;

		$fileTipe=strtolower($fileType);



		foreach($aTypes as $item){

			if($item=='gifJpg'){

				if(preg_match('/gif/i',$fileType) || preg_match('/jpeg/i',$fileType) || preg_match('/pjpeg/i',$fileType) || preg_match('/jpg/i',$fileType)){

					$ok=true;

					break;

				}

			}

			if($item=='gif'){

				if(preg_match('/gif/i',$fileType)){

					$ok=true;

					break;

				}

			}

			if($item=='jpg'){

				if(preg_match('/jpeg/i',$fileType) || preg_match('/pjpeg/i',$fileType) || preg_match('/jpg/i',$fileType)){

					$ok=true;

					break;

				}

			}

			if($item=='video'){

				if(preg_match('/video/i',$fileType)){

					$ok=true;

					break;

				}

			}

		}

		return $ok;

	}

	

	/*

	* checkmail

	* Recibe: string de cadena

	* Devuelve: bool

	* Indica si el mail es válido

	*/

	function checkmail($email){

		if(!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email)) {

			return false;

		}

		else{

			return true;

		}

	}



	/********************************* FIN VALIDACION */



	/********************************* HTML */



	/*

	* cutText

	* Permite tomar una porción de una cadena sin danar las palabras

	*

	*/

	function cutText($string, $length) {

		if(strlen($string)<=$length){

			return $string;

		}

		$partes=explode(' ',$string);

		$longitud=0;

		$partesFinales=array();

		foreach($partes as $cad){

			if($longitud>=$length){

				return implode(' ',$partesFinales);

			}

			$partesFinales[]=$cad;

			$longitud+=strlen($cad);

		}

		return implode(' ',$partesFinales);

	}



	/**

	 * Publico: Devuelve una porción del texto determinada por longitud sin dañar las palabras

	 *

	 * @param string $cadena

	 * @param int $longitud

	 * @return string

	 */

	function cutHtmlText($cadena,$longitud){

		return PF::cutText(strip_tags($cadena),$longitud);

	}



	/**

	 * Publico: devuelve las medidas a las que se debería mostrar la imagen a escala

	 *

	 * @param path $ruta

	 * @param int $maxW

	 * @param int $maxH

	 * @return array

	 */

	function escalarImagen($ruta,$maxW,$maxH){

		$medidas=getimagesize($ruta);

		if($medidas[0]>$medidas[1]){

			$anchoFinal=$maxH;

			$altoFinal=($medidas[1]*$maxH)/$medidas[0];

		}

		else{

			$altoFinal=$maxH;

			$anchoFinal=($medidas[0]*$altoFinal)/$medidas[1];

		}

		return array($anchoFinal,$altoFinal);

	}



	/**

	 * Decodifica una url GET codificada como un solo string de base64

	 *

	 * 

	 */

	function decodeURL(){

		if(isset($_GET['q'])){

			$string=base64_decode(urldecode($_GET['q']));

			$array=explode('&',$string);

			$_GET=array();

			foreach($array as $dato){

				$d=explode('=',$dato);

				$_GET[$d[0]]=$d[1];

			}

		}

		else{

			$this->GET=$_GET;

		}

	}





	/**

	 * Estático: codifica una cadena de url para decodificar con decodeURL

	 *

	 * @param string $string

	 */

	function encodeURL($string,$return=NULL){

		if(!is_null($return)){

			return 'q='.urlencode(base64_encode($string));

		}

		echo 'q='.urlencode(base64_encode($string));

	}





	/**

	 * Estático: permite imprimir una cadena con las trasformaciones de caracteres

	 * a html

	 *

	 * @param strings $string

	 */

	function html($string,$bool=false){

		if(defined($string) && !is_null(constant($string))){

				$string=constant($string);

		}

		if($bool){

			return preg_replace('/[^\x00-\x7F]/e', '"&#".ord("$0").";"', $string);

		}

		echo  preg_replace('/[^\x00-\x7F]/e', '"&#".ord("$0").";"', $string);



	}



	/*

	* listaSelect:Estático

	* Recibe: un vector, dos indices del vector, string de estilo, seleccionado

	* Devuelve: el contenido de un select ya armado

	*/

	function listaSelect($vector,$value,$etiqueta,$estilo=NULL,$seleccionado=NULL){

		$array=array();

		$i=0;

		if(!is_null($estilo)){

			$estilo=' class="'.$estilo.'" ';

		}

		else{

			$estilo='';

		}

		foreach($vector as $item){

			if(!is_null($seleccionado) && $seleccionado==$item[$value]){

				$selected=' selected="selected" ';

			}

			else{

				$selected='';

			}

			$array[$i]='<option value="'.$item[$value].'"'.$estilo.$selected.'>'.htmlspecialchars($item[$etiqueta]).'</option>';

			$i++;

		}

		return implode("\r\n",$array);

	}







	/**************************************** FIN HTML */





	/************************** PATH */

	

	function getPath($ruta){

		

		if(defined('PF_CONFIG_SYSTEM_PATH')){
			$profundidadActual=str_replace('^'.PF_CONFIG_SYSTEM_PATH,'',$_SERVER['PHP_SELF']);


			$profundidad=substr_count($profundidadActual,'/');

		}

		else{

			$profundidad=$_SERVER['PHP_SELF'];

		}

		for($i=1; $i<$profundidad; $i++){

			$ruta='../'.$ruta;

		} 
		//echo $ruta;
		return $ruta;

	}

	

	function addRuta($arrayData,$field,$ruta){

		foreach($arrayData as $ind => $data){

			if(is_array($data)){

				if(trim($arrayData[$ind][$field])!=''){

					$arrayData[$ind][$field]=$ruta.'/'.$arrayData[$ind][$field];

				}

			}

			else{

				if(trim($arrayData[$field])!=''){

					$arrayData[$field]=$ruta.'/'.$arrayData[$field];

				}

			}

		}

		return $arrayData;

	}

	

	/************************** FIN PATH ***/

	

	/**************************** FORMATEOS ****************/

	

	function forzarArrayStrings(&$vector){

		$lista=func_get_args();

		array_shift($lista); 

		PF::forzarArrayTipo('string',$vector,$lista,'');

	}

	

	function forzarArrayIntegers(&$vector){

		$lista=func_get_args();

		array_shift($lista); 

		PF::forzarArrayTipo('integer',$vector,$lista,0);

	}

	

	function forzarArrayDoubles(&$vector){

		$lista=func_get_args();

		array_shift($lista); 

		PF::forzarArrayTipo('double',$vector,$lista,0.0);

	}

	

	function forzarArrayTipo($tipo,&$vector,$lista,$defecto=null){

		foreach($lista as $var){

			if(!isset($vector[$var])){

				$vector[$var]=$defecto;

			}

			settype($vector[$var],$tipo);

		}

	}

	

	function traducirDate($variable,$orden){

		$anio=1;

		$mes=1;

		$dia=1;

		$hora=1;

		$minuto=1;

		$segundo=1;

		//echo $variable;

		$partes=explode(' ',$variable);

		$fecha=$partes[0];

		$horario='';

		if(isset($partes[1])){

			$horario=$partes[1];

		}

		

		if ( preg_match( "/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/i", $fecha, $regs ) ) {

			$anio=$regs[1];

			$mes=$regs[2];

			$dia=$regs[3];

			

		} 

		elseif ( preg_match( "/([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})/i", $fecha, $regs ) ) {

			$anio=$regs[3];

			$mes=$regs[2];

			$dia=$regs[1];

			

		} 

		elseif ( preg_match( "/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/i", $fecha, $regs ) ) {

			$anio=$regs[1];

			$mes=$regs[2];

			$dia=$regs[3];

			

		} 

		elseif ( preg_match( "/([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})/i", $fecha, $regs ) ) {

			$anio=$regs[3];

			$mes=$regs[2];

			$dia=$regs[1];

			

		}

		elseif ( preg_match( "/([0-9]{8})/i", $fecha) ) {

			$anio=substr($variable,0,4);

			$mes=substr($variable,4,2);

			$dia=substr($variable,6,2);

		} 

		else{

			$anio=date("Y",$fecha);

			$mes=date("m",$fecha);

			$dia=date("d",$fecha);

			$hora=date("d",$fecha);

			$minuto=date("i",$fecha);

			$segundo=date("s",$fecha);

		}

		

		if(preg_match( "/([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $horario, $regs)){

			$hora=$regs[1];

			$minuto=$regs[2];

			$segundo=$regs[3];

		}

		elseif(preg_match( "/([0-9]{2})([0-9]{2})([0-9]{2})/i", $horario, $regs)){

			$hora=$regs[1];

			$minuto=$regs[2];

			$segundo=$regs[3];

		}

		

		if($orden=='TIMESTAMP'){

			return mktime($hora,$minuto,$segundo,$mes,$dia,$anio);

		}

		

		$arrayData['Y']=$anio;

		$arrayData['m']=$mes;

		$arrayData['d']=$dia;

		$arrayData['h']=$hora;

		$arrayData['i']=$minuto;

		$arrayData['s']=$segundo;

		

		foreach($arrayData as $var => $val){

			$orden=str_replace($var,$val,$orden);

		}

		

		return $orden;

	}

	

	function date($string,$time=null){

		if(!is_null($time)){

			return date($string,$time);

		}

		return date($string);

	}

	

	

	function arrayToCSV($array, $delimiter = ',', $enclosure = '"', $terminator = "\n") {

		# First convert associative array to numeric indexed array

		foreach ($array as $key => $value){

			$workArray[] = str_replace("\r",'',str_replace("\n",'',$value));

		}



		$returnString = '';                 # Initialize return string

		$arraySize = count($workArray);     # Get size of array



		for ($i=0; $i<$arraySize; $i++) {

			# Nested array, process nest item

			if (is_array($workArray[$i])) {

				$returnString .= PF::arrayToCSV($workArray[$i], $delimiter, $enclosure, $terminator);

			} 

			else {

				switch (gettype($workArray[$i])) {

					# Manually set some strings

					case "NULL":     $_spFormat = ''; break;

					case "boolean":  $_spFormat = ($workArray[$i] == true) ? 'true': 'false'; break;

					# Make sure sprintf has a good datatype to work with

					case "integer":  $_spFormat = '%i'; break;

					case "double":   $_spFormat = '%0.2f'; break;

					case "string":   $_spFormat = '%s'; break;

					# Unknown or invalid items for a csv - note: the datatype of array is already handled above, assuming the data is nested

					case "object":

					case "resource":

					default:         $_spFormat = ''; break;

				}

				$returnString .= sprintf('%2$s'.$_spFormat.'%2$s', $workArray[$i], $enclosure);

				$returnString .= ($i < ($arraySize-1)) ? $delimiter : $terminator;

			}

		}

		# Done the workload, return the output information

		return $returnString;

	}

	

	/*************************** FIN FORMATEOS **********/

}

?>