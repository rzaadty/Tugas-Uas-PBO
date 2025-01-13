<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_model extends CI_Model {

    // Fungsi untuk menambah pesanan baru
    public function tambah_pesanan($data_pesanan) {
        // Menyimpan data pesanan ke dalam tabel pesanan
        $this->db->insert('pesanan', $data_pesanan);
        return $this->db->insert_id(); // Mengembalikan ID pesanan yang baru saja disimpan
    }

    // Fungsi untuk menambah detail pesanan
    public function tambah_detail_pesanan($data_detail) {
        // Menyimpan detail pesanan ke dalam tabel pesanan_detail
        $this->db->insert('pesanan_detail', $data_detail);
    }

    // Fungsi untuk mengurangi stok menu
    public function kurangi_stok($id_barang, $qty) {
        // Update stok barang di tabel menu
        $this->db->set('stok', 'stok - '. (int)$qty, FALSE); // Kurangi stok sesuai dengan qty
        $this->db->where('id_menu', $id_barang); // Menyaring berdasarkan ID menu
        $this->db->update('menu'); // Melakukan pembaruan stok
    }

    // Fungsi untuk mendapatkan semua pesanan
    public function get_all_pesanan() {
        // Mengambil semua data dari tabel pesanan
        $query = $this->db->get('pesanan');
        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    // Fungsi untuk mendapatkan detail pesanan berdasarkan ID pesanan
    public function get_detail_pesanan($id_pesanan) {
        $this->db->select('
            pesanan_detail.id_pesanan,
            pesanan_detail.id_barang,
            pesanan_detail.jumlah,
            pesanan_detail.harga_jual,
            menu.nama_barang,
            pesanan.uang_bayar,
            pesanan.kembalian'); // Kolom yang akan diambil
        $this->db->from('pesanan_detail'); // Mengambil data dari tabel pesanan_detail
        $this->db->join('menu', 'menu.id_menu = pesanan_detail.id_barang', 'left'); // Join dengan tabel menu
        $this->db->join('pesanan', 'pesanan.id_pesanan = pesanan_detail.id_pesanan', 'left'); // Join dengan tabel pesanan
        $this->db->where('pesanan_detail.id_pesanan', $id_pesanan); // Filter berdasarkan ID pesanan
        $query = $this->db->get(); // Menjalankan query
        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    // Fungsi untuk mendapatkan semua data meja
    public function get_all_meja() {
        // Mengambil semua data dari tabel meja
        $query = $this->db->get('meja');
        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    // Fungsi untuk mengambil semua menu (barang)
    public function get_all_menu() {
        // Mengambil semua data dari tabel menu
        $query = $this->db->get('menu');
        return $query->result_array(); // Mengembalikan hasil query sebagai array
    }

    public function update_status_meja($id_meja, $data) {
        $this->db->where('id_meja', $id_meja);
        return $this->db->update('meja', $data);
    }
    
}
