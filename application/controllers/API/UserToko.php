<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class UserToko extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('UserTokoModel');
	}

	function get_toko_get($id_toko)
	{
		$toko = $this->UserTokoModel->get_toko($id_toko);
		if ($toko) {
			$this->response(array(
				'status' => true,
				'message' => 'Data User Toko Berdasarkan Toko Berhasil Diambil',
				'data' => $toko
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data User Toko Berdasarkan Toko Tidak Ada',
			), 404);
		}
	}

	//Menambah data toko baru
	function index_post()
	{
		$data = array(
			'id_toko'      => $this->post('id_toko'),
			'id_user'      => $this->post('id_user')
		);

		if ($this->UserTokoModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data '
			), 502);
		}
	}

	function index_put()
	{
		$id_user    = $this->put('id_user');
		$data       = array(
			'id_toko'          => $this->put('id_toko')
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
}
