<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// Count Data Owner
		$totalOwner = 0;
		foreach ($datas["user"] as $row) {
			foreach ($row["role"] as $value) {
				if ($value['id'] == 2) {
					$totalOwner += 1;
				}
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

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/dashboard', $data);
	}

	// Bagian Owner
	public function owner()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data['owners'] = array_filter($datas['toko'], function ($value) {
			return $value['status_toko'] == "valid";
		});

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/index', $data);
	}

	public function ownerEdit($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id'] == $id) {
				$user = array(
					'nama' => $row["user"][0]["nama"],
					'email' => $row["user"][0]["email"],
					'alamat' => $row["user"][0]["alamat"],
					'no_hp' => $row["user"][0]["no_hp"],
				);
				$value = array(
					'id' => $row['id'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/edit', $data);
	}

	public function ownerDetail($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id'] == $id) {
				$user = array(
					'nama' => $row["user"][0]["nama"],
					'email' => $row["user"][0]["email"],
					'alamat' => $row["user"][0]["alamat"],
					'no_hp' => $row["user"][0]["no_hp"],
				);
				$value = array(
					'id' => $row['id'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/detail', $data);
	}

	// Bagian Validasi
	public function validasiOwner()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data['owners'] = array_filter($datas['toko'], function ($value) {
			return $value['status_toko'] == "tidak valid";
		});

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/index', $data);
	}

	public function validasiDetail($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['toko'] as $row) {
			if ($row['id'] == $id) {
				$user = array(
					'nama' => $row["user"][0]["nama"],
					'email' => $row["user"][0]["email"],
					'alamat' => $row["user"][0]["alamat"],
					'no_hp' => $row["user"][0]["no_hp"],
				);
				$value = array(
					'id' => $row['id'],
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => $user
				);
			}
		}

		$data['owner'] = $value;

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/detail', $data);
	}
}
