<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carritos extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Sabor');
    $this->load->model('Factura');
  }

  public function index()
  {
    $this->load->view('comunes/carrito');
  }

  function anadir()
  {
    $id = $this->input->post('id');
    $opciones = $this->input->post('opciones');
    $id2 = $id;
    if ($opciones != null) {
      foreach ($opciones as $k => $v) {
        $k += 1;
        $sabor = $this->Sabor->obtener($v);
        $sabores["S.$k"] = $sabor['nombre'];
        $id2.= $v;
      } 
    }

    $producto = $this->Producto->obtener($id);
    if (isset($sabores)) {
       $data = array(
               'id'      => $producto['id'],
               'qty'     => 1,
               'price'   => $producto['precio'],
               'name'    => $producto['nombre'],
               'options' => $sabores,
               'id2'     => $id2,
               'imagen'  => $producto['imagen']
                );
    }
    else{
       $data = array(
               'id'      => $producto['id'],
               'qty'     => 1,
               'price'   => $producto['precio'],
               'name'    => $producto['nombre'],
               'id2'     => $id2,
               'imagen'  => $producto['imagen']
                );
    }
   

    $this->cart->insert($data); 

    $this->load->view('comunes/carrito');
  }

  function modificar()
  {
    $rowid = $this->input->post('rowid');
    $cant = $this->input->post('cant');

    $cant_actual = $this->cart->contents()[$rowid];

    $cant_actual = $cant_actual['qty'];
    $cant += $cant_actual;

    if ($cant < 0) {
      $cant = 0;
    }

    $data = array(
               'rowid' => $rowid,
               'qty'   => $cant
            );

    $this->cart->update($data); 

    $this->load->view('comunes/carrito');
  }

  function limpiar()
  {
    $this->cart->destroy();
    $this->load->view('comunes/carrito');
  }

  function quitar_linea()
  {
    $rowid = $this->input->post('rowid');


    $data = array(
               'rowid' => $rowid,
               'qty'   => 0
            );

    $this->cart->update($data); 

    $this->load->view('comunes/carrito');
  }

  function confirmar()
  {
    if (!$this->Usuario->logueado())
    {
      redirect('admin/usuarios/login');
    }
    else
    {
      $id = $this->session->userdata('id_login');
      $data['id'] = $id;
      $data['usuario'] = $this->Usuario->obtener($id);
      $this->template->load('comunes/plantilla', 'carrito/confirmar', $data);
    }
  }

  function realizar_pedido()
  {

    $direccion = $this->input->post('direccion_entrega');
    $id = $this->input->post('id_oculto');

    $usuario = $this->Usuario->obtener($id);

    if ($direccion != '') {
      $usuario['direccion'] = $direccion;
    }
    // Creamos la factura

    $id_factura = $this->Factura->crear($usuario);

    // Insertamos las lineas de factura;

    $productos = $this->cart->contents();

    foreach ($productos as $producto) {
      $this->Factura->insertar_linea($producto, $id_factura);
    }

    // Destruimos el carrito

    $this->cart->destroy();

    $this->session->set_flashdata('mensaje', 
                                  'Su Pedido Se Ha Realizado Correctamente, 
                                   Lo Recibirá En 30 Min');

    redirect('/productos/lista_productos');
  }
}

/* End of file carritos.php */
/* Location: ./application/controllers/carritos.php */