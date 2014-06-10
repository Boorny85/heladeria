<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provincias extends CI_Controller {

  function datos()
  {
    $id_prov = $this->input->post('id_prov');
      $filas = $this->Provincia->obtener_municipios($id_prov);  

      $select = array( 0 => "-- Municipio --");
      foreach ($filas as $fila):
        $select[$fila['id']] = $fila['nombre'];
      endforeach;
      
    $data['municipios'] = $select;

    $this->load->view('comunes/municipios',$data);
  }

}

/* End of file provincias.php */
/* Location: ./application/controllers/provincias.php */