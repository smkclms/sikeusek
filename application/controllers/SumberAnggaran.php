<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberAnggaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('SumberAnggaran_model');
    }

    public function index() {
        $data['sumber'] = $this->SumberAnggaran_model->get_all_sumber();
        $this->load->view('sumber_anggaran_view', $data);
    }

    public function add() {
        $data = array(
            'nama_sumber' => $this->input->post('nama_sumber'),
            'jumlah' => $this->input->post('jumlah')
        );
        $this->SumberAnggaran_model->create_sumber($data);
        redirect('sumberanggaran');
    }
}
