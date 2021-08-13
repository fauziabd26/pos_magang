<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		// Count Data Toko Valid && Tidak Valid
		$totalValid = 0;
		$totalPending = 0;
		foreach ($datas["data"] as $value) {
			if ($value["status_toko"] == "valid") {
				$totalValid += 1;
			} else {
				$totalPending += 1;
			}
		}
		// var_dump($datas);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "tidak valid";
		});
		$data['totalValid'] = $totalValid; //Object
		$data['totalPending'] = $totalPending; //Object

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/dashboard', $data);
	}

	// Bagian Toko
	public function toko()
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "valid";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/index', $data);
	}

	public function toko_edit($id)
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => array(
						'nama' => $row["user"]["nama"],
						'email' => $row["user"]["email"],
						'no_hp' => $row["user"]["no_hp"],
					)
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/edit', $data);
	}

	public function toko_detail($id)
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => array(
						'nama' => $row["user"]["nama"],
						'email' => $row["user"]["email"],
						'no_hp' => $row["user"]["no_hp"],
					)
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/detail', $data);
	}

	// Bagian Validasi
	public function validasi_toko()
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "tidak valid";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/index', $data);
	}

	public function validasi_detail($id)
	{
		$getAPI = file_get_contents('json/superadmin/toko/read.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
					'user' => array(
						'nama' => $row["user"]["nama"],
						'email' => $row["user"]["email"],
						'no_hp' => $row["user"]["no_hp"],
					)
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/detail', $data);
	}
}
