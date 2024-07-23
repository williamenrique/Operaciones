<?php
header('Access-Control-Allow-Origin: *');
class Usuarios extends Controllers{

	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'login');
		}
		parent::__construct();
	}
	/* //invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
	 */
	public function usuarios(){
		$data['page_tag'] = "USUARIOS";
		$data['page_title'] = "USUARIOS";
		$data['page_name'] = "Usuarios";
		$data['page_link'] = "active-user";//activar el menu desplegable o link solo
		$data['page_menu_open'] = "menu-open-user";//abrir el desplegable
		$data['page_link_acitvo'] = "link-user";// seleccionar el link en el momento dentro del desplegable
		$data['page_functions'] = "function.user.js";
		$this->views->getViews($this, "usuarios", $data);
	}
	/******** funcion para insertar usuario ********/
	public function setUser(){
		if($_POST){
			$intIdentificacion = intval(strClean($_POST['txtIdPersonal']));
			$strNombre = ucwords(strClean($_POST['txtNombre']));
			$strApellidos = ucwords(strClean($_POST['txtApellido']));
			$intTlf = intval(strClean($_POST['txtTelefono']));
			$strEmail = strtolower($_POST['txtEmail']);
			$intlistRolId = intval($_POST['listRolId']);
			if(empty($_POST['txtIdPersonal']) || empty($_POST['txtNombre'] )|| empty($_POST['txtApellido'] ) ||
				empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolId'])) {
				$arrResponse = array("status" => false, "msg" => "Debe llenar los campos");
			}else{
				// campos llenos proseguimos
				$strPass = encryption(123456);
				//al generar el pass se envia al modelo
				$requestUser = $this->model->insertUser($intIdentificacion, $strNombre, $strApellidos, $intTlf, $strEmail, $intlistRolId, $strPass);
				// evaluamos si ya existe
				if($requestUser == 0){
					$arrResponse = array("status" => false, "msg" => "Usuario existente");
				}else{
					//opcion para actualizar el nick al crearse el usuario
					$userNIck = substr($strNombre,0,1).substr($strApellidos,0,1).'-0'.$requestUser;
					$fileBase = "storage/". $userNIck . "/";
					// creo carpeta en servidor si no existe
					if (!file_exists($fileBase))
					mkdir($fileBase, 0777, true);
					$createNick= $this->model->createNick($requestUser, $intIdentificacion,$strEmail, $userNIck,$intlistRolId,$fileBase);
					$arrResponse = array("status" => true, "msg" => "Usuario creado");
					$source ="src/img/default.png";
					$destination = 'storage/'.$userNIck.'/default.png';
					copy($source, $destination);
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/******* funcion para llamar a los usuarios ********/
	public function getUsers(){
		$arrData = $this->model->selectUsers();
		for ($i=0; $i < count($arrData) ; $i++) {
			$arrData[$i]['rol_name'] = '<a style="font-size: 15px; cursor:pointer" onclick="fntEditUser('.$arrData[$i]['user_id'].')">'.$arrData[$i]['rol_name'].'</a>';
			if ($arrData[$i]['user_status'] == 1) {
				$arrData[$i]['user_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-info" onClick="fntStatus(2,'.$arrData[$i]['user_id'].')">Activo</a>';
			}else{
				$arrData[$i]['user_status'] = '<a style="font-size: 15px; cursor:pointer" class="badge badge-warning" onClick="fntStatus(1,'.$arrData[$i]['user_id'].')">Inactivo</a>';
			}
			$arrData[$i]['opciones'] ='<div class="">
											<button type="button" class="btn btn-secondary btn-sm btnViewUser" onClick="fntViewUser('.$arrData[$i]['user_id'].')" title="Ver"><i class="far fa-eye" aria-hidden="true"></i></button>
											<button type="button" class="btn btn-danger btn-sm btnDelUser" onClick="fntDelUser('.$arrData[$i]['user_id'].')" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
										</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	/******* eliminar usuario ********/
	public function delUser(){
		if($_POST){
			$idUser = intval($_POST['idUser']);
			$requestDel = $this->model->deleteUser($idUser);
			if($requestDel){
				$arrResponse = array('status' => true, 'msg' => 'Usuario eliminado');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	/******* deshabilitar usuario ********/
	public function statusUser(){
		if($_POST){
			$statusUser = intval($_POST['status']);
			$idUser = intval($_POST['idUser']);
			$requestStatus = $this->model->statusUser($idUser,$statusUser);
			if($requestStatus){
				if($requestStatus == 1){
				$arrResponse = array('status' => true, 'msg' => 'Usuario Habilitado', 'estado' => 1);
			}else if($requestStatus == 2){
				$arrResponse = array('status' => true, 'msg' => 'Usuario Deshabilitado','estado' => 2);
			}
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al cambiar status');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	} 
}