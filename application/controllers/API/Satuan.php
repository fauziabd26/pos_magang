<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Satuan extends RestController{
    private $id_user = 0;
    public function __construct(){
        parent::__construct();
		
		$header = getallheaders();
		$apikey = filter_var($header['x-apikey'], FILTER_CALLBACK, ['options' => function($hash) { return preg_replace('/[^a-zA-Z0-9$\/.]/', '', $hash);}]);
		
		if(!empty($apikey))
			{
			$this->load->database();
			$this->id_user = intval($this->db->where(array('apikey'=>$apikey,'status'=>'1'))->limit(1)->get('apikeys')->row('id_user'));
			if($this->id_user > 0)
				{
				$this->apicheck($this->id_user,$header);
				}
				else response_json(401,"Invalid Key");
			}
			else response_json(401,"API Key Required"); 
    }

    //Menampilkan data satuan
    function index_get(){
        $id_satuan = $this->get('id_satuan');
        if($id_satuan == ''){
            $satuan =  $this->db->get('satuan')->result();
        }else{
            $this->db->where('id_satuan', $id_satuan);
            $satuan = $this->db->get('satuan')->result();
        }
        $this->response($satuan, 200);
    }

    //Menambah data satuan baru
    function index_post(){
        $data = array(
            'id_satuan'        => $this->post('id_satuan'),
            'nama_satuan'      => $this->post('nama_satuan'),
            'id_produk'        => $this->post('id_produk'));

        $insert = $this->db->insert('satuan', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
        // $p = $this->input->post();
		// response_json(200,json_encode($p));
		
    }

    //Memperbarui data satuan yang telah ada
	function index_put() {
        $id_satuan  = $this->put('id_satuan');
        $data       = array(
            'id_satuan'        => $this->post('id_satuan'),
            'nama_satuan'      => $this->post('nama_satuan'),
            'id_produk'        => $this->post('id_produk'));
                    
        $this->db->where('id_satuan', $id_satuan);
        $update = $this->db->update('satuan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data toko
	function index_delete() {
        $id_satuan = $this->delete('id_satuan');
        $this->db->where('id_satuan', $id_satuan);
        $delete = $this->db->delete('satuan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

