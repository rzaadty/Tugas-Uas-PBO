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
        $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];
        
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

    // Fungsi untuk edit menu
    public function edit($id_menu) {
        if ($this->input->post('submit')) {
            $data = [
                'kategori' => $this->input->post('kategori'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_dasar' => $this->input->post('harga_dasar'),
                'harga_jual' => $this->input->post('harga_jual'),
                'stok' => $this->input->post('stok'),
            ];

            // Periksa apakah ada gambar yang di-upload
            if (!empty($_FILES['gambar']['name'])) {
                $data['gambar'] = $this->upload_image(); // Fungsi untuk upload gambar
            }

            $this->Menu_model->update_menu($id_menu, $data);
            redirect('Menu');
        } else {
            // Ambil data menu yang akan diedit
            $data['menu_item'] = $this->Menu_model->get_menu_by_id($id_menu);
            $this->load->view('Index/header');
            $this->load->view('Dashboard/Menu/edit', $data);
            $this->load->view('Index/footer');
        }
    }

    // Fungsi untuk mengupload gambar
    private function upload_image() {
        // Konfigurasi upload gambar
        $config['upload_path'] = 'path/gambar_menu/';  // Pastikan path folder upload sudah benar
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // Max file size 2MB
        $config['file_name'] = time() . '_' . $_FILES['gambar']['name'];
        
        $this->upload->initialize($config);

        // Proses upload gambar
        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data('file_name');
        }
        return null;
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
