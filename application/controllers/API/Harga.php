<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Harga extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('HargaModel');
	}

<<<<<<< HEAD
    //Menampilkan data harga
    function index_get($id_harga = null){
        if(!empty($id_harga)){
            $harga = $this->HargaModel->get($id_harga)->row();
        }else{
            $harga = $this->HargaModel->get()->result();
        }
        $this->response(array(
            'status'    => true,
            'message'   => 'Data Harga Berhasil Diambil',
            'data'      => $harga
        ), 200);
    }
=======
	//Menampilkan data harga
	function index_get($id_harga = null)
	{
		if (!empty($id_harga)) {
			$data = $this->HargaModel->get($id_harga)->row();
		} else {
			$data =  $this->HargaModel->get()->result();
		}
>>>>>>> ddf3b7b930318cdab08115d18fc89428aaaf1bb8

		if ($data) {
			$this->response(array(
				'status' => true,
				'message' => 'Data Harga Berhasil Diambil',
				'data' => $data
			), 200);
		} else {
			$this->response(array(
				'status' => false,
				'message' => 'Data Harga Tidak Ada',
			), 404);
		}
	}

	//Menambah data harga baru
	function index_post()
	{
		$data = array(
			'id_harga'       => $this->post('id_harga'),
			'nama_harga'     => $this->post('nama_harga'),
			'nominal'        => $this->post('nominal'),
			'id_produk'      => $this->post('id_produk')
		);

		if ($this->HargaModel->save($data)) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Ditambah',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menambah Data Harga'
			), 502);
		}
	}

	//Memperbarui data harga yang telah ada
	function index_put()
	{
		$id_harga   = $this->put('id_harga');
		$data       = array(
			'id_harga'      => $this->put('id_harga'),
			'nama_harga'    => $this->put('nama_harga'),
			'nominal'       => $this->put('nominal'),
			'id_produk'     => $this->put('id_produk')
		);

		$this->db->where('id_harga', $id_harga);
		$update = $this->db->update('harga', $data);

		if ($update) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Diedit',
				'data'      => $data
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Mengedit Dat Harga'
			), 502);
		}
	}

	//Menghapus salah satu data harga
	function index_delete()
	{
		$id_harga = $this->delete('id_harga');
		$this->db->where('id_harga', $id_harga);

		if ($this->db->delete('harga')) {
			$this->response(array(
				'status'    => true,
				'message'   => 'Data Harga Berhasil Dihapus'
			), 200);
		} else {
			$this->response(array(
				'status'    => false,
				'message'   => 'Gagal Menghapus Data Harga'
			), 502);
		}
	}
}
