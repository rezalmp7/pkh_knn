<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Calculate extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function get_min_max(  )
    {
        $sql = "
            SELECT * from wargas
        ";
         $query = $this->db->query($sql)->result();
         if( empty(  $query ) ){
            return array();
         }
        return array(
            "min_pns" => $this->db->query("SELECT a.is_pns FROM wargas a ORDER BY a.is_pns ASC LIMIT 1")->result(  )[0]->is_pns,
            "max_pns" => $this->db->query("SELECT a.is_pns FROM wargas a ORDER BY a.is_pns DESC LIMIT 1")->result(  )[0]->is_pns,
            "min_type_gaji" => $this->db->query("SELECT a.type_gaji FROM wargas a ORDER BY a.type_gaji ASC LIMIT 1")->result(  )[0]->type_gaji,
            "max_type_gaji" => $this->db->query("SELECT a.type_gaji FROM wargas a ORDER BY a.type_gaji DESC LIMIT 1")->result(  )[0]->type_gaji
        );
         
    }

}
