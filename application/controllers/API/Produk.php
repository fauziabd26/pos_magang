<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('ProdukModel');
	}

	//Menampilkan data
	function barang_get($id_produk = null)
	{
		if (!empty($id_produk)) {
			$produk = $this->ProdukModel->get_barang($id_produk);
		} else {
			$produk =  $this->ProdukModel->get_barang();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Barang Berhasil Diambil',
			'data' => $produk
		), 200);
	}

	function jasa_get($id_produk = null)
	{
		if (!empty($id_produk)) {
			$produk = $this->ProdukModel->get_jasa($id_produk);
		} else {
			$produk =  $this->ProdukModel->get_jasa();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Jasa Berhasil Diambil',
			'data' => $produk
		), 200);
	}

	//Menambah data baru
	function index_post()
	{
		$data = array(
			'nama_produk'      => $this->post('nama_produk'),
			'jenis'            => $this->post('jenis'),
			'id_toko' 		   => $this->post('id_toko')
		);

		if ($this->ProdukModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Produk Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Produk'
			), 502);
		}
	}

	//Memperbarui data toko yang telah ada
	function index_put()
	{
		$id_produk    = $this->put('id_produk');
		$data       = array(
			'nama_produk'         => $this->put('nama_produk'),
			'jenis'            	  => $this->put('jenis'),
			'id_toko'             => $this->put('id_toko')
		);

		$this->db->where('id_produk', $id_produk);
		$update = $this->db->update('produk', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Produk Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Produk'
			), 502);
		}
	}

	//Menghapus salah satu data toko
	function index_delete()
	{
		$id_produk = $this->delete('id_produk');
		$this->db->where('id_produk', $id_produk);
		if ($this->db->delete('produk')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Produk Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Toko'
			), 502);
		}
	}
}
