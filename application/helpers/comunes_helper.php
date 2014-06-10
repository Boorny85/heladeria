<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function combinable($booleano){
      if ($booleano != 0) {
        return TRUE;
      }
      else{
        return FALSE;        
      }
}

function usuario_logueado()
{
  $CI =& get_instance();
  
  $id_login = $CI->session->userdata('id_login');
  
  return $CI->Usuario->obtener_nombre($id_login);
}

function redirecciona($mensaje='')
{      
  $CI =& get_instance();
  $CI->session->set_flashdata('mensaje',$mensaje);
  echo "<script type='text/javascript'>
          window.opener.location.reload();
          window.close();
        </script>";
}

function redirecciona_home($mensaje='')
{      
  $CI =& get_instance();
  $CI->session->set_flashdata('mensaje',$mensaje);
  echo "<script type='text/javascript'>
          window.opener.location.href = '". base_url('/') ."';
          window.close();
        </script>";
}
function redirecciona_form($mensaje='')
{      
  $CI =& get_instance();
  $CI->session->set_flashdata('mensaje',$mensaje);
  echo "<script type='text/javascript'>
          window.location.href = '". base_url('/usuarios/contacto') ."';
        </script>";
}

function logueado(){
  $CI =& get_instance();
  $CI->load->model('Usuario');

  return $CI->Usuario->logueado();
}

function nombre_logueado()
{
  $CI =& get_instance();
  
  $id_login = $CI->session->userdata('id_login');
  $CI->load->model('Usuario');
  
  return $CI->Usuario->obtener_nombre($id_login);
}

function mostrarImagenes($carpeta)
{
  $images = glob("$carpeta{*.gif,*.jpg,*.png}", GLOB_BRACE);  
  foreach($images as $v){  
    echo '<li class="slide">
            <figure>
                <img src="'.$v.'" alt="" />
            </figure>
        </li>';
  }
}

function id_login()
{
  $CI =& get_instance();
  return $CI->session->userdata('id_login');
}

function paginado($pag, $npags, $vista)
{
  $CI =& get_instance();

  if ($npags > 1) {
    $ret = "";
    ($pag != 1)? $ret = anchor($vista."/index/1", 'Inicio '): $ret = "<span>Inicio </span>";

    for ($i=1; $i <= $npags ; $i++) { 
      if ($pag == $i){
        $ret .= " <span>- " . $i . " </span>";
      }
      else{
        $ret .= anchor($vista."/index/$i", "- $i");
      }
    }

    ($pag != $npags)? $ret .= anchor($vista."/index/$npags", '- Fin'): $ret .= "<span> Fin</span>";

    return $ret;
  }

}