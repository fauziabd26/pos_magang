<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard');
	}

	public function profile()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/profile');
	}

	// Bagian Admin
	public function admin()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index');
	}

	public function adminTambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function adminEdit()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/edit');
	}

	public function adminUbahPassword()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubahPassword');
	}

	// Bagian Produk
	public function produk()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/produk/index');
	}

	// Bagian Foto Produk

	//Bagian Harga

	//Bagian Kategori

	//Bagian Satuan

	//Bagian Laporan
}
