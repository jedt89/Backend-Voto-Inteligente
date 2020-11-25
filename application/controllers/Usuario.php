<?php

// damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Scrip no habilitado');

require_once(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Usuario extends REST_Controller
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
        //validacion del rut y el password
        if(!isset($data['rut']) OR !isset($data['password']))
        {
        
            $respuesta= array(
                 'error'=>TRUE,
                 'mensaje'=>'La información enviada no es válida'


            );

            $this->response($respuesta,REST_Controller::HTTP_BAD_REQUEST);
          return;
        }


        $condiciones= array(

            'rut'=>$data['rut'],
            'password'=>$data['password']
        );

      
        //realiza consulta a la base de datos
        $query = $this->db->get_where('usuario',$condiciones);
        /*
           select *
           from usuario
           where rut=$data['rut'] and password=$data['password'];

        */


        $usuario = $query->row(); //obtenga o no obtenga registros
        

        if(!isset($usuario))
        {
              $respuesta= array(
                'error'=>TRUE,
                'mensaje'=>'Usuario y/o contraseña no validos'

              );
              $this->response($respuesta,REST_Controller::HTTP_UNAUTHORIZED);
              return;
             
        }

        else
        {
            $respuesta= array(
                'error'=>FALSE,
                'mensaje'=>'Autentificacion exitosa'

              );

              $this->response($respuesta);
               

        }

       

    }


}

?>