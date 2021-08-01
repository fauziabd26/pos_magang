<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// Count TransaksiProduk
		$totalTransaksiProduk = 0;
		$totalTransaksiJasa = 0;

		foreach ($datas["transaksi"] as $value) {
			if ($value["jenis"] == "produk") {
				$totalTransaksiProduk += 1;
			} elseif ($value["jenis"] == "jasa") {
				$totalTransaksiJasa += 1;
			}
		}

		$data = array('transaksis' => $datas["transaksi"]);
		$data['totalTransaksiProduk'] = $totalTransaksiProduk;
		$data['totalTransaksiJasa'] = $totalTransaksiJasa;

		$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard', $data);
	}

	// Bagian Transaksi
	// Bagian Transaksi Produk
	public function transaksiProduk()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/transaksi/produk');
	}

	// Bagian Transaksi Jasa
	public function transaksiJasa()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/transaksi/jasa');
	}

	// Bagian Histori
	public function historiTransaksi()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('historis' => $datas["transaksi"]);

		$this->template->load('layouts/admin/master', 'dashboard/admin/historiTransaksi/index', $data);
	}

	public function historiTransaksiDetail($id)
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// $data = array('historis' => $datas["transaksi"]);
		foreach ($datas['transaksi'] as $row) {
			if ($row['id'] == $id) {
				$value = array(
					'id' => $row['id'],
					'jenis' => $row['jenis'],
					'nama_customer' => $row['nama_customer'],
					'total_transaksi' => $row['total_transaksi'],
					'tgl_transaksi' => $row['tgl_transaksi'],
				);
			}
		}

		$data['histori'] = $value;

		$this->template->load('layouts/admin/master', 'dashboard/admin/historiTransaksi/detail', $data);
	}
}
