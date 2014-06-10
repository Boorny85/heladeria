<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familia extends CI_Model
{
  function todas($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from familias 
                              where $where
                                and id != 0
                              order by nombre", $valores);
    return $res->result_array();
  }
  
  function por_nombre($nombre)
  {
    return $this->todas("nombre = ?", array($nombre));
  }

  function comprobar_nombre($valor, $id)
  {
    $res = $this->db->query("select *
                               from familias
                              where id != ? and nombre = ?",
                           array($id, $valor));
    return $res->num_rows() == 0;
  }

  function editar($data, $id)
  {
    $this->db->query("update familias set nombre = ?
                      where id = ?", array($data['nombre'], $id));
  }

  function alta($data)
  {
    $this->db->query("insert into familias (nombre)
                      values (?)", array($data['nombre']));
  }

  function borrar($id)
  {
    $this->db->query("delete from familias where id = ?", array($id));
  }

  function obtener($id)
  {
    $res = $this->todas("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }
}