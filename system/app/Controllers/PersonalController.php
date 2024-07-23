<?php
header('Access-Control-Allow-Origin: *');
class Personal extends Controllers{
	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'dashboard');
		}
		//invocar para que se ejecute el metodo de la herencia
		parent::__construct();
	}
	//TODO: interaz
	public function personal(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "Data del personal";
		$data['page_title'] = "Personal del servicio";
		$data['page_menu_open'] = "personal-menu";//1 abrir el menu 
		$data['page_link'] = "personal";//2 activar el menu
		$data['page_link_acitvo'] = "link-personal";//3 activar el item
		$data['page_name'] = "personal";//4 seleccionar el item
		$data['page_functions'] = "function.personal.js";
		$this->views->getViews($this, "personal", $data);
	}
	public function getPersonal(){
		$arrData = $this->model->selectPersonal();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if ($arrData[$i]['personal_status'] == 0) {
				$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-danger" onClick="fntStatus(0,'.$arrData[$i]['id_personal'].')">Inactivo</a>';
			}
			if ($arrData[$i]['personal_status'] == 1) {
				$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success" onClick="fntStatus(1,'.$arrData[$i]['id_personal'].')">Activo</a>';
			}
			if ($arrData[$i]['personal_status'] == 2) {
				$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(2,'.$arrData[$i]['id_personal'].')">Vacaciones</a>';
			}
			if ($arrData[$i]['personal_status'] == 3) {
				$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(3,'.$arrData[$i]['id_personal'].')">Reposo</a>';
			}
			$arrData[$i]['id_personal'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_personal'].' title="Ver">'.$arrData[$i]['id_personal'].'</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	public function getSelectCargo(){
		$htmlOptions = "";
		$arrData = $this->model->selectCargo();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_cargo'].'">'.$arrData[$i]['cargo'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
		/*************cambiar estado de la unidad***************/
	public function statusPersonal(){
		if($_POST){
			$idPersonal = intval($_POST['idPersonal']);
			$idStatus = intval($_POST['idStatus']);
			$srtText = strtoupper($_POST['srtText']);
			$intUserId = $_SESSION['userData']['user_id'];
			$requestStatus = $this->model->statusPersonal($idPersonal,$idStatus);
			// ingresar un historial de cambios
			if($requestStatus){
				$requestCambioStatus = $this->model->cambioStatusPersonal($idPersonal,$idStatus,$srtText,$intUserId);
				if($idStatus == 0){
					$arrResponse = array('status' => true, 'msg' => 'Personal no labora ', 'estado' => 0);
				}else if($idStatus == 1){
					$arrResponse = array('status' => true, 'msg' => 'Personal Activo','estado' => 1);
				}else if($idStatus == 2){
					$arrResponse = array('status' => true, 'msg' => 'Personal de Vacaciones','estado' => 2);
				}else if($idStatus == 3){
					$arrResponse = array('status' => true, 'msg' => 'Personal de Reposo','estado' => 3);
				}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar estado del personal');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	//TODO: interaz
	public function unoxdiez(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "1X10";
		$data['page_title'] = "Personal del servicio";
		$data['page_menu_open'] = "personal-menu";//1 abrir el menu 
		$data['page_link'] = "personal";//2 activar el menu
		$data['page_link_acitvo'] = "link-unoxdiez";//3 activar el item
		$data['page_name'] = "personal";//4 seleccionar el item
		$data['page_functions'] = "function.personal.js";
		$this->views->getViews($this, "unoxdiez", $data);
	}
	// obtener y cargar select de personal
	public function getListPersonal(){
		$htmlOptions = "";
		$arrData = $this->model->selectPersonal();
		if(count($arrData) > 0){
			$htmlOptions .= '<option value="0">SELECCIONE PERSONAL</option>';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_personal'].'">'.$arrData[$i]['personal_nombre'].' - '.$arrData[$i]['personal_cedula'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	// trae peronal para la tabla del voto
	public function getPersonalVota(){
		$arrData = $this->model->selectPersonalVotante();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if ($arrData[$i]['personal_voto'] == 0) {
				$arrData[$i]['personal_voto'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntVotoPersonal('.$arrData[$i]['id_personal'].')">NO</a>';
			}
			if ($arrData[$i]['personal_voto'] == 1) {
				$arrData[$i]['personal_voto'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success">SI</a>';
			}
			$arrData[$i]['1x10'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success" onClick="fntView1x10('.$arrData[$i]['id_personal'].')">1X10</a>';
			}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/**********funcion agregar unox10 al personal**********/
	public function setUnoXDiez(){
		//almacenar los datos en variables
		$listPersonal = $_POST["listPersonal"];
		$txtCedula = $_POST["txtCedula"];
		$txtNombre = strtoupper($_POST["txtNombre"]);
		// $txtTelefono = $_POST['txtTelefono'];
		if($listPersonal == 0 || $txtCedula == "" || $txtNombre == ""){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar los campos'); 
		}else{
			$request = $this->model->insertUnoXDiez($txtCedula,$txtNombre,$listPersonal);
			if($request >= '1'){
				$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente '.$request); 
			}else if($request == 0 ){
				$arrResponse = array('status'=> false,'msg' => "Militante ya agregado"); 
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);	
		die();
	}
	// obtener militantes y cargarlos en una lista segun sea numero de personal
	public function getUnoXDiez(int $idPersonal){
		$htmlOptions = "";
		$idPersonal;
		$arrData = $this->model->selectUnoXDiez($idPersonal);
		if(empty($arrData)){
			$htmlOptions = '<ul><li>No posee militantes</li></ul>';
		}else{
				$htmlOptions = '<ol>';
			for ($i=0; $i < count($arrData); $i++) {
				if($arrData[$i]['voto']== 1){
					$voto = '<a style="font-size: 15px; cursor:pointer" class="float-right badge badge-success">Ya voto</a>';
				}else{
					$voto = '<a style="font-size: 15px; cursor:pointer" class="float-right badge badge-warning" onClick="fntVotoMilitante('.$idPersonal.','.$arrData[$i]['id_voto'].')">No ha votado</a>';
				}
				$htmlOptions .= '<li>
														<a href=javascript:; style="font-size: 15px; cursor:pointer">'.$arrData[$i]['nombre_1x10'].'</a>
														'.$voto.'
												</li>';
			}
			$htmlOptions .= '</ol>';
		}
		echo $htmlOptions;
		die();
	}
	
	public function changeVotoP(){
		if($_POST){
			$intPersonal = intval($_POST['intPersonal']);
			$requestVoto = $this->model->changeVotoP($intPersonal);
			if($requestVoto){
				$arrResponse = array('status' => true, 'msg' => 'Cambio exitoso');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function changeVotoM(){
		if($_POST){
			$intVoto = intval($_POST['intVoto']);
			$requestVoto = $this->model->changeVotoM($intVoto);
			if($requestVoto){
				$arrResponse = array('status' => true, 'msg' => 'Cambio exitoso');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	//TODO: interaz
	public function faltante(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "Personal Faltante 1X10";
		$data['page_title'] = "Personal del servicio";
		$data['page_menu_open'] = "personal-menu";//1 abrir el menu 
		$data['page_link'] = "personal";//2 activar el menu
		$data['page_link_acitvo'] = "link-faltante";//3 activar el item
		$data['page_name'] = "personal";//4 seleccionar el item
		$data['page_functions'] = "function.personal.js";
		$this->views->getViews($this, "faltante", $data);
	}
	public function getPersonalF(){
		$arrData = $this->model->selectPersonalF();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning">Falta</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	//TODO: interaz
	public function conteo(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "Personal Faltante 1X10";
		$data['page_title'] = "Personal del servicio";
		$data['page_menu_open'] = "personal-menu";//1 abrir el menu 
		$data['page_link'] = "personal";//2 activar el menu
		$data['page_link_acitvo'] = "link-conteo";//3 activar el item
		$data['page_name'] = "personal";//4 seleccionar el item
		$data['page_functions'] = "function.personal.js";
		$this->views->getViews($this, "conteo", $data);
	}
	/******** cargar personal que ya voto *********/
	public function getPersonalConteo(){
		$arrData = $this->model->selectPersonalConteo();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			$arrData[$i]['personal_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info">VOTO</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/******** contar cantidad de personas ya votaron *********/
	public function contPersonal(){
		$arrData = $this->model->contPersonal();
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
}