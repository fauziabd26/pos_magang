<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	}
	protected $api = 'https://api.etoko.xyz/';

	public function ubah_profile($id_user)
	{
		$config['upload_path'] = './assets/img/user';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['photo']['name'];

		$this->upload->initialize($config);
		if (!empty($_FILES['photo']['name'])) {
			if ($this->upload->do_upload('photo')) {
				$foto = $this->upload->data();
				$data = array(
					'id_user'	=> $id_user,
					'nama'      => $_POST['nama'],
					'email'    	=> $_POST['email'],
					'no_hp'     => $_POST['no_hp'],
					'photo'     => $foto['file_name'],
				);
				$update = $this->curl->simple_put($this->api . 'profile', $data, array(CURLOPT_BUFFERSIZE => 10));
				if ($update) {
					$this->session->set_flashdata('success', "Data <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
				} else {
					$this->session->set_flashdata('error', 'Data Gagal diubah');
				}
				redirect('owner/dashboard');
			} else {
				die("gagal upload");
			}
		} else {
			echo "tidak masuk";
		}
	}
}
