<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('transaksis' => $datas["transaksi"]);
		$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard', $data);
	}

	public function profile()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/profile');
	}

	// Bagian Admin
	public function admin()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data['admins'] = array_filter($datas['user'], function ($row) {
			foreach ($row['role'] as $value) {
				return $value['id'] == 3;
			}
		});

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function adminTambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function adminEdit($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		foreach ($datas['user'] as $row) {
			if ($row['id'] == $id) {
				$value = array(
					'nama' => $row["nama"],
					'email' => $row["email"],
					'alamat' => $row["alamat"],
					'no_hp' => $row["no_hp"],
				);
			}
		}

		$data['admin'] = $value;

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/edit', $data);
	}

	public function adminUbahPassword()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubahPassword');
	}

	// Bagian Produk

	// Bagian Foto Produk

	//Bagian Harga

	//Bagian Kategori

	//Bagian Satuan

	//Bagian Laporan
}
