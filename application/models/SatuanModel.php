<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SatuanModel extends CI_Model
{
	private $table = "satuan";

	//Menampilkan Data Satuan
	public function get($id_satuan = null)
	{
		$this->db->select('id_satuan, nama_satuan, id_user');
		$this->db->from('satuan');
		if ($id_satuan != null) {
			$this->db->where('id_satuan', $id_satuan);
		}
		return $this->db->get();
	}

	//Menampilkan Data Satuan
	public function by_id_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->select('id_satuan, nama_satuan');
		$this->db->from('satuan');
		return $this->db->get()->result();
	}

	//Simpan data satuan
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	// //edit data satuan
	// public function update(){
	//     $data = array(
	//         "nama_satuan"   => $this->input->post('nama_satuan'),
	//     );
	//     return $this->db->update($this->table, $data, array('id_satuan' => $this->input->post('id_satuan')));
	// }

	// //hapus data mahasiswa
	// public function delete($id_satuan)
	// {
	//     return $this->db->delete($this->table, array("id_satuan" => $id_satuan));
	// }
}
