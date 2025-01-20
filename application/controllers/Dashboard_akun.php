<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_akun extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model yang dibutuhkan
        $this->load->model('Auth_model');
        // Memuat helper untuk session dan URL
        $this->load->helper('url');
    }

    // Menampilkan daftar pengguna
    public function index() {
        $data['users'] = $this->Auth_model->get_all_users();
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Akun/index', $data); // Memanggil view daftar akun
        $this->load->view('Index/footer');
    }

    // Menambahkan pengguna baru
    public function create() {
        if ($this->input->post()) {
            // Mengambil data dari form dan mempersiapkan data untuk ditambahkan ke database
            $data = [
                'nama'       => $this->input->post('nama', true),
                'alamat'     => $this->input->post('alamat', true),
                'no_telepon' => $this->input->post('no_telepon', true),
                'email'      => $this->input->post('email', true),
                'password'   => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
                'status'     => $this->input->post('status', true)
            ];

            // Menyimpan data pengguna baru ke database
            if ($this->Auth_model->register_user($data)) {
                $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
                redirect('Dashboard_akun');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan user.');
                redirect('Dashboard_akun/create');
            }
        }

        // Memanggil form tambah akun
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Akun/add'); // Halaman form tambah akun
        $this->load->view('Index/footer');
    }

    // Mengedit pengguna
    public function edit($id) {
        // Mengambil data pengguna berdasarkan ID
        $data['user'] = $this->Auth_model->get_user_by_id($id);

        if (!$data['user']) {
            redirect('Dashboard_akun');
        }

        if ($this->input->post()) {
            // Mengambil data yang diperbarui dari form
            $update_data = [
                'nama'       => $this->input->post('nama', true),
                'alamat'     => $this->input->post('alamat', true),
                'no_telepon' => $this->input->post('no_telepon', true),
                'email'      => $this->input->post('email', true),
                'status'     => $this->input->post('status', true)
            ];

            // Jika password diubah, maka lakukan hash terhadap password baru
            if (!empty($this->input->post('password'))) {
                $update_data['password'] = password_hash($this->input->post('password', true), PASSWORD_BCRYPT);
            }

            // Memperbarui data pengguna di database
            if ($this->Auth_model->update_user($id, $update_data)) {
                $this->session->set_flashdata('success', 'User berhasil diperbarui!');
                redirect('Dashboard_akun');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui user.');
            }
        }

        // Memanggil form edit akun
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Akun/edit', $data); // Halaman form edit akun
        $this->load->view('Index/footer');
    }

    // Menghapus pengguna
    public function delete($id) {
        if ($this->Auth_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
        }
        redirect('Dashboard_akun');
    }
}
