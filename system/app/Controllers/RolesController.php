<?php
class Roles extends Controllers{

	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'login');
		}
		parent::__construct();
	}
	public function roles(){
		$data['page_id'] = 3;
		$data['page_tag'] = "Roles Usuario";
		$data['page_title'] = "Dashboard - Roles Usuario";
		$data['page_name'] = "roles";
		$data['page_link'] = "usuarios"; /*este es el que activa el desplegable del menu y lo activa */
		$data['page_menu_open'] = "user-menu"; /*este es el que activa el desplegable del menu y lo activa */
		$data['page_link_acitvo'] = "link-roles";
		$data['page_functions'] = "function.rol.js";

		$this->views->getViews($this, "roles", $data);
	}

	/****************************************
	 * funcion de listar todos los  rol
	 ***************************************/
	public function getRoles(){
		$arrData = $this->model->selectRoles();
		//provar que trae el array
		// dep($arrData[0]['rol_status']);exit();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) { 
			if ($arrData[$i]['rol_status'] == 1) {
				$arrData[$i]['rol_status'] = '<h5><span class="badge badge-info">Activo</span><h5>';
			}else{
				$arrData[$i]['rol_status'] = '<h5><span class="badge badge-warning">Inactivo</span><h5>';
			}
			$arrData[$i]['opciones'] ='<div class="">
																	<a href="#" class="btn btn-secondary btn-sm btnPremisoRol" onClick="fntRol('.$arrData[$i]['rol_id'].')" title="Permisos"><i class="fa fa-key" aria-hidden="true"></i></a>
																	<a href="#edit" class="btn btn-success btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['rol_id'].')" title="Editar" ><i class="fa fa-edit" aria-hidden="true"></i></a>
																	<a href="button" class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['rol_id'].')" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
																</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
/****************************************
	 * funcion de listar todos los  roles para un usuario nuevo
	 ***************************************/
	public function getSelectRoles(){
		$htmlOptions = "";
		$arrData = $this->model->selectRoles();
		if(count($arrData) > 0){
			for ($i=0; $i < count($arrData); $i++) { 
				$htmlOptions .= '<option value="'.$arrData[$i]['rol_id'].'">'.$arrData[$i]['rol_name'].'</option>';
			}
		}
		echo $htmlOptions;
		die();
	}
		/****************************************
	 * funcion de extraer datos de un  rol
	 ***************************************/
	public function getRol(int $id){
		$intIdRol = intval($id);
		//comprobamos que sea un id valido para poder ejecutar
		if($intIdRol > 0){
			$arrData = $this->model->selectRol($intIdRol);
			if(empty($arrData)){
				$arrResponse = array('status'=> false,'msg' => '¡Datos no encontrados.'); 
			}else{
				$arrResponse = array('status'=> true,'data' => $arrData); 
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	/****************************************
	 * funcion de guardar nuevo rol
	 ***************************************/
	public function setRol(){
		//almacenar los datos en variables
	 	$strRol = $_POST["txtnombre"];
		$strDescripcion = $_POST['txtdescripcion'];
		$intIdRol = intVal($_POST['idRol']);
		if($strRol == ""){
			$arrResponse = array('status'=> false,'msg' => 'Debe llenar el nombre'); 
		}else{
			if(!isset($_POST['radioStatus'])){
				$arrResponse = array('status'=> false,'msg' => 'Debe seleccionar un status'); 
			}else{
				$intStatus = intVal($_POST['radioStatus']);
				//i el id viene en vacio o 0 quiere decir que debemos crear un nuevo rol
				if($intIdRol == 0){
					//enviamos los datos al modelo crear
					$request_rol = $this->model->insertRol($strRol,$strDescripcion,$intStatus);
					$option = 1;
				}else{
					//si trae en id actualizamos 
					$request_rol = $this->model->updateRol($intIdRol,$strRol,$strDescripcion,$intStatus);
					$option = 2;
				}
				//validamos la respuesta del modelo
				if($request_rol > 0){
					/********************************************************************************
					si es mayor a 0 indica que si se ejecuto el query y hacemos otra validacion
						si obtenemos respuesta de 1 fue un insert si no fue actualizado
					**********************************************************************************/
					if($option == 1){
						$arrResponse = array('status'=> true,'msg' => 'Datos guardados correctamente'); 
					}else{
						$arrResponse =  array('status'=> true,'msg' => 'Datos actualizados correctamente'); 
					}
				}else if($request_rol == 'exist'){
					$arrResponse = array('status'=> false,'msg' => '¡Atención El Rol ya existe.'); 
				}else{
					$arrResponse = array('status'=> false,'msg' => '¡No es posible almacenar los datos.'); 
				}
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}
/****************************************
	 * funcion de eliminar rol
	 ***************************************/
	public function delRol(){
		//si hay una peticion POST abrimos el doc
		if($_POST){
				$intIdRol = intval($_POST['idRol']);
				$requestDel = $this->model->deleteRol($intIdRol);
				if($requestDel == 'ok'){
					$arrResponse = array('status'=> true,'msg' => 'Se a eliminado el rol.'); 
				}else if($requestDel == 'exist'){
					$arrResponse = array('status'=> false,'msg' => '¡No es posible eliminar el rol asociado a usuarios.'); 
				}else{
					$arrResponse = array('status'=> false,'msg' => '¡Error al eliminar rol.'); 
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
}