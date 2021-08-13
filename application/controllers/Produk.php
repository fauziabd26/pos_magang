<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("ProdukModel"); //load model produk
	}

	//method pertama yang akan di eksekusi
	public function index()
	{

		$data["title"] = "Data Produk";
		//ambil fungsi getAll untuk menampilkan semua data produk
		$data["produk"] = $this->ProdukModel->getAll();
		//load view header.php pada folder views/templates
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		//load view index.php pada folder views/produk
		$this->load->view('dashboard/owner/produk/index', $data);
		$this->load->view('templates/footer');
	}

	//method add digunakan untuk menampilkan form tambah data produk
	public function add()
	{
		$ProdukModel = $this->ProdukModel; //objek model
		$validation = $this->form_validation; //objek form validation
		$validation->set_rules($ProdukModel->rules()); //menerapkan rules validasi pada produk_model
		//kondisi jika semua kolom telah divalidasi, maka akan menjalankan method save pada produk_model
		if ($validation->run()) {
			$ProdukModel->save();
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Produk berhasil disimpan. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
			redirect("produk");
		}
		$data["title"] = "Tambah Data produk";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('produk/add', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id = null)
	{
		if (!isset($id)) redirect('produk');

		$produk = $this->produk_model;
		$validation = $this->form_validation;
		$validation->set_rules($produk->rules());

		if ($validation->run()) {
			$produk->update();
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data produk berhasil disimpan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
			redirect("produk");
		}
		$data["title"] = "Edit Data produk";
		$data["data_produk"] = $produk->getById($id);
		if (!$data["data_produk"]) show_404();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('produk/edit', $data);
		$this->load->view('templates/footer');
	}

	public function delete()
	{
		$id = $this->input->get('id');
		if (!isset($id)) show_404();
		$this->produk_model->delete($id);
		$msg['success'] = true;
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data produk berhasil dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
		$this->output->set_output(json_encode($msg));
	}
}
