<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Data input dari form
            $data = [
                'nama'        => $this->input->post('nama', true),
                'alamat'      => $this->input->post('alamat', true),
                'no_telepon'  => $this->input->post('no_telepon', true),
                'email'       => $this->input->post('email', true),
                'password'    => password_hash($this->input->post('password', true), PASSWORD_BCRYPT), // Enkripsi password
                'status'      => 'user' // Set default status
            ];

            // Panggil model untuk insert data
            $inserted = $this->Auth_model->register_user($data);

            if ($inserted) {
                // Redirect ke halaman login dengan pesan sukses
                $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                redirect('auth/login');
            } else {
                // Tampilkan pesan error
                $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
                redirect('auth/register');
            }
        } else {
            $this->load->view('Index/header');
            $this->load->view('Auth/register');
            $this->load->view('Index/footer');
        }
    }

	// Fungsi untuk login
	public function index() {
		if ($this->input->method()=='post') {
			// Ambil input dari form
			$email=$this->input->post('email');
			$password=$this->input->post('password');

			// Proses login
			$user=$this->Auth_model->login($email, $password);

			if ($user) {
				// Set session jika login berhasil
				$this->session->set_userdata([
					'id'=> $user->id_login,
					'nama'=> $user->nama,
					'role'=> $user->status]);

				// Redirect sesuai status pengguna
				if ($user->status=='admin') {
					redirect('Dashboard');
				}

				else {
					redirect('Customer');
				}
			}

			else {
				// Jika login gagal, set flashdata dan redirect
				$this->session->set_flashdata('error', 'Email atau password salah!');
				redirect('Auth/login'); // Setelah redirect, flashdata akan hilang
			}
		}

		else {
			$this->load->view('Index/header');
			$this->load->view('Auth/login');
			$this->load->view('Index/footer');
		}
	}

	
	public function login() {
		if ($this->input->method()=='post') {
			// Ambil input dari form
			$email=$this->input->post('email');
			$password=$this->input->post('password');

			// Proses login
			$user=$this->Auth_model->login($email, $password);

			if ($user) {
				// Set session jika login berhasil
				$this->session->set_userdata([
					'id'=> $user->id_login,
					'nama'=> $user->nama,
					'role'=> $user->status]);

				// Redirect sesuai status pengguna
				if ($user->status=='admin') {
					redirect('Dashboard');
				}

				else {
					redirect('Customer');
				}
			}

			else {
				// Jika login gagal, set flashdata dan redirect
				$this->session->set_flashdata('error', 'Email atau password salah!');
				redirect('Auth/login'); // Setelah redirect, flashdata akan hilang
			}
		}

		else {
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
