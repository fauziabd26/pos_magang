<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		//validasi jika user belum login
		$this->load->library('pdfgenerator');
		check_not_login();
		check_admin();
	}

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		// var_dump($datas);
		if (!empty($datas)) {
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
			$data['totalTransaksi'] = $totalTransaksiProduk + $totalTransaksiJasa;
			$data['transaksis'] = array_filter($datas['data'], function ($value) {
				return $value['id_user'] == $this->session->userdata('id_user');
			});
			$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard', $data);
		} else {
			$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard');
		}
	}

	// Bagian Transaksi
	// Bagian Transaksi Barang
	public function transaksi_barang()
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk/by_id_toko/' . $datasAdmin['data']['id_toko']);
		$datas = json_decode($getAPI, true);
		$data['produks'] = $datas['data'];
		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/barang_lastId/' . $datasAdmin['data']['id_user_toko']);
		$datasTransaksi = json_decode($getAPITransaksi, true);

		// Manggil Id Transaksi
		$id_transaksi = $datasTransaksi['data']['id_transaksi'];

		$getAPIDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/get_detail_transaksi_by_transaksi/' . $id_transaksi);
		$datasDetailTransaksi = json_decode($getAPIDetailTransaksi, true);
		if (!empty($datasDetailTransaksi)) {
			$sum_qty = 0;
			foreach ($datasDetailTransaksi['data'] as $value) {
				$sum_qty += $value['qty'];
			}
			$data['sum_qty'] = $sum_qty;
		}

		$data['detail_transaksi'] = $datasDetailTransaksi['data'];
		$data['transaksi'] = $datasTransaksi['data'];
		$this->load->view('dashboard/admin/transaksi/barang', $data);
		// var_dump($id_transaksi);
	}

	public function proses_tambah_transaksi_barang($id_detail_produk)
	{
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk/barang/' . $id_detail_produk);
		$datas = json_decode($getAPI, true);
		$getAPIUserToko = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasUserToko = json_decode($getAPIUserToko, true);
		if ($datas['data']['id_detail_produk'] == $id_detail_produk) {
			$value = array(
				'id_detail_produk' => $datas['data']["id_detail_produk"],
				'nama_produk' => $datas['data']["nama_produk"],
				'nominal' => $datas['data']["nominal"],
			);
		}
		$getAPITransaksi = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_barang_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$cekTransaksi = json_decode($getAPITransaksi, true);
		if (empty($cekTransaksi)) {
			$dataTransaksi = array(
				'id_user_toko'		=> $datasUserToko['data']['id_user_toko'],
				'total_transaksi'   => 0,
				'jenis_transaksi'  	=> "barang",
				'status'   			=> "belum lunas",
			);
			// var_dump($dataTransaksi);
			$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_transaksi', $dataTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		}
		$getAPITransaksiBaru = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_barang_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$transaksiBaru = json_decode($getAPITransaksiBaru, true);
		$getAPICekDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/cek_transaksi_detail/' . $id_detail_produk . '/' . $transaksiBaru['data']['id_transaksi']);
		$cekTransaksiDetail = json_decode($getAPICekDetailTransaksi, true);
		if (empty($cekTransaksiDetail)) {
			$dataDetailTransaksi = array(
				'id_transaksi'		=> $transaksiBaru['data']['id_transaksi'],
				'id_detail_produk'	=> $id_detail_produk,
				'qty'   			=> $_POST['qty'],
				'sub_total'   		=> $value['nominal'] * $_POST['qty'],
			);
			$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_detail_transaksi', $dataDetailTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		} else {
			$getAPICekDetailTransaksiBaru = $this->curl->simple_get($this->api . 'DetailTransaksi/cek_transaksi_detail/' . $id_detail_produk . '/' . $transaksiBaru['data']['id_transaksi']);
			$transaksiDetailUpdate = json_decode($getAPICekDetailTransaksiBaru, true);
			$sub_total_baru = $value['nominal'] * $_POST['qty'];
			$dataDetailTransaksiUpdate = array(
				'id_detail_trans_produk'	=> $transaksiDetailUpdate['data']['id_detail_trans_produk'],
				'qty'						=> $transaksiDetailUpdate['data']['qty'] + $_POST['qty'],
				'sub_total'					=> $transaksiDetailUpdate['data']['sub_total'] + $sub_total_baru,
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/last_update_detail_transaksi', $dataDetailTransaksiUpdate, array(CURLOPT_BUFFERSIZE => 10));
		}
		//Total Di Transaksi
		$getAPITransaksiLast = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_barang_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$transaksi = json_decode($getAPITransaksiLast, true);
		$updateTotal = array(
			'id_transaksi' => $transaksi['data']['id_transaksi'],
			'total_transaksi' => $transaksi['data']['total_transaksi'] + $value['nominal'] * $_POST['qty']
		);
		$this->curl->simple_put($this->api . 'transaksi/update_total_transaksi', $updateTotal, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_barang');
	}

	//Stok Tambah barang
	public function stok_tambah_barang($id_detail_transaksi)
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'DetailTransaksi/barang/' . $id_detail_transaksi);
		$datas = json_decode($getAPI, true);
		$sub_total_awal = $datas['data']['sub_total'];
		$data = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'qty' 					 => $datas['data']['qty'] + 1,
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok', $data, array(CURLOPT_BUFFERSIZE => 10));
		$data2 = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'sub_total' 			 => $datas['data']['nominal'] * $data['qty'],
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok_update', $data2, array(CURLOPT_BUFFERSIZE => 10));
		$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/barang_lastId/' . $datasAdmin['data']['id_user_toko']);
		$dataTransaksi = json_decode($getAPItransaksi, true);
		$total_sebelum = $dataTransaksi['data']['total_transaksi'];
		$penjumlahan = ($datas['data']['nominal'] * $data['qty']) - ($sub_total_awal);
		$data = array(
			'id_transaksi' 		=> $dataTransaksi['data']['id_transaksi'],
			'total_transaksi' 	=> $total_sebelum + $penjumlahan,
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_barang');
	}

	//Stok Kurang Barang
	public function stok_kurang_barang($id_detail_transaksi)
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'DetailTransaksi/barang/' . $id_detail_transaksi);
		$datas = json_decode($getAPI, true);
		$data = array(
			'id_detail_trans_produk' =>  $id_detail_transaksi,
			'qty' => $datas['data']['qty'] - 1,
		);
		if ($datas['data']['qty'] <= 1) {
			echo "<script> alert('Tidak Bisa Minus!'); 
			window.location.href = '" . base_url('admin/transaksi_barang') . "'; </script>";
		} else {
			$this->curl->simple_put($this->api . 'DetailTransaksi/stok', $data, array(CURLOPT_BUFFERSIZE => 10));
			$data = array(
				'id_detail_trans_produk' => $id_detail_transaksi,
				'sub_total' 			 => $datas['data']['nominal'] * $data['qty'],
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/stok_update', $data, array(CURLOPT_BUFFERSIZE => 10));
			$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/barang_lastId/' . $datasAdmin['data']['id_user_toko']);
			$dataTransaksi = json_decode($getAPItransaksi, true);
			$data = array(
				'id_transaksi' 		=> $dataTransaksi['data']['id_transaksi'],
				'total_transaksi' 	=> $dataTransaksi['data']['total_transaksi'] - $datas['data']['nominal'],
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));
			redirect('admin/transaksi_barang');
		}
	}

	//Konfirmasi Barang
	public function konfirmasi_barang($id_transaksi)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/barang_lastId/' . $datasAdmin['data']['id_user_toko']);
		$dataTransaksi = json_decode($getAPITransaksi, true);
		$data = array(
			'id_transaksi' 		=> $id_transaksi,
			'nama_cust'			=> ucfirst($_POST['nama_cust']),
			'status'			=> 'lunas',
			'bayar'				=> $_POST['bayar'],
			'tggl_transaksi'	=> $now,
		);
		if ($data['bayar'] < $dataTransaksi['data']['total_transaksi']) {
			echo "<script> alert('Uang Bayar Tidak Boleh Kurang !'); 
			window.location.href = '" . base_url('admin/transaksi_barang') . "'; </script>";
		} else {
			$this->curl->simple_put($this->api . 'transaksi/konfirmasi', $data, array(CURLOPT_BUFFERSIZE => 10));
			//Print Struk
			$getAPITransaksi 			= $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_id_user/' . $this->session->userdata('id_user') . '/' . $id_transaksi);
			$datasTransaksi 			= json_decode($getAPITransaksi, true);
			$getAPIDetailTransaksi 		= $this->curl->simple_get($this->api . 'DetailTransaksi/get_transaksi_by_id_user/' . $this->session->userdata('id_user') . '/' . $id_transaksi);
			$datasDetailTransaksi 		= json_decode($getAPIDetailTransaksi, true);
			$cust['transaksi']			= $datasTransaksi['data'];
			$cust['detail_transaksi']	= $datasDetailTransaksi['data'];
			$file_pdf 					= 'Struk Transaksi'; //filename dari pdf ketika didownload
			$paper 						= array(0, 0, 380, 500); //setting paper
			$orientation				= "potrait"; //orientasi paper potrait / landscape
			$html						= $this->load->view('dashboard/admin/struk_transaksi', $cust, true);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
			// redirect('admin/transaksi_barang');
		}
	}

	// Bagian Transaksi Jasa
	public function transaksi_jasa()
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk/jasa_by_toko/' . $datasAdmin['data']['id_toko']);
		$datas = json_decode($getAPI, true);
		$data['produks'] = $datas['data'];
		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa_lastId/' . $datasAdmin['data']['id_user_toko']);
		$datasTransaksi = json_decode($getAPITransaksi, true);
		// Manggil Id Transaksi
		$id_transaksi = $datasTransaksi['data']['id_transaksi'];
		$getAPIDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/get_detail_transaksi_by_transaksi/' . $id_transaksi);
		$datasDetailTransaksi = json_decode($getAPIDetailTransaksi, true);
		if (!empty($datasDetailTransaksi)) {
			$sum_qty = 0;
			foreach ($datasDetailTransaksi['data'] as $value) {
				$sum_qty += $value['qty'];
			}
			$data['sum_qty'] = $sum_qty;
		}
		$data['detail_transaksi'] = $datasDetailTransaksi['data'];
		$data['transaksi'] = $datasTransaksi['data'];
		$this->load->view('dashboard/admin/transaksi/jasa', $data);
	}

	public function proses_tambah_transaksi_jasa($id_detail_produk)
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk/jasa_by_toko/' . $datasAdmin['data']['id_toko'] . '/' . $id_detail_produk);
		$datas = json_decode($getAPI, true);
		$getAPIUserToko = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasUserToko = json_decode($getAPIUserToko, true);
		if ($datas['data']['id_detail_produk'] == $id_detail_produk) {
			$value = array(
				'id_detail_produk' => $datas['data']["id_detail_produk"],
				'nama_produk' => $datas['data']["nama_produk"],
				'nominal' => $datas['data']["nominal"],
			);
		}
		$getAPITransaksi = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_jasa_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$cekTransaksi = json_decode($getAPITransaksi, true);
		if (empty($cekTransaksi)) {
			$dataTransaksi = array(
				'id_user_toko'		=> $datasUserToko['data']['id_user_toko'],
				'total_transaksi'   => 0,
				'jenis_transaksi'  	=> "jasa",
				'status'   			=> "belum lunas",
			);
			// var_dump($dataTransaksi);
			$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_transaksi', $dataTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		}
		$getAPITransaksiBaru = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_jasa_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$transaksiBaru = json_decode($getAPITransaksiBaru, true);
		$getAPICekDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/cek_transaksi_detail/' . $id_detail_produk . '/' . $transaksiBaru['data']['id_transaksi']);
		$cekTransaksiDetail = json_decode($getAPICekDetailTransaksi, true);
		if (empty($cekTransaksiDetail)) {
			$dataDetailTransaksi = array(
				'id_transaksi'		=> $transaksiBaru['data']['id_transaksi'],
				'id_detail_produk'	=> $id_detail_produk,
				'qty'   			=> $_POST['qty'],
				'sub_total'   		=> $value['nominal'] * $_POST['qty'],
			);
			$this->curl->simple_post($this->api . 'DetailTransaksi/tambah_detail_transaksi', $dataDetailTransaksi, array(CURLOPT_BUFFERSIZE => 10));
		} else {
			$getAPICekDetailTransaksiBaru = $this->curl->simple_get($this->api . 'DetailTransaksi/cek_transaksi_detail/' . $id_detail_produk . '/' . $transaksiBaru['data']['id_transaksi']);
			$transaksiDetailUpdate = json_decode($getAPICekDetailTransaksiBaru, true);
			$sub_total_baru = $value['nominal'] * $_POST['qty'];
			$dataDetailTransaksiUpdate = array(
				'id_detail_trans_produk'	=> $transaksiDetailUpdate['data']['id_detail_trans_produk'],
				'qty'						=> $transaksiDetailUpdate['data']['qty'] + $_POST['qty'],
				'sub_total'					=> $transaksiDetailUpdate['data']['sub_total'] + $sub_total_baru,
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/last_update_detail_transaksi', $dataDetailTransaksiUpdate, array(CURLOPT_BUFFERSIZE => 10));
		}
		//Total Di Transaksi
		$getAPITransaksiLast = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_jasa_belum_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$transaksi = json_decode($getAPITransaksiLast, true);
		$updateTotal = array(
			'id_transaksi' => $transaksi['data']['id_transaksi'],
			'total_transaksi' => $transaksi['data']['total_transaksi'] + $value['nominal'] * $_POST['qty']
		);
		$this->curl->simple_put($this->api . 'transaksi/update_total_transaksi', $updateTotal, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_jasa');
	}

	//Stok Tambah jasa
	public function stok_tambah_jasa($id_detail_transaksi)
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa/' . $id_detail_transaksi);
		$datas = json_decode($getAPI, true);
		$sub_total_awal = $datas['data']['sub_total'];
		$data = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'qty' 					 => $datas['data']['qty'] + 1,
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok', $data, array(CURLOPT_BUFFERSIZE => 10));
		$data2 = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'sub_total' 			 => $datas['data']['nominal'] * $data['qty'],
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok_update', $data2, array(CURLOPT_BUFFERSIZE => 10));
		$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa_lastId/' . $datasAdmin['data']['id_user_toko']);
		$dataTransaksi = json_decode($getAPItransaksi, true);
		$total_sebelum = $dataTransaksi['data']['total_transaksi'];
		$penjumlahan = ($datas['data']['nominal'] * $data['qty']) - ($sub_total_awal);
		$data = array(
			'id_transaksi' 		=> $dataTransaksi['data']['id_transaksi'],
			'total_transaksi' 	=> $total_sebelum + $penjumlahan,
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));
		redirect('admin/transaksi_jasa');
	}

	//Stok Kurang Jasa
	public function stok_kurang_jasa($id_detail_transaksi)
	{
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPI = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa/' . $id_detail_transaksi);
		$datas = json_decode($getAPI, true);
		$data = array(
			'id_detail_trans_produk' =>  $id_detail_transaksi,
			'qty' => $datas['data']['qty'] - 1,
		);
		if ($datas['data']['qty'] <= 1) {
			echo "<script> alert('Tidak Bisa Minus!'); 
			window.location.href = '" . base_url('admin/transaksi_jasa') . "'; </script>";
		} else {
			$this->curl->simple_put($this->api . 'DetailTransaksi/stok', $data, array(CURLOPT_BUFFERSIZE => 10));
			$data = array(
				'id_detail_trans_produk' => $id_detail_transaksi,
				'sub_total' 			 => $datas['data']['nominal'] * $data['qty'],
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/stok_update', $data, array(CURLOPT_BUFFERSIZE => 10));
			$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa_lastId/' . $datasAdmin['data']['id_user_toko']);
			$dataTransaksi = json_decode($getAPItransaksi, true);
			$data = array(
				'id_transaksi' 		=> $dataTransaksi['data']['id_transaksi'],
				'total_transaksi' 	=> $dataTransaksi['data']['total_transaksi'] - $datas['data']['nominal'],
			);
			$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));
			redirect('admin/transaksi_jasa');
		}
	}

	//Konfirmasi jasa
	public function konfirmasi_jasa($id_transaksi)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa_lastId/' . $datasAdmin['data']['id_user_toko']);
		$dataTransaksi = json_decode($getAPITransaksi, true);
		$data = array(
			'id_transaksi' 	=> $id_transaksi,
			'nama_cust'		=> ucfirst($_POST['nama_cust']),
			'status'		=> 'lunas',
			'bayar'			=> $_POST['bayar'],
			'tggl_transaksi'	=> $now,
		);
		if ($data['bayar'] < $dataTransaksi['data']['total_transaksi']) {
			echo "<script> alert('Uang Bayar Tidak Boleh Kurang !'); 
			window.location.href = '" . base_url('admin/transaksi_jasa') . "'; </script>";
		} else {
			$this->curl->simple_put($this->api . 'transaksi/konfirmasi', $data, array(CURLOPT_BUFFERSIZE => 10));
			//Print Struk
			$getAPITransaksi 			= $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_id_user/' . $this->session->userdata('id_user') . '/' . $id_transaksi);
			$datasTransaksi 			= json_decode($getAPITransaksi, true);
			$getAPIDetailTransaksi 		= $this->curl->simple_get($this->api . 'DetailTransaksi/get_transaksi_by_id_user/' . $this->session->userdata('id_user') . '/' . $id_transaksi);
			$datasDetailTransaksi 		= json_decode($getAPIDetailTransaksi, true);
			$cust['transaksi']			= $datasTransaksi['data'];
			$cust['detail_transaksi']	= $datasDetailTransaksi['data'];
			$file_pdf 					= 'Struk Transaksi'; //filename dari pdf ketika didownload
			$paper 						= array(0, 0, 380, 500); //setting paper
			$orientation				= "potrait"; //orientasi paper potrait / landscape
			$html						= $this->load->view('dashboard/admin/struk_transaksi', $cust, true);
			$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
			// redirect('admin/transaksi_barang');
		}
	}

	// Bagian Histori
	public function histori_transaksi()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data['transaksis'] = array_filter($datas['data'], function ($value) {
				return $value['id_user'] == $this->session->userdata('id_user');
			});
			$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/index', $data);
		} else {
			$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/index');
		}
	}

	public function histori_transaksi_detail($id_transaksi)
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_id_user/' . $this->session->userdata('id_user') . '/' . $id_transaksi);
		$datas = json_decode($getAPI, true);
		if ($datas['data']['id_transaksi'] == $id_transaksi) {
			$value = array(
				'id_transaksi' 		=> $datas['data']['id_transaksi'],
				'nama_cust' 		=> $datas['data']['nama_cust'],
				'jenis_transaksi' 	=> $datas['data']['jenis_transaksi'],
				'total_transaksi' 	=> $datas['data']['total_transaksi'],
				'tggl_transaksi' 	=> $datas['data']['tggl_transaksi'],
			);
		}

		$getAPITransaksi = $this->curl->simple_get($this->api . 'detailTransaksi/get_detail_transaksi_by_transaksi/' . $id_transaksi);
		$datasTransaksi = json_decode($getAPITransaksi, true);
		$data['detail_transaksi'] = $datasTransaksi['data'];
		$data['transaksi'] = $value;
		$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/detail', $data);
	}

	//Hapus Detail Transaksi Barang
	public function hapus_detail_transaksi_barang($id_detail_trans_produk)
	{
		if (empty($id_detail_trans_produk)) {
			redirect('admin/transaksi_barang');
		} else {
			$getdetail_trans_produk = $this->curl->simple_get($this->api . 'DetailTransaksi/barang/' . $id_detail_trans_produk);
			$detail_trans_produk = json_decode($getdetail_trans_produk, true);
			$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
			$datasAdmin = json_decode($getAPIAdmin, true);
			$gettransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/barang_lastId/' . $datasAdmin['data']['id_user_toko']);
			$transaksi = json_decode($gettransaksi, true);
			$data = array(
				'id_transaksi' 		=> $transaksi['data']['id_transaksi'],
				'total_transaksi' 	=> $transaksi['data']['total_transaksi'] - $detail_trans_produk['data']['sub_total'],
			);
			$this->curl->simple_put($this->api . 'transaksi/update_total_transaksi', $data, array(CURLOPT_BUFFERSIZE => 10));
			$delete = $this->curl->simple_delete($this->api . 'transaksi', array('id_detail_trans_produk' => $id_detail_trans_produk), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success', "Data Detail Transaksi Terhapus !");
			} else {
				$this->session->set_flashdata('error', 'Data Gagal dihapus');
			}
			redirect('admin/transaksi_barang');
		}
	}

	//Hapus Detail Transaksi Jasa
	public function hapus_detail_transaksi_jasa($id_detail_trans_produk)
	{
		if (empty($id_detail_trans_produk)) {
			redirect('admin/transaksi_jasa');
		} else {
			$getdetail_trans_produk = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa/' . $id_detail_trans_produk);
			$detail_trans_produk = json_decode($getdetail_trans_produk, true);
			$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/get_admin/' . $this->session->userdata('id_user'));
			$datasAdmin = json_decode($getAPIAdmin, true);
			$gettransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/jasa_lastId/' . $datasAdmin['data']['id_user_toko']);
			$transaksi = json_decode($gettransaksi, true);
			$data = array(
				'id_transaksi' 		=> $transaksi['data']['id_transaksi'],
				'total_transaksi' 	=> $transaksi['data']['total_transaksi'] - $detail_trans_produk['data']['sub_total'],
			);
			$this->curl->simple_put($this->api . 'transaksi/update_total_transaksi', $data, array(CURLOPT_BUFFERSIZE => 10));
			$delete = $this->curl->simple_delete($this->api . 'transaksi', array('id_detail_trans_produk' => $id_detail_trans_produk), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success', "Data Detail Transaksi Terhapus !");
			} else {
				$this->session->set_flashdata('error', 'Data Gagal dihapus');
			}
			redirect('admin/transaksi_jasa');
		}
	}
}
