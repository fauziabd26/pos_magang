<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Transaksi extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('TransaksiModel');
	}

	//Menampilkan data Transaksi
	function index_get($id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$transaksi = $this->TransaksiModel->get($id_transaksi)->row();
		} else {
			$transaksi =  $this->TransaksiModel->get()->result();
		}
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi Jenis Barang belum lunas sesuai Admin
	function get_transaksi_barang_belum_lunas_by_id_user_get($id_user)
	{
		$transaksi = $this->TransaksiModel->get_transaksi_barang_belum_lunas_by_id_user($id_user);
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi Jenis Jasa belum lunas sesuai Admin
	function get_transaksi_jasa_belum_lunas_by_id_user_get($id_user)
	{
		$transaksi = $this->TransaksiModel->get_transaksi_jasa_belum_lunas_by_id_user($id_user);
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi lunas sesuai Owner
	function get_transaksi_lunas_by_owner_get($id_user, $id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$transaksi = $this->TransaksiModel->get_transaksi_lunas_by_owner($id_user, $id_transaksi)->row();
		} else {
			$transaksi = $this->TransaksiModel->get_transaksi_lunas_by_owner($id_user)->result();
		}
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi lunas sesuai Admin
	function get_transaksi_lunas_by_id_user_get($id_user, $id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$transaksi =  $this->TransaksiModel->get_transaksi_lunas_by_id_user($id_user, $id_transaksi)->row();
		} else {
			$transaksi =  $this->TransaksiModel->get_transaksi_lunas_by_id_user($id_user)->result();
		}
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi Barang
	function barang_get($id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$transaksi = $this->TransaksiModel->get_barang($id_transaksi)->row();
		} else {
			$transaksi =  $this->TransaksiModel->get_barang()->result();
		}

		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi Jasa
	function jasa_get($id_transaksi = null)
	{
		if (!empty($id_transaksi)) {
			$transaksi = $this->TransaksiModel->get_jasa($id_transaksi)->row();
		} else {
			$transaksi =  $this->TransaksiModel->get_jasa()->result();
		}

		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Tidak Ada',
			), 404);
		}
	}

	//Menampilkan data Transaksi Sesuai Customer
	function get_customer_by_owner_get($id_user)
	{
		$transaksi =  $this->TransaksiModel->get_customer_by_owner($id_user);
		if ($transaksi) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Transaksi Sesuai Customer Berhasil Diambil',
				'data' => $transaksi
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Transaksi Sesuai Customer Tidak Ada',
			), 404);
		}
	}

	//Menambah data baru barang
	function barang_post()
	{
		$data = array(
			'nama_cust'         => $this->post('nama_cust'),
			'diskon'            => $this->post('diskon'),
			'total_transaksi'   => $this->post('total_transaksi'),
			'status'            => "sudah bayar",
			'bayar'             => $this->post('bayar'),
			'jenis_transaksi'   => "barang",
			'tggl_transaksi'    => $this->post('tggl_transaksi'),
			'id_user'           => $this->post('id_user'),
			'id_toko'           => $this->post('id_toko')
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

	function jasa_post()
	{
		$data = array(
			'nama_cust'         => $this->post('nama_cust'),
			'diskon'            => $this->post('diskon'),
			'total_transaksi'   => $this->post('total_transaksi'),
			'status'            => "sudah bayar",
			'bayar'             => $this->post('bayar'),
			'jenis_transaksi'   => "jasa",
			'tggl_transaksi'    => $this->post('tggl_transaksi'),
			'id_user'           => $this->post('id_user'),
			'id_toko'           => $this->post('id_toko')
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

	//Memperbarui data yang telah ada
	function update_total_transaksi_put()
	{
		$id_transaksi    = $this->put('id_transaksi');
		$data       = array(
			'total_transaksi'   => $this->put('total_transaksi'),
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

	function konfirmasi_put()
	{
		$id_transaksi    = $this->put('id_transaksi');
		$data       = array(
			'nama_cust'            	=> $this->put('nama_cust'),
			// 'diskon'            	=> $this->put('diskon'),
			'status'               	=> $this->put('status'),
			'bayar'             	=> $this->put('bayar'),
			'tggl_transaksi'   		=> $this->put('tggl_transaksi'),
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

	// Menghapus salah satu data detail transaksi
	function index_delete()
	{
		$id_detail_trans_produk = $this->delete('id_detail_trans_produk');
		$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		if ($this->db->delete('detail_trans_produk')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Detail Transaksi Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Detail Transaksi'
			), 502);
		}
	}
}
