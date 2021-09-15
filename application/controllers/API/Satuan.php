<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Satuan extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('SatuanModel');
	}

	//Menampilkan data satuan
	function index_get($id_satuan = null)
	{
		if (!empty($id_satuan)) {
			$satuan = $this->SatuanModel->get($id_satuan)->row();
		} else {
			$satuan = $this->SatuanModel->get()->result();
		}
		$this->response(array(
			'status'    => true,
			'message'   => 'Data Satuan Berhasil Diambil',
			'data'      => $satuan
		), 200);
	}

	//Menampilkan data satuan berdasarkan ID User
	function by_id_user_get($id_user)
	{
		$satuan = $this->SatuanModel->by_id_user($id_user);
		$this->response(array(
			'status'    => true,
			'message'   => 'Data Satuan Berhasil Diambil',
			'data'      => $satuan
		), 200);
	}

	//Menambah data satuan baru
	function index_post()
	{
		$data = array(
			'nama_satuan'   => $this->post('nama_satuan'),
			'id_user'		=> $this->post('id_user'),
		);

		if ($this->SatuanModel->save($data)) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Satuan Berhasil Diambil',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menambahkan Data Satuan'
			), 502);
		}
	}

	//Memperbarui data satuan yang telah ada
	function index_put()
	{
		$id_satuan  = $this->put('id_satuan');
		$data       = array(
			'id_satuan'         => $this->put('id_satuan'),
			'nama_satuan'       => $this->put('nama_satuan'),
			'id_user'			=> $this->put('id_user'),
		);

		$this->db->where('id_satuan', $id_satuan);
		$update = $this->db->update('satuan', $data);
		if ($update) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Satuan Berhasil Diambil',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Mengedit Data Satuan'
			), 502);
		}
	}

	//Menghapus salah satu data toko
	function index_delete()
	{
		$id_satuan = $this->delete('id_satuan');
		$this->db->where('id_satuan', $id_satuan);

		if ($this->db->delete('satuan')) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Satuan Berhasil Dihapus'
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menghapus Data Satuan'
			), 502);
		}
	}
}
