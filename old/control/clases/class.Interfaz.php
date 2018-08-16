<?php
class Interfaz{
	
	function dateToInterfaz($variable){
		$ln="\n";
		$varDia='dia_'.$variable;
		$varMes='mes_'.$variable;
		$varAnio='anio_'.$variable;
			
		$string='<span>D&iacute;a:</span>'.$ln;
        $array=array();
        for($i=1;$i<32;$i++){
            $array[sprintf("%02d",$i)]=sprintf("%02d",$i);
        }
        $string.=Interfaz::armarSelect($array,$varDia);
               
        $string.='<span>Mes:</span>'.$ln;
        $array=array();
        for($i=1;$i<13;$i++){
            $array[sprintf("%02d",$i)]=sprintf("%02d",$i);
        }
        $string.=Interfaz::armarSelect($array,$varMes);
        
        
        $string.='<span>A&ntilde;o:</span>'.$ln;
        $array=array();
        $array[2008]=2008;
        $array[2009]=2009;
        $string.=Interfaz::armarSelect($array,$varAnio);
        
        return $string;
	}
	
	function dateTimeToInterfaz($variable){
		
		$ln="\n";
		$varHora='hora_'.$variable;
		$varMinuto='minuto_'.$variable;
	
		$string=Interfaz::dateToInterfaz($variable);
        
        $string.=' <span>Hora:</span>'.$ln;
        $array=array();
        for($i=1;$i<24;$i++){
            $array[sprintf("%02d",$i)]=sprintf("%02d",$i);
        }
        $string.=Interfaz::armarSelect($array,$varHora);
        
        $string.='<span>Minuto:</span>'.$ln;
        $string.='<input type="text" size="4" maxlength="2" id="'.$varMinuto.'" name="'.$varMinuto.'">'.$ln;           
		return $string;
	}
	
	function interfazToDateTime($variable,$arrayOrigen){
		return interfazToDate($variable,$arrayOrigen).sprintf("%02d",$arrayOrigen['hora_'.$variable]).sprintf("%02d",$arrayOrigen['minuto_'.$variable]).'00';
	}
	
	function interfazToDate($variable,$arrayOrigen){
		return $arrayOrigen['anio_'.$variable].sprintf("%02d",$arrayOrigen['mes_'.$variable]).sprintf("%02d",$arrayOrigen['dia_'.$variable]);
	}
	
	function desdoblarDateTime($variable,&$arrayData){
		$varDia='dia_'.$variable;
		$varMes='mes_'.$variable;
		$varAnio='anio_'.$variable;
		$varHora='hora_'.$variable;
		$varMinuto='minuto_'.$variable;
		
		$partes=explode(' ',$arrayData[$variable]);
		$partesHora=explode(':',$partes[1]);
		$partesFecha=explode('-',$partes[0]);
		
		$arrayData[$varAnio]=$partesFecha[0];
		$arrayData[$varMes]=$partesFecha[1];
		$arrayData[$varDia]=$partesFecha[2];
		$arrayData[$varHora]=$partesHora[0];
		$arrayData[$varMinuto]=$partesHora[1];
	}
	
	function traducirDateTime($variable,$orden){
		$partes=explode(' ',$variable);
		$partesHora=explode(':',$partes[1]);
		$partesFecha=explode('-',$partes[0]);
		
		$arrayData['Y']=$partesFecha[0];
		$arrayData['m']=$partesFecha[1];
		$arrayData['d']=$partesFecha[2];
		$arrayData['h']=$partesHora[0];
		$arrayData['i']=$partesHora[1];
		
		foreach($arrayData as $var => $val){
			$orden=str_replace($var,$val,$orden);
		}
		
		return $orden;
	}
	
	function desdoblarDate($variable,&$arrayData){
		$varDia='dia_'.$variable;
		$varMes='mes_'.$variable;
		$varAnio='anio_'.$variable;	
		
		$partesFecha=explode('-',$arrayData[$variable]);
		
		$arrayData[$varAnio]=$partesFecha[0];
		$arrayData[$varMes]=$partesFecha[1];
		$arrayData[$varDia]=$partesFecha[2];
	}
	
	function armarOptions($arrayData,$selected=NULL){
		$aStr=array();
		foreach($arrayData as $ind => $val){
			if(is_null($selected) || $selected!=$ind){
				$aStr[]='<option value="'.$ind.'">'.$val.'</option>';
			}
			else{
				$aStr[]='<option value="'.$ind.'" selected="selected">'.$val.'</option>';
			}
		}
		return implode("\r\n",$aStr);
	}
	
	function armarSelect($array,$id){
		$ln="\n";	
		$string='<select name="'.$id.'"  id="'.$id.'">'.$ln;
        $string.=Interfaz::armarOptions($array);
        $string.='</select>'.$ln;
        return $string;
	}
	
	function arrayToOptions($array,$value,$text,$selected=null,$atrib=null){
		$aStr=array();
		foreach($array as $item){
			$itemSelectado='';
			$atributos='';
			if(!is_null($selected) && $selected==$item[$value]){
				$itemSelectado='selected="selected"';
			}
			if(!is_null($atrib)){
				$atributos=$atrib;
			}
			$aStr[]='<option value="'.$item[$value].'" '.$atributos.' '.$itemSelectado.'>'.PF::html($item[$text],true).'</option>';
		}
		return implode("\r\n",$aStr);
	}
	
	/*************************  CAMPO CALENDARIO **************************/
	
	/**** REQUIERE js/cal.js (control/js/cal.js) *****/
	
	function inputCalendar($form,$field,$showIcon=true,$icon='img/icon_cal.gif',$class='txtInput'){
	 
		$string=array();
		$string[]='<input name="'.$field.'" type="text" class="'.$class.'" id="'.$field.'" readonly="readonly" onclick="showCal(\'calendar_'.$field.'\');"/>';
		
        $string[]='<script type="text/javascript">';
	    $string[]='addCalendar("calendar_'.$field.'", "Seleccione:", "'.$field.'", "'.$form.'");';
		$string[]='setColor("", "", "", "#DEDBCE", "", "", "");';
		$string[]='</script>';
		if($showIcon){
        	$string[]='<a href="Javascript: showCal(\'calendar_'.$field.'\')"><img src="'.$icon.'" border="0" align="absmiddle" alt="" /></a>';
		}
		echo implode("\n",$string);
	}
	
	/*************************** FIN CAMPO CALENDARIO **********************/
}
class I extends Interfaz {
	
}
?>