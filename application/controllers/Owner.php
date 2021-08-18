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
		$getAPI = file_get_contents('https://api.etoko.xyz/admin');
		$datas = json_decode($getAPI, true);

		$data['admins'] = array_filter($datas['data'], function ($row) {
			return $row['role'] == "admin"; //Owner Yang Sedang Login
		});

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function admin_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function proses_tambah_admin()
	{
		$postdata = http_build_query(
			array(
				'nama' =>  ucwords($_POST['nama']),
				'email' =>  $_POST['email'],
				'password' => $_POST['password'],
				'no_hp' => $_POST['no_hp'],
				'photo' => $_POST['photo'],
				'role' => "admin",
			)
		);

		$opts = array(
			'http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		file_get_contents('https://api.etoko.xyz/admin', false, $context);

		$this->session->set_flashdata('success-create', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");

		redirect('owner/admin');
	}

	public function admin_edit($id_user)
	{
		$getAPI = file_get_contents('https://api.etoko.xyz/admin');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_user'] == $id_user) {
				$value = array(
					'id_user' => $row["id_user"],
					'nama' => $row["nama"],
					'email' => $row["email"],
					'no_hp' => $row["no_hp"],
					'photo' => $row["photo"],
				);
			}
		}

		$data['admins'] = $value;

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

		// $data['tokos'] = array_filter($datas['data'], function ($row) {
		// 	return $row['id_user'] == 1; //Owner Yang Sedang Login
		// });

		$data['tokos'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
	}

	public function toko_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
	}

	public function proses_tambah_toko()
	{
		$postdata = http_build_query(
			array(
				'nama_toko' =>  ucwords($_POST['nama_toko']),
				'alamat' =>  ucfirst($_POST['alamat']),
				'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
				'foto_toko' => $_POST['foto_toko']
			)
		);

		$opts = array(
			'http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		file_get_contents('https://api.etoko.xyz/toko', false, $context);

		$this->session->set_flashdata('success-create', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Disimpan !");

		redirect('owner/toko');
	}

	public function toko_edit($id_toko)
	{
		$getAPI = file_get_contents('https://api.etoko.xyz/toko');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
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

	public function proses_edit_toko($id_toko)
	{
		$postdata = http_build_query(
			array(
				'id_toko' =>  $id_toko,
				'nama_toko' =>  ucwords($_POST['nama_toko']),
				'alamat' =>  ucfirst($_POST['alamat']),
				'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
				'foto_toko' => $_POST['foto_toko']
			)
		);

		$opts = array(
			'http' =>
			array(
				'method'  => 'PUT',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		file_get_contents('https://api.etoko.xyz/toko', false, $context);

		$this->session->set_flashdata('success-edit', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");

		redirect('owner/toko');
	}

	public function toko_hapus($id_toko)
	{
		$postdata = http_build_query(
			array(
				'id_toko' =>  $id_toko,
			)
		);

		$opts = array(
			'http' =>
			array(
				'method'  => 'DELETE',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context = stream_context_create($opts);

		file_get_contents('https://api.etoko.xyz/toko', false, $context);

		$this->session->set_flashdata('success-delete', "Data Toko Terhapus !");

		redirect('owner/toko');
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
