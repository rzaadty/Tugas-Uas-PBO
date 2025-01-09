<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_pesanan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Customer_pesanan_model');
    }

	public function index() {
		// Ambil user_id dari session
		$user_id = $this->session->userdata('id'); // Pastikan 'id' adalah nama session yang menyimpan ID pengguna
		if (!$user_id) {
			// Jika pengguna belum login, arahkan ke halaman login
			redirect('auth/login');
		}
	
		// Ambil data pesanan berdasarkan id_pemesan_online
		$data['orders'] = $this->Customer_pesanan_model->get_orders_by_user($user_id);
	
		// Load views dengan data
		$this->load->view('Index/header');
		$this->load->view('Customer/Pesanan/index', $data);
		$this->load->view('Index/footer');
	}

	public function view_order($id_pesanan) {
        $data['order_details'] = $this->Customer_pesanan_model->get_order_details($id_pesanan);
        $data['order_id'] = $id_pesanan;
        $this->load->view('Index/header');
        $this->load->view('Customer/Pesanan/detail_order', $data);
        $this->load->view('Index/footer');
    }
	


}
