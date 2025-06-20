<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Anggaran_model');
        $this->load->model('User_model');
    }

    public function index() {
        $data['anggaran'] = $this->Anggaran_model->get_all_anggaran();
        $data['users'] = $this->User_model->get_all_users(); // Ambil semua pengguna
        $this->load->view('anggaran_view', $data);
    }

    public function add() {
        $data = array(
            'user_id' => $this->input->post('user_id'), // ID pengguna yang menerima anggaran
            'jumlah_anggaran' => $this->input->post('jumlah_anggaran'),
            'tahun' => $this->input->post('tahun')
        );
        $this->Anggaran_model->create_anggaran($data);
        redirect('anggaran'); // Redirect ke halaman anggaran
    }
}
?>
