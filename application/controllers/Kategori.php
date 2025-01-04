<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model kategori
        $this->load->model('Kategori_model');
    }

    // Menampilkan daftar kategori
    public function index() {
        $data['kategori_items'] = $this->Kategori_model->get_all_kategori();
        $this->load->view('Index/header'); // Menggunakan header untuk layout umum
        $this->load->view('Dashboard/kategori/index', $data);
        $this->load->view('Index/footer'); // Menggunakan footer untuk layout umum
    }

    // Menambahkan kategori baru
    public function v_tambahkategori() {
        $this->load->view('Index/header'); // Menggunakan header untuk layout umum
        $this->load->view('Dashboard/kategori/add');
        $this->load->view('Index/footer'); // Menggunakan footer untuk layout umum
    }
    

    public function add() {
        $nama_kategori = $this->input->post('nama_kategori');
        $data = [
            'nama_kategori' => $nama_kategori
        ];
        $this->Kategori_model->add_kategori($data);
        redirect('Kategori');
    }

    // Mengedit kategori
    public function v_edit($id_kategori) {
        $data['kategori'] = $this->Kategori_model->get_kategori_by_id($id_kategori);
        $this->load->view('Index/header'); // Menggunakan header untuk layout umum
        $this->load->view('Dashboard/kategori/edit', $data);
        $this->load->view('Index/footer'); // Menggunakan footer untuk layout umum
    }

    public function edit($id_kategori) {
        $nama_kategori = $this->input->post('nama_kategori');
        $data = [
            'nama_kategori' => $nama_kategori
        ];
        $this->Kategori_model->update_kategori($id_kategori, $data);
        redirect('Kategori');
    }

    // Menghapus kategori
    public function delete($id_kategori) {
        $this->Kategori_model->delete_kategori($id_kategori);
        redirect('Kategori');
    }
}
