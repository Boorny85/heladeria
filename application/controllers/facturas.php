<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas extends CI_Controller {
  
  var $FPP = 5;

  function __construct()
  {
    parent::__construct();
    

    $this->load->model('Factura');
  }

  public function index($pag = 1)
  {
    $id = id_login();
    
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }

    $nfilas = $this->Factura->num_filas($id);
    $npags = ceil($nfilas/$this->FPP);
    if ($pag > $npags) redirect("/facturas/index/1");

    $res = $this->Factura->por_usuario($id,$this->FPP,($pag - 1) * $this->FPP);

    $data['filas'] = $res;
    $data['pag'] = $pag;
    $data['npags'] = $npags;
    $data['vista'] = 'facturas';
    $this->template->load('comunes/plantilla', '/facturas/pedidos', $data);
  }

}

/* End of file facturas.php */
/* Location: ./application/controllers/facturas.php */