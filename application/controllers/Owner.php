<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		check_not_login();
		check_owner();
	}

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi');
		$datas = json_decode($getAPI, true);

		// Count Data Transaksi
		$totalTransaksiBarang = 0;
		$totalTransaksiJasa = 0;

		// var_dump($datas);
		foreach ($datas["data"] as $value) {
			if ($value["jenis_transaksi"] == "barang") {
				$totalTransaksiBarang += 1;
			} elseif ($value["jenis_transaksi"] == "jasa") {
				$totalTransaksiJasa += 1;
			}
		}

		$data = array('transaksis' => $datas["data"]);
		$data['totalTransaksiBarang'] = $totalTransaksiBarang;
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
		$getAPI = $this->curl->simple_get($this->api . 'admin');
		$datas = json_decode($getAPI, true);

		$data['admins'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function admin_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function proses_tambah_admin()
	{
		$data = array(
			'nama' =>  ucwords($_POST['nama']),
			'email' =>  $_POST['email'],
			'password' => $_POST['password'],
			'no_hp' => $_POST['no_hp'],
			'photo' => $_POST['photo'],
		);
		$insert = $this->curl->simple_post($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/admin');
	}

	public function admin_edit($id_user)
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin');
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

		$data['admin'] = $value;

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/edit', $data);
	}

	public function proses_edit_admin($id_user)
	{
		$data = array(
			'id_user' =>  $id_user,
			'nama' => $_POST["nama"],
			'email' => $_POST["email"],
			'no_hp' => $_POST["no_hp"],
		);
		$update = $this->curl->simple_put($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/admin');
	}

	public function admin_hapus($id_user)
	{
		if (empty($id_user)) {
			redirect('owner/admin');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'admin', array('id_user' => $id_user), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Admin Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/admin');
		}
	}

	public function admin_ubah_password($id_user)
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubah_password');
	}

	// Bagian Toko
	public function toko()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		$data['tokos'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
	}

	public function toko_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
	}

	public function proses_tambah_toko()
	{
		$data = array(
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko']
		);
		$insert = $this->curl->simple_post($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/toko');
	}

	public function toko_edit($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
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
		$data = array(
			'id_toko' =>  $id_toko,
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko']
		);
		$update = $this->curl->simple_put($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/toko');
	}

	// public function toko_hapus($id_toko)
	// {
	// 	if (empty($id_toko)) {
	// 		redirect('owner/toko');
	// 	} else {
	// 		$delete = $this->curl->simple_delete($this->api . 'toko', array('id_toko' => $id_toko), array(CURLOPT_BUFFERSIZE => 10));
	// 		if ($delete) {
	// 			$this->session->set_flashdata('success-delete', "Data Toko Terhapus !");
	// 		} else {
	// 			$this->session->set_flashdata('info', 'Data Gagal dihapus');
	// 		}
	// 		redirect('owner/toko');
	// 	}
	// }

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
