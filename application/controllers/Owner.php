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
		$this->load->model('TokoModel');
		$data['tokos'] = $this->TokoModel->getAll();

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
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
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('jasas' => $datas["jasa"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/index', $data);
	}

	// Bagian Foto Produk

	//Bagian Harga
	public function index_harga()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('hargas' => $datas["harga"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/index', $data);
	}

	//Bagian Kategori
	public function index_kategori()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('kategories' => $datas["kategori"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/kategori/index', $data);
	}

	//Bagian Satuan
	public function index_satuan()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('satuans' => $datas["satuan"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/index', $data);
	}

	//Bagian Laporan
}
