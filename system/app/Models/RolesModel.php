<?php
class RolesModel extends Mysql {

	//establecemos variables para definir un rol
	public $strId;
	public $strRol;
	public $strDescripcion;
	public $intStatus;
	public $intIdRol;

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
	//funcion para traer todos los roles
	public function selectRoles(){
		$sql = "SELECT * FROM table_roles WHERE rol_status != 0";
		$request = $this->select_all($sql);
		return $request;
	}
	//funcion para obtener solo un rol
	public function selectRol(int $id){
		$this->intIdRol = $id;
		$sql = "SELECT *FROM table_roles WHERE rol_id = $this->intIdRol";
		$request = $this->select($sql);
		return $request;
	}
	public function insertRol(string $rol, string $descripcion, int $status){
		//asignamos las propiedades a las variable
		$return = "";
		$this->strRol = $rol;
		$this->strDescripcion = $descripcion;
		$this->intStatus = $status;
		//seleccionamos todos los rol para comprobar que no exista
		$sql = "SELECT * FROM table_roles WHERE rol_name = '{$this->strRol}'";
		$request = $this->select_all($sql);
		//validar si ya existe si no hace el insert
		if(empty($request)){
			$sql_insert =  "INSERT INTO table_roles(rol_name,rol_descripcion,rol_status) VALUES (?,?,?)"; // se prepara el insert
			$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);// armamos el array con los datos obtenidos
			$request_insert = $this->insert($sql_insert,$arrData);//enviamos el query y el array de datos 
			$return = $request_insert;//retorna el id insertado
		}else{
			$return = "exist";
		}
		return $return;
	}

	public function updateRol(int $idRol, string $rol, string $descripcion, int $status){
		$this->intIdRol = $idRol;
		$this->strRol = $rol;
		$this->strDescripcion = $descripcion;
		$this->intStatus = $status;
		/************************************************
		 *seleccionamos todos los roles  el nombre sea igual y el id sea diferente que estamos enviando
		 si el nombre que estamos enviando es igual al de la BD y el id es diferente
		 si es mismo nombre con mismo id se actualiza si no dira que ya existe y no se cumple
		 */
		$sql = "SELECT * FROM table_roles WHERE rol_name = '$this->strRol' AND rol_id != $this->intIdRol";
		$request = $this->select_all($sql);
		//validamos si el request esta vacio no se esta cumpliendo y actualizamos
		if(empty($request)){
			$sql = "UPDATE table_roles SET rol_name = ?, rol_descripcion = ?, rol_status = ? WHERE rol_id = $this->intIdRol";
			//preparamos la variable y le enviamos los item en orden
			$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
			//enviamos los datos a mysql
			$request = $this->update($sql,$arrData);
		}else{
			//ya existe el rol que estamos ingresando
			$request = "exist";
		}
		return $request;
	}
	public function deleteRol(int $intIdRol){
		$this->intIdRol = $intIdRol;
	/*******************************************
	 * comprovamos que ese rol no este asocido a una persona 
	 */
		$sql = "SELECT * FROM table_person  WHERE person_rol = $this->intIdRol";
		$request = $this->select_all($sql);
		if(empty($request)){
			//preparamos el query
			$sql = "UPDATE table_roles SET rol_status = ? WHERE rol_id = $this->intIdRol";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			if($request){
				$request = 'ok';
			}else{
				$request = 'error';
			}
		}else{
			$request = 'exist';
		}
		return $request;
	}
	
}