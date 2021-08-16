<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Satuan extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
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
        $delete = $this->db->delete('toko');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

