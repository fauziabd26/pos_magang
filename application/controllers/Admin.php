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
		$getAPIBarang = $this->curl->simple_get($this->api . 'produk/barang');
		$datasBarang = json_decode($getAPIBarang, true);

		$getAPIKategori = $this->curl->simple_get($this->api . 'kategori');
		$datasKategori = json_decode($getAPIKategori, true);

		$data['produks'] = $datasBarang['data'];
		$data['kategories'] = $datasKategori['data'];

		$this->load->view('dashboard/admin/transaksi/barang', $data);
	}

	// Bagian Transaksi Jasa
	public function transaksi_jasa()
	{
		$getAPIJasa = $this->curl->simple_get($this->api . 'produk/jasa');
		$datasJasa = json_decode($getAPIJasa, true);

		$getAPIKategori = $this->curl->simple_get($this->api . 'kategori');
		$datasKategori = json_decode($getAPIKategori, true);

		$data['produks'] = $datasJasa['data'];
		$data['kategories'] = $datasKategori['data'];

		$this->load->view('dashboard/admin/transaksi/jasa', $data);
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
