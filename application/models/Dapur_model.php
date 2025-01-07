<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_booking_model extends CI_Model {

	// Fungsi untuk menambah pesanan baru
	public function tambah_pesanan($data_pesanan) {
		$this->db->insert('pesanan', $data_pesanan); // Menyimpan data pesanan ke dalam tabel pesanan

		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id(); // Mengembalikan ID pesanan jika berhasil
		} else {
			return false; // Mengembalikan false jika gagal menyimpan data
		}
	}

	// Fungsi untuk menambah detail pesanan
	public function tambah_detail_pesanan($data_detail) {
		$this->db->insert('pesanan_detail', $data_detail); // Menyimpan detail pesanan ke dalam tabel pesanan_detail
	}

	// Fungsi untuk mengurangi stok menu setelah pesanan dibuat
	public function kurangi_stok($id_barang, $qty) {
		// Mengurangi stok barang di tabel menu berdasarkan ID barang dan jumlah (qty) yang dipesan
		$this->db->set('stok', 'stok - '. (int)$qty, FALSE); // Kurangi stok sesuai dengan qty yang dipesan
		$this->db->where('id_menu', $id_barang); // Menyaring berdasarkan ID barang
		$this->db->update('menu'); // Update stok barang di tabel menu
	}

	// Fungsi untuk mendapatkan semua pesanan
	public function get_all_pesanan() {
		// Mengambil semua data pesanan dari tabel pesanan
		$query = $this->db->get('pesanan');
		return $query->result_array(); // Mengembalikan hasil sebagai array
	}

	// Fungsi untuk mendapatkan detail pesanan berdasarkan ID pesanan
	public function get_detail_pesanan($id_pesanan) {
		// Mengambil detail pesanan berdasarkan ID pesanan
		$this->db->select('
			pesanan_detail.id_pesanan,
			pesanan_detail.id_barang,
			pesanan_detail.jumlah,
			pesanan_detail.harga_jual,
			menu.nama_barang,
			pesanan.uang_bayar,
			pesanan.kembalian '); // Kolom yang akan diambil
		$this->db->from('pesanan_detail');
		$this->db->join('menu', 'menu.id_menu = pesanan_detail.id_barang', 'left'); // Join dengan tabel menu untuk mendapatkan nama barang
		$this->db->join('pesanan', 'pesanan.id_pesanan = pesanan_detail.id_pesanan', 'left'); // Join dengan tabel pesanan untuk mendapatkan informasi pesanan
		$this->db->where('pesanan_detail.id_pesanan', $id_pesanan); // Filter berdasarkan ID pesanan
		$query = $this->db->get(); // Jalankan query
		return $query->result_array(); // Kembalikan hasil query sebagai array
	}

	// Fungsi untuk mendapatkan semua data meja
	public function get_all_meja() {
		// Mengambil semua data meja dari tabel meja
		$query = $this->db->get('meja');
		return $query->result_array(); // Mengembalikan hasil sebagai array
	}

	// Fungsi untuk mengambil semua menu (barang)
	public function get_all_menu() {
		// Mengambil semua data menu (barang) dari tabel menu
		$query = $this->db->get('menu');
		return $query->result_array(); // Mengembalikan hasil sebagai array
	}

	// Fungsi untuk mendapatkan pesanan berdasarkan ID pesanan
	public function get_pesanan_by_id($id_pesanan) {
		// Mengambil data pesanan berdasarkan ID pesanan
		$this->db->where('id_pesanan', $id_pesanan);
		$query = $this->db->get('pesanan'); // Menjalankan query untuk mendapatkan pesanan
		return $query->row_array(); // Mengembalikan satu baris data pesanan
	}
}
