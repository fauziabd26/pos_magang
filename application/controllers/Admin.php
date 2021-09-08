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
		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas');
		$datas = json_decode($getAPI, true);
		if (!empty($datas)) {
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
		} else {
			$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard');
		}
	}

	// Bagian Transaksi
	// Bagian Transaksi Barang
	public function transaksi_barang()
	{
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk');
		$datas = json_decode($getAPI, true);

		$data['produks'] = array_filter($datas['data'], function ($value) {
			return $value['jenis'] == 'barang';
		});

		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$datasTransaksi = json_decode($getAPITransaksi, true);

		// Manggil Id Transaksi
		$id_transaksi = $datasTransaksi['id_transaksi'];

		$getAPIDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/by_id_transaksi/' . $id_transaksi);
		$datasDetailTransaksi = json_decode($getAPIDetailTransaksi, true);

		// var_dump($datasDetailTransaksi);
		if (!empty($datasDetailTransaksi)) {
			$sum_qty = 0;
			foreach ($datasDetailTransaksi as $value) {
				$sum_qty += $value['qty'];
			}
			$data['sum_qty'] = $sum_qty;
		}

		$data['detail_transaksi'] = $datasDetailTransaksi;
		$data['transaksi'] = $datasTransaksi;
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

		$dataTransaksi = array(
			'id_user'			=> $this->session->userdata('id_user'),
			'total_transaksi'   => $value['nominal'],
			'status'   			=> "belum lunas",
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
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk');
		$datas = json_decode($getAPI, true);

		$data['produks'] = array_filter($datas['data'], function ($value) {
			return $value['jenis'] == 'jasa';
		});

		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$datasTransaksi = json_decode($getAPITransaksi, true);

		// Manggil Id Transaksi
		$id_transaksi = $datasTransaksi['id_transaksi'];

		$getAPIDetailTransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/by_id_transaksi/' . $id_transaksi);
		$datasDetailTransaksi = json_decode($getAPIDetailTransaksi, true);

		// var_dump($datasDetailTransaksi);
		if (!empty($datasDetailTransaksi)) {
			$sum_qty = 0;
			foreach ($datasDetailTransaksi as $value) {
				$sum_qty += $value['qty'];
			}
			$data['sum_qty'] = $sum_qty;
		}

		$data['detail_transaksi'] = $datasDetailTransaksi;
		$data['transaksi'] = $datasTransaksi;
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
			'total_transaksi'   => $value['nominal'],
			'status'   			=> "belum lunas",
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

	//Stok Tambah dan Kurang
	public function stok_tambah($id_detail_transaksi)
	{
		$getAPI = $this->curl->simple_get($this->api . 'DetailTransaksi/barang/' . $id_detail_transaksi);
		$datas = json_decode($getAPI, true);

		$data = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'qty' 					 => $datas['data']['qty'] + 1,
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok', $data, array(CURLOPT_BUFFERSIZE => 10));

		$data = array(
			'id_detail_trans_produk' => $id_detail_transaksi,
			'sub_total' 			 => $datas['data']['nominal'] * $data['qty'],
		);
		$this->curl->simple_put($this->api . 'DetailTransaksi/stok_update', $data, array(CURLOPT_BUFFERSIZE => 10));

		$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$dataTransaksi = json_decode($getAPItransaksi, true);

		$data = array(
			'id_transaksi' 		=> $dataTransaksi['id_transaksi'],
			'total_transaksi' 	=> $data['sub_total'],
		);

		$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));

		redirect('admin/transaksi_barang');
	}

	public function stok_kurang($id_detail_transaksi)
	{
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
			$getAPItransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
			$dataTransaksi = json_decode($getAPItransaksi, true);

			$data = array(
				'id_transaksi' 		=> $dataTransaksi['id_transaksi'],
				'total_transaksi' 	=> $data['sub_total'],
			);

			$this->curl->simple_put($this->api . 'DetailTransaksi/transaksi_total_update', $data, array(CURLOPT_BUFFERSIZE => 10));
			redirect('admin/transaksi_barang');
		}
	}

	//Konfirmasi
	public function konfirmasi($id_transaksi)
	{
		$getAPITransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
		$dataTransaksi = json_decode($getAPITransaksi, true);

		$data = array(
			'id_transaksi' 	=> $id_transaksi,
			'nama_cust'		=> ucfirst($_POST['nama_cust']),
			'status'		=> 'lunas',
			'bayar'			=> $_POST['bayar'],
		);

		if ($data['bayar'] < $dataTransaksi['total_transaksi']) {
			echo "<script> alert('Uang Bayar Tidak Boleh Kurang !'); 
			window.location.href = '" . base_url('admin/transaksi_barang') . "'; </script>";
		} else {
			$this->curl->simple_put($this->api . 'transaksi/konfirmasi', $data, array(CURLOPT_BUFFERSIZE => 10));
			redirect('admin/transaksi_barang');
		}
	}

	// Bagian Histori
	public function histori_transaksi()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas');
		$datas = json_decode($getAPI, true);

		if ($datas) {
			$data['transaksis'] = array_filter($datas['data'], function ($value) {
				return $value['id_user'] == $this->session->userdata('id_user');
			});
			$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/index', $data);
		} else {
			$this->template->load('layouts/admin/master', 'dashboard/admin/histori_transaksi/index');
		}
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

	public function hapus_detail_transaksi($id_detail_trans_produk)
	{
		if (empty($id_detail_trans_produk)) {
			redirect('admin/transaksi_barang');
		} else {
			$getdetail_trans_produk = $this->curl->simple_get($this->api . 'DetailTransaksi/' . $id_detail_trans_produk);
			$detail_trans_produk = json_decode($getdetail_trans_produk, true);

			$gettransaksi = $this->curl->simple_get($this->api . 'DetailTransaksi/lastId');
			$transaksi = json_decode($gettransaksi, true);

			$data = array(
				'id_transaksi' 		=> $transaksi['id_transaksi'],
				'total_transaksi' 	=> $transaksi['total_transaksi'] - $detail_trans_produk['data']['sub_total'],
			);
			// var_dump($data);
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
}
