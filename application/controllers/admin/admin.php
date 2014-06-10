<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    if (!$this->Usuario->logueado())
    {
      redirect('admin/usuarios/login');
    }
    else{
      $id = $this->session->userdata('id_login');
      if (!$this->Usuario->admin($id)){
        redirect('/');
      }
    }
  }

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
    $this->template->load('comunes/plantilla_back', 'comunes/menu', $data) ;
  }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */ ?>
