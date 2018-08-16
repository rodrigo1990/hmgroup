<?
/*
* Class Mail HTML
* Permite el envío de emails en html levantando el html desde una plantilla
* Esta versión además permite adjuntar archivos
* Sigue siendo compatible con la versión anterior
*
*/
class mailHTML{
	
	//propiedades publicas
	
	
	//propiedades privadas
	var $con;
	var $plantilla;
	var $to;
	var $asunto;
	var $origen;
	var $origen_nombre;
	var $encabezado;
	var $url;
	var $simulado;
	var $uid;
	var $crlf;
	var $adjuntos;
	var $mail_priority;
	
	/**
	 * Constructor
	 *
	 * @return mailHTML
	 */
	function mailHTML(){
		$this->origen='';
		$this->origen_nombre='';
		$this->url='';
		$this->simulado=false;
		$this->crlf="\r\n";
		$this->adjuntos=array();
		$this->mail_priority=3; // 3 = normal, 2 = high, 4 = low
		$this->uid='';
	}
	//fin constructor
	
	
	/**
	 * Publico: levanta la plantilla HTML
	 *
	 * @param unknown_type $direccion
	 */
	function getPlantilla($direccion){
		$this->plantilla=$this->get_file_data($direccion);
	}
	//fin metodo
	
	
	/**
	 * Publico: especifica los reemplazos a efectuar sobre la plantilla
	 *
	 * @param unknown_type $direccion
	 */
	function replace($cadena,$valor){
		$this->plantilla=str_replace($cadena,$valor,$this->plantilla);
	}
	//fin metodo
	
	/**
	 * Publico: envia el email
	 *
	 * @param unknown_type $direccion
	 */
	function send(){
		$this->headers();
		$this->replace('{URL}',$this->url);
		//echo $this->encabezado;
		if(count($this->adjuntos)>0){
			$this->plantilla=$this->complete_headers($this->plantilla);
			foreach ($this->adjuntos as $val) {
				$this->plantilla .= $val;
			}
			$this->plantilla .= "--".$this->uid."--";
		}
		if($this->simulado){
			echo $this->encabezado;
			echo "<br><br>\r\n\r\n";
			echo $this->plantilla;
			return true;
		}
		if(@mail($this->to,$this->asunto,$this->plantilla,$this->encabezado)){
				return true;
		}
		else{
			return false;
		}
	}
	//fin metodo	
	
	
	/**
	 * Privado: arma los encabezados para el mail
	 *
	 * @param unknown_type $direccion
	 */
	function headers(){
		$to=$this->to;
		$origen=$this->origen;
		$asunto=$this->asunto;
		$headers="";
		$headers .= "X-Sender: $origen <$origen>".$this->crlf; 
		$headers .= "From: ".$this->origen_nombre." <$origen>".$this->crlf;
		$headers .= "Reply-To: $origen <$origen>".$this->crlf;
		$headers .= "Date: ".date("r").$this->crlf;
		$headers .= "Message-ID: <".date("YmdHis")."info@".$_SERVER['SERVER_NAME'].">".$this->crlf;
		$headers .= "Subject: $asunto".$this->crlf; 
		$headers .= "Return-Path: $origen <$origen>".$this->crlf;
		$headers .= "Delivered-to: $origen <$origen>".$this->crlf;
		if(count($this->adjuntos)==0){
			$headers .= "MIME-Version: 1.0".$this->crlf;
			$headers .= "Content-type: text/html;charset=ISO-8859-9".$this->crlf;
			$headers .= "X-Priority: 1".$this->crlf;
			$headers .= "Importance: High".$this->crlf;
			$headers .= "X-MSMail-Priority: High".$this->crlf;
			$headers .= "X-Mailer: php".$this->crlf;
		}
		else{
			$headers .= "MIME-Version: 1.0".$this->crlf;
			$headers .= "X-Mailer: php".$this->crlf;
			$headers .= "X-Priority: ".$this->mail_priority.$this->crlf;
			$headers .= "Content-Type: multipart/mixed;".$this->crlf.chr(9)." boundary=\"".$this->uid."\"".$this->crlf.$this->crlf;
		}
		//echo $headers;
		$this->encabezado=$headers;
	}
	//fin metodo
	
