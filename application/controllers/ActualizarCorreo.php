<?php

// damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Scrip no habilitado');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class ActualizarCorreo extends REST_Controller
{

    public function __construct()
    {
        header("Access-Control-Allow-Methods:PUT,GET,POST,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding");
        header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->database();

    }  

    
    public function index_post()
    {

        $data=$this->post();//llena un arreglo con los datos de entrada
        if(!isset($data['rut']))

          {
            $respuesta= array(
                'error'=>TRUE,
                'mensaje'=>'No existe Rut válido'


           );

           $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
         return;


          }

          else{



        //e-mail nuevo 

        if(!isset($data['email_nuevo']))

        {
          $respuesta_nueva= array(
              'error'=>TRUE,
              'mensaje'=>'No existe nuevo e-mail válido'
             

            );

           

            $this->response($respuesta_nueva);

        }

        else

        {
          $respuesta_nueva= array(
              'error'=>false,
              'mensaje'=>'Nuevo correo con exito'
             

            );

            $this->db->where('rut', $data['rut']);
            $this->db->update('usuario', array('email' => $data['email_nuevo']));
            /*
            update usuario
            set email= $data['email_nuevo']
            where rut= $data['rut']

            */
            $this->response($respuesta_nueva);   
            
            
              
            return;

        }

    }
    }
    
} 