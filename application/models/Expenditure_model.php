<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure_model extends CI_Model {
    // Menyimpan pengeluaran ke dalam database
    public function create_expenditure($data) {
        return $this->db->insert('pengeluaran', $data);
    }

    // Mengambil pengeluaran berdasarkan pengguna
    public function get_expenditures_by_user($user_id) {
    return $this->db->get_where('pengeluaran', ['user_id' => $user_id])->result_array(); // ✅ cocok untuk array_column
}



    // Menghitung total pengeluaran per bulan
    public function get_monthly_expenditure($year, $month, $user_id = null) {
    $this->db->select_sum('jumlah_pengeluaran');
    $this->db->where('YEAR(tanggal_pengeluaran)', $year);
    $this->db->where('MONTH(tanggal_pengeluaran)', $month);
    if ($user_id !== null) {
        $this->db->where('user_id', $user_id);
    }
    return $this->db->get('pengeluaran')->row()->jumlah_pengeluaran;
}
public function get_monthly_expenditure_by_user($year, $month, $user_id) {
    $this->db->select_sum('jumlah_pengeluaran');
    $this->db->where('YEAR(tanggal_pengeluaran)', $year);
    $this->db->where('MONTH(tanggal_pengeluaran)', $month);
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('pengeluaran');
    $result = $query->row();

    return $result ? $result->jumlah_pengeluaran : 0;
}


    // Mengambil semua pengeluaran
    public function get_all_expenditures() {
        return $this->db->get('pengeluaran')->result(); // Mengambil semua data pengeluaran
    }
    
}
?>
