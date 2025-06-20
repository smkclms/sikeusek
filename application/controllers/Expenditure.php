<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenditure extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Budget_model');
        $this->load->model('Expenditure_model'); // Model untuk pengeluaran
        $this->load->model('KodeRekening_model'); // Model untuk kode rekening
        $this->load->helper('url'); // Memuat helper URL

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login'); // Redirect ke login jika belum login
        }
        if ($this->session->userdata('role') === 'pengguna') {
    $user_id = $this->session->userdata('id');
} else {
    $user_id = $this->input->post('user_id');
}

    }

    public function index() {
    $data['expenditures'] = $this->Expenditure_model->get_all_expenditures(); // Ambil semua pengeluaran
    $data['users'] = $this->User_model->get_all_users(); // Ambil semua pengguna untuk form
    $data['kode_rekening'] = $this->KodeRekening_model->get_all_kode_rekening(); // Ambil semua kode rekening
    $this->load->view('expenditure_view', $data); // Tampilkan view pengeluaran
}


  public function add() {
    $data = array(
        'user_id' => $this->input->post('user_id'),
        'tanggal_pengeluaran' => $this->input->post('tanggal_pengeluaran'),
        'jumlah_pengeluaran' => $this->input->post('jumlah_pengeluaran'),
        'keterangan' => $this->input->post('keterangan'),
        'kode_rekening_id' => $this->input->post('kode_rekening_id')
    );
    $this->Expenditure_model->create_expenditure($data);
    redirect('expenditure'); // Redirect kembali ke pengelolaan pengeluaran
}


}
?>
