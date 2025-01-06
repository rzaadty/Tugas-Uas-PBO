<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_booking extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('Customer_booking_model');
		$this->load->library('cart'); // Load library cart
	}

	public function index() {

        $data['meja_items']=$this->Customer_booking_model->get_all_meja();
		$data['menu_items']=$this->Customer_booking_model->get_all_menu();
		$this->load->view('Index/header');
		$this->load->view('Customer/Booking/index',$data);
		$this->load->view('Index/footer');

	}

	// Fungsi untuk menambah item ke cart
	public function tambah_ke_cart() {
		$data=array('id'=> $this->input->post('id_barang'),
			'name'=> $this->input->post('nama_barang'),
			'price'=> $this->input->post('harga'),
			'qty'=> $this->input->post('jumlah'));

		$this->cart->insert($data); // Menambahkan item ke cart
		redirect('Customer_booking/lihat_cart');
	}

	// Fungsi untuk melihat isi cart
	public function lihat_cart() {
		$data['cart_items']=$this->cart->contents(); // Mendapatkan isi cart
		$data['total_harga']=$this->cart->total(); // Total harga cart
		$this->load->view('Index/header_customer');
		$this->load->view('Customer/Booking/lihat_cart', $data);
		$this->load->view('Index/footer_customer');
	}

	// Fungsi untuk menghapus item dari cart
	public function hapus_item_cart($rowid) {
		$data=array('rowid'=> $rowid,
			'qty'=> 0);

		$this->cart->update($data); // Menghapus item berdasarkan rowid
		redirect('Customer_booking/lihat_cart');
	}

	// Fungsi checkout
	public function checkout() {
		// Mendapatkan data dari keranjang belanja
		$data['cart_items']=$this->cart->contents();
		$data['total_harga']=$this->cart->total();
		$data['meja_items']=$this->Customer_booking_model->get_all_meja();
		// Memuat halaman checkout
		$this->load->view('Index/header_customer');
		$this->load->view('Customer/Booking/checkout', $data);
		$this->load->view('Index/footer_customer');
	}

	public function buat_pesanan() {
		$id_meja = $this->input->post('id_meja');
		$id_pemesan_online = $this->input->post('id_pemesan_online');; // Ambil dari session user
		$nama = $this->input->post('nama');
		$jenis_order = $this->input->post('jenis_order');
		$metode_pembayaran = $this->input->post('metode_pembayaran');
		$total_harga = $this->cart->total();
		$uang_bayar = $this->input->post('uang_bayar');
		$kembalian = $uang_bayar - $total_harga;
		$status_pesanan = 'Menunggu';
	
		// Data pesanan
		$data_pesanan = array(
			'id_meja' => $id_meja,
			'id_pemesan_online' => $id_pemesan_online,
			'nama' => $nama,
			'jenis_order' => $jenis_order,
			'metode_pembayaran' => $metode_pembayaran,
			'total_harga' => $total_harga,
			'uang_bayar' => $uang_bayar,
			'kembalian' => $kembalian,
			'tanggal' => date('Y-m-d H:i:s'),
			'status_pesanan' => $status_pesanan
		);
	
		// Menambahkan pesanan
		$id_pesanan = $this->Customer_booking_model->tambah_pesanan($data_pesanan);
	
		// Menambahkan detail pesanan dari cart
		foreach ($this->cart->contents() as $item) {
			$data_detail = array(
				'id_pesanan' => $id_pesanan,
				'id_barang' => $item['id'],
				'jumlah' => $item['qty'],
				'harga_jual' => $item['price']
			);
			$this->Customer_booking_model->tambah_detail_pesanan($data_detail);
	
			// Mengurangi stok barang
			$this->Customer_booking_model->kurangi_stok($item['id'], $item['qty']);
		}
	
		// Jika ada bukti transfer, upload dan simpan ke tabel bukti_pembayaran
		if (!empty($_FILES['bukti_pembayaran']['name'])) {
			$config['upload_path'] = 'path/gambar_bukti_transfer/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048; // Maksimal 2MB
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('bukti_pembayaran')) {
				$upload_data = $this->upload->data();
				$data_bukti = array(
					'id_pesanan' => $id_pesanan,
					'nama_file' => $upload_data['file_name'],
					'path' => 'path/gambar_bukti_transfer/' . $upload_data['file_name'],
					'tanggal_upload' => date('Y-m-d H:i:s')
				);
				$this->Customer_booking_model->simpan_bukti_transfer($data_bukti);
			} else {
				// Tangani error upload
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', 'Upload bukti transfer gagal: ' . $error);
			}
		}
	
		// Kosongkan cart setelah pesanan dibuat
		$this->cart->destroy();
	
		// Redirect ke halaman konfirmasi pesanan
		redirect('Customer_booking/konfirmasi_pesanan/' . $id_pesanan);
	}
	


	// Fungsi untuk konfirmasi pesanan
	public function konfirmasi_pesanan($id_pesanan) {
		$data['pesanan']=$this->Customer_booking_model->get_all_pesanan();
		$data['detail_pesanan']=$this->Customer_booking_model->get_detail_pesanan($id_pesanan);

		// Memuat view konfirmasi
		$this->load->view('Index/header_customer');
		$this->load->view('Customer/Booking/konfirmasi_pesanan', $data);
		$this->load->view('Index/footer_customer');
	}

}
