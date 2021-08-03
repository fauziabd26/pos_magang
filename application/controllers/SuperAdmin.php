<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// Count Data Owner
		$totalOwner = 0;
		foreach ($datas["user"] as $row) {
			if ($row['id_user'] == 2) {
				$totalOwner += 1;
			}
		}

		// Count Data Owner Valid && Tidak Valid
		$totalValid = 0;
		$totalPending = 0;
		foreach ($datas["toko"] as $value) {
			if ($value["status_toko"] == "valid") {
				$totalValid += 1;
			} else {
				$totalPending += 1;
			}
		}

		$data['owners'] = array_filter($datas['toko'], function ($value) {
			return $value['status_toko'] == "tidak valid";
		});
		$data['totalOwner'] = $totalOwner; //Object
		$data['totalValid'] = $totalValid; //Object
		$data['totalPending'] = $totalPending; //Object

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/dashboard', $data);
	}

	// Bagian Owner
	public function owner()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data['owners'] = array_filter($datas['toko'], function ($value) {
			return $value['status_toko'] == "valid";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/owner/index', $data);
	}

	public function owner_edit($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id_toko'] == $id) {
				$user = array(
					'nama' => $row["user"]["nama"],
					'email' => $row["user"]["email"],
					'alamat' => $row["user"]["alamat"],
					'no_hp' => $row["user"]["no_hp"],
				);
				$value = array(
					'id_toko' => $row['id_toko'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/owner/edit', $data);
	}

	public function owner_detail($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id_toko'] == $id) {
				$user = array(
					'nama' => $row["user"]["nama"],
					'email' => $row["user"]["email"],
					'alamat' => $row["user"]["alamat"],
					'no_hp' => $row["user"]["no_hp"],
				);
				$value = array(
					'id_toko' => $row['id_toko'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/owner/detail', $data);
	}

	// Bagian Validasi
	public function validasi_owner()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data['owners'] = array_filter($datas['toko'], function ($value) {
			return $value['status_toko'] == "tidak valid";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/index', $data);
	}

	public function validasi_detail($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id_toko'] == $id) {
				$user = array(
					'nama' => $row["user"]["nama"],
					'email' => $row["user"]["email"],
					'alamat' => $row["user"]["alamat"],
					'no_hp' => $row["user"]["no_hp"],
				);
				$value = array(
					'id_toko' => $row['id_toko'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/detail', $data);
	}
}
