<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	// Fungsi untuk login
	public function login($email, $password) {
		// Query untuk mencari user berdasarkan email
		$this->db->where('email', $email);
		$query=$this->db->get('login');

		if ($query->num_rows()==1) {
			$user=$query->row();

			// Verifikasi password yang di-hash
			if (password_verify($password, $user->password)) {
				return $user;
			}
		}

		return false; // Jika login gagal
	}

	// Fungsi untuk register user
    public function register_user($data) {
        // Insert data ke tabel login
        return $this->db->insert('login', $data);
    }
}
