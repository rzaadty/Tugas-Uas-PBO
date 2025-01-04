<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model meja
        $this->load->model('Meja_model');
    }

    // Menampilkan daftar meja
    public function index() {
        $data['meja_items'] = $this->Meja_model->get_all_meja(); // Mendapatkan semua data meja
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Meja/index', $data); // Kirim data meja ke view
        $this->load->view('Index/footer');
    }

    // Menampilkan form tambah meja
    public function v_tambahmeja() {
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Meja/add'); // Form tambah meja
        $this->load->view('Index/footer');
    }

    // Proses tambah meja
    public function tambah_aksi() {
        $data = array(
            'nomor_meja' => $this->input->post('nomor_meja'),
            'kapasitas' => $this->input->post('kapasitas'),
            'status' => $this->input->post('status'),
            'lokasi' => $this->input->post('lokasi'),
            'catatan' => $this->input->post('catatan'),
            'waktu_dipesan' => $this->input->post('waktu_dipesan')
        );
        $this->Meja_model->insert_meja($data);
        redirect('Meja');
    }

    // Menampilkan form edit meja
    public function v_edit($id_meja) {
        $data['meja'] = $this->Meja_model->get_meja_by_id($id_meja); // Mendapatkan data meja berdasarkan ID
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Meja/edit', $data); // Form edit meja
        $this->load->view('Index/footer');
    }

    // Proses update meja
    public function edit($id_meja) {
        $data = array(
            'nomor_meja' => $this->input->post('nomor_meja'),
            'kapasitas' => $this->input->post('kapasitas'),
            'status' => $this->input->post('status'),
            'lokasi' => $this->input->post('lokasi'),
            'catatan' => $this->input->post('catatan'),
            'waktu_dipesan' => $this->input->post('waktu_dipesan')
        );
        $this->Meja_model->update_meja($id_meja, $data);
        redirect('Meja');
    }

    // Proses hapus meja
    public function delete($id_meja) {
        $this->Meja_model->delete_meja($id_meja);
        redirect('Meja');
    }
}
