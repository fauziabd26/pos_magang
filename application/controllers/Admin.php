<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function dashboard()
	{
		$this->template->load('layouts/admin/master', 'admin/dashboard');
	}
}
