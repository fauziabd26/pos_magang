<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("TokoModel"); //load model toko
    }

    //method pertama yang akan di eksekusi
    public function index(){
        $data["title"]      = "List Data Toko"; 
        $data["data_toko"]  = $this->TokoModel->getAll(); //ambil fungsi getAll untuk menampilkan semua data toko
    }

    public function add(){
        $Toko       = $this->TokoModel; //objek model
        $validation = $this->form_validation; //objek form validasi
        $validation->set_rules($Toko->rules()); //menerapkan rules validasi pada toko model
       
        //kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada toko model
        if($validation->run()){
            $Toko->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Mahasiswa berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect("toko");
        }

        $data["title"] = "Tambah Data Toko";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('templates/add',$data);
        $this->load->view('templates/footer');
    }

    public function edit($id_toko = null){
        if(!isset($id_toko)) redirect('toko');
        $Toko       = $this->TokoModel;
        $validation = $this->form_validation;
        $validation->set_rules($Toko->rules());
        
        if($validation->run()){
            $Toko->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Toko berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');

          redirect("toko");
        }

        $data["title"] = "Edit Data Toko";
        $data["data_toko"] = $Toko->getById($id_toko);
        if (!$data["data_toko"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('toko/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete(){
        $id = $this->input->get('id_toko');
        if (!isset($id_toko)) show_404();
        $this->TokoModel->delete($id_toko);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data toko berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        $this->output->set_output(json_encode($msg));
    }
}