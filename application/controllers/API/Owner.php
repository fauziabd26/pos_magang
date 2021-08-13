<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Owner extends RestController{
    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data 
    function index_get(){
        $id_user = $this->get('id_user');
        if($id_user == ''){
            $owner =  $this->db->get('user')->result();
            // $this->db->where('id_role', 2);
        }else{
            $this->db->where('id_user', $id_user);
            $owner = $this->db->get('user')->result();
        }
        $this->response($owner, 200);
    }

    //Menambah data baru
    function index_post(){
        $data = array(
            'id_toko'        => $this->post('id_toko'),
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

?>

