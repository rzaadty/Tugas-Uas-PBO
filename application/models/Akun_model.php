<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {

    public function get_akun_by_id($id_login) {
        // Mengambil data pengguna berdasarkan id_login
        $this->db->select('id_login, nama, alamat, no_telepon, email, password, status');
        $this->db->from('login');
        $this->db->where('id_login', $id_login);
        $query = $this->db->get();
        
        // Kembalikan hasil query
        return $query->row(); // Mengembalikan satu baris data
    }

    public function update_akun($id_login, $data) {
        $this->db->where('id_login', $id_login);
        return $this->db->update('login', $data);
    }
    
}
