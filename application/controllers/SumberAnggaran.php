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

    // Fungsi menampilkan form edit
    public function edit($id = null) {
        if (!$id) {
            redirect('sumberanggaran');
        }

        $data['item'] = $this->SumberAnggaran_model->get_sumber_by_id($id);
        if (!$data['item']) {
            show_404();
        }

        $this->load->view('sumberanggaran_edit', $data);
    }

    // Fungsi proses update data setelah submit form edit
    public function update($id = null) {
        if (!$id) {
            redirect('sumberanggaran');
        }

        $data = array(
            'nama_sumber' => $this->input->post('nama_sumber'),
            'jumlah' => $this->input->post('jumlah')
        );

        $this->SumberAnggaran_model->update_sumber($id, $data);
        redirect('sumberanggaran');
    }

    // Fungsi hapus data sumber anggaran
    public function delete($id = null) {
        if (!$id) {
            redirect('sumberanggaran');
        }

        $this->SumberAnggaran_model->delete_sumber($id);
        redirect('sumberanggaran');
    }
}
