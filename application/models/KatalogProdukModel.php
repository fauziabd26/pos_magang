<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KatalogProdukModel extends CI_Model
{
	private $table = 'detail_produk';

	//Menampilkan Semua Data Katalog Produk
	public function get($id_detail_produk = null)
	{
		$this->db->select('id_detail_produk, toko.nama_toko, user.nama AS nama_owner, produk.nama_produk, kategori.nama_kategori, satuan.nama_satuan, harga.nama_harga, detail_produk.nominal, produk.jenis');
		$this->db->from('detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user')
			->join('kategori', 'detail_produk.id_kategori = kategori.id_kategori')
			->join('harga', 'detail_produk.id_harga = harga.id_harga')
			->join('satuan', 'detail_produk.id_satuan = satuan.id_satuan');
		if ($id_detail_produk != null) {
			$this->db->where('id_detail_produk', $id_detail_produk);
		}
		return $this->db->get();
	}

	//Menampilkan Semua Data Katalog Produk Jenis Barang
	public function get_barang($id_detail_produk = null)
	{
		$this->db->where('produk.jenis =', 'barang');
		$this->db->select('id_detail_produk, toko.nama_toko, user.nama AS nama_owner, produk.nama_produk, kategori.nama_kategori, satuan.nama_satuan, harga.nama_harga, detail_produk.nominal, produk.jenis');
		$this->db->from('detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user')
			->join('kategori', 'detail_produk.id_kategori = kategori.id_kategori')
			->join('harga', 'detail_produk.id_harga = harga.id_harga')
			->join('satuan', 'detail_produk.id_satuan = satuan.id_satuan');
		if ($id_detail_produk != null) {
			$this->db->where('id_detail_produk', $id_detail_produk);
		}
		return $this->db->get();
	}

	//Menampilkan Semua Data Katalog Produk Jenis Jasa
	public function get_jasa($id_detail_produk = null)
	{
		$this->db->where('produk.jenis =', 'jasa');
		$this->db->select('id_detail_produk, toko.nama_toko, user.nama AS nama_owner, produk.nama_produk, kategori.nama_kategori, satuan.nama_satuan, harga.nama_harga, detail_produk.nominal, produk.jenis');
		$this->db->from('detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user')
			->join('kategori', 'detail_produk.id_kategori = kategori.id_kategori')
			->join('harga', 'detail_produk.id_harga = harga.id_harga')
			->join('satuan', 'detail_produk.id_satuan = satuan.id_satuan');
		if ($id_detail_produk != null) {
			$this->db->where('id_detail_produk', $id_detail_produk);
		}
		return $this->db->get();
	}

	//Menampilkan Semua Data Katalog Produk Sesuai Owner
	public function by_id_user($id_owner, $id_detail_produk = null)
	{
		$this->db->where('user.id_user', $id_owner);
		$this->db->select('id_detail_produk, toko.nama_toko, user.id_user, produk.id_produk, produk.nama_produk, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan, harga.id_harga, harga.nama_harga, detail_produk.nominal, produk.jenis');
		$this->db->from('detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('toko', 'produk.id_toko = toko.id_toko')
			->join('user', 'toko.id_user = user.id_user')
			->join('kategori', 'detail_produk.id_kategori = kategori.id_kategori')
			->join('harga', 'detail_produk.id_harga = harga.id_harga')
			->join('satuan', 'detail_produk.id_satuan = satuan.id_satuan');
		if ($id_detail_produk != null) {
			$this->db->where('id_detail_produk', $id_detail_produk);
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

	//edit data 
	public function update()
	{
		$data = array(
			"id_produk"         => $this->input->post('id_produk'),
			"id_harga"            => $this->input->post('id_harga'),
			"id_kategori"   => $this->input->post('id_kategori'),
			"id_satuan"            => $this->input->post('id_satuan'),
			"nominal"             => $this->input->post('nominal')
		);
		return $this->db->update($this->table, $data, array('id_detail_produk' => $this->input->post('id_detail_produk')));
	}

	//hapus data 
	public function delete($id_detail_produk)
	{
		return $this->db->delete($this->table, array("id_detail_produk" => $id_detail_produk));
	}
}
