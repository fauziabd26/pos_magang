<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
	private $table = 'kategori';

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
	public function get($id_kategori = null)
	{
		$this->db->select('id_kategori, nama_kategori, id_toko');
		$this->db->from('kategori');
		$this->db->order_by('nama_kategori', 'ASC');
		if ($id_kategori != null) {
			$this->db->where('id_kategori', $id_kategori);
			$this->db->select('id_toko');
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
	public function update()
	{
		$data = array(
			"nama_kategori"         => $this->input->post('nama_kategori'),
			"id_toko"            => $this->input->post('id_toko')
		);
		return $this->db->update($this->table, $data, array('id_kategori' => $this->input->post('id_kategori')));
	}
}
