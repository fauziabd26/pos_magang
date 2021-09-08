<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		check_not_login();
		check_superadmin();
	}

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
			return $value['status_toko'] == 'valid' || $value['status_toko'] == 'tidak valid';
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
		$getAPI = $this->curl->simple_get($this->api . 'toko/' . $id_toko);
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		if ($datas['data']['id_toko'] == $id_toko) {
			$value = array(
				'id_toko' => $id_toko,
				'nama_toko' => $datas['data']['nama_toko'],
				'alamat' => $datas['data']['alamat'],
				'deskripsi_toko' => $datas['data']['deskripsi_toko'],
				'status_toko' => $datas['data']['status_toko'],
				'nama_owner' => $datas['data']['nama_owner'],
				'email' => $datas['data']['email'],
				'no_hp' => $datas['data']['no_hp'],
			);
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
		$getAPI = $this->curl->simple_get($this->api . 'toko/' . $id_toko);
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		if ($datas['data']['id_toko'] == $id_toko) {
			$value = array(
				'id_toko' => $id_toko,
				'nama_toko' => $datas['data']['nama_toko'],
				'alamat' => $datas['data']['alamat'],
				'deskripsi_toko' => $datas['data']['deskripsi_toko'],
				'status_toko' => $datas['data']['status_toko'],
				'nama_owner' => $datas['data']['nama_owner'],
				'email' => $datas['data']['email'],
				'no_hp' => $datas['data']['no_hp'],
			);
		}

		$data['toko'] = $value;

		$this->template->load('layouts/superadmin/master', 'dashboard/superadmin/validasi/detail', $data);
	}

	public function status_valid($id_toko)
	{
		$data = array(
			'id_toko' => $id_toko,
		);

		$update = $this->curl->simple_put($this->api . 'toko/valid/' . $id_toko, $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($update) {
			$this->session->set_flashdata('success', "Status Toko Sudah Valid !");
		} else {
			$this->session->set_flashdata('error', 'Status Toko Gagal Diubah !');
		}
		redirect('superadmin/validasi_toko');
	}

	public function status_tidak_valid($id_toko)
	{
		$data = array(
			'id_toko' => $id_toko,
		);

		$update = $this->curl->simple_put($this->api . 'toko/tidak_valid/' . $id_toko, $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($update) {
			$this->session->set_flashdata('success', "Status Toko Berubah Menjadi Tidak Valid !");
		} else {
			$this->session->set_flashdata('error', 'Status Toko Gagal Diubah !');
		}
		redirect('superadmin/validasi_toko');
	}
}
