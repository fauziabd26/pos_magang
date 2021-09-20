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

	//Menampilkan Data Toko Berdasarkan ID User
	function by_id_user_get($id_user)
	{
		$user_toko = $this->UserTokoModel->by_id_user_toko($id_user);

		$this->response(array(
			'status' => true,
			'message' => 'Data Toko Berdasarkan Id User Berhasil Diambil',
			'data' => $user_toko
		), 200);
	}

	//Menampilkan data toko
	function index_get($id_user_toko = null)
	{
		if (!empty($id_user_toko)) {
			$user_toko = $this->UserTokoModel->get($id_user_toko)->row();
		} else {
			$user_toko =  $this->UserTokoModel->get()->result();
		}

		if ($user_toko) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Toko Berhasil Diambil',
				'data' => $user_toko
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
			'id_toko'      => $this->post('id_toko'),
			'id_user'         => $this->post('id_user')
		);

		if ($this->UserTokoModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data  Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data '
			), 502);
		}
	}

}
