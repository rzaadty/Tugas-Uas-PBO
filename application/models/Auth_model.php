<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login_warga($username, $password) {
		$this->db->where('Username', $username);
		$query=$this->db->get('warga');

		if ($query->num_rows()==1) {
			$user=$query->row();

			if (password_verify($password, $user->Password)) {
				return $user; 
			}
		}

		return false; 
	}

	public function login_aparatur($username, $password) {
		$this->db->where('Username', $username);
		$query=$this->db->get('aparatur_desa');

		if ($query->num_rows()==1) {
			$user=$query->row();

			if (password_verify($password, $user->Password)) {
				return $user; 
			}
		}

		return false; 
	}

	public function register($data) {
		return $this->db->insert('Data_Warga', $data);
	}
    
}
