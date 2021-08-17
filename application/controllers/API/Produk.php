<?php

defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }


    //Menampilkan data 
    function index_get() {
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
	function index_post() {
        // $p = $this->input->post();
		
        $data = array(
                    'id_produk'           => $this->post('id_produk'),
                    'id_toko'             => $this->post('id_toko'),
                    'nama_produk'         => $this->post('nama_produk'),
                    'foto_produk'         => $this->post('foto_produk'),
                    'jenis'               => $this->post('jenis'));
        $insert = $this->db->insert('produk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data yang telah ada
	function index_put() {
        $id_produk = $this->put('id_produk');
        $data      = array(
                    'id_produk'       => $this->put('id_produk'),
                    'id_toko'         => $this->put('id_toko'),
                    'nama_produk'     => $this->put('nama_produk'),
                    'foto_produk'     => $this->put('foto_produk'),
                    'jenis'           => $this->put('jenis'));
        $this->db->where('id_produk', $id_produk);
        $update = $this->db->update('produk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data 
	function index_delete() {
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
