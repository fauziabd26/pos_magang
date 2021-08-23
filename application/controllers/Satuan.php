<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("SatuanModel"); //load model satuan
    }

    //method pertama yang akan dieksekusi
    public function index(){
        $this->load->models {'SatuanModel'};
        $data["title"]          = "List Data Satuan";
        $data["data_satuan"]    = $this->SatuanModel->getAll(); //ambil fungsi getAll untuk menampilkan semua data satuan
    }

    public function add(){
        $Satuan     = $this->SatuanModel;
        $validation = $this->form_validation;
        $validation->set_rules($Satuan->rules());

        if($validation->run()){
            $Satuan->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Satuan berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect("satuan");
        }

        $data["title"] = "Tambah Data Satuan";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('templates/add',$data);
        $this->load->view('templates/footer');
    }

    public function edit($id_satuan = null){
        if(!isset($id_satuan)) redirect('satuan');
        $Satuan     = $this->SatuanModel;
        $validation = $this->form_validation;
        $validation->set_rules($Satuan->rules());

        if($validation->run()){
            $Satuan->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Toko berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

              redirect("satuan");
            }

        $data["title"] = "Edit Data Satuan";
        $data["data_satuan"] = $Satuan->getById($id_satuan);
        if (!$data["data_toko"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('toko/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete(){
        $id = $this->input->get('id_satuan');
        if (!isset($id_satuan)) show_404();
        $this->SatuanModel->delete($id_satuan);
        $msg['success'] = true;
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data toko berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');  
        $this->output->set_output(json_encode($msg));
    }
}