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
    public function get_anggaran_by_id($id) {
    return $this->db->where('id', $id)->get('anggaran')->row();
}

public function update_anggaran($id, $data) {
    return $this->db->where('id', $id)->update('anggaran', $data);
}

public function delete_anggaran($id) {
    return $this->db->where('id', $id)->delete('anggaran');
}
    
}
?>
