<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Toko extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('TokoModel');
	}

	//Menampilkan Data Toko Berdasarkan ID User
	function by_id_user_get($id_user)
	{
		$toko = $this->TokoModel->by_id_user($id_user);

		$this->response(array(
			'status' => true,
			'message' => 'Data Toko Berdasarkan Id User Berhasil Diambil',
			'data' => $toko
		), 200);
	}

	//Menampilkan Data Toko Valid Berdasarkan ID User
	function by_id_user_valid_get($id_user)
	{
		$toko = $this->TokoModel->by_id_user_valid($id_user);

		$this->response(array(
			'status' => true,
			'message' => 'Data Toko Valid Berdasarkan Id User Berhasil Diambil',
			'data' => $toko
		), 200);
	}

	//Menampilkan data toko
	function index_get($id_toko = null)
	{
		if (!empty($id_toko)) {
			$toko = $this->TokoModel->get($id_toko)->row();
		} else {
			$toko =  $this->TokoModel->get()->result();
		}

		if ($toko) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Diambil',
				'data' => $toko
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Toko Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data toko pedning Terbaru
	function new_pending_get($id_toko = null)
	{
		if (!empty($id_toko)) {
			$toko = $this->TokoModel->get_new_pending($id_toko)->row();
		} else {
			$toko =  $this->TokoModel->get_new_pending()->result();
		}

		if ($toko) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Diambil',
				'data' => $toko
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Toko Tidak Ada',
			), 404);
		}
	}

	//validasi status toko
	public function valid_put($id_toko)
	{
		if (!empty($id_toko)) {
			$toko = $this->TokoModel->get($id_toko)->row();
		}

		$status = array(
			'status_toko' => 'valid'
		);

		if ($toko) {
			$this->db->where('id_toko', $id_toko);
			$this->db->update('toko', $status);
			$this->response(array(
				'status' => true,
				'message' => 'Status Toko Berhasil Diedit',
				'data' => $status
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Toko Tidak Ada',
			), 404);
		}
	}

	public function tidak_valid_put($id_toko)
	{
		if (!empty($id_toko)) {
			$toko = $this->TokoModel->get($id_toko)->row();
		}

		$status = array(
			'status_toko' => 'tidak valid'
		);

		if ($toko) {
			$this->db->where('id_toko', $id_toko);
			$this->db->update('toko', $status);
			$this->response(array(
				'status' => true,
				'message' => 'Status Toko Berhasil Diedit',
				'data' => $status
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Toko Tidak Ada',
			), 404);
		}
	}

	//Menambah data toko baru
	function index_post()
	{
		$data = array(
			'nama_toko'      => $this->post('nama_toko'),
			'alamat'         => $this->post('alamat'),
			'deskripsi_toko' => $this->post('deskripsi_toko'),
			'foto_toko'      => $this->post('foto_toko'),
			'status_toko'    => "pending",
			'id_user'        => $this->post('id_user')
		);

		if ($this->TokoModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Toko'
			), 502);
		}
	}

	//Memperbarui data toko yang telah ada
	function index_put()
	{
		$id_toko    = $this->put('id_toko');
		$data       = array(
			'nama_toko'         => $this->put('nama_toko'),
			'alamat'            => $this->put('alamat'),
			'deskripsi_toko'    => $this->put('deskripsi_toko'),
			'foto_toko'         => $this->put('foto_toko'),
			'id_user'           => $this->put('id_user')
		);

		$this->db->where('id_toko', $id_toko);
		$update = $this->db->update('toko', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Toko'
			), 502);
		}
	}

	//Menghapus salah satu data toko
	function index_delete()
	{
		$id_toko = $this->delete('id_toko');
		$this->db->where('id_toko', $id_toko);
		if ($this->db->delete('toko')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Toko'
			), 502);
		}
	}
}
