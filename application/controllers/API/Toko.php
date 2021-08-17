<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Toko extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data toko
    function index_get(){
        $id_toko = $this->get('id_toko');
        if($id_toko == ''){
            $toko =  $this->db->get('toko')->result();
        }else{
            $this->db->where('id_toko', $id_toko);
            $toko = $this->db->get('toko')->result();
        }
        $this->response($toko, 200);
    }

    //Menambah data toko baru
    function index_post(){
        $data = array(
            // 'id_toko'        => $this->post('id_toko'),
            'nama_toko'      => $this->post('nama_toko'),
            'alamat'         => $this->post('alamat'),
            'deskripsi_toko' => $this->post('deskripsi_toko'),
            'foto_toko'      => $this->post('foto_toko'),
            'status_toko'    => $this->post('status_toko'),
            'id_user'        => $this->post('id_user'));

        $insert = $this->db->insert('toko', $data);
        if($insert){
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data toko yang telah ada
	function index_put() {
        $id_toko    = $this->put('id_toko');
        $data       = array(
                    'id_toko'           => $this->put('id_toko'),
                    'nama_toko'         => $this->put('nama_toko'),
                    'alamat'            => $this->put('alamat'),
                    'deskripsi_toko'    => $this->put('deskripsi_toko'),
                    'foto_toko'         => $this->put('foto_toko'),
                    'status_toko'       => $this->put('status_toko'),
                    'id_user'           => $this->put('id_user'));
                    
        $this->db->where('id_toko', $id_toko);
        $update = $this->db->update('toko', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data toko
	function index_delete() {
        $id_toko = $this->delete('id_toko');
        $this->db->where('id_toko', $id_toko);
        $delete = $this->db->delete('toko');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

