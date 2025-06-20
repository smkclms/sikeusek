<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Expenditure_model');
        $this->load->model('User_model');
        $this->load->model('Anggaran_model');
        $this->load->model('SumberAnggaran_model');

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // Redirect ke login jika belum login
        }
    }

    public function index() {
        $data['expenditures'] = $this->Expenditure_model->get_all_expenditures(); // Ambil semua pengeluaran
        $data['users'] = $this->User_model->get_all_users(); // Ambil semua pengguna
        
        // Hitung total pagu anggaran
    $sumber_anggaran = $this->SumberAnggaran_model->get_all_sumber();

$total_pagu = 0;
foreach ($sumber_anggaran as $item) {
    $total_pagu += $item->jumlah; // karena $item adalah objek
}
$data['total_pagu'] = $total_pagu;

        $this->load->view('dashboard_view', $data); // Tampilkan view dashboard
    }
    public function bendahara() {
    $data['users'] = $this->User_model->get_all_users();
    $data['expenditures'] = $this->Expenditure_model->get_all_expenditures();

    // Hitung total pagu anggaran
    $sumber_anggaran = $this->SumberAnggaran_model->get_all_sumber();
    $total_pagu = 0;
    foreach ($sumber_anggaran as $item) {
        $total_pagu += $item->jumlah;
    }
    $data['total_pagu'] = $total_pagu;

    $this->load->view('dashboard_bendahara', $data);
}
public function view() {
    $user_id = $this->session->userdata('user_id');

    // Cek jika belum login
    if (!$user_id) {
        redirect('auth/login');
    }

    // Ambil data pengeluaran milik user
    $data['expenditures'] = $this->Expenditure_model->get_expenditures_by_user($user_id);

    // Ambil data anggaran user
    $anggaran = $this->Anggaran_model->get_anggaran_by_user($user_id);
    $data['anggaran'] = !empty($anggaran) ? $anggaran[0] : null;

    // Kirim data user juga jika dibutuhkan di view
    $data['user'] = $this->User_model->get_user_by_id($user_id);

    // Load view khusus pengguna
    $this->load->view('dashboard_view', $data);
}


}
?>
