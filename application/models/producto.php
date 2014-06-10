<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Model {

  function todos($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from productos_v 
                              where $where
                              order by nombre", $valores);
    return $res->result_array();
  }

  function alta($data)
  {
    $this->db->query("insert into productos (nombre, id_familia, precio, 
                                             descripcion)
                      values (?, ?, ?, ?)", array($data['nombre'],
                                                  $data['id_familia'],
                                                  $data['precio'],
                                                  $data['descripcion']));
  }

  function anadir_imagen($id,$producto)
  {
    $this->db->query("update productos
                         set imagen = ?
                       where id = ?", array($producto,$id));
  }


  function borrar($id)
  {
    $this->db->query("delete from productos where id = ?", array($id));
  }

  function obtener_id($nombre)
  {
    $ret = $this->db->query("select id 
                               from productos
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
    $this->db->query("update productos 
                         set nombre = ?, id_familia = ?, precio = ?,
                             descripcion = ?
                      where id = ?", array($data['nombre'], $data['id_familia'],
                                           $data['precio'], 
                                           $data['descripcion'], $id));
  }

  function por_familia($id)
  {
    return $this->todos("id_familia = ?", array($id));
  }

  function combinar($id)
  {
    $this->db->query("insert into combinables values(?)", array($id));
  }

  function descombinar($id)
  {
    $this->db->query("delete from combinables where id_producto = ?", 
                     array($id)); 
  }

  function combinado($id)
  {
    $res = $this->db->query('select * from combinables where id_producto = ?',
                            array($id));

    $res = $res->result_array();
    
    return (!empty($res)) ? TRUE : FALSE;
  }


}

/* End of file producto.php */
/* Location: ./application/models/producto.php */