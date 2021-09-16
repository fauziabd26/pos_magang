<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class DetailTransaksi extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('DetailTransaksiModel');
	}

	function cek_transaksi_detail_get($id_detail_trans_produk, $id_transaksi)
	{
		$transaksidetail = $this->DetailTransaksiModel->cek_transaksi_detail($id_detail_trans_produk, $id_transaksi);
		if ($transaksidetail) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Detail Berdasarkan Produk dan Transaksi Berhasil Diambil',
				'data' => $transaksidetail
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Detail Berdasarkan Produk dan Transaksi Tidak Ada',
			), 404);
		}
	}

	function lastId_get()
	{
		$transaksi = $this->DetailTransaksiModel->lastId();
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Terakhir Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Terakhir Tidak Ada',
			), 404);
		}
	}

	function cekTransaksi_get()
	{
		$this->response($this->DetailTransaksiModel->cekTransaksi(), 200);
	}

	function get_transaksi_by_id_user_get($id_user, $id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$detail_transaksi = $this->DetailTransaksiModel->get_transaksi_by_id_user($id_user, $id_transaksi)->row();
		} else {
			$detail_transaksi = $this->DetailTransaksiModel->get_transaksi_by_id_user($id_user)->result();
		}
		if ($detail_transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diambil',
				'data' => $detail_transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Detail Transaksi Tidak Ada',
			), 404);
		}
	}

	function get_detail_transaksi_by_transaksi_get($id_transaksi)
	{
		$detail_transaksi = $this->DetailTransaksiModel->get_detail_transaksi_by_transaksi($id_transaksi);
		if ($detail_transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diambil',
				'data' => $detail_transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Detail Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data semua detail transaksi
	function index_get($id_detail_trans_produk = null)
	{
		if (!empty($id_detail_trans_produk)) {
			$detail_transaksi = $this->DetailTransaksiModel->get($id_detail_trans_produk)->row();
		} else {
			$detail_transaksi =  $this->DetailTransaksiModel->get()->result();
		}
		if ($detail_transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diambil',
				'data' => $detail_transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Detail Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data semua detail transaksi jenis barang
	function barang_get($id_detail_trans_produk = null)
	{
		if (!empty($id_detail_trans_produk)) {
			$detail_transaksi = $this->DetailTransaksiModel->get_barang($id_detail_trans_produk)->row();
		} else {
			$detail_transaksi =  $this->DetailTransaksiModel->get_barang()->result();
		}

		if ($detail_transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diambil',
				'data' => $detail_transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Detail Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data semua detail transaksi jenis jasa
	function jasa_get($id_detail_trans_produk = null)
	{
		if (!empty($id_detail_trans_produk)) {
			$detail_transaksi = $this->DetailTransaksiModel->get_jasa($id_detail_trans_produk)->row();
		} else {
			$detail_transaksi =  $this->DetailTransaksiModel->get_jasa()->result();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Detail Transaksi Berhasil Diambil',
			'data' => $detail_transaksi
		), 200);
	}

	function stok_put()
	{
		$id_detail_trans_produk    = $this->put('id_detail_trans_produk');
		$data       = array(
			'qty'               => $this->put('qty'),
		);

		$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		$update = $this->db->update('detail_trans_produk', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Detail Transaksi'
			), 502);
		}
	}

	function stok_update_put()
	{
		$id_detail_trans_produk    = $this->put('id_detail_trans_produk');
		$data       = array(
			'sub_total'               => $this->put('sub_total'),
		);

		$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		$update = $this->db->update('detail_trans_produk', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Detail Transaksi'
			), 502);
		}
	}

	function transaksi_total_update_put()
	{
		$id_transaksi    = $this->put('id_transaksi');
		$data       = array(
			'total_transaksi'	=> $this->put('total_transaksi'),
		);

		$this->db->where('id_transaksi', $id_transaksi);
		$update = $this->db->update('transaksi', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Transaksi'
			), 502);
		}
	}

	function detail_transaksi_where_get($id_detail_trans_produk = null)
	{
		$detail_transaksi = $this->DetailTransaksiModel->get_where($id_detail_trans_produk)->row();

		if ($detail_transaksi) {
			$this->response($detail_transaksi, 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Detail Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menambah data baru barang
	function index_post()
	{
		$data = array(
			'sub_total'         => $this->post('sub_total'),
			'qty'               => $this->post('qty'),
			'id_user'           => $this->post('id_user'),
			'id_produk'         => $this->post('id_produk'),
			'id_transaksi'      => $this->post('id_transaksi'),
		);

		if ($this->TransaksiModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Transaksi'
			), 502);
		}
	}

	function tambah_transaksi_post()
	{
		$dataTransaksi = array(
			'id_user_toko'   		=> $this->post('id_user_toko'),
			'jenis_transaksi'	=> 'barang',
			'total_transaksi'   => $this->post('total_transaksi'),
			'status'			=> $this->post('status'),
			'tggl_transaksi'	=> $this->post('tggl_transaksi'),
		);
		if ($this->DetailTransaksiModel->saveTransaksi($dataTransaksi)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Ditambah',
				'data' => $dataTransaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data  Transaksi'
			), 502);
		}
	}

	function tambah_transaksi_jasa_post()
	{
		$dataTransaksi = array(
			'id_user_toko'   		=> $this->post('id_user_toko'),
			'jenis_transaksi'	=> 'jasa',
			'total_transaksi'   => $this->post('total_transaksi'),
			'status'			=> $this->post('status'),
			'tggl_transaksi'	=> $this->post('tggl_transaksi'),
		);
		if ($this->DetailTransaksiModel->saveTransaksi($dataTransaksi)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Ditambah',
				'data' => $dataTransaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data  Transaksi'
			), 502);
		}
	}

	function tambah_detail_transaksi_post()
	{
		$dataDetailTransaksi = array(
			'id_transaksi'		=> $this->post('id_transaksi'),
			'id_detail_produk'	=> $this->post('id_detail_produk'),
			'qty'   			=> $this->post('qty'),
			'sub_total'   		=> $this->post('sub_total'),
		);
		if ($this->DetailTransaksiModel->save($dataDetailTransaksi)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Ditambah',
				'data' => $dataDetailTransaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data  Detail Transaksi'
			), 502);
		}
	}

	//Memperbarui data yang telah ada
	function index_put()
	{
		$id_detail_trans_produk    = $this->put('id_detail_trans_produk');
		$data       = array(
			'sub_total'         => $this->put('sub_total'),
			'qty'               => $this->put('qty'),
			'id_user'           => $this->put('id_user'),
			'id_produk'         => $this->put('id_produk'),
			'id_transaksi'      => $this->put('id_transaksi'),
		);

		$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		$update = $this->db->update('detail_trans_produk', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Detail Transaksi'
			), 502);
		}
	}

	//Menghapus salah satu data toko
	// function index_delete()
	// {
	// 	$id_toko = $this->delete('id_toko');
	// 	$this->db->where('id_toko', $id_toko);
	// 	if ($this->db->delete('toko')) {
	// 		$this->response(array(
	// 			'status' => true,
	// 			'message' => 'Data Toko Berhasil Dihapus',
	// 		), 200);
	// 	} else {
	// 		$this->response(array(
	// 			'status' => false,
	// 			'message' => 'Gagal Menghapus Data Toko'
	// 		), 502);
	// 	}
	// }
}
