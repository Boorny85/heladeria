<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sabores extends CI_Controller {

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
    $this->load->model('Sabor');
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
    $res = $this->Sabor->todos();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla_back', '/sabores/index', $data);
  }

  function alta()
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'nombre',
        'rules' => "trim|required|max_length[100]"
      ),
      array(
        'field' => 'descripcion',
        'label' => 'Descripcion',
        'rules' => "trim"
      )
    );
    
    $this->form_validation->set_rules($reglas);
      
    if ($this->form_validation->run() == FALSE)
    {
      $data['num_error'] = $this->form_validation->get_error_count();
      
      $this->template->load('comunes/plantilla_popup', 'sabores/alta', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['descripcion'] = ($this->input->post('descripcion') != '') ? 
                              $this->input->post('descripcion') : null;

      $this->Sabor->alta($data);

      $data['error'] = "";
      $this->template->load('comunes/plantilla_popup', 'sabores/alta_imagen', $data);
    }
  }

  function alta_imagen(){
    $nombre = $this->input->post('nombre');
    $id = $this->Sabor->obtener_id($nombre);
    $config['upload_path'] = './uploads/sabores';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $this->load->library('upload', $config);
    
    if (!$this->upload->do_upload('sabor'))
    {
      $data['nombre'] = $nombre;
      $data['error']= $this->upload->display_errors();
      $data['id'] = $id;
      $this->template->load('comunes/plantilla_popup', 'sabores/alta_imagen', $data);
    }
    else
    {
      
      $this->load->library('upload', $config);
      
      $archivo = $this->upload->data();
      
      $sabor = "uploads/sabores/" . $archivo['file_name'];
      $this->Sabor->anadir_imagen($id, $sabor);
      redirecciona("Se ha dado de alta correctamente el sabor.");
    }
  }

  function editar($id)
  {
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'nombre',
        'rules' => "trim|required|max_length[100]"
      ),
      array(
        'field' => 'descripcion',
        'label' => 'Descripcion',
        'rules' => "trim"
      )
    );
    
    $this->form_validation->set_rules($reglas);
      
    if ($this->form_validation->run() == FALSE)
    {
      $data['num_error'] = $this->form_validation->get_error_count();
      $data['fila'] = $this->Sabor->obtener($id);
      $data['id'] = $id;
    
      $this->template->load('comunes/plantilla_popup', 'sabores/editar', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['descripcion'] = ($this->input->post('descripcion') != '') ? 
                              $this->input->post('descripcion') : null;

      $this->Sabor->editar($data,$id);

      redirecciona('Se ha editado correctamente el sabor');
    }
  }


  function editar_imagen($id){
    $config['upload_path'] = './uploads/sabores';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $config['overwrite'] = TRUE;
    $this->load->library('upload', $config);
    $fila = $this->Sabor->obtener($id);

    if (!$this->upload->do_upload('sabor'))
    {
      $data['fila'] = $fila;
      $data['error']= $this->upload->display_errors();
      $data['id'] = $id;
      $this->template->load('comunes/plantilla_popup', 'sabores/editar_imagen', $data);
    }
    else
    {
      $archivo =  $this->upload->data();

      $sabor = "uploads/sabores/" . $archivo['file_name'];

      if ($sabor != $fila['imagen']) {
        unlink($fila['imagen']);
      }

      $this->Sabor->anadir_imagen($id, $sabor);
      redirecciona("Se ha modificado correctamente la imagen del sabor.");
    }
  } 

  function borrar($id = null)
  {
    if ($id == null) redirect('sabores/index');

    $data['id'] = $id;
    $this->template->load('comunes/plantilla_popup', 'sabores/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $sabor = $this->Sabor->obtener($id);

      $this->Sabor->borrar($id);

      if($sabor['imagen'] != "imagenes/defecto.png")
      {
        unlink($sabor['imagen']);
      }
    }
    
    redirecciona("Se ha borrado el sabor correctamente");
  }

  function redirecciona()
  {
    redirecciona("Se ha dato de alta el sabor sin imagen");
  }
}

/* End of file sabores.php */
/* Location: ./application/controllers/sabores.php */