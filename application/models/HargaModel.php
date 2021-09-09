<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HargaModel extends CI_Model
{

	private $table = "harga";

	//Menampilkan Data Harga
	public function get($id_harga = null)
	{
		$this->db->select('id_harga, nama_harga, id_user');
		$this->db->from('harga');
		if ($id_harga != null) {
			$this->db->where('id_harga', $id_harga);
		}
		return $this->db->get();
	}

	public function by_id_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->select('id_harga, nama_harga');
		$this->db->from('harga');
		return $this->db->get()->result();
	}

	//Simpan data Harga
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}
	// //edit data Harga
	// public function update()
	// {
	// 	$data = array(
	// 		"nama_harga"   => $this->input->post('nama_harga'),
	// 	);
	// 	return $this->db->update($this->table, $data, array('id_harga' => $this->input->post('id_harga')));
	// }

	// public function delete($id_harga)
	// {
	// 	return $this->db->delete($this->table, array("id_harga" => $id_harga));
	// }
}
