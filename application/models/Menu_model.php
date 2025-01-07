<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    // Fungsi untuk mendapatkan semua menu
    public function get_all_menu() {
        // Mengambil semua data dari tabel menu
        return $this->db->get('menu')->result_array(); // Mengembalikan hasil query dalam bentuk array
    }

    // Fungsi untuk mendapatkan menu berdasarkan ID menu
    public function get_menu_by_id($id_menu) {
        // Mengambil data menu berdasarkan ID menu
        return $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array(); // Mengembalikan satu baris data
    }

    // Fungsi untuk menambah menu baru
    public function insert_menu($data) {
        // Menyimpan data menu baru ke dalam tabel menu
        return $this->db->insert('menu', $data); // Mengembalikan status keberhasilan
    }

    // Fungsi untuk memperbarui data menu
    public function update_menu($id_menu, $data) {
        // Memperbarui data menu berdasarkan ID menu
        $this->db->where('id_menu', $id_menu); // Menyaring berdasarkan ID menu
        return $this->db->update('menu', $data); // Mengembalikan status keberhasilan
    }

    // Fungsi untuk menghapus menu berdasarkan ID menu
    public function delete_menu($id_menu) {
        // Menghapus data menu berdasarkan ID menu
        $this->db->where('id_menu', $id_menu); // Menyaring berdasarkan ID menu
        return $this->db->delete('menu'); // Mengembalikan status keberhasilan
    }

    // Fungsi untuk mendapatkan semua kategori menu
    public function get_all_kategori() {
        // Mengambil semua data dari tabel kategori
        $query = $this->db->get('kategori');
        return $query->result_array(); // Mengembalikan hasil query dalam bentuk array
    }
}
