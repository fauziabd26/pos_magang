<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	private $table = 'user';

	

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
		$data = array(
			"nama"         => $this->input->post('nama'),
			"email"        => $this->input->post('email'),
			"no_hp"        => $this->input->post('no_hp'),
			"photo"        => $this->input->post('photo'),
			"status_Admin"  => $this->input->post('status_Admin'),
		);
		return $this->db->update($this->table, $data, array('id_user' => $this->input->post('id_user')));
	}
}