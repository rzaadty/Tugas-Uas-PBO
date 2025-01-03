<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function get_all_menu() {
        return $this->db->get('menu')->result_array();
    }

    public function get_menu_by_id($id_menu) {
        return $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();
    }

    public function insert_menu($data) {
        return $this->db->insert('menu', $data); 
    }

    public function update_menu($id_menu, $data) {
        $this->db->where('id_menu', $id_menu);
        return $this->db->update('menu', $data); 
    }

    public function delete_menu($id_menu) {
        $this->db->where('id_menu', $id_menu);
        return $this->db->delete('menu'); 
    }

    public function get_all_kategori() {
        $query = $this->db->get('kategori');
        return $query->result_array();
    }
    
}
