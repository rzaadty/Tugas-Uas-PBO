<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Akun_model'); // Pastikan model sudah diload
    }

    public function index() {
        // Ambil ID pengguna dari session
        $id_login = $this->session->userdata('id');

        // Ambil data pengguna berdasarkan ID
        $data['akun'] = $this->Akun_model->get_akun_by_id($id_login);

        // Muat view dengan data akun
        $this->load->view('Index/header_customer');
        $this->load->view('Customer/Akun/index', $data); // Kirim data ke view
        $this->load->view('Index/footer_customer');
    }

    public function update_akun() {
        $id_login = $this->session->userdata('id');
        
        // Ambil data dari form
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_telepon' => $this->input->post('no_telepon'),
            'email' => $this->input->post('email')
        );
    
        // Cek apakah password diisi
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT); // Hash password
        }
    
        // Update data di database
        $this->Akun_model->update_akun($id_login, $data);
    
        // Set flash data dan redirect
        $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
        redirect('Akun'); // Redirect ke halaman akun
    }
    

}
