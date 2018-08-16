<?php

class AdapterImagen extends CMSImagen {
	
	
	function AdapterImagen($oDBM){
		parent::CMSImagen($oDBM);
	}
	
		
	function eliminarImagen($idImagen){
		$data=$this->getRow($idImagen);
		if(count($data)==0){
			return true;
		}
		/*
		if($data['id_tipo']==1){ //Imagen de Galeria de Producto
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_GRANDE.'/'.$data['nombre']));
		}
		*/
		
		if($data['id_tipo']==1){ //Archivo de Lista de precios
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO.'/'.$data['nombre']));
		}
		
		if($data['id_tipo']==2){ //Imagen de Producto
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS1.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS2.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_ORIGINAL.'/'.$data['nombre']));
		}
		
		if($data['id_tipo']==3){ //Imagen de Noticias
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS1.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_THUMBS2.'/'.$data['nombre']));
			PF::deleteFile(PF::getPath(RUTA_CONTENIDO_ORIGINAL.'/'.$data['nombre']));
		}
		
		
		return $this->delete($idImagen);
	}
	
	/********************* EJEMPLO ***********************/
	
	/*
	function nuevaImagenProducto($arrayFiles,$idProducto){
		$ext=strtolower(PF::extension($arrayFiles['imagen']['name']));
		$medidas=@getimagesize($arrayFiles['imagen']['tmp_name']);
		$filesize=filesize($arrayFiles['imagen']['tmp_name']);
				
		if(($ext!='gif' && $ext!='jpg' && $ext!=='jpeg') || !$medidas){
			$this->aErrors[]='La imagen tiene formato inv�lido';
			return false;
		}
		if( $filesize>FOTO_GAL_MAX_FILESIZE){
			$this->aErrors[]='La imagen supera el tama�o m�ximo permitido';
			return false;
		}
		
		$arrayData['nombre']=$this->cargarImagenProducto($arrayFiles['imagen']);
		$arrayData['descripcion']='';
		$arrayData['fecha']=date("Ymdhis");
		$arrayData['id_tipo']=1;
		$arrayData['id_relacion']=$idProducto;
		$arrayData['id_categoria']=0;
		$arrayData['activa']=1;
		
		return $this->insert($arrayData);
	}
	
	function cargarImagenProducto($file){
		$fileName=uniqid('PROD').'.'.PF::extension($file['name']);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO.'/'.$fileName),IMG_PROD_ANCHO,IMG_PROD_ALTO);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$fileName),IMG_MIN_PROD_ANCHO,IMG_MIN_PROD_ALTO);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_GRANDE.'/'.$fileName),IMG_GDE_PROD_ANCHO,IMG_GDE_PROD_ALTO);
		return $fileName;
	}
	
	function getImagenesProducto($from=null,$qty=null,$idProducto=null){
		
		return $this->getImagenes(1,$idProducto,null,false,$from,$qty);
	}
	
	function countTotalImagenesProducto($idProducto=null){
		$array=array();
		$array['id_tipo']=1;
		if(!is_null($idProducto)){
			$array['id_relacion']=$idProducto;
		}
		return $this->countRows($array);
	}
	*/
	
	/********************* FIN EJEMPLO ***********************/
	
	function nuevaListaPrecios($arrayFiles,$id){//carga imagen en base - para usar descripcion cargar argumento nuevo
		$filesize=filesize($arrayFiles['archivo']['tmp_name']);
				
		if( $filesize>MAX_UPLOAD_FILESIZE){
			$this->aErrors[]='El archivo supera el tama�o m�ximo permitido';
			return false;
		}
		
		$arrayData['nombre']=$this->cargarListaPrecios($arrayFiles['archivo']);
		$arrayData['descripcion']='';//para usar esto tengo que poner un tercer argumento a la funcion
		$arrayData['fecha']=date("Ymdhis");
		$arrayData['id_tipo']=1;
		$arrayData['id_relacion']=$id;
		$arrayData['id_categoria']=0;
		$arrayData['activa']=1;
		
		return $this->insert($arrayData);
	}
	
	function cargarListaPrecios($file){
		$fileName=uniqid('PRECIOS').'.'.PF::extension($file['name']);
		move_uploaded_file($file['tmp_name'],PF::getPath(RUTA_CONTENIDO.'/'.$fileName));//poner constantes en vez de ancho y alto
		return $fileName;
	}
	
			
	function getListaPrecios($idImagen=null){
		return $this->getImagenes(1,$idImagen,null,false);
	}
	
	
	function eliminarListaPrecios($idListaPrecios){
		$lista = $this->getImagenes(1,$idListaPrecios);
		foreach ($lista as $item){//esto es por si hay mas de una imagen asociada a un id de imagen general
			$this->eliminarImagen($item['id_imagen']);
		}
		return true;
	}
	
	function getImagenProd($idImagen=null){
		return $this->getImagenes(2,$idImagen,null,false);
		
	}
	
		
	function nuevaImagenProducto($arrayFiles,$idProducto){
		$ext=strtolower(PF::extension($arrayFiles['imagen']['name']));
		$medidas=@getimagesize($arrayFiles['imagen']['tmp_name']);
		$filesize=filesize($arrayFiles['imagen']['tmp_name']);
				
		if(($ext!='gif' && $ext!='jpg' && $ext!=='jpeg') || !$medidas){
			$this->aErrors[]='La imagen tiene formato inv�lido';
			return false;
		}
		if( $filesize>IMAGEN_MAX_UPLOAD_FILESIZE){
			$this->aErrors[]='La imagen supera el tama�o m�ximo permitido';
			return false;
		}
		
		$arrayData['nombre']=$this->cargarImagenProducto($arrayFiles['imagen']);
		$arrayData['descripcion']='';
		$arrayData['fecha']=date("Ymdhis");
		$arrayData['id_tipo']=2;
		$arrayData['id_relacion']=$idProducto;
		$arrayData['id_categoria']=0;
		$arrayData['activa']=1;
		
		return $this->insert($arrayData);
	}
	
	function cargarImagenProducto($file){
		$fileName=uniqid('PROD').'.'.PF::extension($file['name']);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO.'/'.$fileName),FOTO_GAL_ANCHO,FOTO_GAL_ALTO);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$fileName),ANCHO_THUMBS,ALTO_THUMBS);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS1.'/'.$fileName),ANCHO_THUMBS1,ALTO_THUMBS1);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS2.'/'.$fileName),ANCHO_THUMBS2,ALTO_THUMBS2);
		move_uploaded_file($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_ORIGINAL.'/'.$fileName));
		return $fileName;
	}
	
	function eliminarImagenesProducto($idProd){
		$lista = $this->getImagenes(2,$idProd);
		foreach ($lista as $item){//esto es por si hay mas de una imagen asociada a un id de imagen general
			$this->eliminarImagen($item['id_imagen']);
		}
		return true;
	}
	
	function subirOrdenImg($idImg){
		$this->subirOrden($idImg);
		return true;
	}
	
	function bajarOrdenImg($idImg){
		$this->bajarOrden($idImg);
		return true;
	}
	
	/******************* IMAGEN NOTICIA **********************/
	
	function getImagenNoticia($idImagen=null){
		return $this->getImagenes(3,$idImagen,null,false);
		
	}
	
		
	function nuevaImagenNoticia($arrayFiles,$idNoticia){
		$ext=strtolower(PF::extension($arrayFiles['imagen']['name']));
		$medidas=@getimagesize($arrayFiles['imagen']['tmp_name']);
		$filesize=filesize($arrayFiles['imagen']['tmp_name']);
				
		if(($ext!='gif' && $ext!='jpg' && $ext!=='jpeg') || !$medidas){
			$this->aErrors[]='La imagen tiene formato inv�lido';
			return false;
		}
		if( $filesize>IMAGEN_MAX_UPLOAD_FILESIZE){
			$this->aErrors[]='La imagen supera el tama�o m�ximo permitido';
			return false;
		}
		
		$arrayData['nombre']=$this->cargarImagenNoticia($arrayFiles['imagen']);
		$arrayData['descripcion']='';
		$arrayData['fecha']=date("Ymdhis");
		$arrayData['id_tipo']=3;
		$arrayData['id_relacion']=$idNoticia;
		$arrayData['id_categoria']=0;
		$arrayData['activa']=1;
		
		return $this->insert($arrayData);
	}
	
	function cargarImagenNoticia($file){
		$fileName=uniqid('NOTICIA').'.'.PF::extension($file['name']);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO.'/'.$fileName),359,266,'aEscalaModificada');
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS.'/'.$fileName),ANCHO_THUMBS,ALTO_THUMBS,'aEscalaModificada');
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS1.'/'.$fileName),ANCHO_THUMBS1,ALTO_THUMBS1);
		$this->cargarImagen($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_THUMBS2.'/'.$fileName),ANCHO_THUMBS2,ALTO_THUMBS2);
		move_uploaded_file($file['tmp_name'],PF::getPath(RUTA_CONTENIDO_ORIGINAL.'/'.$fileName));
		return $fileName;
	}
	
	function eliminarImagenesNoticia($idNoticia){
		$lista = $this->getImagenes(3,$idNoticia);
		foreach ($lista as $item){//esto es por si hay mas de una imagen asociada a un id de imagen general
			$this->eliminarImagen($item['id_imagen']);
		}
		return true;
	}
	
	/******************* FIN IMAGEN NOTICIA ******************/
}

?>