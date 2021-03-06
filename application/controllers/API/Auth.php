<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('AuthModel');
	}

	public function login_post()
	{
		$email     = $this->input->post('email');
		$password  = $this->input->post('password');
		// $where = array(
		//     'email' => $email,
		//     'password' => password_hash($password, PASSWORD_BCRYPT)
		// );

		$result = $this->AuthModel->getUser($email, $password);
		if ($result == true) {
			foreach ($result as $row) {
				$sess_data = array(
					'id_user'    => $row->id_user,
					'email'      => $row->email,
					'nama'       => $row->nama,
					'no_hp'      => $row->no_hp,
					'role'       => $row->role,
					// 'apikeys'    =>
				);
			}
			$this->response(array(
				'status'  => true,
				'message' => 'login success',
				'data'    => $sess_data
			), 200);
		}
	}

	public function register_post()
	{
		$data = array(
			'nama'      	=> $this->post('nama'),
			'no_hp'         => $this->post('no_hp'),
			'email' 		=> $this->post('email'),
			'password'      => password_hash($this->post('password'), PASSWORD_BCRYPT),
			'role'      	=> "owner",
		);

		if ($this->AuthModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Owner Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Owner'
			), 502);
		}
	}

	public function logout_get()
	{
		// hancurkan semua sesi
		if ($this->session->sess_destroy()) {
			$this->response(array(
				'status' => true,
				'message' => 'Berhasil Logout',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Logout',
			), 404);
		}
	}
}
