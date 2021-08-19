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

	//Menampilkan data 
	function index_get($id_user = null)
	{
		if (!empty($id_user)) {
			$admin = $this->AdminModel->get($id_user);
		} else {
			$admin =  $this->AdminModel->get();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Toko Berhasil Diambil',
			'data' => $admin
		), 200);
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

	//Memperbarui data yang telah ada
	function index_put()
	{
		$id_user    = $this->put('id_user');
		$data       = array(
			'nama'         => $this->put('nama'),
			'email'        => $this->put('email'),
			// 'password'     => $this->put('password'),
			'photo'        => $this->put('photo'),
			'role'         => $this->put('role')
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

	//Menghapus salah satu data 
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
