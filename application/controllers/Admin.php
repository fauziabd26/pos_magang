<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		// Count Data Customer
		$totalCustomer = 0;
		foreach ($datas["user"] as $value) {
			foreach ($value['role'] as $role) {
				if ($role["id_role"] == 4) {
					$totalCustomer += 1;
				}
			}
		}

		$data = array('customers' => $datas["user"]);
		$data['totalCustomer'] = $totalCustomer; //Object

		$this->template->load('layouts/admin/master', 'dashboard/admin/dashboard', $data);
	}

	// Bagian Customer
	public function customer()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('customers' => $datas["user"]);

		$this->template->load('layouts/admin/master', 'dashboard/admin/customer/index', $data);
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
