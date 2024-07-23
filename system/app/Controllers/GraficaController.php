<?php
header('Access-Control-Allow-Origin: *');
class Grafica extends Controllers{

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
	public function grafica(){
		$data['page_tag'] = "Data del personal";
		$data['page_title'] = "Personal del servicio";
		$data['page_menu_open'] = "grafica-menu";//1 abrir el menu despleglable
		$data['page_link'] = "grafica";//2 activar el link 
		$data['page_link_acitvo'] = "link-grafica";//3 activar el item
		$data['page_name'] = "personal";//4 seleccionar el item
		$data['page_functions'] = "function.grafica.js";
		$this->views->getViews($this, "grafica", $data);
	}
	public function getData(){
		$arrData = $this->model->getData();
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
	public function getDataP(){
		$arrData = $this->model->getDataP();
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
}