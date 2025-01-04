<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    // Mengambil semua kategori dari database
    public function get_all_kategori() {
        return $this->db->get('kategori')->result_array();
    }

    // Menambahkan kategori baru
    public function add_kategori($data) {
        return $this->db->insert('kategori', $data);
    }

    // Mengupdate kategori berdasarkan ID
    public function update_kategori($id_kategori, $data) {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->update('kategori', $data);
    }

    // Menghapus kategori berdasarkan ID
    public function delete_kategori($id_kategori) {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->delete('kategori');
    }

    // Mengambil kategori berdasarkan ID
    public function get_kategori_by_id($id_kategori) {
        return $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array();
    }
}
