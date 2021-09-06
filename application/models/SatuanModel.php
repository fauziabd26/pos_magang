<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SatuanModel extends CI_Model{
    
    private $table = "satuan";

    public function rules(){
        return[
            [
                'field' => 'nama_satuan', //samakan dengan atribut name pada tags input
                'label' => 'Nama Satuan', //label yang akan ditampilkan pada pesan eror
                'rules' => 'trim|required' //rules validasi
            ],
        ];
    }

    //Menampilkan Data Satuan
    public function get($id_satuan = null)
    {
        $this->db->select('id_satuan, nama_satuan, id_produk');
        $this->db->from('satuan');
        $this->db->order_by('nama_satuan','ASC');
        if($id_satuan != null){
            $this->db->where('id_satuan', $id_satuan);
            $this->db->select('id_produk');
        }
        return $this->db->get();
    }

    //Simpan data satuan
    public function save($data){
        $save = $this->db->insert($this->table, $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    //edit data satuan
    public function update(){
        $data = array(
            "nama_satuan"   => $this->input->post('nama_satuan'),
        );
        return $this->db->update($this->table, $data, array('id_satuan' => $this->input->post('id_satuan')));
    }

    //hapus data mahasiswa
    public function delete($id_satuan)
    {
        return $this->db->delete($this->table, array("id_satuan" => $id_satuan));
    }
}