<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	public function ubah_profile($id_user)
	{
		$data = array(
			'id_user'	=> $id_user,
			'nama'      => $_POST['nama'],
			'email'    	=> $_POST['email'],
			'no_hp'     => $_POST['no_hp'],
		);
		// var_dump($data);
		$update = $this->curl->simple_put($this->api . 'profile', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($update) {
			$this->session->set_flashdata('success', "Data <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('error', 'Data Gagal diubah');
		}
		redirect('owner/profile/' . $id_user);
	}
}
