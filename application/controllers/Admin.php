<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		check_not_login();
		check_admin();
	}

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi');
		$datas = json_decode($getAPI, true);

		// var_dump($datas['data']);
		// Count TransaksiProduk
		$totalTransaksiProduk = 0;
		$totalTransaksiJasa = 0;

		foreach ($datas["data"] as $value) {
			if ($value['id_user'] == $this->session->userdata('id_user')) {
				if ($value["jenis_transaksi"] == "barang") {
					$totalTransaksiProduk += 1;
				} elseif ($value["jenis_transaksi"] == "jasa") {
					$totalTransaksiJasa += 1;
				}
			}
		}

		$data['totalTransaksiProduk'] = $totalTransaksiProduk;
		$data['totalTransaksiJasa'] = $totalTransaksiJasa;
		$data['transaksis'] = array_filter($datas['data'], function ($value) {
			return $value['id_user'] == $this->session->userdata('id_user');
		});

		$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard', $data);
	}

	// Bagian Transaksi
	// Bagian Transaksi Barang
	public function transaksi_barang()
	{
		$getAPI = $this->curl->simple_get($this->api . 'harga');
		$datas = json_decode($getAPI, true);

		$data['produks'] = array_filter($datas['data'], function ($value) {
			return $value['jenis'] == 'barang';
		});

		$this->load->view('dashboard/admin/transaksi/barang', $data);
	}

	public function proses_tambah_transaksi_barang($id_harga)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');

		$getAPI = $this->curl->simple_get($this->api . 'harga/' . $id_harga);
		$datas = json_decode($getAPI, true);

		if ($datas['data']['id_harga'] == $id_harga) {
			$value = array(
				'id_produk' => $datas['data']["id_produk"],
				'nama_produk' => $datas['data']["nama_produk"],
				'nominal' => $datas['data']["nominal"],
			);
		}

		// $getAPITransaksi = $this->curl->simple_get($this->api . 'transaksi/barang');
		// $datasTransaksi = json_decode($getAPITransaksi, true);
		// foreach ($datasTransaksi["data"] as $value) {
		// 	$value= array(
		// 		'id_user' 	=> $this->session->userdata('id_user'),
		// 		'status' 	=> 0,
		// 	);
		// }

		// foreach ($datasTransaksi['data'] as $row) {
		// 	if ($row['id_user'] == $this->session->userdata('id_user') && $row['status'] == 0) {
		// 		echo 't';
		// 	}
		// }

		$dataTransaksi = array(
			'id_user'			=> $this->session->userdata('id_user'),
			'total_transaksi'   => 0,
			'status'   			=> 0,
			'tggl_transaksi'	=> $now,
		);
		$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_transaksi', $dataTransaksi, array(CURLOPT_BUFFERSIZE => 10));

		$id_transaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$data = json_decode($id_transaksi, true);

		$dataDetailTransaksi = array(
			'id_transaksi'		=> $data['id_transaksi'],
			'id_harga'			=> $id_harga,
			'qty'   			=> 1,
			'sub_total'   		=> $value['nominal'] * 1,
		);

		$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_detail_transaksi', $dataDetailTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_barang');
	}

	// Bagian Transaksi Jasa
	public function transaksi_jasa()
	{
		$getAPI = $this->curl->simple_get($this->api . 'harga');
		$datas = json_decode($getAPI, true);

		$data['produks'] = array_filter($datas['data'], function ($value) {
			return $value['jenis'] == 'jasa';
		});

		$this->load->view('dashboard/admin/transaksi/jasa', $data);
	}

	public function tambah_transaksi_jasa($id_harga)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');

		$getAPI = $this->curl->simple_get($this->api . 'harga/' . $id_harga);
		$datas = json_decode($getAPI, true);

		if ($datas['data']['id_harga'] == $id_harga) {
			$value = array(
				'id_produk' => $datas['data']["id_produk"],
				'nama_produk' => $datas['data']["nama_produk"],
				'nominal' => $datas['data']["nominal"],
			);
		}

		// $getAPITransaksi = $this->curl->simple_get($this->api . 'transaksi/barang');
		// $datasTransaksi = json_decode($getAPITransaksi, true);
		// foreach ($datasTransaksi["data"] as $value) {
		// 	$value= array(
		// 		'id_user' 	=> $this->session->userdata('id_user'),
		// 		'status' 	=> 0,
		// 	);
		// }

		// foreach ($datasTransaksi['data'] as $row) {
		// 	if ($row['id_user'] == $this->session->userdata('id_user') && $row['status'] == 0) {
		// 		echo 't';
		// 	}
		// }

		$dataTransaksi = array(
			'id_user'			=> $this->session->userdata('id_user'),
			'total_transaksi'   => 0,
			'status'   			=> 0,
			'tggl_transaksi'	=> $now,
		);
		$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_transaksi_jasa', $dataTransaksi, array(CURLOPT_BUFFERSIZE => 10));

		$id_transaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$data = json_decode($id_transaksi, true);

		$dataDetailTransaksi = array(
			'id_transaksi'		=> $data['id_transaksi'],
			'id_harga'			=> $id_harga,
			'qty'   			=> 1,
			'sub_total'   		=> $value['nominal'] * 1,
		);

		$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_detail_transaksi', $dataDetailTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_jasa');
	}

	// Bagian Histori
	public function histori_transaksi()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi');
		$datas = json_decode($getAPI, true);

		$data['transaksis'] = array_filter($datas['data'], function ($value) {
			return $value['id_user'] == $this->session->userdata('id_user');
		});

		$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/index', $data);
	}

	public function histori_transaksi_detail($id)
	{
		$getAPI = file_get_contents('json/transaksi/transaksi.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['transaksi'] as $row) {
			if ($row['id_transaksi'] == $id) {
				$value = array(
					'id_transaksi' => $row['id_transaksi'],
					'jenis' => $row['jenis'],
					'nama_customer' => $row['nama_customer'],
					'total_transaksi' => $row['total_transaksi'],
					'tgl_transaksi' => $row['tgl_transaksi'],
				);
			}
		}

		$data['transaksi'] = $value;

		$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/detail', $data);
	}
}
