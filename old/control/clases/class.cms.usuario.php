<?php
class Usuario extends PFTableManager {
	
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
	function Usuario($oDBM){
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
/*INSERT INTO ".$this->tabla." (id_usuario,email,user_pass,user_name,nombre,apellido,direccion,ciudad,provincia,pais,cp,empresa,cargo) VALUES (NULL,'$arrayData[email]','$arrayData[user_pass]','$arrayData[user_name]','$arrayData[nombre]','$arrayData[apellido]','$arrayData[direccion]','$arrayData[ciudad]','$arrayData[provincia]','$arrayData[pais]','$arrayData[cp]','$arrayData[empresa]','$arrayData[cargo]') */
		if(!$this->validate($arrayData,'i')){
			return false;
		}
		if(!isset($arrayData['id_tipo']) || !is_numeric($arrayData['id_tipo'])){
			$arrayData['id_tipo']='NULL';
		}
		if(!isset($arrayData['id_estado']) || !is_numeric($arrayData['id_estado'])){
			$arrayData['id_estado']=1;
		}
		$sql="INSERT INTO ".$this->tabla." (id_usuario,email,user_pass,user_name,nombre,apellido,direccion,ciudad,provincia,pais,cp,empresa,cargo,id_tipo,id_estado) VALUES (NULL,'$arrayData[email]','$arrayData[user_pass]','$arrayData[user_name]','$arrayData[nombre]','$arrayData[apellido]','$arrayData[direccion]','$arrayData[ciudad]','$arrayData[provincia]','$arrayData[pais]','$arrayData[cp]','$arrayData[empresa]','$arrayData[cargo]','$arrayData[id_tipo]','$arrayData[id_estado]') ";
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
/*UPDATE ".$this->tabla." SET email='$arrayData[email]' , user_pass='$arrayData[user_pass]' , user_name='$arrayData[user_name]' , nombre='$arrayData[nombre]' , apellido='$arrayData[apellido]' , direccion='$arrayData[direccion]' , ciudad='$arrayData[ciudad]' , provincia='$arrayData[provincia]' , pais='$arrayData[pais]' , cp='$arrayData[cp]' , empresa='$arrayData[empresa]' , cargo='$arrayData[cargo]' WHERE id_usuario=$arrayData[id_usuario]*/
		if(!$this->validate($arrayData,'u')){
			return false;
		}
		if(!isset($arrayData['id_tipo']) || !is_numeric($arrayData['id_tipo'])){
			$data=$this->getRow($arrayData['id_usuario']);
			$arrayData['id_tipo']=$data['id_tipo'];
		}
		if(!isset($arrayData['id_estado']) || !is_numeric($arrayData['id_estado'])){
			$data=$this->getRow($arrayData['id_usuario']);
			$arrayData['id_estado']=$data['id_estado'];
		}
		$sql="UPDATE ".$this->tabla." SET email='$arrayData[email]' , user_pass='$arrayData[user_pass]' , user_name='$arrayData[user_name]' , nombre='$arrayData[nombre]' , apellido='$arrayData[apellido]' , direccion='$arrayData[direccion]' , ciudad='$arrayData[ciudad]' , provincia='$arrayData[provincia]' , pais='$arrayData[pais]' , cp='$arrayData[cp]' , empresa='$arrayData[empresa]' , cargo='$arrayData[cargo]',id_tipo=$arrayData[id_tipo],id_estado=$arrayData[id_estado] WHERE id_usuario=$arrayData[id_usuario]";
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
cargo 
FROM ".$this->tabla." 
WHERE id_usuario=$id_usuario */
		$sql="SELECT 
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
WHERE id_usuario=$id_usuario ";
		return $this->toRow($sql);
	}
	
	
	/**
	 * Público: devuelve todos los datos de la tabla
	 *
	 */
	function getData($from=null,$qty=null){
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
cargo 
FROM ".$this->tabla." */
		$sql="SELECT 
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
FROM ".$this->tabla." ";
		if(!is_null($from)){
			$sql.=" LIMIT $from,$qty ";
		}
		return $this->toArray($sql);
	}
		function buscarUsuario($arrayData){
	
		$sql="SELECT 
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
FROM ".$this->tabla." where 1=1 ";

if (isset($arrayData['user_name']))
	$sql.="and user_name='".$arrayData['user_name']."'";
if ($arrayData['user_pass']!="")
	$sql.="and user_pass='".$arrayData['user_pass']."'";
if ($arrayData['nombre']!="")
	$sql.="and nombre='".$arrayData['nombre']."'";
if ($arrayData['apellido']!="")
	$sql.="and apellido='".$arrayData['apellido']."'";
if ($arrayData['id_tipo']!="")
	$sql.="and id_tipo=".$arrayData['id_tipo']."";


		if(!is_null($from)){
			$sql.=" LIMIT $from,$qty ";
		}
		return $this->toArray($sql);
	}
	function getDataByTipo($from=null,$qty=null){
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
cargo 
FROM ".$this->tabla." */
		$sql="SELECT "
.$this->tabla.".id_usuario, 
email, 
user_pass, 
user_name, 
".$this->tabla.".nombre, 
apellido, 
".$this->tabla.".direccion, 
ciudad, 
provincia, 
pais, 
cp, 
empresa, 
cargo,
control_tipo_usuario.descripcion as tipo,
".$this->tabla.".id_tipo,
sis_local.nombre as local,
sis_local.id_local as id_local,
id_estado
FROM ".$this->tabla.", control_tipo_usuario, sis_usuario, sis_local  where ".$this->tabla.".id_tipo=control_tipo_usuario.id_tipo
and ".$this->tabla.".id_estado=1 and sis_usuario.id_usuario=".$this->tabla.".id_usuario and 
sis_local.id_local=sis_usuario.id_local";
		if(!is_null($from)){
			$sql.=" LIMIT $from,$qty ";
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
	
	/**
	 * Publico: devuelve todos los permisos asignados a un usuario
	 *
	 * @param int $idUser
	 * @return array
	 */
	function getPermisos($idUser){
		$sql="
		SELECT DISTINCT
		control_objeto.clave as 'objeto',
		control_permiso.tipo as 'tipo'
		FROM
		control_perfil_usuario
		INNER JOIN control_perfil_permiso ON control_perfil_usuario.id_perfil=control_perfil_permiso.id_perfil
		INNER JOIN control_permiso ON control_perfil_permiso.id_permiso=control_permiso.id_permiso
		INNER JOIN control_objeto ON control_permiso.id_objeto=control_objeto.id_objeto
		WHERE control_perfil_usuario.id_usuario=$idUser";
		return $this->toArray($sql);
	}
	
	function checkLoginUser($username,$pass){
		$sql="SELECT 
id_usuario
FROM ".$this->tabla." 
WHERE user_name='$username' AND user_pass='$pass' ";
		return $this->toVar($sql);
	}
	
	/**
	 * Publico: devuelve el listado de los perfiles a los que pertenece el usuario
	 *
	 */
	function getPerfiles($idUser){
		/*
		Deben obtenerse de control_perfil_usuario los id de perfiles a los que pertenece el 
		usuario para poder desplegarlos en el formulario de edición de datos
		*/
		$array=array();
		$oPerfilUsuario=new Perfil_usuario($this->oDBM);
		$arrayPerfilUsuario=$oPerfilUsuario->getPerfilesUsuario($idUser);
		
		foreach ($arrayPerfilUsuario as $item){
			$array[]=$item['id_perfil'];
		}
		return $array;
		
	}
	
	/**
	 * Privado: indica si existe o no ese username en la base
	 *
	 * @param array $username
	 * @return bool
	 */
	function checkUsernameExists($username){
		$sql="SELECT 
id_usuario
FROM ".$this->tabla." 
WHERE user_name='$username'";

		return $this->toVar($sql);
	}
	
	/**
	 * Privado: indica si existe o no ese password en la base
	 *
	 * @param string $password
	 * @return bool
	 */
	function checkPasswordExists($password){
		$sql="SELECT id_usuario FROM ".$this->tabla." 
			  WHERE user_pass='$password'";

		return $this->toVar($sql);
	}
	
	/**
	 * Privado: indica si existe o no ese username en la base
	 *
	 * @param array $username $id_usuario
	 * @return bool
	 */
	function checkUsernameExistsUpdate($username,$idUsuario){
		$sql="SELECT 
COUNT(id_usuario)
FROM ".$this->tabla." 
WHERE user_name='$username' AND (id_usuario!='$idUsuario')";

		return $this->toVar($sql);
	}
	
	/**
	 * Privado: indica si existe o no ese password en la base
	 *
	 * @param string $password $id_usuario
	 * @return bool
	 */
	function checkPasswordExistsUpdate($password,$idUsuario){
		$sql="SELECT 
COUNT(id_usuario)
FROM ".$this->tabla." 
WHERE user_pass='$password' AND (id_usuario!='$idUsuario')";

		return $this->toVar($sql);
	}
	
	
	
	
	
	
	/**
	 * Publico: actualiza los datos del usuario
	 *
	 * @param arrray $arrayData
	 * @return bool
	 */
	function actualizarUsuario($arrayData,$arrayPerfil=NULL){
		/*
		Actualiza los datos del usuario y además ejecuta actualizarPerfilesUsuario()
		para actualizar los datos de pertenencia a perfiles, de acuerdo a los checkbox
		marcados en el formulario
		*/
		$existeUsu=$this->checkUsernameExistsUpdate($arrayData['user_name'],$arrayData['id_usuario']);
		//$existePass=$this->checkPasswordExistsUpdate($arrayData['user_pass'],$arrayData['id_usuario']);
		
		if($existeUsu){
			$this->aErrors[]='El nombre de usuario ya fue utilizado';
			return false;
		}
		
		if(!is_null($arrayPerfil)){
			$this->actualizarPerfilesUsuario($arrayPerfil,$arrayData['id_usuario']);
		}
		
	
		return $this->update($arrayData);

	}
	
	/**
	 * Privado: actualiza la pertenencia del usuario a perfiles
	 *
	 * @param array $arrayData
	 * @return bool
	 */
	function actualizarPerfilesUsuario($arrayPerfil,$idUsuario){
		/* Debe tomar los perfiles que se marcaron como pertenecientes en un formulario
		y actualizar en la tabla control_perfil_usuario
		Lo ideal es eliminar primero todos los perfiles, y volver a escribirlos
		*/
		
		$oPerfilUsu=new Perfil_usuario($this->oDBM);
		$okDelete=$oPerfilUsu->deleteUsuario($idUsuario);
		foreach ($arrayPerfil as $item){
			$okInsert=$oPerfilUsu->insertUsuario($idUsuario,$item);
		}
		return true;
	}
	
	/**
	 * Publico: agrega un nuevo usuario 
	 *
	 * @param array $arrayData
	 * @return int $idUsuario
	 */
	function nuevoUsuario($arrayData, $arrayPerfil){
		/*
		Ingresa un nuevo usuario. Una vez grabado, deben actualizarse sus datos de
		pertenencia a perfiles de acuerdo a lo seleccionado en el formulario
		*/
		$existeUsu=$this->checkUsernameExists($arrayData['user_name']);
		//$existePass=$this->checkPasswordExists($arrayData['user_pass']);
		
		if($existeUsu){
			$this->aErrors[]='El nombre de usuario ya fue utilizado';
			return false;
		}
		
		$idUsuario=$this->insert($arrayData);
		if ($idUsuario){
			$okPerfilUsuario=$this->actualizarPerfilesUsuario($arrayPerfil,$idUsuario);
		}
		return $idUsuario;
	}
	
	 /*function nuevoUsuario($arrayData){
		
		//SI HAY PROCESOS EXTRA SE REALIZAN ACÁ
		
		//EL METODO INSERT ESCRIBE EN LA TABLA
		$idUsuario=$this->insert($arrayData);
		return $idUsuario;
	}
	*/
	
	/**
	 * Obtiene los Perfiles seteados
	 *
	 * @param array $arrayPerfil
	 * @param array $arrayData
	 * @return array
	 */
	
	function getPerfilesUsuariosSeteados($arrayPerfil,$arrayData){
		for($i=0;$i<count($arrayPerfil);$i++){
			$array[$i]=$arrayPerfil[$i]['id_perfil'];
		}
		for($i=0;$i<count($array);$i++){
			if(isset($arrayData[$array[$i]])){
				$array2[]=$array[$i];
			}else{
				$array2[]=0;
			}
		}
		return $array2;
		
	}
	
	/**
	 * Publico: elimina a un usuario
	 *
	 * @param int $idUsuario
	 * @return bool
	 */
	function eliminarUsuario($idUsuario){
		$this->actualizarPerfilesUsuario(array(),$idUsuario);
		return $this->delete($idUsuario);

		/*$sql="UPDATE ".$this->tabla." set id_estado=2 where id_usuario=".$idUsuario;
		$query=$this->oDBM->query($sql);
		return $this->oDBM->affected_rows();*/
	}
	
	
	function countTotal(){
		$sql="SELECT COUNT(id_usuario) FROM ".$this->tabla." ";
		return $this->toVar($sql);
	}
	
	
	
	function getTotalUsuariosTipo($tipo){
		$sql="SELECT 
		COUNT(*) as cantidad
		FROM control_usuario
		INNER JOIN control_perfil_usuario ON control_perfil_usuario.id_usuario=control_usuario.id_usuario
		INNER JOIN control_perfil ON control_perfil.id_perfil=control_perfil_usuario.id_perfil AND control_perfil.nombre='$tipo'";
		
		return $this->toVar($sql);
	}
	
	function listarUsuariosTipo($tipo,$from=null,$qty=null){
		
		$sql="SELECT 
		control_usuario.id_usuario AS id_usuario,
		email,
		user_pass,
		user_name,
		control_usuario.nombre,
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
		FROM control_usuario
		INNER JOIN control_perfil_usuario ON control_perfil_usuario.id_usuario=control_usuario.id_usuario
		INNER JOIN control_perfil ON control_perfil.id_perfil=control_perfil_usuario.id_perfil AND control_perfil.nombre='$tipo'";

		if(!is_null($from)){
			$sql.= " LIMIT $from, $qty ";
		}
		return $this->toArray($sql);

	}
	
	
}
?>