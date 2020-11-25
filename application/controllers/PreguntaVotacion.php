<?php

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

require_once(APPPATH.'/libraries/REST_controller.php');
use Restserver\libraries\REST_controller;

class PreguntaVotacion extends REST_controller{

    public function __construct(){

        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers:Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin:*");
        parent::__construct();
        $this->load->database();

    }


    public function index_get($nro_votacion)
    {
        
        $query = $this->db->query("select * from pregunta_votacion where FK_nro_votacion=$nro_votacion");
        echo json_encode($query->result());
        $preguntas= $query->row();


    }
}

?>