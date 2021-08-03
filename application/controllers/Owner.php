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
			return $row['id_user'] == 3;
		});

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function admin_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function admin_edit($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		foreach ($datas['user'] as $row) {
			if ($row['id_user'] == $id) {
				$value = array(
					'id_user' => $row["id_user"],
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

	public function admin_ubah_password($id)
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubah_password');
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
