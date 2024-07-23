<?php
class PersonalModel extends Mysql {

	public function __construct(){
	//heradar la clase padre 
		parent::__construct();
	}
	/**********funcion para traer todo el personal**********/
	public function selectPersonal(){
		$sql = "SELECT p.*, c.* FROM table_cargo c 
						INNER JOIN table_personal p  ON p.personal_cargo = c.id_cargo AND p.personal_status <> 0 ORDER BY p.personal_cedula desc ";
		$request = $this->select_all($sql);
		return $request;
	}
	/**********funcion para seleccionar carg*********/
	public function selectCargo(){
		$sql = "SELECT * FROM table_cargo";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** cambiar el status del personal**********/
	public function statusPersonal(int $intPersonal, int $intStatus){
		$this->intPersonal = $intPersonal;
		$this->intStatus = $intStatus;
		$sql = "UPDATE table_personal SET personal_status = ? WHERE id_personal = $this->intPersonal";
		$arrData = array($this->intStatus);
		$request = $this->update($sql,$arrData);
		return $request;
	}
		/********** cambiar el status y agregar texto**********/
	public function cambioStatusPersonal(int $intPersonal, int $intStatus, string $srtText, int $intUserId){
		//asignamos las propiedades a las variable
		$return = "";
		$this->intPersonal = $intPersonal;
		$this->intStatus = $intStatus;
		$this->srtText = $srtText;
		$this->intUserId = $intUserId;
		$sql =  "INSERT INTO table_cambiostatuspersonal (id_personal, idStatus,textCambio,user_id) VALUES (?,?,?,?)";
		$arrData = array($this->intPersonal,$this->intStatus,$this->srtText,$this->intUserId);// armamos el array con los datos obtenidos
		$request = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
		return $request;
	}

	public function selectPersonalVotante(){
		$sql = "SELECT p.*, c.* FROM table_cargo c 
						INNER JOIN table_personal p  ON p.personal_cargo = c.id_cargo AND p.personal_status <> 0";
		$request = $this->select_all($sql);
		return $request;
	}
	// traer agregados del personal  
	public function selectUnoXDiez(int $intPersonal){
		$this->intPersonal = $intPersonal;
		$sql = "SELECT u.*, v.* FROM table_1x10 u 
						INNER JOIN table_voto v  ON u.id_1x10 = v.id_1x10
						WHERE u.id_personal= $this->intPersonal"; 
		// $sql = "SELECT p.*, c.*, u.* FROM table_cargo c 
		// 	INNER JOIN table_personal p  ON p.personal_cargo = c.id_cargo
		// 	INNER JOIN table_1x10 u on u.id_personal = p.id_personal ";
		$request = $this->select_all($sql);
		return $request;
	}
	/********** insertar 1x10 y en tabla voto**********/
	public function insertUnoXDiez(string $strCedula, string $strNombre, int $intPersonal){
		//asignamos las propiedades a las variable
		$return = "";
		$this->strCedula = $strCedula;
		$this->strNombre = $strNombre;
		$this->intPersonal = $intPersonal;
		//seleccionamos todos los rol para comprobar que no exista
		$sql = "SELECT * FROM table_1x10 WHERE cedula_1x10 = $this->strCedula";
		$request = $this->select_all($sql);
		//validar si ya existe si no hace el insert
		if(empty($request)){
			// $return = "vacio";
			$sql = "INSERT INTO table_1x10 (cedula_1x10,nombre_1x10,id_personal)VALUES (?,?,?)"; // se 
			$arrData = array($this->strCedula,$this->strNombre,$this->intPersonal);
			$request_insert = $this->insert($sql,$arrData);//enviamos el query y el array de datos 
			$return = $request_insert;//retorna el id insertado
			$sql_insert = "INSERT INTO table_voto (id_1x10,id_personal,voto)VALUES (?,?,?)"; // se 
			$arrDataV = array($request_insert,$this->intPersonal,0);
			$request = $this->insert($sql_insert,$arrDataV);
		}else{
			$return = 0;
		}
		return $return;
	}
	// TODO: cambio del estado al votar personal y militante
	public function changeVotoP(int $intPersonal){
		$this->intPersonal = $intPersonal;
		$this->intVoto = 1;
		$sql = "UPDATE table_personal SET personal_voto = ? WHERE id_personal = $this->intPersonal";
		$arrData = array($this->intVoto);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	public function changeVotoM(int $intIdVoto){
		$this->intIdVoto = $intIdVoto;
		$this->intVoto = 1;
		$sql = "UPDATE table_voto SET voto = ? WHERE id_voto = $this->intIdVoto ";
		$arrData = array($this->intVoto);
		$request = $this->update($sql,$arrData);
		return $request;
	}
	// obtener personal que le falte el 1x10
	public function selectPersonalF(){
		// $sql = "SELECT * FROM table_personal p
		// 				WHERE NOT EXISTS (SELECT NULL FROM table_voto t2 WHERE t2.id_personal = p.id_personal)";
		$sql = "SELECT t1.*, t3.*	FROM table_personal t1
							INNER JOIN table_cargo t3  ON t1.personal_cargo = t3.id_cargo
							LEFT JOIN table_voto t2
							ON t2.id_personal = t1.id_personal
							WHERE t2.id_personal IS NULL";
		$request = $this->select_all($sql);
		return $request;
	}

	// obtener personal ya voto
	public function selectPersonalConteo(){
		// $sql = "SELECT * FROM table_personal p
		// 				WHERE NOT EXISTS (SELECT NULL FROM table_voto t2 WHERE t2.id_personal = p.id_personal)";
		$sql = "SELECT t1.*, t3.*	FROM table_personal t1
						INNER JOIN table_cargo t3  ON t1.personal_cargo = t3.id_cargo
						WHERE t1.personal_voto = 1";
		$request = $this->select_all($sql);
		return $request;
	}
	public function contPersonal(){
		$sql = "SELECT COUNT(*) AS CONTEO	FROM table_personal 	WHERE personal_voto = 1";
		$request = $this->select_all($sql);
		return $request;
	}
}