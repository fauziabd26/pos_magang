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

	//menampilkan data toko berdasarkan id toko
	public function getById($id_toko)
	{
		return $this->db->get_where($this->table, ["IdToko" => $id_toko])->row();
		//query diatas seperti halnya query pada mysql 
		//select * from mahasiswa where IdMhsw='$id'
	}

	//menampilkan semua data toko
	public function getAll()
	{
		$this->db->from('toko');
        $this->db->order_by("id_toko", "desc");
        $query = $this->db->get();
        return $query->result();
		//fungsi diatas seperti halnya query 
		//select * from mahasiswa order by IdMhsw desc
	}

	//menyimpan data toko
	public function save()
	{
		$data = array(
			"nama_toko"         => $this->input->post('nama_toko'),
			"alamat"            => $this->input->post('alamat'),
			"deskripsi_toko"    => $this->input->post('deskripsi_toko'),
			"foto_toko"         => $this->input->post('foto_toko'),
			"status_toko"       => $this->input->post('status_toko'),
		);
		return $this->db->insert($this->table, $data);
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

	//hapus data toko
	public function delete($id_toko)
	{
		return $this->db->delete($this->table, array("IdToko" => $id_toko));
	}
}
