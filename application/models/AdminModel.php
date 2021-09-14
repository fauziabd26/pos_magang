<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	private $table = 'user';

	//Menampilkan Data Admin
	public function get_admin($id_admin)
	{
		$this->db->where('user_toko.id_user', $id_admin);
		$this->db->select('user_toko.id_user_toko, user.id_user, user.nama, user.email');
		$this->db->from('user_toko')->join('user', 'user_toko.id_user = user.id_user');
		return $this->db->get()->row();
	}

	//Menampilkan Data Admin
	public function get($id_user = null)
	{
		$this->db->select('id_user, nama, email, no_hp, photo, role');
		$this->db->from('user');
		$this->db->where('role =', 'admin');
		if ($id_user != null) {
			$this->db->where('id_user', $id_user);
		}
		return $this->db->get();
	}

	//Menampilkan Data Admin Berdasarkan ID User
	public function by_id_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->select('id_user, nama, email, no_hp, photo, role');
		$this->db->from('user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Admin Berdasarkan Toko Yang Dimiliki Owner
	public function by_admin_toko($id_owner, $id_admin = null)
	{
		$this->db->where('toko.id_user', $id_owner);
		$this->db->select('user.id_user, user.nama, user.email, user.no_hp, toko.id_toko, toko.nama_toko, toko.id_user as id_owner, nama as nama_owner');
		$this->db->from('user_toko as ut')
			->join('user', 'ut.id_user = user.id_user')
			->join('toko', 'ut.id_toko = toko.id_toko');
		if ($id_admin != null) {
			$this->db->where('user.id_user', $id_admin);
			$this->db->select('user.photo');
		}
		return $this->db->get();
	}

	//Simpan Data Admin
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
