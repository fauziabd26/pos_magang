<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
	public function dashboard()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);
		
		// Count Data JSON
		$totalOwner = 0;
		foreach ($datas["user"] as $value) {
			foreach ($value['role'] as $role) {
				if ($role["id_role"] == 2) {
					$totalOwner = $totalOwner + 1;
				}
			}
		}
		
		$data = array('owners' => $datas["user"]);
		$data['totalOwner'] = $totalOwner; //Object

		// Count Data JSON 
		// $data['totalOwner'] = count($datas["user"]);


		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/dashboard', $data);
	}

	// Bagian Owner
	public function owner()
	{
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('owners' => $datas["user"]);

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/owner/index', $data);
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
		$getAPI = file_get_contents('fakeAPI.json');
		$datas = json_decode($getAPI, true);

		$data = array('owners' => $datas["user"]);

		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/index', $data);
	}

	public function validasiDetail()
	{
		$this->template->load('layouts/superAdmin/master', 'dashboard/superAdmin/validasi/detail');
	}
}
