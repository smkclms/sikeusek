<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KodeRekening extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('KodeRekening_model');
    }

    // Menampilkan daftar kode rekening
    public function index() {
        $data['kode_rekening'] = $this->KodeRekening_model->get_all_kode_rekening();
        $this->load->view('kode_rekening_view', $data);
    }

    // Menambahkan kode rekening baru
    public function add() {
        $data = array(
            'kode' => $this->input->post('kode'),
            'nama_rekening' => $this->input->post('nama_rekening')
        );
        $this->KodeRekening_model->create_kode_rekening($data);
        redirect('koderekening');
    }

    public function edit($id) {
    $data['kode_rekening'] = $this->KodeRekening_model->get_kode_rekening_by_id($id);

    // Cek apakah data ditemukan
    if (!$data['kode_rekening']) {
        show_404(); // atau redirect ke halaman lain
    }

    $this->load->view('edit_kode_rekening_view', $data);
}

public function update($id) {
    $data = array(
        'kode' => $this->input->post('kode'),
        'nama_rekening' => $this->input->post('nama_rekening')
    );

    $this->KodeRekening_model->update_kode_rekening($id, $data);
    redirect('koderekening');
}
public function delete($id) {
    $this->KodeRekening_model->delete_kode_rekening($id);
    redirect('koderekening');
}


}
?>
