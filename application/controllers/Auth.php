<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function login() {
        $this->load->view('login_view'); // Memuat view login
    }

  public function authenticate() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->User_model->get_user_by_username($username);

    if ($user) {
        if (password_verify($password, $user->password)) {
            // ✅ Set lengkap nama dan id yang dibutuhkan
            $this->session->set_userdata([
                'user_id'       => $user->id,
                'id'            => $user->id, // untuk kebutuhan view
                'role'          => $user->role,
                'nama'          => $user->nama_lengkap,
                'nama_lengkap'  => $user->nama_lengkap // untuk kebutuhan view
            ]);

            // Redirect berdasarkan role
            if ($user->role === 'bendahara') {
                redirect('dashboard/bendahara');
            } else {
                redirect('dashboard/view');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth/login');
        }
    } else {
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth/login');
    }
}
public function logout() {
    $this->session->sess_destroy(); // Menghancurkan session
    redirect('auth/login'); // Redirect ke halaman login setelah logout
}


}
?>
