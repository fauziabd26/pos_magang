<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{
	private $table = 'produk';

	//Menampilkan Data Semua Produk Jenis Barang Berdasarkan Owner
	public function by_id_user($id_user)
	{
		$this->db->where('toko.id_user', $id_user);
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Semua Produk Jenis Barang Berdasarkan Owner
	public function barang_by_id_user($id_user)
	{
		$this->db->where('toko.id_user', $id_user);
		$this->db->where('jenis =', 'barang');
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Semua Produk Jenis jasa Berdasarkan Owner
	public function jasa_by_id_user($id_user)
	{
		$this->db->where('toko.id_user', $id_user);
		$this->db->where('jenis =', 'jasa');
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Semua Produk
	public function get_index($id_produk = null)
	{
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko, toko.id_user');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		if ($id_produk != null) {
			$this->db->where('id_produk', $id_produk);
		}
		return $this->db->get();
	}

	public function get_barang($id_produk = null)
	{
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko, toko.id_user');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		$this->db->where('jenis =', 'barang');
		if ($id_produk != null) {
			$this->db->where('id_produk', $id_produk);
		}
		return $this->db->get();
	}

	public function get_jasa($id_produk = null)
	{
		$this->db->select('id_produk, nama_produk, jenis, produk.id_toko, toko.nama_toko, toko.id_user');
		$this->db->from('produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user');
		$this->db->where('jenis =', 'jasa');
		if ($id_produk != null) {
			$this->db->where('id_produk', $id_produk);
		}
		return $this->db->get();
	}

	//Simpan Data 
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);

		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	// //edit data 
	// public function update()
	// {
	//     $data = array(
	//         "nama_produk" => $this->input->post('nama_produk'),
	//         "jenis"       => $this->input->post('jenis')
	//     );
	//     return $this->db->update($this->table, $data, array('IdProduk' => $this->input->post('IdProduk')));
	// }

	// //hapus data 
	// public function delete($id_produk)
	// {
	//     return $this->db->delete($this->table, array("id_produk" => $id_produk));
	// }
}
