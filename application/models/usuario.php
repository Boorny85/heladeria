<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model
{
  function todos($where = "true", $valores = array())
  {
    $res = $this->db->query("select * from usuarios where $where", $valores);
    return $res->result_array();
  }
  
  function por_nombre($nombre)
  {
    return $this->todos("usuario = ?", array($nombre));
  }

  function por_email($email)
  {
    return $this->todos("email like '%' || ? || '%'", array($email));
  }
  
  function existe($usuario, $password)
  {
    $res = $this->db->query("select *
                               from usuarios
                              where usuario = ? and password = md5(?)",
                            array($usuario, $password));
    return $res->num_rows() > 0;
  }
  
  function admin($id)
  {
    if ($this->session->userdata('id_login') != '')
    { 
      $id = $this->session->userdata('id_login');
    };

    $res = $this->db->query("select * 
                               from admins 
                              where id_usuario = ?",array($id));

    return $res->num_rows() > 0;
  }
  
  function logueado()
  {
    return $this->session->userdata('id_login') != FALSE;
  }
  
  function buscar($columna, $criterio)
  {
    if ($criterio == '' || $criterio == FALSE)
    {
      $res = $this->todos();
    }
    else
    {
      switch ($columna)
      {
        case 'usuario':
          $res = $this->por_nombre($criterio);
          break;

        case 'email':
          $res = $this->por_email($criterio);
          break;
          
        default:
          $res = $this->todos();
          break;
      }
    }
    return $res;
  }
    
  function obtener_id($nombre)
  {
    $res = $this->todos("usuario = ?", array($nombre));
    
    if (!empty($res))
    {
      $fila = $res[0];
      return $fila['id'];
    }
    else
    {
      return FALSE;
    }
  }
  
  function obtener_nombre($id)
  {
    $res = $this->todos("id = ?", array($id));
    
    if (!empty($res))
    {
      $fila = $res[0];
      return $fila['usuario'];
    }
    else
    {
      return FALSE;
    }
  }
  
  function obtener($id)
  {
    $res = $this->todos("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }
  
  function comprobar_nombre($valor, $id)
  {
    $res = $this->db->query("select *
                               from usuarios
                              where id != ? and usuario = ?",
                           array($id, $valor));
    return $res->num_rows() == 0;
  }
  
  function editar($data, $id)
  {
    $this->db->query("update usuarios
                           set nombre = ?, apellidos = ?, dni = ?, 
                               direccion = ?, cp = ?, id_prov = ?, id_municipio = ?,
                               email = ?, telefono = ?, usuario = ?
                         where id = ?", array($data['nombre'], 
                                              $data['apellidos'], 
                                              $data['dni'], 
                                              $data['direccion'],
                                              $data['cp'],
                                              $data['id_prov'],
                                              $data['id_municipio'],
                                              $data['email'],
                                              $data['telefono'],
                                              $data['usuario'],
                                              $id));

    if ($data['password'] != "")
    {
      $this->db->query("update usuarios
                           set password = ?
                         where id = ?", array($data['password'], $id));
    }
  }
  
  function alta($data)
  {
    $res = $this->db->query("insert into usuarios (nombre, apellidos, dni,
                                                   direccion, cp, id_prov,
                                                   id_municipio, email,
                                                   telefono, usuario, password)
                             values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, md5(?))",
                             array($data['nombre'], 
                                   $data['apellidos'], 
                                   $data['dni'],
                                   $data['direccion'],
                                   $data['cp'],
                                   $data['id_prov'],
                                   $data['id_municipio'],
                                   $data['email'],
                                   $data['telefono'],
                                   $data['usuario'],
                                   $data['password']));

    return $this->db->insert_id();
  }
  
  function borrar($id)
  {
    $this->db->query("delete from usuarios where id = ?", array($id));
  }

  function comprobar_dni($valor, $id)
  {
    $res = $this->db->query("select *
                               from usuarios
                              where id != ? and dni = ?",
                           array($id, $valor));
    return $res->num_rows() == 0;
  }

  function promocionar($id)
  {
    $res = $this->db->query("insert into admins values (?)", array($id));
  }

  function degradar($id)
  {
    $res = $this->db->query("delete from admins where id_usuario = ?", 
                            array($id));
  }
}
