<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    if (!$this->Usuario->logueado())
    {
      redirect('admin/usuarios/login');
    }

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

    $this->template->load('comunes/plantilla', '/usuarios/menu', $data);
  }


  function _dni_unico($valor, $id)
  {
    if ($this->Usuario->comprobar_dni($valor, $id))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_dni_unico',
                       'Ya existe un dni con ese valor');
      return FALSE;
    }  
  }

  function _usuario_unico($valor, $id)
  {
    if ($this->Usuario->comprobar_nombre($valor, $id))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_usuario_unico',
                       'Ya existe un usuario con ese nombre');
      return FALSE;
    }  
  }

  function editar()
  {

    $id = id_login();
    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim|required|max_length[50]"
      ),
      array(
        'field' => 'apellidos',
        'label' => 'Apellidos',
        'rules' => "trim|required|max_length[100]"
      ),
      array(
        'field' => 'dni',
        'label' => 'DNI',
        'rules' => "trim|required|max_length[9]|callback__dni_unico[$id]"
      ),
      array(
        'field' => 'direccion',
        'label' => 'Direccion',
        'rules' => "trim|required|max_length[200]"
      ),
      array(
        'field' => 'cp',
        'label' => 'CP',
        'rules' => "trim|required|numeric|max_length[5]"
      ),
      array(
        'field' => 'id_prov',
        'label' => 'Provincia',
        'rules' => "trim|required"
      ),
      array(
        'field' => 'id_municipio',
        'label' => 'Municipio',
        'rules' => "trim|required|max_length[50]"
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => "trim|required|max_length[50]|valid_email"
      ),
      array(
        'field' => 'telefono',
        'label' => 'Telefono',
        'rules' => "trim|required|max_length[12]"
      ),
      array(
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => "trim|required|max_length[20]|callback__usuario_unico[$id]"
      ),
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => "trim|matches[pass_confirmation]"
      ),
      array(
        'field' => 'pass_confirmation',
        'label' => 'Confirmacion',
        'rules' => "trim|matches[password]" )
    );
    
    $this->form_validation->set_rules($reglas);
      
    if ($this->form_validation->run() == FALSE)
    {
      $data['id'] = $id;
      $data['fila'] = $this->Usuario->obtener($id);

      $filas = $this->Provincia->todas();  

      $select = array( 0 => "-- Provincia --");
      foreach ($filas as $fila):
        $select[$fila['id']] = $fila['nombre'];
      endforeach;
      $data['provincias'] = $select;

      $this->template->load('comunes/plantilla_popup', 'usuarios/editar', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['apellidos'] = $this->input->post('apellidos');
      $data['dni'] = $this->input->post('dni');
      $data['direccion'] = $this->input->post('direccion');
      $data['cp'] = $this->input->post('cp');
      $data['id_prov'] = $this->input->post('id_prov');
      $data['id_municipio'] = $this->input->post('id_municipio');
      $data['email'] = $this->input->post('email');
      $data['telefono'] = $this->input->post('telefono');
      $data['usuario'] = $this->input->post('usuario');
      $data['password'] = $this->input->post('password');

      $this->Usuario->editar($data,$id);     
      redirecciona('Se han editado correctamente sus datos de Usuario');
    }
  }

function contacto()
{
  if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }

    $reglas = array(
      array(
        'field' => 'nombre',
        'label' => 'Nombre',
        'rules' => "trim"
            ),
      array(
        'field' => 'apellidos',
        'label' => 'Apellidos',
        'rules' => "trim"
            ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => "trim|required"
            ),
      array(
        'field' => 'texto',
        'label' => 'Texto',
        'rules' => "trim|required"
            )
    );
    
    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $this->template->load('comunes/plantilla', 'home/formulario',$data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['apellidos'] = $this->input->post('apellidos');
      $data['email'] = $this->input->post('email');
      $data['texto'] = $this->input->post('texto');

      //cargamos la libreria email de ci
      $this->load->library("email");


      //configuracion para gmail
      $config = array('protocol' => 'smtp',
                      'smtp_host' => 'mail.bornay.heliohost.org',
                      'smtp_port' => 25,
                      'smtp_user' => 'Boorny85',
                      'smtp_pass' => 'Columdrum85',
                      'mailtype' => 'text',
                      'charset' => 'utf-8',
                      'newline' => "\r\n",
                      'validation' => TRUE
                      );

      //cargamos la configuración para enviar con gmail
      $this->email->initialize($config);

      $this->email->from($data['email']);
      $this->email->to("bornay85@gmail.com");
      $this->email->subject("Email de". $data['nombre'] . " " . $data['apellidos']);
      $this->email->message($data['texto']);  

      if ($this->email->send()) {
        redirecciona_form('Mensaje Enviado Correctamente, En Breve Le Contestaremos. GRACIAS.');    
      }
      else{
        echo "ERROOOOOOOOOOOR"; 
        show_error($this->email->print_debugger());
      }   
    }
}

}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */