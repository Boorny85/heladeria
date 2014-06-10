<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas extends CI_Controller {

  var $FPP = 10;  

  function __construct()
  {
    parent::__construct();

    $d = $this->uri->segment($this->uri->total_segments()-1);
    $e = $this->uri->segment($this->uri->total_segments());
    if (!$this->Usuario->logueado())
    {
      redirect('admin/usuarios/login');
    }
    else{
      if ($d != 'factura_pdf' && $e != 'buscar') {
        $id = $this->session->userdata('id_login');
        if (!$this->Usuario->admin($id)){
        redirect('/');
        }
      }
    }

    $this->load->model('Factura');
    $this->load->model('Familia');
    $this->load->library('fpdf/fpdf');
    $this->load->library('mpdf/mpdf');

  }

  function index($pag = 1)
  {
    if ($this->session->flashdata('mensaje'))
    {
      $data['mensaje'] = $this->session->flashdata('mensaje');
    }
    else
    {
      $data['mensaje'] = '';
    }

    $nfilas = $this->Factura->num_filas_ajax(array(),"true");

    $npags = ceil($nfilas/$this->FPP); 
    if ($npags > 0 && $pag > $npags)
      {
        redirect("/admin/facturas/index/1");
      } 
    $filas = $this->Factura->todas("true",array(),$this->FPP, ($pag - 1) * $this->FPP);

    $data['filas'] = $filas;
    $data['pag'] = $pag;
    $data['nfilas'] = $nfilas;
    $data['npags'] = $npags;
    $data['vista'] = 'admin/facturas';
    $this->template->load('comunes/plantilla_back', '/facturas/index', $data);
  }

  function buscar()
  {
    $where = $this->input->post('where');
    $valores = $this->input->post('valores');
    $pag = $this->input->post('pag');

    if ($pag == '') {
      $pag = 1;
    }

    $nfilas = $this->Factura->num_filas_ajax($valores,$where);

    $npags = ceil($nfilas/$this->FPP); 
    if ($npags > 0 && $pag > $npags)
      {
        redirect("/admin/facturas/index/1");
      } 
    $filas = $this->Factura->buscar($where, $valores, $this->FPP, ($pag - 1) * $this->FPP);

    $data['filas'] = $filas;
    $data['pag'] = $pag;
    $data['nfilas'] = $nfilas;
    $data['npags'] = $npags;
    $data['vista'] = 'admin/facturas';
    $this->load->view('facturas/tabla',$data);
  }

  function informe()
  {
    $desde = $this->input->post('desde');
    $hasta = $this->input->post('hasta');

    if ($desde != "") {
      $where .= "fecha >= ? ";
      $valores[] = $desde;
    }
    else{
      $where .= "true ";
    }

    $where .= "and ";

    if ($hasta != "") {
      $where .= "fecha <= ? ";
      $valores[] = $hasta;
    }
    else{
      $where .= "true ";
    }

    $mpdf=new mPDF();
    $res = $this->Factura->buscar($where,$valores);
    $data['filas'] = $res;
    $mpdf->charset_in='UTF-8';
    $stylesheet = file_get_contents("css/estilopdf.css");
    $stylesheet .= file_get_contents("bootstrap/css/bootstrap.css");
    $mpdf->WriteHTML($stylesheet,1);
    $html = $this->load->view('comunes/informe_pdf', $data,TRUE);
    $mpdf->WriteHTML($html,2);

    $mpdf->Output();
    
    exit;
  }


  function factura_pdf($id_factura)
  {
    $mpdf=new mPDF();
    $res = $this->Factura->obtener($id_factura);
    $data['factura'] = $res; 
    $id = id_login();
    if($res['id_usuario'] != $id && !$this->Usuario->admin($id))
    {
      redirect('/facturas/index');
    }

    $res = $this->Factura->obtener_lineas($id_factura);
    $data['lineas'] = $res;
    $mpdf->showImageErrors = true;
    $mpdf->charset_in='UTF-8';
    $stylesheet = file_get_contents("css/estilopdf.css");
    $stylesheet .= file_get_contents("bootstrap/css/bootstrap.css");
    $mpdf->WriteHTML($stylesheet,1);
    $html = $this->load->view('comunes/plantilla_pdf', $data,TRUE);
    $mpdf->WriteHTML($html,2);

    $mpdf->Output();
    
    exit;
  }
}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */