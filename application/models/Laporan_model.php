<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // Ambil semua laporan
    public function get_all_laporan() {
        return $this->db->get('pesanan')->result_array();
    }

    // Ambil laporan berdasarkan ID
    public function get_laporan_by_id($id_pesanan) {
        return $this->db->get_where('pesanan', ['id_pesanan' => $id_pesanan])->row_array();
    }

    // Hapus laporan berdasarkan ID
    public function delete_laporan($id_pesanan) {
        return $this->db->delete('pesanan', ['id_pesanan' => $id_pesanan]);
    }
}
