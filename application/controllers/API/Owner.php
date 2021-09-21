<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Owner extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('OwnerModel');
	}

	//Menampilkan data 
	function index_get($id_owner = null)
	{
		if (!empty($id_owner)) {
			$owner = $this->OwnerModel->get($id_owner)->row();
		} else {
			$owner =  $this->OwnerModel->get()->result();
		}
		$this->response(array(
			'status' => true,
			'message' => 'Data Owner Berhasil Diambil',
			'data' => $owner
		), 200);
	}
}
