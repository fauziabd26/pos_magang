<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FotoProdukModel extends CI_Model
{
	private $table = "foto_produk";

	//Menampilkan Data Foto produk
	public function get($id_foto_produk = null)
	{
		$this->db->select('id_foto_produk, nama_foto_produk, id_produk');
		$this->db->from('foto_produk');
		$this->db->order_by('nama_foto_produk', 'ASC');
		if ($id_foto_produk != null) {
			$this->db->where('id_foto_produk', $id_foto_produk);
		}
		return $this->db->get();
	}

	//Simpan data Foto produk
	public function save($data)
	{
		$save = $this->db->insert($this->table, $data);
		if ($save) {
			return true;
		} else {
			return false;
		}
	}

    //edit data Foto produk
    public function update(){
        $data = array(
            "nama_foto_produk"   => $this->input->post('nama_foto_produk'),
        );
        return $this->db->update($this->table, $data, array('id_foto_produk' => $this->input->post('id_foto_produk')));
    }

    public function delete($id_foto_produk)
    {
        return $this->db->delete($this->table, array("id_foto_produk" => $id_foto_produk));
    }

    public function do_upload()
    {
        $config['upload_path']          = 'assets/img/products';
		$config['allowed_types']        = 'gif|jpg|png';
		// $config['file_name']            = 'gambar2';
		$config['overwrite']            = true;
		$config['max_size']             = 2048;
		// $config['max_width']            = 10000;
		// $config['max_height']           = 10000;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('nama_foto_produk'))
		{
			return $this->upload->data();
		}
        return 'gambardefault.jpg';
    }

}
