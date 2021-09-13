<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Admin extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('AdminModel');
	}


	function cek_email_get($id_admin = null)
	{
		if (!empty($id_admin)) {
			$this->response($this->AdminModel->get($id_admin)->row(), 200);
		} else {
			$this->response($this->AdminModel->get()->result(), 200);
		}
	}

	//Menampilkan data 
	function index_get($id_admin = null)
	{
		if (!empty($id_admin)) {
			$data = $this->AdminModel->get($id_admin)->row();
		} else {
			$data =  $this->AdminModel->get()->result();
		}

		if ($data) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berhasil Diambil',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Admin Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data 
	function by_id_user_get($id_user)
	{
		$data = $this->AdminModel->by_id_user($id_user);
		if ($data) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berdasarkan ID User Berhasil Diambil',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Admin Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data berdasrkan toko milik owner
	public function by_admin_toko_get($id_owner, $id_admin = null)
	{
		if (!empty($id_admin)) {
			$data = $this->AdminModel->by_admin_toko($id_owner, $id_admin)->row();
		} else {
			$data = $this->AdminModel->by_admin_toko($id_owner)->result();
		}

		if ($data) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berdasarkan Toko Milik Owner Berhasil Diambil',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Admin Tidak Ada',
			), 404);
		}
	}


	//Menambah data  baru
	function index_post()
	{
		$data = array(
			'nama'          => $this->post('nama'),
			'email'         => $this->post('email'),
			'password'      => password_hash($this->post('password'), PASSWORD_BCRYPT),
			'no_hp'         => $this->post('no_hp'),
			'photo'         => $this->post('photo'),
			'role'          => "admin"
		);

		if ($this->AdminModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Admin'
			), 502);
		}
	}

	//Memperbarui data Admin yang telah ada
	function index_put()
	{
		$id_user    = $this->put('id_user');
		$data       = array(
			'nama'          => $this->put('nama'),
			'email'         => $this->put('email'),
			'no_hp'         => $this->put('no_hp'),
			'role'          => "admin"
		);

		$this->db->where('id_user', $id_user);
		$update = $this->db->update('user', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Admin'
			), 502);
		}
	}

	//Menghapus salah satu data admin
	function index_delete()
	{
		$id_user = $this->delete('id_user');
		$this->db->where('id_user', $id_user);
		if ($this->db->delete('user')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Admin Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Admin'
			), 502);
		}
	}
}
