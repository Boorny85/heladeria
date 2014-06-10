<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familias extends CI_Controller
{
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
    $this->load->model('Familia');
  }

  function index()
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }
    $res = $this->Familia->todas();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla_back', '/familias/index', $data);
    
  }

  function borrar($id = null)
  {
    if ($id == null) redirect('familias/index');

    $data['id'] = $id;
    $this->template->load('comunes/plantilla_popup', 'familias/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Familia->borrar($id);
    }
    
    redirecciona('Se ha eliminado correctamente el familia');
  }

  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[50]|callback__nombre_unico[$id]"
      )
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $data['fila'] = $this->Familia->obtener($id);
      $this->template->load('comunes/plantilla_popup', 'familias/editar', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');

      $this->Familia->editar($data, $id);     
      redirecciona('Se ha editado correctamente el familia');
    }
  }

  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[50]|is_unique[familias.nombre]"
      )
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->template->load('comunes/plantilla_popup', 'familias/alta');
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');

      $this->Familia->alta($data);     
      redirecciona('Se ha dado de alta correctamente el familia');
    }
  }

  function _nombre_unico($valor, $id)
  {
    if ($this->Familia->comprobar_nombre($valor, $id))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_nombre_unico',
                       'Ya existe un familia con ese nombre');
      return FALSE;
    }  
  }
}