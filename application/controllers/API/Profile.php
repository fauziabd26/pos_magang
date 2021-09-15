<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Profile extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('AdminModel');
	}

	//Menampilkan data user
	function index_get($id_user)
	{
		$user =  $this->AdminModel->by_id_user($id_user);
		$this->response(array(
			'status' => true,
			'message' => 'Data User Berhasil Diambil',
			'data' => $user
		), 200);
	}

	function index_put()
	{
		$id_user    = $this->put('id_user');
		$data       = array(
			'nama'          => $this->put('nama'),
			'email'         => $this->put('email'),
			'no_hp'         => $this->put('no_hp'),
			// 'photo'         => $this->put('photo'),
		);

		$this->db->where('id_user', $id_user);
		$update = $this->db->update('user', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data User Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data User'
			), 502);
		}
	}
}
