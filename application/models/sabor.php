<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sabor extends CI_Model {

  function todos($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from sabores
                              where $where
                              order by nombre", $valores);
    return $res->result_array();
  }

  function alta($data)
  {
    $this->db->query("insert into sabores (nombre, descripcion)
                      values (?, ?)", array($data['nombre'],
                                            $data['descripcion']));
  }

  function anadir_imagen($id,$sabor)
  {
    $this->db->query("update sabores
                         set imagen = ?
                       where id = ?", array($sabor,$id));
  }


  function borrar($id)
  {
    $this->db->query("delete from sabores where id = ?", array($id));
  }

  function obtener_id($nombre)
  {
    $ret = $this->db->query("select id 
                               from sabores
                              where nombre = ?", array($nombre));
    $ret = $ret->row_array();
    return $ret['id'];
  }
  function obtener($id)
  {
    $res = $this->todos("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }

  function editar($data, $id)
  {
    $this->db->query("update sabores 
                         set nombre = ?, descripcion = ?
                      where id = ?", array($data['nombre'],
                                           $data['descripcion'], $id));
  }
}

/* End of file sabor.php */
/* Location: ./application/models/sabor.php */