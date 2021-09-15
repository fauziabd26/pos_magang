<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	public function login()
	{
		check_login();
		$this->load->view('login');
	}

	public function proses_login()
	{
		$data = array(
			'email' =>  $_POST['email'],
			'password' =>  $_POST['password'],
		);
		$cek = $this->curl->simple_post($this->api . 'auth/login', $data, array(CURLOPT_BUFFERSIZE => 10));
		$datas = json_decode($cek, true);
		$data = array(
			'id_user' 	=> $datas['data']['id_user'],
			'id_toko' 	=> $datas['data']['id_toko'],
			'nama' 		=> $datas['data']['nama'],
			'email' 	=> $datas['data']['email'],
			'no_hp' 	=> $datas['data']['no_hp'],
			'role' 		=> $datas['data']['role'],
		);
		if ($datas['data']['role'] == "superadmin") {
			$this->session->set_userdata($data);
			redirect('superadmin/dashboard');
		} elseif ($datas['data']['role'] == "owner") {
			$this->session->set_userdata($data);
			redirect('owner/dashboard');
		} elseif ($datas['data']['role'] == "admin") {
			$this->session->set_userdata($data);
			redirect('admin/dashboard');
		} else {
			$this->session->set_flashdata('error', "Email atau Password Yang Anda Masukan Salah !");
			redirect('auth/login');
		}
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
			$this->session->set_flashdata('error', 'data gagal disimpan.');
		}
		redirect('auth/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', "Berhasil Logout");
		redirect('auth/login');
	}
}
