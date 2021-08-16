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

	//Menampilkan Data Toko
	public function get($id_toko = null)
	{
		$this->db->select('id_toko, nama_toko, deskripsi_toko, alamat, status_toko');
		$this->db->from('toko');
		$this->db->order_by('nama_toko', 'ASC');
		if ($id_toko != null) {
			$this->db->where('id_toko', $id_toko);
			$this->db->select('foto_toko');
		}
		return $this->db->get()->result();
	}

	//Simpan Data Toko
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);

		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	//edit data toko
	public function update()
	{
		$data = array(
			"nama_toko"         => $this->input->post('nama_toko'),
			"alamat"            => $this->input->post('alamat'),
			"deskripsi_toko"    => $this->input->post('deskripsi_toko'),
			"foto_toko"         => $this->input->post('foto_toko'),
			"status_toko"       => $this->input->post('status_toko'),
		);
		return $this->db->update($this->table, $data, array('IdToko' => $this->input->post('IdToko')));
	}
}
