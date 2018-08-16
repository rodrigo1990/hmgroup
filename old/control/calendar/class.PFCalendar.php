<?
class PFCalendar{
	
	
	
	var $arrayPropiedades;
	var $arrayEventos;
	var $nombre;
	var $anio;
	var $mes;
	var $destino;
	var $idioma;
	var $idiomas=array();
	
	function PFCalendar($nombre, $destino, $idioma=NULL,$anio=NULL,$mes=NULL){
		
		$this->idiomas=array(1=>'es',2=>'en');
		
		$this->nombre=$nombre;
		$this->destino=$destino;
		if(!$idioma){
			$idioma=1;
		}
		$this->idioma=$idioma;
		if(is_null($anio)){
			$anio=date("Y");
		}
		$this->anio=$anio;
		if(is_null($mes)){
			$mes=date("m");
		}
		$this->mes=$mes;
		
		$this->init();
	}
	
	function init(){
		
		$this->arrayEventos=array();
		
		$this->arrayPropiedades=array(
			'link'=>'',
			'offset'=>'1',
			'name'=>$this->nombre,
			'fixed'=>'0',   //No aparecen flechas para cambiar de mes
			'weekNumbers'=>'false',
			'year'=>$this->anio,
			'month'=>$this->mes,
			'tFontFace'=>'Arial, Helvetica', // title:
			'tFontSize'=>'14',
			'tFontColor'=>'#333333',
			'tBGColor'=>'#E4E4E4',
			'hFontFace'=>'Arial, Helvetica',  //heading
			'hFontSize'=>'12',
			'hFontColor'=>'#333333',
			'hBGColor'=>'#E4E4E4',
			'dFontFace'=>'Arial, Helvetica', //days
			'dFontSize'=>'14',
			'dFontColor'=>'#333333',
			'dBGColor'=>'#E4E4E4',
			'wFontFace'=>'Arial, Helvetica',  //weeks
			'wFontSize'=>'12',
			'wFontColor'=>'#333333',
			'wBGColor'=>'#E4E4E4',
			'saFontColor'=>'#333333',        //saturday
			'saBGColor'=>'#E4E4E4',
			'suFontColor'=>'#FF3300',		//sunday
			'suBGColor'=>'#E4E4E4',
			'tdBorderColor'=>'#FF0000',  //today
			'borderColor'=>'#000000',   //border
			'hilightColor'=>'#669999'  //hilight
		);
	}
	
	function setProperty($prop,$value){
		$this->arrayPropiedades[$prop]=$value;
	}
	
	function setCalendar($return=false){
		
		$string=array();
		$string[]='<script type="text/javascript">';
		$string[]= $this->nombre ."= new CALENDAR(".$this->anio.",".$this->mes.",'".$this->idiomas[$this->idioma]."');";
		foreach($this->arrayPropiedades as $prop=> $value){
			if(!is_numeric($value) && $value!='false' && $value!='true'){
				$value="'".$value."'";
			}
			$string[]= $this->nombre .".".$prop."=".$value.";";
		}
		
		foreach($this->arrayEventos as $item){
			$finDia=$item['dia']+1;
			if(trim($item['link']!='')){
				$string[]= $this->nombre .".viewEvent(".$item['anio'].",".$item['mes'].",".$item['dia'].", ".$item['dia'].", '".$item['color']."', '".$item['texto']."', '".$item['link']."');";
			}
			else{
				$string[]= $this->nombre .".viewEvent(".$item['anio'].",".$item['mes'].",".$item['dia'].", ".$item['dia'].", '".$item['color']."', '".$item['texto']."');";
			}
		}
		$string[]=$this->nombre .'.addCalendar(\''.$this->destino.'\');';
		$string[]='</script>';
		
		$finalString=implode("\n",$string);
		if($return){
			return $finalString;
		}
		else{
			echo $finalString;
		}
		
	}
	
	function setEvento($anio,$mes,$dia,$color,$texto,$link=''){
		$texto=str_replace("'","\\'",$texto);
		$texto=str_replace('"',"",$texto);
		$this->arrayEventos[]=array('anio'=>$anio,'mes'=>$mes,'dia'=>$dia,'color'=>$color,'texto'=>$texto,'link'=>$link);
	}

	
	
/*	
<script type="text/javascript">

myCal = new CALENDAR(2008,9,'es');
myCal.name='myCal';
myCal.link = 'test.html';                      // page to link to when day is clicked
myCal.offset = 1;   
myCal.weekNumbers  =false;            

 myCal.viewEvent(6, 8, "#E0E0FF", "Seminar &quot;How to use HTML-Calendar&quot;");
 myCal.viewEvent(15, 19, "#D0FFD0", "Trip to Hawaii!", "/trips/hawaii/index.php");

myCal.year = 2004;
myCal.month = 12;
myCal.tFontFace = 'Arial, Helvetica'; // title: font family (CSS-spec, e.g. "Arial, Helvetica")
  myCal.tFontSize = 14;                 // title: font size (pixels)
  myCal.tFontColor = '#333333';         // title: font color
  myCal.tBGColor = '#E4E4E4';           // title: background color

  myCal.hFontFace = 'Arial, Helvetica'; // heading: font family (CSS-spec, e.g. "Arial, Helvetica")
  myCal.hFontSize = 12;                 // heading: font size (pixels)
  myCal.hFontColor = '#333333';         // heading: font color
  myCal.hBGColor = '#E4E4E4';           // heading: background color

  myCal.dFontFace = 'Arial, Helvetica'; // days: font family (CSS-spec, e.g. "Arial, Helvetica")
  myCal.dFontSize = 14;                 // days: font size (pixels)
  myCal.dFontColor = '#333333';         // days: font color
  myCal.dBGColor = '#E4E4E4';           // days: background color

  myCal.wFontFace = 'Arial, Helvetica'; // weeks: font family (CSS-spec, e.g. "Arial, Helvetica")
  myCal.wFontSize = 12;                 // weeks: font size (pixels)
  myCal.wFontColor = '#333333';         // weeks: font color
  myCal.wBGColor = '#E4E4E4';           // weeks: background color

  myCal.saFontColor = '#333333';        // Saturdays: font color
  myCal.saBGColor = '#E4E4E4';          // Saturdays: background color

  myCal.suFontColor = '#FF3300';        // Sundays: font color
  myCal.suBGColor = '#E4E4E4';          // Sundays: background color

  myCal.tdBorderColor = '#333333';      // today: border color

  myCal.borderColor = '#000000';        // border color
  myCal.hilightColor = '#669999';       // hilight color (works only in combination with link)

//document.write(myCal.create());


</script>*/
}
?>