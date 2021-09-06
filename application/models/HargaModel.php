<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HargaModel extends CI_Model
{

	private $table = "harga";

	public function rules()
	{
		return [
			[
				'field' => 'nama_harga', //samakan dengan atribut name pada tags input
				'label' => 'Nama Harga', //label yang akan ditampilkan pada pesan eror
				'rules' => 'trim|required' //rules validasi
			], [
				'field' => 'nominal', //samakan dengan atribut name pada tags input
				'label' => 'Nominal', //label yang akan ditampilkan pada pesan eror
				'rules' => 'trim|required' //rules validasi
			],
		];
	}

	//Menampilkan Data Harga
	public function get($id_harga = null)
	{
		$this->db->select('id_harga, nama_harga, nominal, harga.id_produk, produk.nama_produk, produk.jenis');
		$this->db->from('harga')->join('produk', 'harga.id_produk=produk.id_produk');
		if ($id_harga != null) {
			$this->db->where('id_harga', $id_harga);
			$this->db->select('harga.id_produk');
		}
		return $this->db->get();
	}

	//Simpan data Harga
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

	//edit data Harga
	public function update()
	{
		$data = array(
			"nama_harga"   => $this->input->post('nama_harga'),
			"nominal"      => $this->input->post('nominal'),

		);
		return $this->db->update($this->table, $data, array('id_harga' => $this->input->post('id_harga')));
	}

	public function delete($id_harga)
	{
		return $this->db->delete($this->table, array("id_harga" => $id_harga));
	}
}
