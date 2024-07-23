<?php
class UsuariosModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}
	/********** funcion de insertar usuario en la DB **********/
	public function insertUser(int $intIdentificacion, string $strNombre,string $strApellidos,int $intTlf, string	$strEmail,int $intlistRolId,string $strPass){
		$this->intId =  $intIdentificacion;
		$this->strNombre =  $strNombre;
		$this->strApellidos =  $strApellidos;
		$this->intTlf =  $intTlf;
		$this->strEmail =  $strEmail;
		$this->intListStatus =  1;
		$this->intlistRolId =  $intlistRolId;
		$this->strPass =  $strPass;
		$this->strImg = "storage/default.png";
		$return = 0;
		//consultar si existe
		$sql = "SELECT * FROM table_user WHERE  user_email = '{$this->strEmail}' or  user_ci = {$this->intId}";
		$request = $this->select_all($sql);
		//si no encontro ningun resultado insertamos el usuario
		if(empty($request)){
			$queryInsert = "INSERT INTO table_user(user_ci,user_nombres,user_apellidos, user_tlf,user_email,user_status,user_img, user_rol,user_pass) VALUES(?,?,?,?,?,?,?,?,?)";
			$arrData = array($this->intId,$this->strNombre,$this->strApellidos,$this->intTlf,$this->strEmail,$this->intListStatus,$this->strImg,$this->intlistRolId,$this->strPass);
			$requestInsert = $this->insert($queryInsert,$arrData);
			//si no existe devolvemos el id de insert
			$return = $requestInsert;
			$userNIck = substr($strNombre,0,1).substr($strApellidos,0,1).'-0'.$requestInsert;
			$insertRol = "INSERT INTO table_user_rol(user_nick,id_rol) VALUES(?,?)";
			$arrDataRol = array($userNIck,$this->intlistRolId);
		}else{
			//si existe un registro devolvemos 0
			$return = 0;
		}
		return $return;
	}
	/********** funcioncrear nombre de usuario **********/
	public function createNick(int $intIdUser,int $intIdentificacion,string $strEmail, string $strTxtNick,int $intlistRolId,string $fileBase ){
		$this->intIdUser = $intIdUser;
		$this->strEmail = $strEmail;
		$this->intIdentificacion = $intIdentificacion;
		$this->strTxtNick = $strTxtNick;
		$this->intlistRolId = $intlistRolId;
		$this->fileBase = $fileBase;
		$sql = "SELECT * FROM table_user WHERE user_id = $this->intIdUser";
		$request = $this->select_all($sql);
		if(!empty($request)){
			$sql = "UPDATE table_user SET  user_nick = ?, user_ruta = ? , user_img = ? WHERE user_id = $this->intIdUser AND user_ci = $this->intIdentificacion";
			$arrData = array($this->strTxtNick,$this->fileBase,$this->fileBase.'default.png');
			$request = $this->update($sql,$arrData);
			$insertRol = "INSERT INTO table_user_rol(user_nick,id_rol) VALUES(?,?)";
			$arrDataRol = array($this->strTxtNick,$this->intlistRolId);
			$Rol = $this->insert($insertRol,$arrDataRol);
		}else{
			$request = "error";
		}
		return $request;
	}
	/******** seleccionar usuario y cargarlo en la tabla********/
	public function selectUsers(){
		@session_start();
		$sql = "SELECT p.user_id, p.user_nick,p.user_nombres,p.user_apellidos,p.user_tlf,
		p.user_email, p.user_status,rol.rol_id,rol.rol_name
					FROM table_user p
					JOIN table_user_rol r
					JOIN table_roles rol
					WHERE
					p.user_nick = r.user_nick AND
					r.id_rol = rol.rol_id AND
					p.user_status != 0 AND p.user_id != {$_SESSION['userData']['user_id']}";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** eliminar usuario **********/
	public function deleteUser(int $intIdUser){
		$this->intIdUser = $intIdUser;
		$sql = "UPDATE table_user SET user_status = ? WHERE user_id = $this->intIdUser";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		//almacenar errores
		$pagina_error = $_SERVER['PHP_SELF']. addslashes($request);
		$usuario = $_SESSION['userData']['user_id'];

		$sqlLog = "INSERT INTO table_log(log_idUser,log_descripcion,log_comando) VALUES(?,?,?)";
		$arrDataLog = array($usuario,$pagina_error,$sql);
		$log = $this->insert($sqlLog,$arrDataLog);
		return $request;
	}
	/********** deshabilitar usuario **********/
	public function statusUser(int $intIdUser, int $intStatus){
		$this->intIdUser = $intIdUser;
		$this->intStatus = $intStatus;
		$sql = "UPDATE table_user SET user_status = ? WHERE user_id = $this->intIdUser";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		if($this->intStatus == 1){
			$request = "1";
		}else{
			$request = "2";
		}
		return $request;
	}
}