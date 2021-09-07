<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksiModel extends CI_Model
{
	private $table = 'detail_trans_produk';

	//Menampilkan Data 
	public function lastId()
	{
		return $this->db->select('id_transaksi')->order_by('id_transaksi', 'DESC')->limit(1)->get('transaksi')->row();
	}

	public function get_barang($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_harga, harga.nominal, produk.nama_produk, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('harga', 'detail_trans_produk.id_harga = harga.id_harga')
			->join('produk', 'harga.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi');
		$this->db->where('jenis_transaksi =', 'barang');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		}
		return $this->db->get(); 
	}

	public function get_where($id_detail_trans_produk)
	{
		$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		$this->db->select('id_detail_trans_produk');
		$this->db->from('detail_trans_produk');
		return $this->db->get();
	}

	public function get_jasa($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_harga, harga.nominal, produk.nama_produk, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('harga', 'detail_trans_produk.id_harga = harga.id_harga')
			->join('produk', 'harga.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi');
		$this->db->where('jenis_transaksi =', 'jasa');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
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

	public function saveTransaksi($data)
	{
		$this->db->insert('transaksi', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	//edit data 
	public function update()
	{
		$data = array(
			"nama_cust"         => $this->input->post('nama_cust'),
			"diskon"            => $this->input->post('diskon'),
			"total_transaksi"   => $this->input->post('total_transaksi'),
			"status"            => $this->input->post('status'),
			"bayar"             => $this->input->post('bayar'),
			"jenis_transaksi"   => $this->input->post('jenis_transaksi'),
			"tggl_transaksi"    => $this->input->post('tggl_transaksi'),
			"id_user"           => $this->input->post('id_user'),
			"id_toko"           => $this->input->post('id_toko')
		);
		return $this->db->update($this->table, $data, array('id_transaksi' => $this->input->post('id_transaksi')));
	}
}
