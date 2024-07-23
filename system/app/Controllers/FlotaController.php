<?php
header('Access-Control-Allow-Origin: *');
class Flota extends Controllers{
	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'dashboard');
		}
		//invocar para que se ejecute el metodo de la herencia
		parent::__construct();
	}
	public function flota(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "FLOTA";
		$data['page_title'] = "TODA LA FLOTA";
		$data['page_name'] = "flota";
		$data['page_link'] = "flota";
		$data['page_menu_open'] = "flota-menu";
		$data['page_link_acitvo'] = "link-flota";
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "flota", $data);
	}
	/**********funcion de listar todos las unidades para la tabla**********/
	public function getFlota(){
		$arrData = $this->model->selectFlota();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if ($arrData[$i]['status_unidad'] == 0) {
				$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-danger" onClick="fntStatus(0,'.$arrData[$i]['id_flota'].')">Desincorporado</a>';
			}
			if ($arrData[$i]['status_unidad'] == 1) {
				$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-success" onClick="fntStatus(1,'.$arrData[$i]['id_flota'].')">Operativo</a>';
			}
			if ($arrData[$i]['status_unidad'] == 2) {
				$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning">Mantenimiento</a>';
			}
			if ($arrData[$i]['status_unidad'] == 3) {
				$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(3,'.$arrData[$i]['id_flota'].')">Inoperativo</a>';
			}
			if ($arrData[$i]['status_unidad'] == 4) {
				$arrData[$i]['status_unidad'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(4,'.$arrData[$i]['id_flota'].')">Critca</a>';
			}
			$arrData[$i]['id_unidad'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/**********funcion de listar todos las marcas de unidades **********/
	public function getSelectMarca(){
		$htmlOptions = "";
		$arrData = $this->model->selectMarca();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['rol_id'].'">'.$arrData[$i]['rol_name'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/**********funcion de listar todos los modelos de unidades**********/
	public function getSelectModelo(){
		$htmlOptions = "";
		$arrData = $this->model->selectModelos();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['modelo_unidad'].'">'.$arrData[$i]['modelo_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/**********funcion de guardar unidad en flota**********/
	public function setUnidad(){
		//almacenar los datos en variables
		// $intIdUnidad = intVal($_POST['idUnidad']);
		$srtIdUnidad = $_POST["txtIdUnidad"];
		$srtMarcaUnidad = $_POST['listMarcaUnidad'];
		$srtModelo = strtoupper($_POST["listModelo"]);
		$srtVim = strtoupper($_POST["txtVimUnidad"]);
		$srtFechaUnidad = $_POST["txtFechaUnidad"];
		$srtCapacidad = $_POST["txtCapacidad"];
		$srtTipoCombustible = strtoupper($_POST["txtTipoCombustible"]);
		if($srtIdUnidad == "" || $srtMarcaUnidad == "" || $srtModelo == "" || $srtVim == "" || $srtFechaUnidad == "" || $srtCapacidad == "" || $srtTipoCombustible == ""){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar los campos'); 
		}else{
			$request_unidad = $this->model->insertUnidad($srtIdUnidad,$srtMarcaUnidad,$srtModelo, $srtVim,$srtFechaUnidad,$srtCapacidad,$srtTipoCombustible);
			$option = 1;
			if($request_unidad > 0){
			/***************si es mayor a 0 indica que si se ejecuto el query***************/
				$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente'); 
			}else if($request_unidad == "exist"){
				$arrResponse = array('status'=> false,'msg' => '¡Atención esa unidad ya existe.'); 
			}else{
				$arrResponse = array('status'=> false,'msg' => '¡No es posible almacenar los datos.'); 
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*************cambiar estado de la unidad***************/
	public function statusUnidad(){
		if($_POST){
			$idStatus = intval($_POST['idStatus']);
			$idUnidad = intval($_POST['idUnidad']);
			$srtText = strtoupper($_POST['srtText']);
			$intUserId = $_SESSION['userData']['user_id'];
			$requestStatus = $this->model->statusUnidad($idUnidad,$idStatus);
			// ingresar un historial de cambios
			if($requestStatus){
				$requestCambioStatus = $this->model->cambioStatusUnidad($idUnidad,$idStatus,$srtText,$intUserId);
				if($idStatus == 0){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Desincorporada', 'estado' => 0);
				}else if($idStatus == 1){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Operativa','estado' => 1);
				}else if($idStatus == 2){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Mantenimiento','estado' => 2);
				}else if($idStatus == 3){
					$arrResponse = array('status' => true, 'msg' => 'Unidad Inoperativa','estado' => 3);
				}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar estado de unidad');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/*********
	 * //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion de la vista ingresar mantenimiento 
	 */
	public function ingresar_mant(){
		$data['page_tag'] = "Ingresar mantenimiento";
		$data['page_title'] = "Mantenimiento";
		$data['page_name'] = "ingresar_mant";
		$data['page_link'] = "mantenimiento";
		$data['page_menu_open'] = "mant-menu";
		$data['page_link_acitvo'] = "link-ingresar_mant";
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "ingresar_mant", $data);
	}
	/*********** funcion obtener unidades en mantenimiento para la tabla*****************/
	public function listUnidadMantenimiento(){
		$arrData = $this->model->selectFlotaMantenimiento();
		//provar que trae el array
		// dep($arrData[0]['rol_status']);exit();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			if ($arrData[$i]['tipo_mantenimiento'] == 'c') {
				$arrData[$i]['tipo_mantenimiento'] = '<span>Correctivo</a>';
			}else {
				$arrData[$i]['tipo_mantenimiento'] = '<span>Preventivo</span>';
			}
			if ($arrData[$i]['fecha_salida'] == '') {
				$arrData[$i]['fecha_salida'] = '<span>En espera</a>';
			}
			$arrData[$i]['id_unidad'] ='<a href=unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*************funcion de listar todos unidades para mantenimiento y cargarlo en el select******************/
	public function getSelectUnidad(){
		$htmlOptions = "";
		$arrData = $this->model->selectUnidad();
		if(count($arrData) > 0){
			$htmlOptions .= '<option selected>Seleccione Unidad</option>';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_flota'].'">'.$arrData[$i]['id_unidad'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
	/***************funcion ingresar unidad a mantenimiento*****************/
	public function setIMantenimiento(){
		$intidUnidad = $_POST['idUnidad'];
		$srtListUnidad = $_POST['listUnidad'];
		$srtRutaUnidad = strtoupper($_POST['txtRutaUnidad']);
		$srtOperador = strtoupper($_POST['txtOperador']);
		$srtMecanico = strtoupper($_POST['txtMecanico']);
		$srtKilometraje = strtoupper($_POST['txtKilometraje']);
		$srtFechaEntrada = $_POST['txtFechaEntrada'];
		$srtObsOper = strtoupper($_POST['txtObsOper']);
		$srtObsSuper = strtoupper($_POST['txtObsSuper']);
		$srtDiagnostico = strtoupper($_POST['txtDiagnostico']);
		$srtRecomendacion = strtoupper($_POST['txtRecomendacion']);
		$srtRadioTipo = $_POST['radioTipo'];
		$intUserId = $_SESSION['userData']['user_id'];
		if($srtListUnidad == "Seleccione Unidad" || $srtRutaUnidad == "" || $srtOperador == "" || $srtMecanico == "" || $srtKilometraje == "" || $srtFechaEntrada == "" || $srtDiagnostico == "" || $srtRecomendacion == ""  || $srtObsOper == ""  || $srtObsSuper == ""){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar los campos');
		}else{
			$request_ingreso = $this->model->setIMantenimiento($srtListUnidad,$srtRutaUnidad,$srtOperador,$srtMecanico,$srtKilometraje,$srtRadioTipo,$srtFechaEntrada,$srtDiagnostico,$srtRecomendacion,$srtObsOper,$srtObsSuper,$intUserId);
			if($request_ingreso > 0 ){
				$requestStatus = $this->model->statusUnidad($srtListUnidad,2);
				$arrResponse = array('status'=> true,'msg' => 'Unidad en mantenimiento');
			}else{
				$arrResponse = array('status'=> false,'msg' => 'Ah ocurrido un error');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}

	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function unidad(){
		//invocar la vista con views y usamos getViews y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home		
		$data['page_tag'] = "Historial Unidad";
		$data['page_title'] = "Historial Unidad";
		$data['page_userImg'] = "usuario/default.png";
		$data['page_userNomb'] = "William Enrique";
		$data['page_userRol'] = "Administrador";
		$data['page_name'] = "unidad";

		$data['page_link'] = "mantenimiento";
		$data['page_menu_open'] = "unidad-menu";
		$data['page_link_acitvo'] = "link-unidad";
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "unidad", $data);
	}
	/************obtener informacion de la unidad y mostrarla en el timeline*********************/
	public function getUnidad(int $idUnidad){
		$idUnidad = intval($idUnidad);
		if($idUnidad > 0){
			$htmlOptions = "";
			$arrDataH = $this->model->selectUnidadHM($idUnidad);
			if(empty($arrDataH)){
				$arrData = $this->model->selectUnidadID($idUnidad);
				if($arrData['status_unidad'] == 0){
					$status = '<span class="badge badge-danger">DESINCORPORADO</span>';
				}
				if($arrData['status_unidad'] == 1){
					$status = '<span class="badge badge-success">OPERATIVO</span>';
				}
				if($arrData['status_unidad'] == 2){
					$status = '<span class="badge badge-info">MANTENIMIENTO</span>';
				}
				if($arrData['status_unidad'] == 3){
					$status = '<span class="badge badge-danger">critico</span>';
				}
				$htmlOptions .= '
					<div class="invoice p-3 mb-3">
						<div class="row">
							<div class="col-12">
								<h5>'.$arrData['id_unidad'].' <small class="float-right">CREACION:'.$arrData["fecha_creacion"].'</small></h5>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>VIN   <span class="text-info"> '.$arrData['vim_unidad'].'</span></strong><br>
									<strong>COMBUSTIBLE  '.$arrData['tipo_combustible'].'</strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MODELO  '.$arrData['modelo_unidad'].'</strong><br>
									<strong>CAPACIDAD '.$arrData['cap_pasajero'].'</strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MARCA '.$arrData['marca_unidad'].'</strong><br>
									<strong>'.$status.'</strong><br>
								</address>
							</div>
						</div>
					</div>
				';
				
			}else{
				$arrDataH = $this->model->selectUnidadHM($idUnidad);
				// dep($arrDataH);
				// $arrResponse = array('status' => true, 'msg' => $arrDataH);
				if($arrDataH[0]['status_unidad'] == 0){
					$status = '<span class="badge badge-danger">DESINCORPORADO</span>';
				}
				if($arrDataH[0]['status_unidad'] == 1){
					$status = '<span class="badge badge-success">OPERATIVO</span>';
				}
				if($arrDataH[0]['status_unidad'] == 2){
					$status = '<span class="badge badge-info">MANTENIMIENTO</span>';
					$mantActivo = '
					<form id="mantOut">
					<input type="hidden" name="idMantenimiento" value="'.$arrDataH[0]['id_unidad_mantenimiento'].'">
						<div class="form-row align-items-center">
							<div class="col-sm-6 my-1">
								<label class="sr-only" for="inlineFormInputName">OBSERVACION SALIDA</label>
								<input type="text" class="form-control" placeholder="OBSERVACION SALIDA" id="txtObsSalida" name="txtObsSalida">
							</div>
							<div class="col-sm-2 my-1">
								<label class="sr-only" for="inlineFormInputName">FECHA SALIDA</label>
								<input type="date" class="form-control" placeholder="FECHA SALIDA" id="txtFechaSalida" name="txtFechaSalida">
							</div>
							<button type="button" id="btnActionForm" onClick="fntOutMant('.$arrDataH[0]['id_flota'].')" class="btn btn-primary btn-sm">
								</i><span id="btnText">Salir mantenimiento</span>
							</button>
						</div>
					</form>';
				}else{
					$mantActivo = "";
				}
				if($arrDataH[0]['status_unidad'] == 3){
					$status = '<span class="badge badge-danger">CRITICO</span>';
				}
				$htmlOptions .= '
					<div class="invoice p-3 mb-3">
						<div class="row">
							<div class="col-12">
								<h5>'.$arrDataH[0]['id_unidad'].' <small class="float-right">CREACION:'.$arrDataH[0]["fecha_creacion"].'</small></h5>
							</div>
						</div>
						<div class="row invoice-info">
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>VIN   <span class="text-info">'  .$arrDataH[0]['vim_unidad'].'</span></strong><br>
									<strong>COMBUSTIBLE  <span class="text-info">'.$arrDataH[0]['tipo_combustible'].'</span></strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MODELO  <span class="text-info">'.$arrDataH[0]['modelo_unidad'].'</span></strong><br>
									<strong>CAPACIDAD <span class="text-info">'.$arrDataH[0]['cap_pasajero'].'</span></strong><br>
								</address>
							</div>
							<div class="col-sm-4 invoice-col">
								<address>
									<strong>MARCA '.$arrDataH[0]['marca_unidad'].'</strong><br>
									'.$status.'
								</address>
							</div>
						</div>
						'.$mantActivo.'
					</div>
				';
				$htmlFin = "";
				for ($i=0; $i < count($arrDataH); $i++) {
					
					$htmlOptions .= '
					<div class="timeline">
						<div class="time-label">
							<span class="bg-red">'.$arrDataH[$i]['fecha_entrada'].'</span>
						</div>
						<div>
							<i class="fas fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<h6 class="time timeline-header" style="font-size: 12px;"><a href="#" class="mr-1">KM: </a> '.$arrDataH[$i]['km_unidad'].'</h5>
								<h6 class="timeline-header" style="font-size: 12px;"><a href="#" class="mr-1">RUTA :</a> '.$arrDataH[$i]['ruta_unidad'].'</h6>
								<div class="timeline-body">
									<strong class="mr-1">MECANICO :</strong><span class="mr-2">'.$arrDataH[$i]['nomb_mecanico'].'</span>
									<strong class="mr-1">OPERADOR :</strong><span>'.$arrDataH[$i]['operardor_unidad'].'</span><br>
									<strong class="mr-1">OBSERVACION OPERADOR :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span>
									<strong class="mr-1">OBSERVACION SUPERVISOR :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span>
									<strong class="mr-1">DIAGNOSTICO :</strong><span class="mr-2">'.$arrDataH[$i]['diagnostico'].'</span><br>
									<strong class="mr-1">RECOMENDACION :</strong><span class="mr-2">'.$arrDataH[$i]['recomendacion'].'</span>
								</div>
								<div class="timeline-footer">
									<strong class="mr-1">OBS SALIDA :</strong><span class="mr-2">'.$arrDataH[$i]['obsSalida'].'</span><br>
									<span class="badge badge-info">'.$arrDataH[$i]['fecha_salida'].'</span>
									<h5>'.$arrDataH[$i]['user_nombres'].' '.$arrDataH[$i]['user_apellidos'].'</h5>
								</div>
							</div>
						</div>
					<div>
						<i class="fas fa-clock bg-gray"></i>
					</div>
				</div>
					';
				}
			}
			echo $htmlOptions;
			die();
		}
	}
	/************sacar unidad del mantenimiento*********************/
	public function outMantenimiento(int $idUnidad){
		$idUnidad = intval($idUnidad);
		$txtFechaSalida = $_POST['txtFechaSalida'];
		$idMantenimiento = $_POST['idMantenimiento'];
		$txtObsSalida = strtoupper($_POST["txtObsSalida"]);
		if($txtObsSalida == "" || $txtFechaSalida == ""){
			$arrResponse = array('status' => false, 'msg' => 'Debe colocar una fecha');
		}else{
			$requestUpdate = $this->model->outMantenimiento($idUnidad,$txtFechaSalida,$txtObsSalida,$idMantenimiento);
			if($requestUpdate == 1){
				$arrResponse = array('status' => true, 'msg' => 'Salida exitosa');
				$requestUpdateUnidad = $this->model->statusUnidad($idUnidad, 1);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
	/*********
	 * //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion de la vista ingresar mantenimiento 
	 */
	public function historia(){
		$data['page_tag'] = "HISTORIA CAMBIO";
		$data['page_title'] = "Historial de cambios";
		$data['page_name'] = "ingresar_mant";
		$data['page_link'] = "mantenimiento";
		$data['page_menu_open'] = "mant-menu";
		$data['page_link_acitvo'] = "link-ingresar_mant";
		$data['page_functions'] = "function.flota.js";
		$this->views->getViews($this, "historia", $data);
	}
	public function getHistoriaStatus(){
		$arrDataH = $this->model->selectHistoriaStatus();
		for ($i= 0; $i < count($arrDataH) ; $i++) {
			if ($arrDataH[$i]['idStatus'] == 0) {
				$arrDataH[$i]['idStatus'] = '<a style="font-size: 15px;">CRITICO</a>';
			}
			if ($arrDataH[$i]['idStatus'] == 1) {
				$arrDataH[$i]['idStatus'] = '<a style="font-size: 15px;">OPERATIVO</a>';
			}
			if ($arrDataH[$i]['idStatus'] == 2) {
				$arrDataH[$i]['idStatus'] = '<a style="font-size: 15px;">MANTENIMIENTO</a>';
			}
			if ($arrDataH[$i]['idStatus'] == 3) {
				$arrDataH[$i]['idStatus'] = '<a style="font-size: 15px;">INOPERATIVO</a>';
			}
			$arrDataH[$i]['fechaCambio'] = formatear_fecha($arrDataH[$i]['fechaCambio']);
		}
		echo json_encode($arrDataH,JSON_UNESCAPED_UNICODE);
		die();
	}

		/********* NO ESTA EN USO
	 * //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function unidad_mant(){
		$data['page_tag'] = "MANTENIMIENTO";
		$data['page_title'] = "Unidad en mantenimiento";
		$data['page_name'] = "unidad_mant";
		$data['page_link'] = "mantenimiento";
		$data['page_menu_open'] = "mant-menu";
		$data['page_link_acitvo'] = "link-unidad_mant";
		$data['page_functions'] = "function.mant.und.js";
		$this->views->getViews($this, "unidad_mant", $data);
	}
	/************funcion traer unidad en mantenimiento al activar el select para historial********************/
	/*revisar cuando veo una unidad en mantenimiento*/
	public function getUnidadMant(int $idFlota){
		$idFlota = intval($idFlota);
		if($idFlota > 0){
			$arrData = $this->model->selectUnidadHM($idFlota);
			if(empty($arrData)){
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
			}else{
				// $arrResponse = array('status' => true, 'data' => $arrData);
				$htmlOptions = "";
				$arrResponse = array('status' => true, 'msg' => 'historial');
				for ($i=0; $i < count($arrData); $i++) {
					if($arrData[$i]['tipo_mantenimiento'] == "c"){
						$tipoMant = '<span class="badge badge-info">CORRECTIVO</span>';
					}else{
						$tipoMant  = '<span class="badge badge-info">PREVENTIVO</span>';
					}
					$htmlOptions .= '
								<div class="card ">
									<div class="card-header">
										<h3 class="card-title mr-2 accent-light" > <span id="unidad">'.$arrData[$i]['id_unidad'].'</span></h3>
										<h3 class="card-title mr-2 accent-light" > <span id="marca">'.$arrData[$i]['marca_unidad'].'</span>  </h3>
										<h3 class="card-title mr-2" > <span id="modelo">'.$arrData[$i]['vim_unidad'].'</span>  </h3>
										<h3 class="card-title mr-2" > <span id="vim">'.$arrData[$i]['modelo_unidad'].'</span></h3>
									</div>
									<div class="card-body">
										<form id="formUndMant">
											<div class="form-row align-items-center">
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">ENTRADA</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['fecha_entrada'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">OPERADOR</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['operardor_unidad'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">MECANICO</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['nomb_mecanico'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">Combustible</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['tipo_combustible'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">KM</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['km_unidad'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">RUTA</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['ruta_unidad'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">CAPACIDAD</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['cap_pasajero'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName">AÑO</label>
													<input type="text" class="form-control" disabled value="'.$arrData[$i]['fecha_creacion'].'">
												</div>
												<div class="col-sm-2 my-1">
													<label class="" for="inlineFormInputName"></label>
													'.$tipoMant.'
												</div>
												<div class="row">
													<div class="col-sm-6 my-1">
														<label class="" for="floatingTextarea2">Diagnostico</label>
														<input type="text" class="form-control" disabled   value="'.$arrData[$i]['diagnostico'].'"></input>
													</div>
													<div class="col-sm-6 my-1">
														<label class="" for="floatingTextarea2">Recomendacion</label>
														<input type="text" class="form-control" disabled  value="'.$arrData[$i]['recomendacion'].'"></input>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								';
				}
			}
			echo $htmlOptions;
			die();
		}
		die();
	}
	/************funcion de listar toda la flota en mantenimiento status 1 no repetidas en el select*********************/
	public function selectUnidadMantenimiento(){
		$htmlOptions = "";
		$arrData = $this->model->selectFlotaMantenimiento();
		if(count($arrData) > 0){
			$htmlOptions .= '<option selected>Seleccione Unidad</option>';
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['id_flota'].'">'.$arrData[$i]['id_unidad'].'</option>';
			}
		}else{
			$htmlOptions .= '<option value="0">No hay unidades</option>';
		}
		echo $htmlOptions;
		die();
	}
	
}