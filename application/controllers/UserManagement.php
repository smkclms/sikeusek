<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user_management_view', $data);
    }
    

    public function add() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
            'nama_lengkap' => $this->input->post('nama_lengkap')
        );
        $this->User_model->create_user($data);
        redirect('usermanagement'); // Redirect ke halaman manajemen pengguna
    }
    
}
?>
