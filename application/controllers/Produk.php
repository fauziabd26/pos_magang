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
		$this->load->view('view');
	}
}
