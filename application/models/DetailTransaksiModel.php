<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
	private $table = 'detail_trans_produk';

	//validasi form, method ini akan mengembalikan data berupa rules validasi form
	public function rules()
	{
		return [
			[
				'field' => 'nama_toko', //samakan dengan atribut name pada tags input
				'label' => 'Nama Toko', //label yang akan ditampilkan pada pesan eror
				'rules' => 'trim|required' //rules validasi
			],
			[
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'trim|required'
			],
			[
				'field' => 'deskripsi_toko',
				'label' => 'Deskripsi Toko',
				'rules' => 'trim|required'
			],
			[
				'field' => 'foto_toko',
				'label' => 'Foto Toko',
				'rules' => 'trim|required'
			],
			[
				'field' => 'status_toko',
				'label' => 'Status Toko',
				'rules' => 'trim|required'
			],
		];
	}

	//Menampilkan Data 
	public function get_barang($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, id_user, id_produk, id_transaksi');
		$this->db->from('detail_trans_produk');
        // $this->db->where('jenis_transaksi =','barang');
		// $this->db->order_by('nama_cust', 'ASC');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_transaksi', $id_detail_trans_produk);
			$this->db->select('id_user');
		}
		return $this->db->get()->result();
	}

    public function get_jasa($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, id_user, id_produk, id_transaksi');
		$this->db->from('detail_transaksi');
        // $this->db->where('jenis_transaksi =','jasa');
		// $this->db->order_by('nama_cust', 'ASC');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
			$this->db->select('id_user');
		}
		return $this->db->get()->result();
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
