<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class FotoProduk extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
        $this->load->model('FotoProdukModel');
    }

    //Menampilkan data foto produk
    function index_get($id_foto_produk = null){

        if(!empty($id_foto_produk)){
            $foto_produk = $this->FotoProdukModel->get($id_foto_produk);
        }else{
            $foto_produk = $this->FotoProdukModel->get();
        }
        $this->response(array(
            'status'    => true,
            'message'   => 'Data Foto Produk Berhasil Diambil',
            'data'      => $id_foto_produk
        ), 200);
    }

    //Menambah data foto produk baru
    function index_post(){
        $data = array(
            'id_foto_produk'    => $this->post('id_foto_produk'),
            'nama_foto_produk'  => $this->post('nama_foto_produk'),
            'id_produk'         => $this->post('id_produk'));

        $insert = $this->FotoProdukModel->save('foto_produk', $data);
        if($insert){
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Foto Produk Berhasil Diambil',
                'data'      => $data
            ), 200);
        }else{
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Menambah Data Foto Produk'
            ), 502);
        }
    }

    //Memperbarui data foto produk yang telah ada
	function index_put() {
        $id_foto_produk  = $this->put('id_foto_produk');
        $data  = array(
            'id_foto_produk'    => $this->post('id_foto_produk'),
            'nama_foto_produk'  => $this->post('nama_foto_produk'),
            'id_produk'         => $this->post('id_produk')
        );
                    
        $this->db->where('id_foto_produk', $id_foto_produk);
        $update = $this->db->update('foto_produk', $data);
        
        if ($update) {
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Harga Berhasil Diedit',
                'data'      => $data
            ), 200);
        } else {
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Mengedit Data Foto Produk'
            ), 502);
        }
    }

    //Menghapus salah satu data toko
	function index_delete() {
        $id_foto_produk = $this->delete('id_foto_produk');
        $this->db->where('id_foto_produk', $id_foto_produk);

        if ($this->db->delete('foto_produk')) {
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Foto Produk Berhasil Dihapus'
            ), 201);
        } else {
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Menghapus Data Foto Produk'
            ), 502);
        }
    }
}

