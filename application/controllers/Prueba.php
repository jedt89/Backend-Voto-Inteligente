<?php 

//damos acceso a la ruta del archivo
defined('BASEPATH') OR exit('Script no habilitado');

class Prueba extends CI_Controller{

public function index()
{
    echo "Hola mundo";



}

public function obtener_arreglo($indice)
{
    $arreglo = array("Lunes","Martes","Miercoles","Viernes chico","Mi cuerpo lo sabe");
    echo json_encode($arreglo[$indice]);
}

public function obtener_usuarios()
{

    $this->load->database();
    
    $query = $this->db->query("select * from usuario");
    echo json_encode($query->result());

    
}


public function obtener_usuarios_rut($rut)
{

    $this->load->database();
    
    $query = $this->db->query("select * from usuario where rut=$rut");
    echo json_encode($query->result());

    
}



public function rango_fecha()
{
     //obtener la fecha del servidor
     //convertir al formato yyyy-mm-dd
     //variable con la fecha actual en formato yyyy-mm-dd
    $fecha_actual= date();

    $this->load->database();
    
    $query = $this->db->query("select * from votacion");
    
  

    echo json_encode($query->result());

    
}

}




?>