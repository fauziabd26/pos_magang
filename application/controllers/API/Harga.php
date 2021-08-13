<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Harga extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data harga
    function index_get(){
        $id_harga = $this->get('id_harga');
        if($id_harga == ''){
            $harga =  $this->db->get('harga')->result();
        }else{
            $this->db->where('id_harga', $id_harga);
            $harga = $this->db->get('harga')->result();
        }
        $this->response($harga, 200);
    }

    //Menambah data harga baru
    function index_post(){
        $data = array(
            'id_harga'       => $this->post('id_harga'),
            'nama_harga'     => $this->post('nama_harga'),
            'nominal'        => $this->post('nominal'),
            'id_produk'      => $this->post('id_produk'));

        $insert = $this->db->insert('harga', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data harga yang telah ada
	function index_put() {
        $id_harga   = $this->put('id_harga');
        $data       = array(
            'id_harga'      => $this->put('id_harga'),
            'nama_harga'    => $this->put('nama_harga'),
            'nominal'       => $this->put('nominal'),
            'id_produk'     => $this->put('id_produk'));
                    
        $this->db->where('id_harga', $id_harga);
        $update = $this->db->update('harga', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data harga
	function index_delete() {
        $id_harga = $this->delete('id_harga');
        $this->db->where('id_harga', $id_harga);
        $delete = $this->db->delete('harga');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

