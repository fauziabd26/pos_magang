<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Kategori extends RestController{
    public function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();        
    }

    //Menampilkan data kategori
    function index_get(){
        $id_kategori = $this->get('id_kategori');
        if($id_kategori == ''){
            $kategori =  $this->db->get('kategori')->result();
        }else{
            $this->db->where('id_kategori', $id_kategori);
            $kategori = $this->db->get('kategori')->result();
        }
        $this->response($kategori, 200);
    }

    //Menambah data kategori baru
    function index_post(){
        $data = array(
            'id_kategori'        => $this->post('id_kategori'),
            'nama_kategori'      => $this->post('nama_kategori'),
            'id_toko'            => $this->post('id_toko'));

        $insert = $this->db->insert('kategori', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data kategori yang telah ada
    function index_put(){
        $id_kategori    = $this->put('id_kategori');
        $data   = array(
            'id_kategori'        => $this->put('id_kategori'),
            'nama_kategori'      => $this->put('nama_kategori'),
            'id_toko'            => $this->put('id_toko'));                    
        $this->db->where('id_kategori', $id_kategori);
        $update = $this->db->update('kategori', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

	function index_delete() {
        $id_kategori = $this->delete('id_kategori');
        $this->db->where('id_kategori', $id_kategori);
        $delete = $this->db->delete('kategori');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}