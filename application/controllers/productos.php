<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Familia');
    $this->load->model('Sabor');
  }


function lista_productos()
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }

    $familias = $this->Familia->todas();

    $select = array( 0 => "-- Familias --");
      
      foreach ($familias as $familia) {
        $select[$familia['id']] = $familia['nombre'];
      }

    $data['familias'] = $familias;
    $data['select_fam'] = $select;

    $this->template->load('comunes/plantilla', 'productos/lista_productos',$data);
  }

  function buscar()
  {
    $id = $this->input->post('id');

    if ($id == 0) {
      $productos = $this->Producto->todos();
    }
    else{
      $productos = $this->Producto->por_familia($id);
    }
    
    $sabores = $this->Sabor->todos();      
      foreach ($sabores as $sabor) {
        $select[$sabor['id']] = $sabor['nombre'];
      }

    $data['sabores'] = $select;

    $data['productos'] = $productos;

    $this->load->view('productos/busqueda', $data);
  }

  function ficha($id)
  {
    $producto = $this->Producto->obtener($id);
    $data['producto'] = $producto;

    $this->template->load('comunes/plantilla_popup', 'productos/ficha', $data);
  }
}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */