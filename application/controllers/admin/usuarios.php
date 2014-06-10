<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $c = $this->uri->segment(2);
    $m = $this->uri->segment(3);

    if ($c != 'usuarios' || $m != 'login' && $m != 'alta' && $m != 'registro')
    {
      if (!$this->Usuario->logueado())
      {
        redirect('admin/usuarios/login');
      }
    }
  }

  function index()
  {
    /*
    $criterio = trim($this->input->post('criterio'));
    $columna = trim($this->input->post('columna'));

    $res = $this->Usuario->buscar($columna, $criterio);

    if ($criterio == FALSE) $criterio = '';
    if ($columna == FALSE) $columna = 'usuario';

    $opciones = array('usuario' => 'Nombre', 'email' => 'e-mail');
    
    $data['filas'] = $res;
    $data['opciones'] = $opciones;
    $data['columna'] = $columna;
    $data['criterio'] = $criterio;
    
    if ($this->session->flashdata('info'))
    {
      $data['info'] = $this->session->flashdata('info');
    }
    else
    {
      $data['mensaje'] = 'David';
    }
    */

    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }
    $res = $this->Usuario->todos();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla_back', '/usuarios/index', $data);
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('/');
  }
  
  function login()
  {
    $usuario = $this->input->post('usuario');
  
    $reglas = array(
      array(
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => "trim|required|callback__usuario_existe[$usuario]"
      ),
    );

    $this->form_validation->set_rules($reglas);
    
    if ($this->form_validation->run() == FALSE)
    {
      $data['num_error'] = $this->form_validation->get_error_count();
      $this->load->view('usuarios/login',$data);
    }
    else
    {
      $id = $this->Usuario->obtener_id($usuario);
      $this->session->set_userdata('id_login', $id);
      $data['id_usuario'] = $id;
      if ($this->Usuario->admin($id)){
        redirect('admin/admin/index');
      }
      else
      {
      redirect('/');
      }
    }
  }

  function _usuario_existe($password, $usuario)
  {
    if ($this->Usuario->existe($usuario, $password))
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_usuario_existe',
                                          'Usuario o contraseña incorrectos');
      return FALSE;
    }
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
  function editar($id)
  {
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
      redirecciona('Se ha editado correctamente el Usuario');
    }
  }

  function alta()
  {
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
        'rules' => "trim|required|max_length[9]|is_unique[usuarios.dni]"
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
        'rules' => "trim|required|max_length[20]|is_unique[usuarios.usuario]"
      ),
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => "trim|required"
      ),
      array(
        'field' => 'password_confirm',
        'label' => 'Confirmacion',
        'rules' => "trim|required|matches[password]" )
    );
    
    $this->form_validation->set_rules($reglas);
      
    if ($this->form_validation->run() == FALSE)
    {
      $filas = $this->Provincia->todas();  

      $select = array( 0 => "-- Provincia --");
      foreach ($filas as $fila):
        $select[$fila['id']] = $fila['nombre'];
      endforeach;
      $data['provincias'] = $select;

      $this->template->load('comunes/plantilla_popup', 'usuarios/alta', $data);
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

      $id_insertado = $this->Usuario->alta($data); 


      if ($this->Usuario->logueado()){
        redirecciona('Se ha creado correctamente el Usuario');
      }
      else{
        $this->session->set_userdata('id_login', $id_insertado);
        redirecciona_home('Bienvenido.');
      }
    }
  }

  function borrar($id = null)
  {
    if ($id == null) redirect('usuarios/index');

    $data['id'] = $id;
    $this->template->load('comunes/plantilla_popup', 'usuarios/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $this->Usuario->borrar($id);
    }
    
    redirecciona("Se ha borrado el producto correctamente");
  }
}