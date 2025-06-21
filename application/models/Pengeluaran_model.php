<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model {

    public function get_all_by_user($user_id) {
        $this->db->select('tanggal_pengeluaran, jumlah_pengeluaran, keterangan, kode_rekening_id');
        $this->db->from('pengeluaran');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('tanggal_pengeluaran', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_filtered_expenditures($start_date = null, $end_date = null, $user_id = null) {
    $this->db->select('*');
    $this->db->from('pengeluaran');

    if ($start_date) {
        $this->db->where('tanggal_pengeluaran >=', $start_date);
    }
    if ($end_date) {
        $this->db->where('tanggal_pengeluaran <=', $end_date);
    }
    if ($user_id) {
        $this->db->where('user_id', $user_id);
    }

    $this->db->order_by('tanggal_pengeluaran', 'DESC');
    return $this->db->get()->result();
}
public function get_filtered_expenditures_with_rekening($start_date = null, $end_date = null, $user_id = null) {
    $this->db->select('pengeluaran.*, kode_rekening.kode as kode_rekening_kode, kode_rekening.nama_rekening');
    $this->db->from('pengeluaran');
    $this->db->join('kode_rekening', 'pengeluaran.kode_rekening_id = kode_rekening.id', 'left');

    if ($start_date) {
        $this->db->where('tanggal_pengeluaran >=', $start_date);
    }
    if ($end_date) {
        $this->db->where('tanggal_pengeluaran <=', $end_date);
    }
    if ($user_id) {
        $this->db->where('user_id', $user_id);
    }

    $this->db->order_by('tanggal_pengeluaran', 'DESC');
    return $this->db->get()->result();
}



}
