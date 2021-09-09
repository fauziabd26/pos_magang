<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TokoModel extends CI_Model
{
	private $table = 'toko';

	public function by_id_user($id_user)
	{
		$this->db->where('toko.id_user', $id_user);
		$this->db->select('id_toko, nama_toko, deskripsi_toko, alamat, status_toko, toko.id_user, user.nama AS nama_owner');
		$this->db->from('toko')->join('user', 'user.id_user=toko.id_user');
		return $this->db->get()->result();
	}

	public function by_id_user_valid($id_user)
	{
		$this->db->where('toko.id_user', $id_user);
		$this->db->where('status_toko =', 'valid');
		$this->db->select('id_toko, nama_toko, deskripsi_toko, alamat, status_toko, toko.id_user, user.nama AS nama_owner');
		$this->db->from('toko')->join('user', 'user.id_user=toko.id_user');
		return $this->db->get()->result();
	}

	//Menampilkan Data 
	public function get($id_toko = null)
	{
		$this->db->select('id_toko, nama_toko, deskripsi_toko, alamat, status_toko, toko.id_user, user.nama AS nama_owner');
		$this->db->from('toko')->join('user', 'user.id_user=toko.id_user');

		if ($id_toko != null) {
			$this->db->where('id_toko', $id_toko);
			$this->db->select('foto_toko, nama AS nama_owner, email, no_hp');
		}
		return $this->db->get();
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

	//edit data 
	public function update($table, $data)
	{
		$update = $this->db->update($table, $data);

		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}
