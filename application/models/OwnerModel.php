<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OwnerModel extends CI_Model
{
	private $table = "user";

	//Menampilkan Data 
	public function get($id_owner = null)
	{
		$this->db->where('role =', 'owner');
		$this->db->select('id_user, nama, no_hp, email, photo');
		$this->db->from('user');
		if ($id_owner != null) {
			$this->db->where('id_user', $id_owner);
		}
		return $this->db->get();
    }
}
