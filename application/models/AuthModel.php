<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	private $table = 'user';

	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);

		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	public function getUser($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		if ($query->num_rows() == 1) {
			$hash = $query->row('password');
			if (password_verify($password, $hash)) {
				return $query->result();
			} else {
				echo "password salah";
			}
		} else {
			echo "akun tidak ada";
		}
	}
}
