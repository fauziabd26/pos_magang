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

	function get_last_get()
	{
		$transaksi =  $this->TransaksiModel->get_last()->result();

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
	function index_put()
	{
		$id_transaksi    = $this->put('id_transaksi');
		$data       = array(
			'nama_cust'         => $this->post('nama_cust'),
			'diskon'            => $this->post('diskon'),
			'total_transaksi'   => $this->post('total_transaksi'),
			'status'            => $this->post('status'),
			'bayar'             => $this->post('bayar'),
			'jenis_transaksi'   => $this->post('jenis_transaksi'),
			'tggl_transaksi'    => $this->post('tggl_transaksi'),
			'id_user'           => $this->post('id_user'),
			'id_toko'           => $this->post('id_toko')
		);

		$this->db->where('id_toko', $id_transaksi);
		$update = $this->db->update('toko', $data);
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
			// 'total_transaksi'   	=> $this->put('total_transaksi'),
			'status'               	=> $this->put('status'),
			'bayar'             	=> $this->put('bayar'),
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
