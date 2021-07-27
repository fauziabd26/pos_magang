<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/admin/master', 'admin/dashboard');
	}

	// Bagian Customer
	public function customer()
	{
		$this->template->load('layouts/admin/master', 'admin/customer/index');
	}

	public function customerTambah()
	{
		$this->template->load('layouts/admin/master', 'admin/customer/tambah');
	}

	public function customerEdit()
	{
		$this->template->load('layouts/admin/master', 'admin/customer/edit');
	}

	public function customerHapus()
	{
		$this->template->load('layouts/admin/master', 'admin/customer/tambah');
	}

	// Bagian Transaksi
	// Bagian Transaksi Produk
	public function transaksiProduk()
	{
		$this->template->load('layouts/admin/master', 'admin/transaksi/produk');
	}

	// Bagian Transaksi Jasa
	public function transaksiJasa()
	{
		$this->template->load('layouts/admin/master', 'admin/transaksi/jasa');
	}
}
