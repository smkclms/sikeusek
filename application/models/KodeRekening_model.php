<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KodeRekening_model extends CI_Model {
    public function get_all_kode_rekening() {
        return $this->db->get('kode_rekening')->result();
    }

    public function create_kode_rekening($data) {
        return $this->db->insert('kode_rekening', $data);
    }
}
?>
