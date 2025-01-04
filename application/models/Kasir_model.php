<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kasir_model extends CI_Model {

    // Fungsi untuk menambah pesanan baru
    public function tambah_pesanan($data_pesanan) {
        // Menyimpan data pesanan ke dalam tabel pesanan
        $this->db->insert('pesanan', $data_pesanan);
        return $this->db->insert_id();  // Mengembalikan ID pesanan yang baru saja disimpan
    }

    // Fungsi untuk menambah detail pesanan
    public function tambah_detail_pesanan($data_detail) {
        // Menyimpan detail pesanan ke dalam tabel detail_pesanan
        $this->db->insert('detail_pesanan', $data_detail);
    }

    // Fungsi untuk mendapatkan semua pesanan
    public function get_all_pesanan() {
        return $this->db->get('pesanan')->result_array();
    }

    // Fungsi untuk mendapatkan detail pesanan berdasarkan id_pesanan
    public function get_detail_pesanan($id_pesanan) {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->get('detail_pesanan')->result_array();
    }

    public function get_all_meja() {
        $query = $this->db->get('meja');  // Mengambil semua data dari tabel meja
        return $query->result_array();  // Mengembalikan data meja dalam bentuk array
    }

    // Fungsi untuk mengambil semua menu (barang)
    public function get_all_menu() {
        $query = $this->db->get('menu');  // Mengambil semua data dari tabel barang
        return $query->result_array();  // Mengembalikan data menu dalam bentuk array
    }
}


