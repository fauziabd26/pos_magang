<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
	private $table = 'transaksi';

	//Menampilkan Data Transaksi
	public function get($id_transaksi = null)
	{
		$this->db->select('id_transaksi, nama_cust, diskon, total_transaksi, status, bayar, jenis_transaksi, tggl_transaksi, id_user, id_toko');
		$this->db->from('transaksi');
		if ($id_transaksi != null) {
			$this->db->where('id_transaksi', $id_transaksi);
			$this->db->select('id_user');
		}
		return $this->db->get();
	}

	public function get_transaksi_lunas()
	{
		$this->db->select('id_transaksi, nama_cust, diskon, total_transaksi, status, bayar, jenis_transaksi, tggl_transaksi, id_user, id_toko');
		$this->db->from('transaksi');
		$this->db->where('status =', 'lunas');
		$this->db->order_by('tggl_transaksi', 'DESC');
		return $this->db->get();
	}

	//Menampilkan Data Transaksi Barang
	public function get_barang($id_transaksi = null)
	{
		$this->db->select('id_transaksi, nama_cust, diskon, total_transaksi, status, bayar, jenis_transaksi, tggl_transaksi, id_user, id_toko');
		$this->db->from('transaksi');
		$this->db->where('jenis_transaksi =', 'barang');
		// $this->db->order_by('nama_cust', 'ASC');
		if ($id_transaksi != null) {
			$this->db->where('id_transaksi', $id_transaksi);
			$this->db->select('id_user');
		}
		return $this->db->get();
	}

	//Menampilkan Data Transaksi Jasa
	public function get_jasa($id_transaksi = null)
	{
		$this->db->select('id_transaksi, nama_cust, diskon, total_transaksi, status, bayar, jenis_transaksi, tggl_transaksi, id_user, id_toko');
		$this->db->from('transaksi');
		$this->db->where('jenis_transaksi =', 'jasa');
		// $this->db->order_by('nama_cust', 'ASC');
		if ($id_transaksi != null) {
			$this->db->where('id_transaksi', $id_transaksi);
			$this->db->select('id_user');
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
