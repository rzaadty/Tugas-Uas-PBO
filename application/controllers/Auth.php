<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // KONSEP OOP TENTANG CONTRUCT
        $this->load->model('Auth_model');
        // Memuat helper untuk session
        $this->load->helper('url');
    }

    // Fungsi untuk register (pendaftaran)
    public function register() {
        $this->load->view('Index/header');
        $this->load->view('Auth/register');
        $this->load->view('Index/footer');
    }

    // Fungsi untuk login
    public function login() {
        if ($this->input->method() == 'post') {
            // Ambil input dari form
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            // Proses login
            $user = $this->Auth_model->login($email, $password);
            
            if ($user) {
                // Set session jika login berhasil
                $this->session->set_userdata([
                    'id_login' => $user->id_login,
                    'nama' => $user->nama,
                    'role' => $user->status
                ]);
                
                // Redirect sesuai status pengguna
                if ($user->status == 'admin') {
                    redirect('Dashboard');
                } else {
                    redirect('Customer');
                }
            } else {
                // Jika login gagal, set flashdata dan redirect
                $this->session->set_flashdata('error', 'Email atau password salah!');
                redirect('Auth/login'); // Setelah redirect, flashdata akan hilang
            }
        } else {
            $this->load->view('Index/header');
            $this->load->view('Auth/login');
            $this->load->view('Index/footer');
        }
    }

    // Fungsi logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth/login');
    }
}