	/**
	 * Publico: elimina todos los datos anteriores para enviar un nuevo email
	 *
	 */
	function clean(){
		$this->plantilla='';
		$this->to='';
		$this->asunto='';
		$this->encabezado='';
	}
	//fin metodo
	
	/**
	 * Privado: crea un id para separar los adjuntos en el email
	 *
	 */
	function create_mime_boundry() {
		$this->uid = "_".md5(uniqid(time()));
	}
	
	
	/**
	 * Privado:obtiene el contenido del archivo a adjuntar
	 *
	 * @param unknown_type $filepath
	 */
	function get_file_data($filepath){
		if(function_exists('file_get_contents')){
			$str=file_get_contents($filepath);
		}
		else{
			$fp=fopen($filepath,"rb");
			if(!$fp){
				$this->error("NO SE PUDO LEER EL ARCHIVO A ADJUNTAR");
			}
			$str=fread($fp,filesize($filepath));
			fclose($fp);
		}
		return $str;
	}
	
	
	/**
	 * Privado: manejo de errores de clase
	 *
	 * @param unknown_type $msg
	 */
	function error($msg){
		echo $msg;
		exit();
	}
	
	
	/**
	 * Publico: añade un adjunto al email
	 * $dispo puede valer "attachment" o "inline"
	 * @param  $file: ruta al archivo a adjuntar
	 * @param  $dispo: content_disposition
	 * @param  $file_type: tipo MIME de archivo
	 * @param  $filename: nombre de archivo final
	 */
	function create_attachment_part($file,$filename,$file_type, $dispo = "attachment") {
		if($this->uid==''){
			$this->create_mime_boundry();
		}
		$file_str = $this->get_file_data($file);
		if ($file_str == "") {
			$this->error("EL ARCHIVO A ADJUNTAR SE ENCUENTRA VACÍO");
		} 
		else {
			//SE ALMACENA EL NOMBRE AISLADO DEL ARCHIVO
			$filename = basename($filename);
			//SE DIVIDE EN LINEAS DE ACUERDO A LA NORMA DE EMAIL
			$chunks = chunk_split(base64_encode($file_str));
			//SE AGREGAN ENCABEZADOS
			$mail_part = "--".$this->uid.$this->crlf;
			$mail_part .= "Content-type:".$file_type.";".$this->crlf.chr(9)." name=\"".$filename."\"".$this->crlf;
			$mail_part .= "Content-Transfer-Encoding: base64".$this->crlf;
			$mail_part .= "Content-Disposition: ".$dispo.";".chr(9)."filename=\"".$filename."\"".$this->crlf.$this->crlf;
			$mail_part .= $chunks;
			$mail_part .= $this->crlf.$this->crlf;
			//SE AGREGA A LA LISTA DE ADJUNTOS
			$this->adjuntos[] = $mail_part;
		}			
	}
	
	/**
	 * Privado: modifica el mensaje html agregando los encabezados necesarios
	 * de un mail multipart
	 *
	 * @param unknown_type $mensaje
	 * @param unknown_type $cont_tranf_enc
	 * @param unknown_type $type
	 * @param unknown_type $enc
	 * @return unknown
	 */
	function complete_headers($mensaje, $cont_tranf_enc = "7bit", $type = "text/html", $enc = "iso-8859-1"){
		$str = "--".$this->uid.$this->crlf;
		$str .= "Content-type:".$type."; charset=".$enc.$this->crlf;
		$str .= "Content-Transfer-Encoding: ".$cont_tranf_enc.$this->crlf.$this->crlf;
		$str .= trim($mensaje).$this->crlf.$this->crlf;
		return $str;
	}
	
}
?>