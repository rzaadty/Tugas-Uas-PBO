<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_model extends CI_Model {

    // Mendapatkan semua meja
    public function get_all_meja() {
        return $this->db->get('meja')->result_array();
    }

    // Mendapatkan meja berdasarkan ID
    public function get_meja_by_id($id_meja) {
        return $this->db->get_where('meja', ['id_meja' => $id_meja])->row_array();
    }

    // Menambahkan meja
    public function insert_meja($data) {
        return $this->db->insert('meja', $data);
    }

    // Mengupdate meja
    public function update_meja($id_meja, $data) {
        return $this->db->update('meja', $data, ['id_meja' => $id_meja]);
    }

    // Menghapus meja
    public function delete_meja($id_meja) {
        return $this->db->delete('meja', ['id_meja' => $id_meja]);
    }
}
