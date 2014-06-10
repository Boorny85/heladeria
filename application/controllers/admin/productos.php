<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    $d = $this->uri->segment($this->uri->total_segments());

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

    $familias = $this->Familia->todas();
    
    foreach ($familias as $familia):
          $select[$familia['id']] = $familia['nombre'];
        endforeach;
    $data['familias'] = $select;


    $res = $this->Producto->todos();
    $data['filas'] = $res;
    $this->template->load('comunes/plantilla_back', '/productos/index', $data);
  }

  function _familia_valida($valor)
  {
    if ($valor != 0) 
    {
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('_familia_valida',
      'No ha seleccionado ninguna familia');
      return FALSE;
    }
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
        'field' => 'id_familia',
        'label' => 'Familia',
        'rules' => "trim|required|callback__familia_valida"
      ),
      array(
        'field' => 'precio',
        'label' => 'Precio',
        'rules' => "trim|required|regex_match[/^\d{1,2}(\.\d{1,2})?$/]"
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
      $familias = $this->Familia->todas();
      $data['num_error'] = $this->form_validation->get_error_count();

     $select = array( 0 => "-- Familias --");
      
      foreach ($familias as $familia) {
        $select[$familia['id']] = $familia['nombre'];
      }

      $data['familias'] = $select;
      $this->template->load('comunes/plantilla_popup', 'productos/alta', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['id_familia'] = $this->input->post('id_familia');
      $data['precio'] = $this->input->post('precio');
      $data['descripcion'] = ($this->input->post('descripcion') != '') ? $this->input->post('descripcion') : null;
      $combinable = ($this->input->post('combinable') != '') ? 't' : 'f';
      
      $this->Producto->alta($data);
      $id_producto = $this->Producto->obtener_id($data['nombre']);

      if ($combinable == 't') {
        $this->Producto->combinar($id_producto);
      }

      $data['error'] = "";
      $this->template->load('comunes/plantilla_popup', 'productos/alta_imagen', $data);
    }
  }

  function alta_imagen(){
    $nombre = $this->input->post('nombre');
    $id = $this->Producto->obtener_id($nombre);
    $config['upload_path'] = './uploads/productos';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $this->load->library('upload', $config);

    
    if (!$this->upload->do_upload('producto'))
    {
      $data['nombre'] = $nombre;
      $data['error']= $this->upload->display_errors();
      $data['id'] = $id;
      $this->template->load('comunes/plantilla_popup', 'productos/alta_imagen', $data);
    }
    else
    {
      $this->load->library('upload', $config);
      
      $archivo = $this->upload->data();
      
      $producto = "uploads/productos/" . $archivo['file_name'];
      if (is_file($producto)):
        chmod($config['upload_path'], 777);
      endif;
      $this->Producto->anadir_imagen($id, $producto);
      redirecciona("Se ha dado de alta correctamente el producto.");
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
        'field' => 'id_familia',
        'label' => 'Familia',
        'rules' => "trim|required|callback__familia_valida"
      ),
      array(
        'field' => 'precio',
        'label' => 'Precio',
        'rules' => "trim|required|regex_match[/^\d{1,2}(\.\d{1,2})?$/]"
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
      $familias = $this->Familia->todas();
      $data['num_error'] = $this->form_validation->get_error_count();
      $data['fila'] = $this->Producto->obtener($id);
      $data['id'] = $id;
      $select = array( 0 => "-- Familias --");
      
      foreach ($familias as $familia) {
        $select[$familia['id']] = $familia['nombre'];
      }

      $data['familias'] = $select;
      $this->template->load('comunes/plantilla_popup', 'productos/editar', $data);
    }
    else
    {
      $data['nombre'] = $this->input->post('nombre');
      $data['id_familia'] = $this->input->post('id_familia');
      $data['precio'] = $this->input->post('precio');
      $data['descripcion'] = ($this->input->post('descripcion') != '') ? $this->input->post('descripcion') : null;
      $data['combinable'] = ($this->input->post('combinable') != '') ? $this->input->post('combinable') : null;
      $this->Producto->editar($data,$id);

      if ($data['combinable'] != null) {
        if(!$this->Producto->combinado($id)):
          $this->Producto->combinar($id);
        endif;
      }
      else{
        $this->Producto->descombinar($id);
      }

      redirecciona('Se ha editado correctamente el producto');
    }
  }


  function editar_imagen($id){
    $config['upload_path'] = './uploads/productos';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['file_name'] = $id;
    $config['overwrite'] = TRUE;
    $this->load->library('upload', $config);
    $fila = $this->Producto->obtener($id);
    
    if (!$this->upload->do_upload('producto'))
    {
      $data['fila'] = $fila;
      $data['error']= $this->upload->display_errors();
      $data['id'] = $id;
      $this->template->load('comunes/plantilla_popup', 'productos/editar_imagen', $data);
    }
    else
    {
      $archivo =  $this->upload->data();

      $producto = "uploads/productos/" . $archivo['file_name'];

      if ($producto != $fila['imagen']) {
        unlink($fila['imagen']);
      }
      $this->Producto->anadir_imagen($id, $producto);
      redirecciona("Se ha modificado correctamente la imagen del producto.");
    }
  } 

  function borrar($id = null)
  {
    if ($id == null) redirect('productos/index');

    $data['id'] = $id;
    $this->template->load('comunes/plantilla_popup', 'productos/borrar',$data);    
  }

  function hacer_borrado()
  {
    $id = $this->input->post('id');
    
    if ($id != FALSE)
    {
      $producto = $this->Producto->obtener($id);

      $this->Producto->borrar($id);

      if($producto['imagen'] != "imagenes/defecto.png")
      {
        unlink($producto['imagen']);
      }
    }
    
    redirecciona("Se ha borrado el producto correctamente");
  }

  function redirecciona()
  {
    redirecciona("Se ha dato de alta el producto sin imagen");
  }

  function lista_productos()
  {
    $this->template->load('comunes/plantilla', 'productos/lista_productos');
  }

  function buscar()
  {
    $where = $this->input->post('where');
    $valores = $this->input->post('valores');

    $filas = $this->Producto->todos($where, $valores);

    $data['filas'] = $filas;
    $this->load->view('comunes/tabla_productos',$data);
  }
}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */