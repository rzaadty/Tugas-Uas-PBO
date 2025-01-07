<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dapur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dapur_model');
    }

    // Fungsi untuk menampilkan halaman utama dengan daftar pesanan
    public function index() {
        $data['orders'] = $this->Dapur_model->get_orders(); // Mendapatkan daftar pesanan
        $this->load->view('Index/header'); // Memuat header
        $this->load->view('Dashboard/Dapur/index', $data); // Memuat halaman utama dengan daftar pesanan
        $this->load->view('Index/footer'); // Memuat footer
    }

    // Fungsi untuk melihat detail pesanan berdasarkan ID pesanan
    public function view_order($id_pesanan) {
        $data['order_details'] = $this->Dapur_model->get_order_details($id_pesanan); // Mendapatkan detail pesanan
        $data['order_id'] = $id_pesanan; // Menyimpan ID pesanan
        $this->load->view('Index/header'); // Memuat header
        $this->load->view('Dashboard/Dapur/detail_order', $data); // Memuat halaman detail pesanan
        $this->load->view('Index/footer'); // Memuat footer
    }

    // Fungsi untuk memperbarui status pesanan berdasarkan ID pesanan dan status baru
    public function update_status($id_pesanan, $status) {
        $this->Dapur_model->update_order_status($id_pesanan, $status); // Memperbarui status pesanan
        redirect('Dapur'); // Mengarahkan kembali ke halaman utama
    }

    // Fungsi untuk memfilter pesanan berdasarkan status
    public function filter_orders() {
        $status_filter = $this->input->get('status_filter'); // Mendapatkan status filter dari input pengguna
    
        // Jika status filter ada, ambil pesanan berdasarkan status tersebut
        if ($status_filter) {
            $orders = $this->Dapur_model->get_orders_by_status($status_filter); // Mendapatkan pesanan berdasarkan status
        } else {
            // Jika tidak ada filter, ambil semua pesanan
            $orders = $this->Dapur_model->get_all_orders(); // Mendapatkan semua pesanan
        }
    
        $data['orders'] = $orders; // Menyimpan daftar pesanan ke dalam data
    
        $this->load->view('Index/header'); // Memuat header
        $this->load->view('Dashboard/Dapur/order_list', $data); // Memuat halaman daftar pesanan
        $this->load->view('Index/footer'); // Memuat footer
    }
}
