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
}
