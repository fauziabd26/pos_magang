<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksiModel extends CI_Model
{
	private $table = 'detail_trans_produk';

	//SUM QTY di Detail Transaksi
	public function sum_qty($id_transaksi)
	{
		$this->db->select_sum('qty');
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->from('transaksi');
		return $this->db->get()->row();
	}

	//Menampilkan Data Detail Transaksi Sesuai Produk dan Transaksi Yang Dipilih
	public function cek_transaksi_detail($id_detail_trans_produk, $id_transaksi)
	{
		$this->db->where('id_detail_produk', $id_detail_trans_produk);
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->select('id_detail_trans_produk, sub_total, qty, id_detail_produk, id_transaksi');
		$this->db->from('detail_trans_produk');
		$this->db->order_by('id_detail_produk', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Menampilkan Data Detail Transaksi Sesuai Produk dan Transaksi Yang Dipilih
	public function get_detail_transaksi_by_customer($id_transaksi)
	{
		$this->db->where('detail_trans_produk.id_transaksi', $id_transaksi);
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, produk.nama_produk, detail_produk.nominal, detail_trans_produk.id_transaksi, transaksi.nama_cust, transaksi.jenis_transaksi, transaksi.tggl_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi')
			->join('user_toko', 'transaksi.id_user_toko = user_toko.id_user_toko')
			->join('user', 'user_toko.id_user = user.id_user');
		return $this->db->get()->result();
	}

	//Menampilkan Data Transaksi Jenis Barang Terakhir
	public function barang_lastId($id_admin)
	{
		return $this->db->select('*')
			->where('id_user_toko', $id_admin)
			->where('jenis_transaksi =', 'barang')
			->where('status =', 'belum lunas')
			->order_by('id_transaksi', 'DESC')
			->limit(1)
			->get('transaksi')->row();
	}

	//Menampilkan Data Transaksi Jenis Jasa Terakhir
	public function jasa_lastId($id_admin)
	{
		return $this->db->select('*')
			->where('id_user_toko', $id_admin)
			->where('jenis_transaksi =', 'jasa')
			->where('status =', 'belum lunas')
			->order_by('id_transaksi', 'DESC')
			->limit(1)
			->get('transaksi')->row();
	}

	//Menampilkan Data Detail Transaksi Berdasarkan ID Transaksi
	public function get_transaksi_by_id_user($id_user, $id_transaksi = null)
	{
		$this->db->where('user.id_user', $id_user);
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, produk.nama_produk, detail_produk.nominal, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi')
			->join('user_toko', 'transaksi.id_user_toko = user_toko.id_user_toko')
			->join('user', 'user_toko.id_user = user.id_user');
		if ($id_transaksi != null) {
			$this->db->where('detail_trans_produk.id_transaksi', $id_transaksi);
		}
		return $this->db->get();
	}

	public function get_detail_transaksi_by_transaksi($id_transaksi)
	{
		$this->db->where('detail_trans_produk.id_transaksi', $id_transaksi);
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, produk.nama_produk, detail_produk.nominal, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi')
			->join('user_toko', 'transaksi.id_user_toko = user_toko.id_user_toko')
			->join('user', 'user_toko.id_user = user.id_user');
		return $this->db->get()->result();
	}

	public function get($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, detail_produk.nominal, produk.nama_produk, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi');
		if ($id_detail_trans_produk != null) {
			$this->db->where('id_detail_trans_produk', $id_detail_trans_produk);
		}
		return $this->db->get();
	}

	public function get_barang($id_detail_trans_produk = null)
	{
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, detail_produk.nominal, produk.nama_produk, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi')
			->join('user_toko', 'transaksi.id_user_toko = user_toko.id_user_toko')
			->join('user', 'user_toko.id_user = user.id_user');
		$this->db->where('transaksi.jenis_transaksi =', 'barang');
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
		$this->db->select('id_detail_trans_produk, sub_total, qty, detail_trans_produk.id_detail_produk, detail_produk.nominal, produk.nama_produk, detail_trans_produk.id_transaksi, transaksi.jenis_transaksi');
		$this->db->from('detail_trans_produk')
			->join('detail_produk', 'detail_trans_produk.id_detail_produk = detail_produk.id_detail_produk')
			->join('produk', 'detail_produk.id_produk = produk.id_produk')
			->join('transaksi', 'detail_trans_produk.id_transaksi = transaksi.id_transaksi')
			->join('user_toko', 'transaksi.id_user_toko = user_toko.id_user_toko')
			->join('user', 'user_toko.id_user = user.id_user');
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
