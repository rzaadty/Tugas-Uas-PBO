<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kasir_model');
		$this->load->library('cart'); // Load library cart
	}

	public function index() {
		// Mengambil data meja dan menu
		$data['meja_items']=$this->Kasir_model->get_all_meja();
		$data['menu_items']=$this->Kasir_model->get_all_menu();

		// Memuat view dengan data meja dan menu
		$this->load->view('Index/header');
		$this->load->view('Dashboard/Kasir/index', $data);
		$this->load->view('Index/footer');
	}

	// Fungsi untuk menambah item ke cart
	public function tambah_ke_cart() {
		$data=array('id'=> $this->input->post('id_barang'),
			'name'=> $this->input->post('nama_barang'),
			'price'=> $this->input->post('harga'),
			'qty'=> $this->input->post('jumlah'));

		$this->cart->insert($data); // Menambahkan item ke cart
		redirect('Kasir/lihat_cart');
	}

	// Fungsi untuk melihat isi cart
	public function lihat_cart() {
		$data['cart_items']=$this->cart->contents(); // Mendapatkan isi cart
		$data['total_harga']=$this->cart->total(); // Total harga cart
		$this->load->view('Index/header');
		$this->load->view('Dashboard/Kasir/lihat_cart', $data);
		$this->load->view('Index/footer');
	}

	// Fungsi untuk menghapus item dari cart
	public function hapus_item_cart($rowid) {
		$data=array('rowid'=> $rowid,
			'qty'=> 0);

		$this->cart->update($data); // Menghapus item berdasarkan rowid
		redirect('Kasir/lihat_cart');
	}

	// Fungsi checkout
	public function checkout() {
		// Mendapatkan data dari keranjang belanja
		$data['cart_items']=$this->cart->contents();
		$data['total_harga']=$this->cart->total();
		$data['meja_items']=$this->Kasir_model->get_all_meja();
		// Memuat halaman checkout
		$this->load->view('Index/header');
		$this->load->view('Dashboard/Kasir/checkout', $data);
		$this->load->view('Index/footer');
	}

	// Fungsi untuk membuat pesanan dari cart
	public function buat_pesanan() {
		$id_meja=$this->input->post('id_meja');
		$nama=$this->input->post('nama');
		$jenis_order=$this->input->post('jenis_order');
		$metode_pembayaran=$this->input->post('metode_pembayaran');
		$total_harga=$this->cart->total();
		$uang_bayar=$this->input->post('uang_bayar');
		$kembalian=$uang_bayar - $total_harga;
		$status_pesanan='Menunggu';

		// Data pesanan
		$data_pesanan=array('id_meja'=> $id_meja,
			'nama'=> $nama,
			'jenis_order'=> $jenis_order,
			'metode_pembayaran'=> $metode_pembayaran,
			'total_harga'=> $total_harga,
			'uang_bayar'=> $uang_bayar,
			'kembalian'=> $kembalian,
			'tanggal'=> date('Y-m-d H:i:s'),
			'status_pesanan'=> $status_pesanan);

		// Menambahkan pesanan
		$id_pesanan=$this->Kasir_model->tambah_pesanan($data_pesanan);

		// Menambahkan detail pesanan dari cart
		foreach ($this->cart->contents() as $item) {
			// Data detail pesanan
			$data_detail=array('id_pesanan'=> $id_pesanan,
				'id_barang'=> $item['id'],
				'jumlah'=> $item['qty'],
				'harga_jual'=> $item['price']);
			$this->Kasir_model->tambah_detail_pesanan($data_detail);

			// Mengurangi stok barang setelah pesanan dibuat
			$this->Kasir_model->kurangi_stok($item['id'], $item['qty']);
		}

		// Kosongkan cart setelah pesanan dibuat
		$this->cart->destroy();

		// Redirect ke halaman konfirmasi pesanan
		redirect('Kasir/konfirmasi_pesanan/'. $id_pesanan);
	}


	// Fungsi untuk konfirmasi pesanan
	public function konfirmasi_pesanan($id_pesanan) {
		$data['pesanan']=$this->Kasir_model->get_all_pesanan();
		$data['detail_pesanan']=$this->Kasir_model->get_detail_pesanan($id_pesanan);

		// Memuat view konfirmasi
		$this->load->view('Index/header');
		$this->load->view('Dashboard/Kasir/konfirmasi_pesanan', $data);
		$this->load->view('Index/footer');
	}
}
