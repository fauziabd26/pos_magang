<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Kategori extends RestController{
    function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('KategoriModel');
	}

	//Menampilkan data
	function index_get($id_kategori = null)
	{
		if (!empty($id_kategori)) {
			$kategori = $this->KategoriModel->get($id_kategori);
		} else {
			$kategori =  $this->KategoriModel->get();
		}

		$this->response(array(
			'status' 	=> true,
			'message' 	=> 'Data Kategori Berhasil Diambil',
			'data' 		=> $kategori
		), 200);
	}

	//Menambah data toko baru
	function index_post()
	{
		$data = array(
			'nama_kategori'   => $this->post('nama_kategori'),
			'id_toko'         => $this->post('id_toko')
		);

		if ($this->KategoriModel->save($data)) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Kategori Berhasil Ditambah',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menambahkan Data Kategori'
			), 502);
		}
	}

	//Memperbarui data toko yang telah ada
	function index_put()
	{
		$id_kategori    = $this->put('id_kategori');
		$data = array(
			'nama_kategori'      => $this->put('nama_kategori'),
			'id_toko'            => $this->put('id_toko')
		);

		$this->db->where('id_kategori', $id_kategori);
		$update = $this->db->update('kategori', $data);
		if ($update) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Kategori Berhasil Diedit',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Mengedit Data Kategori'
			), 502);
		}
	}

	//Menghapus salah satu data toko
	function index_delete()
	{
		$id_kategori = $this->delete('id_kategori');
		$this->db->where('id_kategori', $id_kategori);
		
		if ($this->db->delete('kategori')) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Kategori Berhasil Dihapus',
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Gagal Menghapus Data Kategori'
			), 502);
		}
	}
}
