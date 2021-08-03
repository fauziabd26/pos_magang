<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
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

    //Mengirim atau menambah data kontak baru
	function index_post() {
        $data = array(
                    'id_produk'           => $this->post('id_produk'),
                    'nama_produk'         => $this->post('nama_produk'),
                    'jenis'               => $this->post('jenis'));
        $insert = $this->db->insert('produk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data kontak yang telah ada
	function index_put() {
        $id_produk = $this->put('id_produk');
        $data      = array(
                    'id_produk'       => $this->put('id_produk'),
                    'nama_produk'     => $this->put('nama_produk'),
                    'jenis'           => $this->put('jenis'));
        $this->db->where('id_produk', $id_produk);
        $update = $this->db->update('produk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data kontak
	function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>