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

    //menampilkan data mahasiswa berdasarkan id mahasiswa
    public function getById($id_produk)
    {
        return $this->db->get_where($this->table, ["IdProduk" => $id_produk])->row();
        //query diatas seperti halnya query pada mysql 
        //select * from mahasiswa where IdMhsw='$id'
    }

    //menampilkan semua data mahasiswa
    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("IdProduk", "desc");
        $query = $this->db->get();
        return $query->result();
        //fungsi diatas seperti halnya query 
        //select * from mahasiswa order by IdMhsw desc
    }

    //menyimpan data mahasiswa
    public function save()
    {
        $data = array(
            "nama_produk"   => $this->input->post('nama_produk'),
            "jenis"         => $this->input->post('jenis')
        );
        return $this->db->insert($this->table, $data);
    }

    //edit data mahasiswa
    public function update()
    {
        $data = array(
            "nama_produk" => $this->input->post('nama_produk'),
            "jenis"       => $this->input->post('jenis')
        );
        return $this->db->update($this->table, $data, array('IdProduk' => $this->input->post('IdProduk')));
    }

    //hapus data mahasiswa
    public function delete($id_produk)
    {
        return $this->db->delete($this->table, array("IdProduk" => $id_produk));
    }
}