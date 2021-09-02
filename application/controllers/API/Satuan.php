<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Satuan extends RestController{
    function __construct($config = 'rest'){

        parent::__construct($config);
        $this->load->database();
        $this->load->model('SatuanModel');
    }

    //Menampilkan data satuan
    function index_get($id_satuan = null){
        
        if(!empty($id_satuan)){
            $satuan = $this->SatuanModel->get($id_satuan);
        }else{
            $satuan = $this->SatuanModel->get();
        }
        $this->response(array(
            'status'    => true,
            'message'   => 'Data Satuan Berhasil Diambil',
            'data'      => $satuan
        ), 200);
    }

    //Menambah data satuan baru
    function index_post(){
        $data = array(
            'id_satuan'        => $this->post('id_satuan'),
            'nama_satuan'      => $this->post('nama_satuan'),
            'id_produk'        => $this->post('id_produk')
        );

        if($this->SatuanModel->save($data)){
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Satuan Berhasil Diambil',
                'data'      => '$data'
            ), 200);
        }else{
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Menambahkan Data Satuan'
            ), 502);
        }
    }

    //Memperbarui data satuan yang telah ada
	function index_put() {
        $id_satuan  = $this->put('id_satuan');
        $data       = array(
            'id_satuan'        => $this->put('id_satuan'),
            'nama_satuan'      => $this->put('nama_satuan'),
            'id_produk'        => $this->put('id_produk')
        );
                    
        $this->db->where('id_satuan', $id_satuan);
        $update = $this->db->update('satuan', $data);
        if ($update) {
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Satuan Berhasil Diambil',
                'data'      => $data
            ), 200);
        } else {
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Mengedit Data Satuan'
            ), 502);
        }
    }

    //Menghapus salah satu data toko
	function index_delete(){
        $id_satuan = $this->delete('id_satuan');
        $this->db->where('id_satuan', $id_satuan);

        if ($this->db->delete('satuan')) {
            $this->response(array(
                'status'    => true,
                'message'   => 'Data Satuan Berhasil Dihapus'
            ), 200);
        } else {
            $this->response(array(
                'status'    => false,
                'message'   => 'Gagal Menghapus Data Satuan'
            ), 502);
        }
    }
}

