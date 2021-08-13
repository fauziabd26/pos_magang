<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('json//transaksi/transaksi.json');
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
	public function transaksi_produk()
	{
		$this->load->view('dashboard/admin/transaksi/produk');
	}

	// Bagian Transaksi Jasa
	public function transaksi_jasa()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/transaksi/jasa');
	}

	// Bagian Histori
	public function histori_transaksi()
	{
		$getAPI = file_get_contents('json/transaksi/transaksi.json');
		$datas = json_decode($getAPI, true);

		$data = array('transaksis' => $datas["transaksi"]);

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
