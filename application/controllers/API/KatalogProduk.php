<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class KatalogProduk extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('KatalogProdukModel');
	}

	//Menampilkan data
	function index_get($id_detail_produk = null){
		
		if (!empty($id_detail_produk)) {
			$katalog_produk = $this->KatalogProdukModel->get($id_detail_produk)->row();
		} else {
			$katalog_produk =  $this->KatalogProdukModel->get()->result();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Katalog Produk Berhasil Diambil',
			'data' => $katalog_produk
		), 200);
	}

	//Menambah data baru
	function index_post()
	{
		$data = array(
			'id_produk'      => $this->post('id_produk'),
			'id_harga' 	     => $this->post('id_harga'),
			'id_satuan'      => $this->post('id_satuan'),
			'id_kategori'    => $this->post('id_kategori'),
			'nominal' 		 => $this->post('nominal')
		);

		if ($this->KatalogProdukModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Katalog Produk Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Katalog Produk'
			), 502);
		}
	}

	//Memperbarui data yang telah ada
	function index_put()
	{
		$id_detail_produk    = $this->put('id_detail_produk');
		$data         = array(
			'id_produk'      => $this->put('id_produk'),
			'id_harga' 	     => $this->put('id_harga'),
			'id_satuan'      => $this->put('id_satuan'),
			'id_kategori'    => $this->put('id_kategori'),
			'nominal' 		 => $this->put('nominal')
		);

		$this->db->where('id_detail_produk', $id_detail_produk);
		$update = $this->db->update('detail_produk', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Katalog Produk Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Katalog Produk'
			), 502);
		}
	}

	//Menghapus salah satu data
	function index_delete()
	{
		$id_detail_produk = $this->delete('id_detail_produk');
		$this->db->where('id_detail_produk', $id_detail_produk);
		if ($this->db->delete('detail_produk')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Katalog Produk Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Katalog Produk'
			), 502);
		}
	}
}