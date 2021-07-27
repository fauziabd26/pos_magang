<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard');
	}

	// Bagian Customer
	public function customer()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/customer/index');
	}

	public function customerTambah()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/customer/tambah');
	}

	public function customerEdit()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/customer/edit');
	}


	// Bagian Transaksi
	// Bagian Transaksi Produk
	public function transaksiProduk()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/transaksi/produk');
	}

	// Bagian Transaksi Jasa
	public function transaksiJasa()
	{
		$this->template->load('layouts/admin/master', 'dashboard/admin/transaksi/jasa');
	}
}
