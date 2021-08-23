<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('json/admin/transaksi/read.json');
		$datas = json_decode($getAPI, true);

		// Count TransaksiProduk
		$totalTransaksiProduk = 0;
		$totalTransaksiJasa = 0;

		foreach ($datas["data"] as $value) {
			if ($value["jenis"] == "produk") {
				$totalTransaksiProduk += 1;
			} elseif ($value["jenis"] == "jasa") {
				$totalTransaksiJasa += 1;
			}
		}

		$data = array('transaksis' => $datas["data"]);
		$data['totalTransaksiProduk'] = $totalTransaksiProduk;
		$data['totalTransaksiJasa'] = $totalTransaksiJasa;

		$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard', $data);
	}

	public function profile()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/profile');
	}

	// Bagian Admin
	public function admin()
	{
		$getAPI = file_get_contents('json/owner/admin/read.json');
		$datas = json_decode($getAPI, true);

		$data['admins'] = array_filter($datas['data'], function ($row) {
			return $row['id_role'] == 3;
		});

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function admin_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function admin_edit($id)
	{
		$getAPI = file_get_contents('json/owner/admin/read.json');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_user'] == $id) {
				$value = array(
					'id_user' => $row["id_user"],
					'nama' => $row["nama"],
					'email' => $row["email"],
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

	// Bagian Toko
	public function toko()
	{
		$getAPI = file_get_contents('https://api.etoko.xyz/toko');
		$datas = json_decode($getAPI, true);

		$data['tokos'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
	}

	public function toko_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
	}

	public function toko_edit($id)
	{
		$getAPI = file_get_contents('https://api.etoko.xyz/toko');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id) {
				$value = array(
					'id_toko' => $row["id_toko"],
					'nama_toko' => $row["nama_toko"],
					'deskripsi_toko' => $row["deskripsi_toko"],
					'alamat' => $row["alamat"],
					'status_toko' => $row["status_toko"],
				);
			}
		}

		$data['toko'] = $value;

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/edit', $data);
	}

	// Bagian Produk
	public function produk()
	{
		$getAPI = file_get_contents('http://api.etoko.xyz/produk');
		$datas = json_decode($getAPI, true);

		$data['produks'] = $datas;

		$this->template->load('layouts/owner/master', 'dashboard/owner/produk/index', $data);
	}
	// Bagian Jasa
	public function index_jasa()
	{
		$getAPI = file_get_contents('json/owner/jasa/read.json');
		$datas = json_decode($getAPI, true);

		$data = array('jasas' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/index', $data);
	}

	// Bagian Foto Produk

	//Bagian Harga
	public function index_harga()
	{
		$getAPI = file_get_contents('json/owner/harga/read.json');
		$datas = json_decode($getAPI, true);

		$data = array('hargas' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/index', $data);
	}

	//Bagian Kategori
	public function index_kategori()
	{
		$getAPI = file_get_contents('json/owner/kategori/read.json');
		$datas = json_decode($getAPI, true);

		$data = array('kategories' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/kategori/index', $data);
	}

	//Bagian Satuan
	public function index_satuan()
	{
		$getAPI = file_get_contents('json/owner/satuan/read.json');
		$datas = json_decode($getAPI, true);

		$data['satuans'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/index', $data);
	}

	//Bagian Laporan Transaksi
	public function index_laporan_trans()
	{
		$getAPI = file_get_contents('json/owner/laporan/transaksi/read.json');
		$datas = json_decode($getAPI, true);

		$data['transaksis'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/transaksi/index', $data);
	}

	//Bagian Laporan Customer
	public function index_laporan_cust()
	{
		$getAPI = file_get_contents('json/owner/laporan/customer/read.json');
		$datas = json_decode($getAPI, true);

		$data['customers'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/customer/index', $data);
	}
}
