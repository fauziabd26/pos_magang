<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

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
		$data = array(
			'nama' =>  ucwords($_POST['nama']),
			'email' =>  $_POST['email'],
			'password' => $_POST['password'],
			'no_hp' => $_POST['no_hp'],
		);
		$insert = $this->curl->simple_post($this->api . 'auth/register', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success', "Silahkan Login Dengan Akun Yang Anda Daftarkan");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('auth/login');
	}
}
