<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Factura extends CI_Model {

  function todas($where = "true", $valores = array(), $limit = "", $offset = 0)
  {

    if($limit == "") $limit = "offset $offset";
    else             $limit = "limit $limit offset $offset";

    $res = $this->db->query("select * 
                               from facturas_v 
                              where $where
                              order by 1 desc
                              $limit", $valores);
    return $res->result_array();
  }

  function crear($usuario)
  {
    $this->db->query("insert into facturas (id_usuario, nombre,
                                            apellidos, dni,
                                            direccion, fecha)
                      values (?, ?, ?, ?, ?, current_timestamp)", 
                      array($usuario['id'],
                            $usuario['nombre'],
                            $usuario['apellidos'],
                            $usuario['dni'],
                            $usuario['direccion']));
    return $this->db->insert_id();  
  }


  function insertar_linea($producto, $id_factura)
  {
    $this->db->query("insert into lineas (id_factura, id_producto, nombre, precio, cantidad)
                      values (?, ?, ?, ?, ?)", array($id_factura,
                                                  $producto['id'],
                                                  $producto['name'],
                                                  $producto['price'],
                                                  $producto['qty']));
  }

  function buscar($where, $valores,$limit = "", $offset = 0)
  {
    $res = $this->todas($where, $valores,$limit, $offset);
    return $res;
  }

  function obtener($id)
  {
    $res = $this->todas("id = ?", array($id));
    return (!empty($res)) ? $res[0] : FALSE;
  }


  function lineas($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from lineas_v 
                              where $where", 
                            $valores);
    return $res->result_array();
  }

  function obtener_lineas($id)
  {
    $res = $this->lineas("id_factura = ?", array($id));
    return $res;
  }

  function por_usuario($id, $limit = "", $offset = 0)
  {
    return $this->todas("id_usuario = ?", array($id), $limit, $offset);
  }

  function num_filas($id)
  {
    $res = $this->db->query("select count(*) as total
                               from facturas
                               where id_usuario = ?", array($id));
    $res = $res->row_array();
    return $res['total'];
  }

  function num_filas_ajax($valores = array(),$where = "where true")
  {
    $res = $this->db->query("select count(*) as total
                               from facturas_v
                               where $where ", $valores);
    $res = $res->row_array();
    return $res['total'];
  }


}

/* End of file factura.php */
/* Location: ./application/models/factura.php */