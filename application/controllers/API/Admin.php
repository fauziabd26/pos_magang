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
			'password'      => $this->post('password'),
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

	//Memperbarui data toko yang telah ada
	function index_put()
	{
		$id_toko    = $this->put('id_toko');
		$data       = array(
			'nama_toko'         => $this->put('nama_toko'),
			'alamat'            => $this->put('alamat'),
			'deskripsi_toko'    => $this->put('deskripsi_toko'),
			'foto_toko'         => $this->put('foto_toko'),
			'photo'       => $this->put('status_toko'),
			'role'           => "$this->put('id_user')"
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
