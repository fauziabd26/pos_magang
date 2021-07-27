<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/dashboard');
	}

	// Bagian Owner
	public function owner()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/index');
	}

	public function ownerEdit()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/edit');
	}

	public function ownerDetail()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/detail');
	}

	// Bagian Validasi
	public function validasiOwner()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/index');
	}

	public function validasiDetail()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/detail');
	}
}
