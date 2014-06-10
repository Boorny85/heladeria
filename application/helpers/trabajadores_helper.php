<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function trabajador_logueado()
{
  $CI =& get_instance();
  
  $id_login = $CI->session->userdata('id_login');
  
  return $CI->Trabajador->obtener_nombre($id_login);
}

function id_login()
{
  $CI =& get_instance();
  return $CI->session->userdata('id_login');
}

