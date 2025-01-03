<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index($action = 'login') {
        switch ($action) {
            case 'login':
                $this->login();
                break;

            case 'register':
                $this->register();
                break;

            case 'logout':
                $this->logout();
                break;

            default:
                show_404(); // Jika aksi tidak dikenali
                break;
        }
    }

    private function login() {
        // Validasi form input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login
            $this->load->view('Auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            // Cek kredensial login untuk Warga
            $warga = $this->Auth_model->login_warga($username, $password);
            if ($warga) {
                // Jika pengguna adalah Warga, simpan data ke dalam session
                $this->session->set_userdata([
                    'user_id'            => $warga->ID_Warga,
                    'user_role'          => 'Warga',
                    'user_nama'          => $warga->Nama_Warga,
                    'user_nik'           => $warga->NIK,
                    'user_tempat_lahir'  => $warga->Tempat_Lahir,
                    'user_tanggal_lahir' => $warga->Tanggal_Lahir,
                    'user_jenis_kelamin' => $warga->Jenis_Kelamin,
                    'user_alamat'        => $warga->Alamat,
                    'user_rt_rw'         => $warga->RT_RW,
                    'user_kelurahan'     => $warga->Kelurahan,
                    'user_kecamatan'     => $warga->Kecamatan,
                    'user_kontak'        => $warga->No_HP,
                    'user_username'      => $warga->Username
                ]);
    
                // Redirect ke halaman dashboard Warga
                redirect('Warga');
            } else {
                // Cek kredensial login untuk Aparatur Desa
                $aparatur = $this->Auth_model->login_aparatur($username, $password);
                if ($aparatur) {
                    // Jika pengguna adalah Aparatur Desa, simpan data ke dalam session
                    $this->session->set_userdata([
                        'user_id'    => $aparatur->ID_Aparatur,
                        'user_role'  => 'Aparatur',
                        'user_nama'  => $aparatur->Nama_Aparatur,
                        'user_jabatan' => $aparatur->Jabatan,
                        'user_unit'   => $aparatur->Unit
                    ]);
    
                    // Redirect ke halaman dashboard Aparatur
                    redirect('Dashboard');
                } else {
                    // Jika login gagal (username atau password salah)
                    $this->session->set_flashdata('error', 'Username atau Password salah');
                    redirect('Auth/index/login'); // Kembali ke form login
                }
            }
        }
    }
    
    


    // Proses registrasi untuk warga
    private function register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[Data_Warga.Username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form registrasi
            $this->load->view('auth/register');
        } else {
            $data = array(
                'Nama_Warga' => $this->input->post('nama'),
                'Alamat' => $this->input->post('alamat'),
                'Kontak' => $this->input->post('kontak'),
                'Username' => $this->input->post('username'),
                'Password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'Tanggal_Dibuat' => date('Y-m-d'),
                'Tanggal_Perubahan' => date('Y-m-d')
            );

            if ($this->Auth_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth/index/login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal!');
                redirect('auth/index/register');
            }
        }
    }

    // Halaman logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/index/login');
    }
}
