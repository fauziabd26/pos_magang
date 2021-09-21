<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FotoProdukModel extends CI_Model
{
	private $table = "foto_produk";

	//Menampilkan Data Foto produk
	public function get($id_foto_produk = null)
	{
		$this->db->select('id_foto_produk, nama_foto_produk, produk.id_produk, produk.nama_produk, produk.jenis, user.id_user');
		$this->db->from('foto_produk')
			->join('produk', 'foto_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		if ($id_foto_produk != null) {
			$this->db->where('id_foto_produk', $id_foto_produk);
		}
		return $this->db->get();
	}

	//Menampilkan Data Foto produk Sesuai Owner
	public function by_id_user($id_user, $id_foto_produk = null)
	{
		$this->db->where('user.id_user', $id_user);
		$this->db->select('id_foto_produk, nama_foto_produk, produk.id_produk, produk.nama_produk, produk.jenis, user.id_user');
		$this->db->from('foto_produk')
			->join('produk', 'foto_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		if ($id_foto_produk != null) {
			$this->db->where('id_foto_produk', $id_foto_produk);
		}
		return $this->db->get();
	}

	//Simpan data Foto produk
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	//edit data Foto produk
	public function update()
	{
		$data = array(
			"nama_foto_produk"   => $this->input->post('nama_foto_produk'),
			"id_produk"   		 => $this->input->post('id_produk'),
		);
		return $this->db->update($this->table, $data, array('id_foto_produk' => $this->input->post('id_foto_produk')));
	}

	public function delete($id_foto_produk)
	{
		return $this->db->delete($this->table, array("id_foto_produk" => $id_foto_produk));
	}
}
