<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{
    private $table = 'produk';

    //validasi form, method ini akan mengembailkan data berupa rules validasi form       
    public function rules()
    {
        return [
            [
                'field' => 'nama_produk',  //samakan dengan atribute name pada tags input
                'label' => 'Nama Produk',  // label yang kan ditampilkan pada pesan error
                'rules' => 'trim|required' //rules validasi
            ],
            [
                'field' => 'jenis',
                'label' => 'Jenis Produk',
                'rules' => 'trim|required'
            ],
        ];
    }

    //Menampilkan Data 
	public function get_barang($id_produk = null)
	{
		$this->db->select('id_produk, nama_produk, jenis, id_toko, foto_produk');
		$this->db->from('produk');
        $this->db->where('jenis =','barang');
		// $this->db->order_by('nama_produk', 'ASC');
		if ($id_produk != null) {
			$this->db->where('id_produk', $id_produk);
			$this->db->select('foto_produk, id_toko');
		}
		return $this->db->get()->result();
	}

    public function get_jasa($id_produk = null)
	{
		$this->db->select('id_produk, nama_produk, jenis, id_toko, foto_produk');
		$this->db->from('produk');
        $this->db->where('jenis =','jasa');
		// $this->db->order_by('nama_produk', 'ASC');
		if ($id_produk != null) {
			$this->db->where('id_produk', $id_produk);
			$this->db->select('foto_produk, id_toko');
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
            "nama_produk" => $this->input->post('nama_produk'),
            "jenis"       => $this->input->post('jenis')
        );
        return $this->db->update($this->table, $data, array('IdProduk' => $this->input->post('IdProduk')));
    }

    //hapus data 
    public function delete($id_produk)
    {
        return $this->db->delete($this->table, array("IdProduk" => $id_produk));
    }
}