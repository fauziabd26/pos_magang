<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TokoModel extends CI_Model
{
	private $table = 'toko';

	//validasi form, method ini akan mengembalikan data berupa rules validasi form
	public function rules()
	{
		return [
			[
				'field' => 'nama_toko', //samakan dengan atribut name pada tags input
				'label' => 'Nama Toko', //label yang akan ditampilkan pada pesan eror
				'rules' => 'trim|required' //rules validasi
			],
			[
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'trim|required'
			],
			[
				'field' => 'deskripsi_toko',
				'label' => 'Deskripsi Toko',
				'rules' => 'trim|required'
			],
			[
				'field' => 'foto_toko',
				'label' => 'Foto Toko',
				'rules' => 'trim|required'
			],
			[
				'field' => 'status_toko',
				'label' => 'Status Toko',
				'rules' => 'trim|required'
			],
		];
	}

	//Menampilkan Data 
	public function get($id_toko = null)
	{
		$this->db->select('id_toko, nama_toko, deskripsi_toko, alamat, status_toko, nama AS "nama_owner"');
		$this->db->from('toko')->join('user', 'user.id_user=toko.id_user');
		if ($id_toko != null) {
			$this->db->where('id_toko', $id_toko);
			$this->db->select('foto_toko, email, no_hp');
		}
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
