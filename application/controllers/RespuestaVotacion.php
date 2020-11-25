<?php

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

require_once(APPPATH.'/libraries/REST_controller.php');
use Restserver\libraries\REST_controller;

class RespuestaVotacion extends REST_controller{

    public function __construct(){

        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers:Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin:*");
        parent::__construct();
        $this->load->database();

    }

    public function index_post(){

        $data=$this->post();
        if(!isset($data['apruebo']) OR !isset($data['rechazo']) OR !isset($data['abstengo']) OR !isset($data['id_respuesta'])){
    
            $respuesta= array(
                 'error'=>TRUE,
                 'mensaje'=>'La información enviada no es válida'
    
            );
    
            $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
          return;
        }
        
        $query = $this->db->get_where('respuesta_votacion',array(
            'id_respuesta'=>$data['id_respuesta']  //eqiuvale a select * from respuesta_votacion where nro_votacion= $data['id_respuesta']
        ));
        
        $respuestas=$query->row();
        //echo "Apruebo: ".$respuestas->apruebo;
        if(!isset($respuestas)){
            
            $respuesta= array(
                'error'=>TRUE,
                'mensaje'=>'No se encontró un número de respuesta válido'
   
           );
   
           $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        else{
            if($data['apruebo']==1 and $data['rechazo']==0 and $data['abstengo']==0){
                $this->db->where('id_respuesta', $data['id_respuesta']);
                $this->db->update('respuesta_votacion', array('apruebo'=>$respuestas->apruebo+1)); 

            }
            elseif($data['apruebo']==0 and $data['rechazo']==1 and $data['abstengo']==0){
                $this->db->where('id_respuesta', $data['id_respuesta']);
                $this->db->update('respuesta_votacion', array('rechazo'=>$respuestas->rechazo+1)); 

            }
            elseif($data['apruebo']==0 and $data['rechazo']==0 and $data['abstengo']==1){
                $this->db->where('id_respuesta', $data['id_respuesta']);
                $this->db->update('respuesta_votacion', array('abstengo'=>$respuestas->abstengo+1)); 

            }
            elseif($data['apruebo']==0 and $data['rechazo']==0 and $data['abstengo']==0){
                $this->db->where('id_respuesta', $data['id_respuesta']);
                $this->db->update('respuesta_votacion', array('blanco'=>$respuestas->blanco+1)); 

            }
            else{
                $this->db->where('id_respuesta', $data['id_respuesta']);
                $this->db->update('respuesta_votacion', array('nulo'=>$respuestas->nulo+1)); 

            }
            
            
        }
    }


}
?>