<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Harga extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('HargaModel');
	}

	//Menampilkan data harga
	function index_get($id_harga = null)
	{
		if (!empty($id_harga)) {
			$harga = $this->HargaModel->get($id_harga)->row();
		} else {
			$harga = $this->HargaModel->get()->result();
		}
		$this->response(array(
			'status'    => true,
			'message'   => 'Data Harga Berhasil Diambil',
			'data'      => $harga
		), 200);
	}

	//Menampilkan data harga sesuai ID user
	function by_id_user_get($id_harga = null)
	{
		$harga = $this->HargaModel->by_id_user($id_harga);
		$this->response(array(
			'status'    => true,
			'message'   => 'Data Harga Berdasarkan ID User Berhasil Diambil',
			'data'      => $harga
		), 200);
	}

	//Menambah data harga baru
	function index_post()
	{
		$data = array(
			'nama_harga'	=> $this->post('nama_harga'),
			'id_user'     	=> $this->post('id_user')
		);

		if ($this->HargaModel->save($data)) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Ditambah',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menambah Data Harga'
			), 502);
		}
	}

	//Memperbarui data harga yang telah ada
	function index_put()
	{
		$id_harga   = $this->put('id_harga');
		$data       = array(
			'id_harga'      => $this->put('id_harga'),
			'nama_harga'    => $this->put('nama_harga'),
			'id_user'     	=> $this->put('id_user')
		);

		$this->db->where('id_harga', $id_harga);
		$update = $this->db->update('harga', $data);

		if ($update) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Diedit',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Mengedit Dat Harga'
			), 502);
		}
	}

	//Menghapus salah satu data harga
	function index_delete()
	{
		$id_harga = $this->delete('id_harga');
		$this->db->where('id_harga', $id_harga);

		if ($this->db->delete('harga')) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Dihapus'
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menghapus Data Harga'
			), 502);
		}
	}
}
