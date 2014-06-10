<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  public function index()
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }
    $res = $this->Producto->todos();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla', 'home/home', $data) ;
  }

  function ubicacion()
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }
    $res = $this->Producto->todos();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla', 'home/ubicacion', $data) ;
  }

  function conocenos()
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }
    $this->template->load('comunes/plantilla', 'home/conocenos') ;
  }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */ ?>
