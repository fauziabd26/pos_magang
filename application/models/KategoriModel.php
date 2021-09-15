<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
	private $table = 'kategori';

	//Menampilkan Data 
	public function get($id_kategori = null)
	{
		$this->db->select('id_kategori, nama_kategori, id_user');
		$this->db->from('kategori');
		if ($id_kategori != null) {
			$this->db->where('id_kategori', $id_kategori);
		}
		return $this->db->get();
	}

	//Menampilkan Data Berdasrkan ID User
	public function by_id_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->select('id_kategori, nama_kategori');
		$this->db->from('kategori');
		return $this->db->get()->result();
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

	// //edit data 
	// public function update()
	// {
	// 	$data = array(
	// 		"nama_kategori"         => $this->input->post('nama_kategori'),
	// 		"id_toko"            => $this->input->post('id_toko')
	// 	);
	// 	return $this->db->update($this->table, $data, array('id_kategori' => $this->input->post('id_kategori')));
	// }
}
