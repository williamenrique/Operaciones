<?php
class GraficaModel extends Mysql {
    public function __construct(){
		parent::__construct();
	}
    public function getData(){
        $sql = " SELECT count(voto) AS total ,
        (SELECT count(voto) FROM table_voto WHERE voto = 0) AS no, 
        (SELECT count(voto) FROM table_voto WHERE voto = 1) AS si
        FROM table_voto";
        $request = $this->select_all($sql);
        return $request;
    }
    public function getDataP(){
        $sql = " SELECT count(id_personal) AS total ,
                (SELECT count(personal_voto) FROM table_personal WHERE personal_voto = 0) AS no, 
                (SELECT count(personal_voto) FROM table_personal WHERE personal_voto = 1) AS si
                FROM table_personal";
        $request = $this->select_all($sql);
        return $request;
    }
}