<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	private $table = 'user';


	//Menampilkan Data Admin
	public function get_admin($id_admin)
	{
		$this->db->where('user_toko.id_user', $id_admin);
		$this->db->select('user_toko.id_user_toko, user.id_user, user.nama, user.email');
		$this->db->from('user_toko')->join('user', 'user_toko.id_user = user.id_user');
		return $this->db->get()->row();
	}

	//Menampilkan Data Admin
	public function get($id_user = null)
	{
		$this->db->select('id_user, nama, email, no_hp, photo, role');
		$this->db->from('user');
		$this->db->where('role =', 'admin');
		if ($id_user != null) {
			$this->db->where('id_user', $id_user);
		}
		return $this->db->get()->result();
	}

	//Menampilkan Data Admin Berdasarkan ID User
	public function by_id_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->select('id_user, nama, email, no_hp, photo, role');
		$this->db->from('user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Admin Berdasarkan Toko Yang Dimiliki Owner
	public function by_admin_toko($id_owner, $id_admin = null)
	{
		$this->db->where('toko.id_user', $id_owner);
		$this->db->select('user.id_user, user.nama, user.email, user.no_hp, toko.id_toko, toko.nama_toko, toko.id_user as id_owner, nama as nama_owner');
		$this->db->from('user_toko as ut')
			->join('user', 'ut.id_user = user.id_user')
			->join('toko', 'ut.id_toko = toko.id_toko');
		if ($id_admin != null) {
			$this->db->where('user.id_user', $id_admin);
			$this->db->select('user.photo');
		}
		return $this->db->get();
	}

	//Simpan Data Admin
	public function save($data, $upload)
	{
		$data = array(
			'nama'			=>$this->input->post('nama'),
			'email'			=>$this->input->post('email'),
			'password'		=>$this->input->post('password'),
			'no_hp'			=>$this->input->post('no_hp'),
			'photo' 		=> $upload['file']['photo'],
			'ukuran_file'	=> $upload['file']['file_size'],
			'tipe_file' 	=> $upload['file']['file_type']
		  );

			$this->curl->simple_post($this->api . 'admin', array(CURLOPT_BUFFERSIZE => 10));
			$this->session->set_flashdata('success-create', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");

		// if ($save) {
		// 	return true;
		// } else {
		// 	return false;
		// }
	}


	//edit data Admin
	public function update()
	{
		$data = array(
			"nama"         => $this->input->post('nama'),
			"email"        => $this->input->post('email'),
			"no_hp"        => $this->input->post('no_hp'),
			"photo"        => $this->input->post('photo'),
			"status_Admin"  => $this->input->post('status_Admin'),
		);
		return $this->db->update($this->table, $data, array('id_user' => $this->input->post('id_user')));
	}

	// Fungsi untuk melakukan proses upload file
	public function upload(){
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']  = '2048';
		$config['remove_space'] = TRUE;
	  
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('photo')){ // Lakukan upload dan Cek jika proses upload berhasil
		  // Jika berhasil :
		  $return = array('result' => 'success', 'file' => $this->api . 'admin', array(CURLOPT_BUFFERSIZE => 10), 'error' => '');
		  return $return;
		}else{
		  // Jika gagal :
		  $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		  return $return;
		}
	  }
}