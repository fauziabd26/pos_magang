<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KatalogProdukModel extends CI_Model
{
	private $table = 'detail_produk';

	public function get($id_detail_produk = null)
	{
		$this->db->select('id_detail_produk,  harga.nama_harga, detail_produk.nominal, produk.nama_produk, produk.jenis, kategori.nama_kategori, satuan.nama_satuan');
		$this->db->from('detail_produk')
			->join('harga', 'detail_produk.id_harga = harga.id_harga')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('satuan', 'detail_produk.id_satuan = satuan.id_satuan')
			->join('kategori', 'detail_produk.id_kategori = kategori.id_kategori');
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
