<?php
class UsuarioManager extends PFTableManager {
	
	//Propiedades públicas
	
	//Propiedades privadas
	var $tabla;
	var $oDBM;
	var $aErrors;
	var $prefijo;
	
	/**
	 * Constructor
	 *
	 * @return Usuario
	 */
	function UsuarioManager($oDBM){
		$this->pref='control_';
		$this->tabla=$this->pref.'usuario';
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
/*INSERT INTO ".$this->tabla." (id_usuario,email,user_pass,user_name,nombre,apellido,direccion,ciudad,provincia,pais,cp,empresa,cargo,id_tipo,id_estado) VALUES (NULL,'$arrayData[email]','$arrayData[user_pass]','$arrayData[user_name]','$arrayData[nombre]','$arrayData[apellido]','$arrayData[direccion]','$arrayData[ciudad]','$arrayData[provincia]','$arrayData[pais]','$arrayData[cp]','$arrayData[empresa]','$arrayData[cargo]',$arrayData[id_tipo],$arrayData[id_estado]) */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		$sql="INSERT INTO ".$this->tabla." (id_usuario,email,user_pass,user_name,nombre,apellido,id_tipo,id_estado) VALUES (NULL,'$arrayData[email]','$arrayData[user_pass]','$arrayData[user_name]','$arrayData[nombre]','$arrayData[apellido]',$arrayData[id_tipo],$arrayData[id_estado]) ";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->last_id();
	}
	
	
	/**
	 * Público: elimina un registro de la tabla
	 *
	 * @param Primary Key $id
	 */
	function delete($id_usuario){
		/*DELETE*/
/*DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario*/
		$sql="DELETE FROM ".$this->tabla." WHERE id_usuario=$id_usuario";
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
/*UPDATE ".$this->tabla." SET email='$arrayData[email]' , user_pass='$arrayData[user_pass]' , user_name='$arrayData[user_name]' , nombre='$arrayData[nombre]' , apellido='$arrayData[apellido]' , direccion='$arrayData[direccion]' , ciudad='$arrayData[ciudad]' , provincia='$arrayData[provincia]' , pais='$arrayData[pais]' , cp='$arrayData[cp]' , empresa='$arrayData[empresa]' , cargo='$arrayData[cargo]' , id_tipo=$arrayData[id_tipo] , id_estado=$arrayData[id_estado] WHERE id_usuario=$arrayData[id_usuario]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		$sql="UPDATE ".$this->tabla." SET email='$arrayData[email]' , user_pass='$arrayData[user_pass]' , user_name='$arrayData[user_name]' , nombre='$arrayData[nombre]' , apellido='$arrayData[apellido]' , id_tipo=$arrayData[id_tipo] , id_estado=$arrayData[id_estado] WHERE id_usuario=$arrayData[id_usuario]";
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	
	/**
	 * Público: devuelve los datos de un registro
	 *
	 * @param Primary Key $id
	 */
	function getRow($id_usuario){
		/*GETROW*/
/*SELECT 
id_usuario, 
email, 
user_pass, 
user_name, 
nombre, 
apellido, 
direccion, 
ciudad, 
provincia, 
pais, 
cp, 
empresa, 
cargo, 
id_tipo, 
id_estado 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario */
		$sql="SELECT 
id_usuario, 
email, 
user_pass, 
user_name, 
nombre, 
apellido, 
id_tipo, 
id_estado 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null,$arrayCond=array(),$orderBy=null){
		/*GETDATA*/
/*SELECT 
id_usuario, 
email, 
user_pass, 
user_name, 
nombre, 
apellido, 
direccion, 
ciudad, 
provincia, 
pais, 
cp, 
empresa, 
cargo, 
id_tipo, 
id_estado 
FROM ".$this->tabla." */
		$sql="SELECT 
id_usuario, 
email, 
user_pass, 
user_name, 
nombre, 
apellido, 
id_tipo, 
id_estado 
FROM ".$this->tabla." ";
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
	
	function nuevo($arrayData){
		return $this->insert($arrayData);
	}
	
	function actualizar($arrayData){
		return $this->update($arrayData);
	}
	
	function eliminar($id_usuario){
		return $this->delete($id_usuario);
	}
	
	function getListado($from=null,$qty=null,$where=null){
		return $this->getData($from,$qty,$where);
	}
	
	function countTotal($where=null){
		if (is_null($where)){
			return $this->countRows();
		}
		return $this->countRows(array('id_tipo'=>$where));
	}
	
	function activar($id_usuario){
		$sql="UPDATE ".$this->tabla." SET activa=1 WHERE id_usuario='$id_usuario' ";
		return $this->oDBM->query($sql);
	}
	
	function desactivar($id_usuario){
		$sql="UPDATE ".$this->tabla." SET activa=0 WHERE id_usuario='$id_usuario' ";
		return $this->oDBM->query($sql);
	}

	
	function subirOrden($id){
		$aData=$this->getRow($id);
		//echo $aFotoData['orden'];
		$nextData=$this->getNextUp($aData);
		//echo '-'.$nextFotoData['orden'];
		if(count($nextData)!=0){
			$this->switchPosicion($aData,$nextData);
		}
	}
	
	function bajarOrden($id){
		$aData=$this->getRow($id);
		$previousData=$this->getNextDown($aData);
		if(count($previousData)!=0){
			$this->switchPosicion($aData,$previousData);
		}
	}
	
	function getNextUp($data){
		$sql="SELECT
		*
		FROM $this->tabla 
		WHERE orden<$data[orden] 
		ORDER BY orden DESC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function getNextDown($data){
		$sql="SELECT 
		* 
		FROM $this->tabla 
		WHERE orden>$data[orden] 
		ORDER BY orden ASC LIMIT 0,1";
		return $this->toRow($sql);
	}
	
	function switchPosicion($arrayData, $arrayData2){
		$this->updateOrden($arrayData['id_usuario'],$arrayData2['orden']);
		$this->updateOrden($arrayData2['id_usuario'],$arrayData['orden']);
	}
	
	function updateOrden($id_usuario,$orden){
		$sql="UPDATE $this->tabla SET orden=$orden WHERE id_usuario='$id_usuario' ";
		//echo $sql;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();
	}
	
	function getNextOrden($data){
		$sql="SELECT MAX(orden) 
		FROM ". $this->tabla." ";
		return $this->toVar($sql)+1;
	}
	
	
	
	
}
?>