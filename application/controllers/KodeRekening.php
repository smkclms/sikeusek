<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KodeRekening extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('KodeRekening_model');
    }

    public function index() {
        $data['kode_rekening'] = $this->KodeRekening_model->get_all_kode_rekening();
        $this->load->view('kode_rekening_view', $data);
    }

    public function add() {
        $data = array(
            'kode' => $this->input->post('kode'),
            'nama_rekening' => $this->input->post('nama_rekening')
        );
        $this->KodeRekening_model->create_kode_rekening($data);
        redirect('koderekening'); // Redirect ke halaman kode rekening
    }
}
?>
