<?php //CODE_IGNITER

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

require_once(APPPATH.'/libraries/REST_controller.php');
use Restserver\libraries\REST_controller;

class respuestas extends REST_controller{

    public function __construct(){

        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers:Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin:*");
        parent::__construct();
        $this->load->database();

    }
    //listar votaciones disponibles
    public function index_get($id){
        $query = $this->db->query(
            "SELECT apruebo, rechazo, abstengo, nulo, blanco 
             FROM respuesta_votacion 
             WHERE id_respuesta = $id;"
        );
        echo json_encode($query->result());
    }
    
}

?>