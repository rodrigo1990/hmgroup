<?php
class Banner_AdapterEspacioManager extends Banner_EspacioManager {
	
	var $espaciosCategorias;
	var $espaciosVideos;
	
	function Banner_AdapterEspacioManager($oDBM){
		parent::Banner_EspacioManager($oDBM);
		
		$this->espaciosCategorias=array(
			0=>array(
				'nombre'=>'Izquierda 1',
				'ancho'=>ANCHO_BANNER_COL_IZQ,
				'alto'=>ALTO_BANNER_COL_IZQ
			),
			1=>array(
				'nombre'=>'Izquierda 2',
				'ancho'=>ANCHO_BANNER_COL_IZQ,
				'alto'=>ALTO_BANNER_COL_IZQ
			),
			2=>array(
				'nombre'=>'Izquierda 3',
				'ancho'=>ANCHO_BANNER_COL_IZQ,
				'alto'=>ALTO_BANNER_COL_IZQ
			),
			3=>array(
				'nombre'=>'Centro 1',
				'ancho'=>ANCHO_BANNER_COL_CENTRO,
				'alto'=>ALTO_BANNER_COL_CENTRO
			),
			4=>array(
				'nombre'=>'Centro 2',
				'ancho'=>ANCHO_BANNER_COL_CENTRO,
				'alto'=>ALTO_BANNER_COL_CENTRO
			),
			5=>array(
				'nombre'=>'Centro 3',
				'ancho'=>ANCHO_BANNER_COL_CENTRO,
				'alto'=>ALTO_BANNER_COL_CENTRO
			),
			6=>array(
				'nombre'=>'Derecha 1',
				'ancho'=>ANCHO_BANNER_COL_DER,
				'alto'=>ALTO_BANNER_COL_DER
			),
			7=>array(
				'nombre'=>'Derecha 2',
				'ancho'=>ANCHO_BANNER_COL_DER,
				'alto'=>ALTO_BANNER_COL_DER
			),
			8=>array(
				'nombre'=>'Derecha 3',
				'ancho'=>ANCHO_BANNER_COL_DER,
				'alto'=>ALTO_BANNER_COL_DER
			)
		);
		
		
		$this->espaciosVideos=array(
			0=>array(
				'nombre'=>'(Video) Izquierda 1',
				'ancho'=>ANCHO_BANNER_COL_IZQ,
				'alto'=>ALTO_BANNER_COL_IZQ
			),
			1=>array(
				'nombre'=>'(Video) Izquierda 2',
				'ancho'=>ANCHO_BANNER_COL_IZQ,
				'alto'=>ALTO_BANNER_COL_IZQ
			),
			2=>array(
				'nombre'=>'(Video) Centro 1',
				'ancho'=>ANCHO_BANNER_COL_CENTRO,
				'alto'=>ALTO_BANNER_COL_CENTRO
			),
			3=>array(
				'nombre'=>'(Video) Centro 2',
				'ancho'=>ANCHO_BANNER_COL_CENTRO,
				'alto'=>ALTO_BANNER_COL_CENTRO
			),
			4=>array(
				'nombre'=>'(Video) Derecha 1',
				'ancho'=>ANCHO_BANNER_COL_DER,
				'alto'=>ALTO_BANNER_COL_DER
			),
			5=>array(
				'nombre'=>'(Video) Derecha 2',
				'ancho'=>ANCHO_BANNER_COL_DER,
				'alto'=>ALTO_BANNER_COL_DER
			)
		);
	}
	
	
	/******************** CATEGORIAS **********************************/
	
	function actualizarEspaciosCategoria($idCategoria,$nombre){
		$sql="SELECT id_espacio FROM ".$this->tabla." WHERE id_relacion=$idCategoria AND id_tipo_espacio=2 ORDER BY id_espacio ASC";
		$arrayData=$this->toArray($sql);
	
		foreach($this->espaciosCategorias as $ind => $item){
			if(isset($arrayData[$ind])){
				$this->actualizarNombreEspacio($arrayData[$ind]['id_espacio'],$nombre.' '.$item['nombre']);
			}
			else{
				$array=array('nombre'=>$nombre.' '.$item['nombre'],'ancho'=>$item['ancho'], 'alto'=>$item['alto'],'activo'=>1,'id_relacion'=>$idCategoria,'id_tipo_espacio'=>2);
				$this->nuevoEspacio($array);
			}
		}
		
		
	}
	
	function nuevosEspaciosCategoria($idCategoria,$nombreCategoria){
		foreach($this->espaciosCategorias as $ind => $item){
			$array=array('nombre'=>$nombreCategoria.' '.$item['nombre'],'ancho'=>$item['ancho'], 'alto'=>$item['alto'],'activo'=>1,'id_relacion'=>$idCategoria,'id_tipo_espacio'=>2);
			$this->nuevoEspacio($array);
		}
	}
	
	function eliminarEspaciosCategoria($idCategoria){
		$this->eliminarEspacioPorRelacion($idCategoria,2);
	}
	
	/********************** FIN CATEGORIAS ***************************/
	
	
	/******************** VIDEOS *********************************/
	
	function actualizarEspaciosVideo($idVideo,$nombre){
		$sql="SELECT id_espacio FROM ".$this->tabla." WHERE id_relacion=$idVideo AND id_tipo_espacio=3 ORDER BY id_espacio ASC";
		$arrayData=$this->toArray($sql);
	
		foreach($this->espaciosVideos as $ind => $item){
			if(isset($arrayData[$ind])){
				$this->actualizarNombreEspacio($arrayData[$ind]['id_espacio'],$nombre.' '.$item['nombre']);
			}
			else{
				$array=array('nombre'=>$nombre.' '.$item['nombre'],'ancho'=>$item['ancho'], 'alto'=>$item['alto'],'activo'=>1,'id_relacion'=>$idVideo,'id_tipo_espacio'=>3);
				$this->nuevoEspacio($array);
			}
		}
		
		
	}
	
	function nuevosEspaciosVideo($idVideo,$nombre){
		foreach($this->espaciosVideos as $ind => $item){
			$array=array('nombre'=>$nombre.' '.$item['nombre'],'ancho'=>$item['ancho'], 'alto'=>$item['alto'],'activo'=>1,'id_relacion'=>$idVideo,'id_tipo_espacio'=>3);
			$this->nuevoEspacio($array);
		}
	}
	
	function eliminarEspaciosVideo($idVideo){
		$this->eliminarEspacioPorRelacion($idVideo,3);
	}
	
	/******************** FIN VIDEOS *************************/
}
?>