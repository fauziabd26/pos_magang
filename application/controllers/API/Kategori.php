<?php
defined('BASEPATH') or exit('No direct script access allowed');
//require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Kategori extends RestController
{
	// private $id_user = 0;
	// public function __construct(){
	//     parent::__construct();
	// 	$this->load->database();
	// 	$this->load->model('KategoriModel');

	// 	$header = getallheaders();
	// 	$apikey = filter_var($header['x-apikey'], FILTER_CALLBACK, ['options' => function($hash) { return preg_replace('/[^a-zA-Z0-9$\/.]/', '', $hash);}]);

	// 	if(!empty($apikey))
	// 		{
	// 		$this->load->database();
	// 		$this->id_user = intval($this->db->where(array('apikey'=>$apikey,'status'=>'1'))->limit(1)->get('apikeys')->row('id_user'));
	// 		if($this->id_user > 0)
	// 			{
	// 			$this->apicheck($this->id_user,$header);
	// 			}
	// 			else response_json(401,"Invalid Key");
	// 		}
	// 		else response_json(401,"API Key Required"); 
	// }

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
			$kategori = $this->KategoriModel->get($id_kategori)->row();
		} else {
			$kategori =  $this->KategoriModel->get()->result();
		}

		$this->response(array(
			'status' => true,
			'message' => 'Data Kategori Berhasil Diambil',
			'data' => $kategori
		), 200);
	}

	//Menampilkan data berdasarkan ID User
	function by_id_user_get($id_user)
	{
		$kategori = $this->KategoriModel->by_id_user($id_user);
		$this->response(array(
			'status' => true,
			'message' => 'Data Kategori Berdasarkan ID User Berhasil Diambil',
			'data' => $kategori
		), 200);
	}

	//Menambah data toko baru
	function index_post()
	{
		$data = array(
			'nama_kategori'   => $this->post('nama_kategori'),
			'id_user'         => $this->post('id_user')
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
		$data       = array(
			'nama_kategori'   => $this->put('nama_kategori'),
			'id_user'         => $this->put('id_user')
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
