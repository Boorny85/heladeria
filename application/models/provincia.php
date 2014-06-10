<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provincia extends CI_Model {

  function todas($where = "true", $valores = array())
  {
    $res = $this->db->query("select * 
                               from provincias 
                              where $where
                                and id != 0 ", $valores);
    return $res->result_array();
  }

  function obtener_municipios($id_prov)
  {
    $res = $this->db->query("select *
                               from municipios
                              where id_provincia = ?", array($id_prov));
    return $res->result_array();
  }

}

/* End of file provincia.php */
/* Location: ./application/models/provincia.php */