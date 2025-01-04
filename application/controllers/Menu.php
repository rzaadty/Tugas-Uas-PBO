<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Menu_model'); 
        $this->load->library('upload'); // Pastikan upload library dimuat
    }

    // Halaman menu
    public function index() {
        $data['menu_items'] = $this->Menu_model->get_all_menu(); 
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Menu/index', $data);
        $this->load->view('Index/footer');
    }
    // Halaman tambah menu
    public function v_tambahmenu() {
        $data['kategoris'] = $this->Menu_model->get_all_kategori(); 
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Menu/add', $data);
        $this->load->view('Index/footer');
    }
    public function v_edit($id_menu) {
        $data['kategoris'] = $this->Menu_model->get_all_kategori();
        $data['menu_item'] = $this->Menu_model->get_menu_by_id($id_menu);
        $this->load->view('Index/header');
        $this->load->view('Dashboard/Menu/edit', $data);
        $this->load->view('Index/footer');
    }

    // Fungsi untuk menambah menu
    public function add() {
        // Ambil data dari form
        $nama_barang = $this->input->post('nama_barang');
        $kategori = $this->input->post('kategori');
        $harga_dasar = $this->input->post('harga_dasar');
        $harga_jual = $this->input->post('harga_jual');
        $stok = $this->input->post('stok');

        // Konfigurasi upload gambar
        $config['upload_path'] = 'path/gambar_menu/';  // Pastikan path folder upload sudah benar
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // Max file size 2MB
        $config['file_name'] = 'menu_' . time();
        
        $this->upload->initialize($config);

        // Proses upload gambar
        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name');
        } else {
            $gambar = null; // Jika gambar tidak diupload
        }

        // Simpan data menu ke database
        $data = [
            'nama_barang' => $nama_barang,
            'kategori' => $kategori,
            'harga_dasar' => $harga_dasar,
            'harga_jual' => $harga_jual,
            'stok' => $stok,
            'gambar' => $gambar
        ];

        $this->Menu_model->insert_menu($data);

        // Redirect ke halaman menu
        redirect('Menu');
    }


// Fungsi untuk mengedit menu berdasarkan id_menu
public function edit($id_menu) {
    $this->load->model('Menu_model'); // Load model

    // Ambil data menu berdasarkan ID
    $menu_item = $this->Menu_model->get_menu_by_id($id_menu);

    // Pastikan data menu ditemukan
    if (!$menu_item) {
        show_404();
    }

    // Ambil data dari form
    $nama_barang = $this->input->post('nama_barang');
    $kategori = $this->input->post('kategori');
    $harga_dasar = $this->input->post('harga_dasar');
    $harga_jual = $this->input->post('harga_jual');
    $stok = $this->input->post('stok');

    // Konfigurasi upload gambar
    $config['upload_path'] = 'path/gambar_menu/'; // Pastikan path folder upload sudah benar
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size'] = 2048; // Max file size 2MB
    $config['file_name'] = 'menu_' . time();
    
    $this->upload->initialize($config);

    // Proses upload gambar
    if ($this->upload->do_upload('gambar')) {
        // Hapus gambar lama jika ada
        if (!empty($menu_item['gambar']) && file_exists('path/gambar_menu/' . $menu_item['gambar'])) {
            unlink('path/gambar_menu/' . $menu_item['gambar']);
        }
        $gambar = $this->upload->data('file_name');
    } else {
        $gambar = $menu_item['gambar']; // Gunakan gambar lama jika tidak diupload
    }

    // Data yang akan diupdate
    $data = [
        'nama_barang' => $nama_barang,
        'kategori' => $kategori,
        'harga_dasar' => $harga_dasar,
        'harga_jual' => $harga_jual,
        'stok' => $stok,
        'gambar' => $gambar
    ];

    // Update data menu ke database
    $this->Menu_model->update_menu($id_menu, $data);

    // Redirect ke halaman menu
    redirect('Menu');
}

 

    // Fungsi untuk menghapus menu
    public function delete($id) {
        $menu_item = $this->Menu_model->get_menu_by_id($id);
        if ($menu_item && !empty($menu_item['gambar'])) {
            $image_path = 'path/gambar_menu/' . $menu_item['gambar'];
            if (file_exists($image_path)) {
                unlink($image_path); // Hapus gambar dari folder jika ada
            }
        }

        $this->Menu_model->delete_menu($id);
        redirect('Menu');
    }
}
