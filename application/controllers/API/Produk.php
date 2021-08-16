<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{
	private $id_user = 0;

	public function __construct()
	{
		parent::__construct();

		$header = getallheaders();
		$apikey = filter_var($header['x-apikey'], FILTER_CALLBACK, ['options' => function ($hash) {
			return preg_replace('/[^a-zA-Z0-9$\/.]/', '', $hash);
		}]);

		if (!empty($apikey)) {
			$this->load->database();
			$this->id_user = intval($this->db->where(array('apikey' => $apikey, 'status' => '1'))->limit(1)->get('apikeys')->row('id_user'));
			if ($this->id_user > 0) {
				$this->apicheck($this->id_user, $header);
			} else response_json(401, "Invalid Key");
		} else response_json(401, "API Key Required");
	}


	//Menampilkan data 
	function index_get()
	{
		$id_produk = $this->get('id_produk');
		if ($id_produk == '') {
			$produk = $this->db->get('produk')->result();
		} else {
			$this->db->where('id_produk', $id_produk);
			$produk = $this->db->get('produk')->result();
		}
		$this->response($produk, 200);
	}

	//Mengirim atau menambah data  baru
	function index_post()
	{
		$p = $this->input->post();

		$data = array(
			'id_produk'           => $this->post('id_produk'),
			'id_toko'             => $this->post('id_toko'),
			'nama_produk'         => $this->post('nama_produk'),
			'foto_produk'         => $this->post('foto_produk'),
			'jenis'               => $this->post('jenis')
		);
		$insert = $this->db->insert('produk', $data);
		if ($insert) {
			$this->response(json_encode($data, $p), 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//Memperbarui data yang telah ada
	function index_put()
	{
		$id_produk = $this->put('id_produk');
		$data      = array(
			'id_produk'       => $this->put('id_produk'),
			'id_toko'         => $this->put('id_toko'),
			'nama_produk'     => $this->put('nama_produk'),
			'jenis'           => $this->put('jenis')
		);
		$this->db->where('id_produk', $id_produk);
		$update = $this->db->update('produk', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//Menghapus salah satu data 
	function index_delete()
	{
		$id_produk = $this->delete('id_produk');
		$this->db->where('id_produk', $id_produk);
		$delete = $this->db->delete('produk');
		if ($delete) {
			$this->response(array('status' => 'success'), 201);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}
}
