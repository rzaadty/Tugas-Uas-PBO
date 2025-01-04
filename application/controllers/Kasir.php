<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Kasir extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('Kasir_model');
        }


        public function index() {
            // Mengambil data meja dan menu
            $data['meja_items'] = $this->Kasir_model->get_all_meja();  // Mendapatkan data meja
            $data['menu_items'] = $this->Kasir_model->get_all_menu();  // Mendapatkan data menu/barang
    
            // Memuat view dengan data meja dan menu
            $this->load->view('Index/header');
            $this->load->view('Dashboard/Kasir/index', $data);  // Mengirim data ke view
            $this->load->view('Index/footer');
        }


        // Fungsi untuk melakukan proses pemesanan
        public function buat_pesanan() {
            // Menangkap data dari form
            $id_meja = $this->input->post('id_meja');
            $jenis_order = $this->input->post('jenis_order');
            $metode_pembayaran = $this->input->post('metode_pembayaran');
            $total_harga = $this->input->post('total_harga');
            $uang_bayar = $this->input->post('uang_bayar');
            $kembalian = $uang_bayar - $total_harga;
            $status_pesanan = 'Menunggu';  // Status awal pesanan
    
            // Data pesanan
            $data_pesanan = array(
                'id_meja' => $id_meja,
                'jenis_order' => $jenis_order,
                'metode_pembayaran' => $metode_pembayaran,
                'total_harga' => $total_harga,
                'uang_bayar' => $uang_bayar,
                'kembalian' => $kembalian,
                'tanggal' => date('Y-m-d H:i:s'),
                'status_pesanan' => $status_pesanan
            );
    
            // Menambahkan pesanan
            $id_pesanan = $this->Kasir_model->tambah_pesanan($data_pesanan);
    
            // Menambahkan detail pesanan
            $barang_items = $this->input->post('barang_items'); // Contoh data: array('id_barang' => 1, 'jumlah' => 2, 'harga_jual' => 50000)
            foreach ($barang_items as $item) {
                $data_detail = array(
                    'id_pesanan' => $id_pesanan,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah'],
                    'harga_jual' => $item['harga_jual']
                );
                $this->Kasir_model->tambah_detail_pesanan($data_detail);
            }
    
            // Redirect atau tampilkan konfirmasi
            redirect('Kasir/konfirmasi_pesanan/' . $id_pesanan);
        }
    
        // Fungsi untuk konfirmasi pesanan
        public function konfirmasi_pesanan($id_pesanan) {
            $data['pesanan'] = $this->Kasir_model->get_all_pesanan();
            $data['detail_pesanan'] = $this->Kasir_model->get_detail_pesanan($id_pesanan);
            $this->load->view('kasir/konfirmasi_pesanan', $data);
        }
    }
    

