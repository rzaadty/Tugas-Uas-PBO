<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Dapur_model extends CI_Model {

    // Fetch all orders with status "Menunggu" (Waiting)
    public function get_orders() {
        $this->db->select('*');
        $this->db->from('pesanan p');
        $this->db->order_by('p.tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Update the status of the order (e.g., from "Menunggu" to "Diproses")
    public function update_order_status($id_pesanan, $status) {
        $data = array('status_pesanan' => $status);
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update('pesanan', $data);
    }

    public function get_order_details($id_pesanan) {
        $this->db->select('d.id_barang, d.jumlah, d.harga_jual, m.nama_barang, p.id_meja, t.nomor_meja');
        $this->db->from('pesanan_detail d');
        $this->db->join('menu m', 'm.id_menu = d.id_barang');
        $this->db->join('pesanan p', 'p.id_pesanan = d.id_pesanan');
        $this->db->join('meja t', 't.id_meja = p.id_meja');
        $this->db->where('d.id_pesanan', $id_pesanan);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
}

