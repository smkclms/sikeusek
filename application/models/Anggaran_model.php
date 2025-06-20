<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_model extends CI_Model {
    public function create_anggaran($data) {
        return $this->db->insert('anggaran', $data);
    }

    public function get_all_anggaran() {
        return $this->db->get('anggaran')->result(); // Mengambil semua anggaran
    }

    public function get_anggaran_by_user($user_id) {
        return $this->db->get_where('anggaran', ['user_id' => $user_id])->result();
    }
    
}
?>
