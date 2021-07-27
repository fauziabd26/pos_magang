<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/superAdmin/master', 'superAdmin/dashboard');
	}

	// Bagian Owner
	public function owner()
	{
		$this->template->load('layouts/superAdmin/master', 'superAdmin/owner/index');
	}

	public function ownerEdit()
	{
		$this->template->load('layouts/superAdmin/master', 'superAdmin/owner/edit');
	}

	public function ownerDetail()
	{
		$this->template->load('layouts/superAdmin/master', 'superAdmin/owner/detail');
	}
}
