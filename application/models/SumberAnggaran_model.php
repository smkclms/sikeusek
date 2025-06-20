<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberAnggaran_model extends CI_Model {
    public function create_sumber($data) {
        return $this->db->insert('sumber_anggaran', $data);
    }

    public function get_all_sumber() {
        return $this->db->get('sumber_anggaran')->result(); // Mengambil semua sumber anggaran
    }
}
?>
