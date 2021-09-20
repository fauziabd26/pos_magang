<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserTokoModel extends CI_Model
{
	private $table = "user_toko";

	//Menampilkan Data 
	public function get($id_user_toko = null)
	{
		$this->db->select('id_user_toko, id_toko, id_user');
		$this->db->from('user_toko');
		if ($id_user_toko != null) {
			$this->db->where('id_user_toko', $id_user_toko);
		}
		return $this->db->get();
	}

	//Menampilkan Data 
	public function get_toko($id_toko = null)
	{
		$this->db->where('id_toko', $id_toko);
		$this->db->select('id_user_toko, id_toko, id_user');
		$this->db->from('user_toko');
		return $this->db->get()->row();
	}

	//Simpan Data 
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);

		if ($save) {
			return true;
		} else {
			return false;
		}
	}
}
