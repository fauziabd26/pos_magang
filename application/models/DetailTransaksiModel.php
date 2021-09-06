<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksiModel extends CI_Model
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
	public function get_index($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, id_user, id_harga, id_transaksi');
		$this->db->from('detail_trans_produk');
        // $this->db->where('jenis_transaksi =','barang');
		// $this->db->order_by('nama_cust', 'ASC');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_transaksi', $id_detail_trans_produk);
			$this->db->select('id_user');
		}
		return $this->db->get()->result();
	}

	// public function hitungSubTotal()
	// {
	// 	$this->db->HargaModel->id_harga('harga');
	// 	$this->db->select_sum('qty');
	// 	$query = $this->db->get('DetailTransaksi');
	// 	if($query->num_rows()>0)
	// 	{
	// 		return $query->row()->qty;
	// 	}
	// 	else
	// 	{
	// 		return 0;
	// 	}
	// }

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
