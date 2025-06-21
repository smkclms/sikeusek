<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberAnggaran_model extends CI_Model {
    public function create_sumber($data) {
        return $this->db->insert('sumber_anggaran', $data);
    }

    public function get_all_sumber() {
        return $this->db->get('sumber_anggaran')->result(); // Mengambil semua sumber anggaran
    }
    public function get_sumber_by_id($id) {
    return $this->db->where('id', $id)->get('sumber_anggaran')->row();
}

public function update_sumber($id, $data) {
    return $this->db->where('id', $id)->update('sumber_anggaran', $data);
}

public function delete_sumber($id) {
    return $this->db->where('id', $id)->delete('sumber_anggaran');
}

}
?>
