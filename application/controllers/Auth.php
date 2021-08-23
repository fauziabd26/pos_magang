<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		$this->load->view('login');
	}

	public function proses_login()
	{
	}

	public function register()
	{
		$this->load->view('register');
	}

	public function proses_register()
	{
		$postdata = http_build_query(
			array(
				'nama' =>  ucwords($_POST['nama']),
				'email' =>  $_POST['email'],
				'password' => $_POST['password'],
				'no_hp' => $_POST['no_hp']
			)
		);

		$opts = array(
			'http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		file_get_contents('https://api.etoko.xyz/register', false, $context);

		$this->session->set_flashdata('success-create', "Data <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");

		redirect('auth/login');
	}
}
