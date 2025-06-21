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
    }

    public function index($page = 0) {
    $this->load->library('pagination');

    $limit = 12;

    // Konfigurasi pagination
    $config['base_url'] = site_url('expenditure/index');
    $config['total_rows'] = $this->Expenditure_model->count_all_expenditures(); // hitung total dari tabel 'pengeluaran'
    $config['per_page'] = $limit;
    $config['uri_segment'] = 3;

    // Styling pagination Bootstrap 5 (opsional)
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    // Ambil data pengeluaran dengan limit dan offset
    $data['expenditures'] = $this->Expenditure_model->get_expenditures_paginated($limit, $page);
    $data['users'] = $this->User_model->get_all_users();
    $data['kode_rekening'] = $this->KodeRekening_model->get_all_kode_rekening();

    // Kirim link pagination ke view
    $data['pagination'] = $this->pagination->create_links();
    

    $this->load->view('expenditure_view', $data);
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

    // Tampilkan form edit pengeluaran
    public function edit($id) {
        $data['expenditure'] = $this->Expenditure_model->get_expenditure_by_id($id);
        $data['users'] = $this->User_model->get_all_users();
        $data['kode_rekening'] = $this->KodeRekening_model->get_all_kode_rekening();
        if (!$data['expenditure']) {
            show_404();
        }
        $this->load->view('expenditure_edit_view', $data);
    }

    // Proses update pengeluaran
    public function update($id) {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'tanggal_pengeluaran' => $this->input->post('tanggal_pengeluaran'),
            'jumlah_pengeluaran' => $this->input->post('jumlah_pengeluaran'),
            'keterangan' => $this->input->post('keterangan'),
            'kode_rekening_id' => $this->input->post('kode_rekening_id')
        );
        $this->Expenditure_model->update_expenditure($id, $data);
        redirect('expenditure');
    }

    // Hapus pengeluaran
    public function delete($id) {
        $this->Expenditure_model->delete_expenditure($id);
        redirect('expenditure');
    }
}
