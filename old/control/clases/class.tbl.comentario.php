<?php
class ComentarioManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Comentario
	 */
	function ComentarioManager($oDBM){
		$this->pref='portal_';
		$this->tabla=$this->pref.'comentario';
		$this->oDBM=$oDBM;
		$this->aErrors=array();
		parent::PFTableManager($oDBM,$this->tabla);
	}
	
	
	/**
	 * Publico: inserta los datos en una tabla
	 *
	 * @param array $arrayData
	 */
	function insert($arrayData){
		/*INSERT*/
/*INSERT INTO ".$this->tabla." (id_comentario,id_usuario,id_articulo,fecha,comentario,id_estado_comentario) VALUES (NULL,$arrayData[id_usuario],$arrayData[id_articulo],$arrayData[fecha],'$arrayData[comentario]',$arrayData[id_estado_comentario]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_comentario,id_usuario,id_articulo,fecha,comentario,id_estado_comentario) VALUES (NULL,$arrayData[id_usuario],$arrayData[id_articulo],$arrayData[fecha],'$arrayData[comentario]',$arrayData[id_estado_comentario]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_comentario){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_comentario=$id_comentario*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_comentario=$id_comentario";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: actualiza los registros de una tabla
	 *
	 * @param array $arrayData
	 */
	function update($arrayData){
		/*UPDATE*/
/*UPDATE ".$this->tabla." SET id_usuario=$arrayData[id_usuario] , id_articulo=$arrayData[id_articulo] , fecha=$arrayData[fecha] , comentario='$arrayData[comentario]' , id_estado_comentario=$arrayData[id_estado_comentario] WHERE id_comentario=$arrayData[id_comentario]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET comentario='$arrayData[comentario]' , id_estado_comentario=$arrayData[id_estado_comentario] WHERE id_comentario=$arrayData[id_comentario]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_comentario){
		/*GETROW*/
/*SELECT 
id_comentario, 
id_usuario, 
id_articulo, 
fecha, 
comentario, 
id_estado_comentario 
FROM ".$this->tabla." 
WHERE id_comentario=$id_comentario */
		$sql="SELECT 
t.id_comentario, 
t.id_usuario, 
t.id_articulo, 
t.fecha, 
t.comentario, 
t.id_estado_comentario,
u.nombre,
u.apellido,
a.titulo 
FROM ".$this->tabla." t
INNER JOIN control_usuario u ON u.id_usuario=t.id_usuario
INNER JOIN portal_articulo a ON a.id_articulo=t.id_articulo
WHERE id_comentario=$id_comentario ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_comentario, 
id_usuario, 
id_articulo, 
fecha, 
comentario, 
id_estado_comentario 
FROM ".$this->tabla." */
		$sql="SELECT 
t.id_comentario, 
t.id_usuario, 
t.id_articulo, 
t.fecha, 
t.comentario, 
t.id_estado_comentario,
u.nombre,
u.apellido,
a.titulo
FROM ".$this->tabla." t
INNER JOIN control_usuario u ON u.id_usuario=t.id_usuario
INNER JOIN portal_articulo a ON a.id_articulo=t.id_articulo 
";
		if(count($arrayCond)>0){
			$sql.=" WHERE ".implode(' AND ',$arrayCond)." ";
		}
		if(!is_null($orderBy)){
			$sql.=" ORDER BY $orderBy ";
		}
		if(!is_null($from)){
			$sql.= " LIMIT $from, $qty ";
		}
		return $this->toArray($sql);
	}
	
	/**
	 * Privado: Valida el ingreso de datos a una tabla
	 *
	 * @param array datos $arrayData
	 * @return bool
	 */
	function validate($arrayData,$codigo=false){
		$oDBV=new PFDBValidator($this->oDBM,$this->tabla);
		$oDBV->codigo=$codigo;
		$oDBV->arrayData=$arrayData;
		$b=$oDBV->validarVector();
		if($b){
			return true;
		}
		else{
			$this->aErrors=$oDBV->arrayErrores;
			return false;
		}
	}
	
	function nuevoComentario($arrayData){
		$arrayData['fecha']=PF::date('Ymd');
		return $this->insert($arrayData);
	}
	
	function eliminarComentario($idComentario){
		return $this->delete($idComentario);
	}
	
	function deleteComentariosUsuario($idUsuario){
		$sql="DELETE FROM ".$this->tabla." WHERE id_usuario=$idUsuario";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function deleteComentariosFromArticulo($idArticulo){
		$sql="DELETE FROM ".$this->tabla." WHERE id_articulo=$idUsuario";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function actualizarComentario($arrayData){
		return $this->update($arrayData);
	}
	
	function getComentarios($from=null,$qty=null,$idEstado=null){
		$arrayCond=array();
		if(!is_null($idEstado)){
			$arrayCond[]=" id_estado_comentario=$idEstado ";
		}
		return $this->getData($from,$qty,$arrayCond,' id_comentario DESC ');
	}
	
	function countTotal($idEstado=null){
		if(!is_null($idEstado)){
			return $this->countRows(array('id_estado_comentario'=>$idEstado));
		}
		return $this->countRows();
	}
}
?>