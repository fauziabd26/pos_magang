<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		// Count Data Toko Valid && Tidak Valid
		$totalPending = 0;
		$totalValid = 0;
		$totalTidakValid = 0;
		foreach ($datas["data"] as $value) {
			if ($value["status_toko"] == "valid") {
				$totalValid += 1;
			} elseif ($value["status_toko"] == "pending") {
				$totalPending += 1;
			} else {
				$totalTidakValid += 1;
			}
		}
		// var_dump($datas);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "pending";
		});
		$data['totalValid'] = $totalValid; //Object
		$data['totalPending'] = $totalPending; //Object
		$data['totalTidakValid'] = $totalTidakValid; //Object

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/dashboard', $data);
	}

	// Bagian Toko
	public function toko()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "valid";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/index', $data);
	}

	public function toko_edit($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/edit', $data);
	}

	public function toko_detail($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/toko/detail', $data);
	}

	// Bagian Validasi
	public function validasi_toko()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		$data['data'] = array_filter($datas['data'], function ($value) {
			return $value['status_toko'] == "pending";
		});

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/index', $data);
	}

	public function validasi_detail($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
				$value = array(
					'nama_toko' => $row['nama_toko'],
					'alamat' => $row['alamat'],
					'deskripsi_toko' => $row['deskripsi_toko'],
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/detail', $data);
	}
}
