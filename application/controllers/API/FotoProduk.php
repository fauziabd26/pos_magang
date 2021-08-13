<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class FotoProduk extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data foto produk
    function index_get(){
        $id_foto_produk = $this->get('id_foto_produk');
        if($id_foto_produk == ''){
            $foto_produk =  $this->db->get('foto_produk')->result();
        }else{
            $this->db->where('id_foto_produk', $id_foto_produk);
            $foto_produk = $this->db->get('foto_produk')->result();
        }
        $this->response($foto_produk, 200);
    }

    //Menambah data foto produk baru
    function index_post(){
        $data = array(
            'id_foto_produk'    => $this->post('id_foto_produk'),
            'nama_foto_produk'  => $this->post('nama_foto_produk'),
            'id_produk'         => $this->post('id_produk'));

        $insert = $this->db->insert('foto_produk', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data foto produk yang telah ada
	function index_put() {
        $id_foto_produk  = $this->put('id_foto_produk');
        $data       = array(
            'id_foto_produk'    => $this->post('id_foto_produk'),
            'nama_foto_produk'  => $this->post('nama_foto_produk'),
            'id_produk'         => $this->post('id_produk'));
                    
        $this->db->where('id_foto_produk', $id_foto_produk);
        $update = $this->db->update('foto_produk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data toko
	function index_delete() {
        $id_foto_produk = $this->delete('id_foto_produk');
        $this->db->where('id_foto_produk', $id_foto_produk);
        $delete = $this->db->delete('toko');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

