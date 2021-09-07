<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('fungsi');
        $this->load->model('TokoModel');
        $this->load->model('TransaksiModel');
        $this->load->model('DetailTransaksiModel');
    }

    function addcart($id_harga, $qty)
    {
    	if ($this->session->userdata('akses')) {
            $bmaster = $this->HargaModel->lihat_bmaster($id_harga);
            if ($bmaster->row()->sub_total >= $qty) {
	    	    $result = $this->HargaModel->cart($id_harga);
                $data = array(
                    'id_harga'    => $result[0]['id_harga'],
                    'sub_total'   => $result[0]['sub_total'],
                    'id_user'      => $result[0]['id_user'],
                    'qty'       => $qty,
                    'id_transaksi'     => $result[0]['id_transaksi']
                );
                $this->cart->insert($data);
                redirect(base_url('cart'));
            }else{
                $this->session->set_flashdata('message', 'Ooopss! Stok Barang Kosong atau Kurang dari Jumlah Order');
				redirect(base_url('cart'));
            }
		} else {
			redirect(base_url());
		}
    }
}