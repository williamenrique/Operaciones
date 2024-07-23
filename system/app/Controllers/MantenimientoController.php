<?php
header('Access-Control-Allow-Origin: *');
class Mantenimiento extends Controllers{
	public function __construct(){
		session_start();
		if (empty($_SESSION['login'])) {
			header("Location:".base_url().'dashboard');
		}
		//invocar para que se ejecute el metodo de la herencia
		parent::__construct();
	}
	public function mantenimiento(){
		//invocar la vista con views y usamos getView y pasamos parametros esta clase y la vista
		//incluimos un arreglo que contendra toda la informacion que se enviara al home
		$data['page_tag'] = "FLOTA";
		$data['page_title'] = "TODA LA FLOTA";
		$data['page_name'] = "data";
		$data['page_link'] = "data";
		$data['page_menu_open'] = "data-menu";
		$data['page_link_acitvo'] = "link-data";
		$data['page_functions'] = "function.mantenimiento.js";
		$this->views->getViews($this, "mantenimiento", $data);
	}
    /*********** funcion obtener unidades en mantenimiento para la tabla*****************/
	public function listDataMant(){
		$arrData = $this->model->listDataMant();
		//provar que trae el array
		// dep($arrData[0]['rol_status']);exit();
		//recorrer el arreglo para colocara el status
		for ($i=0; $i < count($arrData) ; $i++) {
			// if ($arrData[$i]['tipo_mantenimiento'] == 'c') {
			// 	$arrData[$i]['tipo_mantenimiento'] = '<span>Correctivo</a>';
			// }else {
			// 	$arrData[$i]['tipo_mantenimiento'] = '<span>Preventivo</span>';
			// }
			// if ($arrData[$i]['fecha_salida'] == '') {
			// 	$arrData[$i]['fecha_salida'] = '<span>En espera</a>';
			// }
			$arrData[$i]['id_unidad'] ='<a href=flota/unidad/?unidad='.$arrData[$i]['id_flota'].' title="Ver">'.$arrData[$i]['id_unidad'].'</a>';
            $arrData[$i]['opciones'] ='<div class="d-flex justify-content-around align-items-center">
											<span>'.$arrData[$i]['id_unidad_mantenimiento'].'</span>
                                            <button type="button" class="btn btn-danger btn-sm btnDelReg" onClick="fntDelReg('.$arrData[$i]['id_unidad_mantenimiento'].')" title="Eliminar">
												<i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
										</div>';
		}
		//convertir el arreglo de datos en un formato json
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
    public function delReg(int $intId){
        $intId = intval($intId);
        $requestDel = $this->model->delReg($intId);
        if($requestDel){
            $arrResponse = array('status' => true, 'msg' => 'Registro eliminado');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Ah ocurrido un error al borrar');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
    }
}