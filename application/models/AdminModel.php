<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	private $table = 'user';

	//validasi form, method ini akan mengembalikan data berupa rules validasi form
	public function rules()
	{
		return [
			[
				'field' => 'nama', //samakan dengan atribut name pada tags input
				'label' => 'Nama', //label yang akan ditampilkan pada pesan eror
				'rules' => 'trim|required' //rules validasi
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			],
			[
				'field' => 'no_hp',
				'label' => 'No HP',
				'rules' => 'trim|required'
			],
			[
				'field' => 'photo',
				'label' => 'Foto',
				'rules' => 'trim|required'
			],
		];
	}

	//Menampilkan Data Admin
	public function get($id_user = null)
	{
		$this->db->select('id_user, nama, email, no_hp, photo, role');
		$this->db->from('user');
        $this->db->where('role =','admin');
		if ($id_user != null) {
			$this->db->where('id_user', $id_user);
		}
		return $this->db->get();
	}

	//Simpan Data Admin
	public function save($data)
	{
		$post = $this->input->post();
		$this->nama		= $post["nama"];
		$this->email	= $post["email"];
		$this->no_ho	= $post["no_hp"];
		$this->photo	= $this->uploadImage();
		$save = $this->db->insert($this->table, $data);

		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	//edit data Admin
	public function update()
	{
		$post = $this->input->post;
		$data = array(
			"nama"         => $this->input->post('nama'),
			"email"        => $this->input->post('email'),
			"no_hp"        => $this->input->post('no_hp'),
			//"photo"        => $this->input->post('photo'),
			"status_Admin" => $this->input->post('status_Admin'),
		);

		if(!empty($_FILES["photo"]["nama"])){
			$this->photo = $this->uploadImage();
		}else{
			$this->photo = $post["old_image"];
		}
		return $this->db->update($this->table, $data, array('id_user' => $this->input->post('id_user')));
	}
	
	private function uploadImage()
	{
		$config['upload_path']          = './assets/foto_admin/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $this->id_user;
		$config['overwrite']			= true;
		$config['max_size']             = 2000; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('photo')) {
			return $this->upload->data("file_name");
		}
		
		return "default.jpg";
	}
}
