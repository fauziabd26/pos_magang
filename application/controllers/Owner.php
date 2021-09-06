<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		//validasi jika user belum login
		check_not_login();
		check_owner();
	}

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'transaksi');
		$datas = json_decode($getAPI, true);

		// Count Data Transaksi
		$totalTransaksiBarang = 0;
		$totalTransaksiJasa = 0;

		// var_dump($datas);
		foreach ($datas["data"] as $value) {
			if ($value["jenis_transaksi"] == "barang") {
				$totalTransaksiBarang += 1;
			} elseif ($value["jenis_transaksi"] == "jasa") {
				$totalTransaksiJasa += 1;
			}
		}

		$data = array('transaksis' => $datas["data"]);
		$data['totalTransaksiBarang'] = $totalTransaksiBarang;
		$data['totalTransaksiJasa'] = $totalTransaksiJasa;

		$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard', $data);
	}

	public function profile()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/profile');
	}

	// Bagian Admin
	public function admin()
	{

		$getAPI = $this->curl->simple_get($this->api . 'admin');
		$datas = json_decode($getAPI, true);

		$data['admins'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
	}

	public function admin_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
	}

	public function proses_tambah_admin()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[255]');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|max_length[15]');
		$this->form_validation->set_rules('photo', 'Foto', 'required');

		$data = array(
			'nama' 		=> ucwords($_POST['nama']),
			'email' 	=> $_POST['email'],
			'password' 	=> $_POST['password'],
			'no_hp' 	=> $_POST['no_hp'],
			'photo' 	=> $_POST['photo'],
		);

		if ($this->form_validation->run() === false) {
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah');
		} else {
			$this->curl->simple_post($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
			$this->session->set_flashdata('success-create', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");
			redirect('owner/admin');
		}
	}

	public function admin_edit($id_user)
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin/' . $id_user);
		$datas = json_decode($getAPI, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Toko!'); 
			window.location.href = '" . base_url('owner/admin') . "'; </script>";
		} else {
			if ($datas['data']['id_user'] == $id_user) {
				$value = array(
					'id_user' => $datas['data']["id_user"],
					'nama' => $datas['data']["nama"],
					'email' => $datas['data']["email"],
					'no_hp' => $datas['data']["no_hp"],
					'photo' => $datas['data']["photo"],
				);
			}
			$data['admin'] = $value;
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/edit', $data);
		}
	}

	public function proses_edit_admin($id_user)
	{
		$data = array(
			'id_user' =>  $id_user,
			'nama' => $_POST["nama"],
			'email' => $_POST["email"],
			'no_hp' => $_POST["no_hp"],
		);
		$update = $this->curl->simple_put($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/admin');
	}

	public function admin_hapus($id_user)
	{
		if (empty($id_user)) {
			redirect('owner/admin');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'admin', array('id_user' => $id_user), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Admin Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/admin');
		}
	}

	public function admin_ubah_password($id_user)
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubah_password');
	}

	// Bagian Toko
	public function toko()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		$data['tokos'] = array_filter($datas['data'], function ($value) {
			return $value['id_user'] == $this->session->userdata('id_user');
		});

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
	}

	public function toko_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
	}

	public function proses_tambah_toko()
	{
		$data = array(
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko'],
			'id_user' => $this->session->userdata('id_user')
		);
		$insert = $this->curl->simple_post($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/toko');
	}

	public function toko_edit($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko/' . $id_toko);
		$datas = json_decode($getAPI, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Toko!'); 
			window.location.href = '" . base_url('owner/toko') . "'; </script>";
		} else {
			if ($datas['data']['id_toko'] == $id_toko) {
				if ($datas['data']['id_user'] == $this->session->userdata('id_user')) {
					$value = array(
						'id_toko' => $datas['data']["id_toko"],
						'nama_toko' => $datas['data']["nama_toko"],
						'deskripsi_toko' => $datas['data']["deskripsi_toko"],
						'alamat' => $datas['data']["alamat"],
						'status_toko' => $datas['data']["status_toko"],
					);
				} else {
					echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
						window.location.href = '" . base_url('owner/toko') . "'; </script>";
				}
			}
			$data['toko'] = $value;
			$this->template->load('layouts/owner/master', 'dashboard/owner/toko/edit', $data);
		}
	}

	public function proses_edit_toko($id_toko)
	{
		$data = array(
			'id_toko' =>  $id_toko,
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko'],
			'id_user' => $this->session->userdata('id_user')
		);
		$update = $this->curl->simple_put($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/toko');
	}

	// public function toko_hapus($id_toko)
	// {
	// 	if (empty($id_toko)) {
	// 		redirect('owner/toko');
	// 	} else {
	// 		$delete = $this->curl->simple_delete($this->api . 'toko', array('id_toko' => $id_toko), array(CURLOPT_BUFFERSIZE => 10));
	// 		if ($delete) {
	// 			$this->session->set_flashdata('success-delete', "Data Toko Terhapus !");
	// 		} else {
	// 			$this->session->set_flashdata('info', 'Data Gagal dihapus');
	// 		}
	// 		redirect('owner/toko');
	// 	}
	// }

	// Bagian Produk
	public function produk()
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/barang');
		$datas = json_decode($getAPI, true);

		$data['produks'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/produk/index', $data);
	}
	// Bagian Jasa
	public function index_jasa()
	{
		$getAPI = $this->curl->simple_get($this->api . 'api');
		$datas = json_decode($getAPI, true);

		$data = array('jasas' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/index', $data);
	}
	public function proses_tambah_jasa()
	{
		$data = array(
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko']
		);
		$insert = $this->curl->simple_post($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/toko');
	}

	public function toko_jasa($id_jasa)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
				$value = array(
					'id_toko' => $row["id_toko"],
					'nama_toko' => $row["nama_toko"],
					'deskripsi_toko' => $row["deskripsi_toko"],
					'alamat' => $row["alamat"],
					'status_toko' => $row["status_toko"],
				);
			}
		}
		$data['toko'] = $value;

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/edit', $data);
	}

	public function proses_edit_jasa($id_jasa)
	{
		$data = array(
			'id_toko' =>  $id_toko,
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko']
		);
		$update = $this->curl->simple_put($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/toko');
	}

	// Bagian Foto Produk
	public function index_foto_produk()
	{
		// arahkan ke url atau lokasi gambar berada
		$getAPI = file_get_contents('https://api.etoko.xyz/FotoProduk');

		$datas = json_decode($getAPI, true);

		$data = array('foto_produks' => $datas["data"]);

		// $data ini masukan ke json
		$this->template->load('layouts/owner/master', 'dashboard/owner/foto_produk/index', $data);
	}

	//Bagian Harga
	public function index_harga()
	{
		$getAPI = $this->curl->simple_get($this->api . 'harga');
		$datas = json_decode($getAPI, true);

		$data = array('hargas' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/index', $data);
	}
	public function harga_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/barang');
		$datas = json_decode($getAPI, true);

		$data = array('produks' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/tambah', $data);
	}

	public function proses_tambah_harga()
	{
		$data = array(
			'nama_harga' =>  ucwords($_POST['nama_harga']),
			'nominal' =>  ucfirst($_POST['nominal']),
			'id_produk' => ucfirst($_POST['id_produk'])
		);
		$insert = $this->curl->simple_post($this->api . 'Harga', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Toko <b>" . $_POST['nama_harga'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/index_harga');
	}

	public function harga_edit($id_harga)
	{

		$getAPI 		= $this->curl->simple_get($this->api . 'harga/' . $id_harga);
		$getAPIProduk 	= $this->curl->simple_get($this->api . 'produk/barang');
		$datas 			= json_decode($getAPI, true);
		$datasProduk = json_decode($getAPIProduk, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Harga!'); 
			window.location.href = '" . base_url('owner/index_harga') . "'; </script>";
		} else {
			if ($datas['data']['id_harga'] == $id_harga) {
				$value = array(
					'id_harga' 		=> $datas['data']["id_harga"],
					'nama_harga' 	=> $datas['data']["nama_harga"],
					'nominal' 		=> $datas['data']["nominal"],
					'id_produk' 	=> $datas['data']["id_produk"],
				);
			}
		}
		$data['harga'] = $value;
		$data['produks'] = $datasProduk['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/edit', $data);
	}

	public function proses_edit_harga($id_harga)
	{
		$data = array(
			'id_harga' =>  $id_harga,
			'nama_harga' =>  ucwords($_POST['nama_harga']),
			'nominal' => $_POST['nominal'],
			'id_produk' => $_POST['id_produk']
		);
		$update = $this->curl->simple_put($this->api . 'harga', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Harga <b>" . $_POST['nama_harga'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/index_harga');
	}

	public function harga_hapus($id_harga)
	{
		if (empty($id_harga)) {
			redirect('owner/index_harga');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'harga', array('id_harga' => $id_harga), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Harga Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/index_harga');
		}
	}
	//Bagian Kategori
	public function index_kategori()
	{
		// $getAPIKategori = $this->curl->simple_get($this->api . 'kategori');
		// $datasKategori = json_decode($getAPIKategori, true);

		// $getAPIToko = $this->curl->simple_get($this->api . 'toko');
		// $datasToko = json_decode($getAPIToko, true);

		// $data['kategories'] = $datasKategori["data"];
		// $data['tokos'] = $datasToko["data"];


		// $this->template->load('layouts/owner/master', 'dashboard/owner/kategori/index', $data);

		$curlKategori = curl_init();
		$curlToko = curl_init();

		curl_setopt_array($curlKategori, array(
			CURLOPT_URL => "https://api.etoko.xyz/kategori",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				'x-apikey : $2y$10$kvfxRLwEQOuysqEyzYmcwuVmv/dzqtp4IbSg0QRHkIiSXy65BKsC2',
				'x-signature : 8c220754d1b7f3dad83f4184da4c58a7e1df9a00'
			),
		));

		curl_setopt_array($curlToko, array(
			CURLOPT_URL => "https://api.etoko.xyz/toko",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				'x-apikey : $2y$10$kvfxRLwEQOuysqEyzYmcwuVmv/dzqtp4IbSg0QRHkIiSXy65BKsC2',
				'x-signature : 8c220754d1b7f3dad83f4184da4c58a7e1df9a00'
			),
		));

		$responseKategori = curl_exec($curlKategori);
		$responseToko = curl_exec($curlToko);
		$errKategori = curl_error($curlKategori);
		$errToko = curl_error($curlToko);

		curl_close($curlKategori);
		curl_close($curlToko);

		if ($errKategori || $errToko) {
			echo "cURL Error #:" . $errKategori;
		} else {
			// echo $response;
			$datasKategori = json_decode($responseKategori, true);
			$datasToko = json_decode($responseToko, true);

			$data['kategories'] = $datasKategori["data"];
			$data['tokos'] = $datasToko["data"];

			$this->template->load('layouts/owner/master', 'dashboard/owner/kategori/index', $data);
		}
	}

	public function proses_tambah_kategori()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.etoko.xyz/kategori",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_HTTPHEADER => array(
				'x-apikey : $2y$10$kvfxRLwEQOuysqEyzYmcwuVmv/dzqtp4IbSg0QRHkIiSXy65BKsC2',
				'x-signature : 8c220754d1b7f3dad83f4184da4c58a7e1df9a00'
			),
			CURLOPT_POSTFIELDS =>  array(
				'nama_kategori' =>  ucwords($_POST['nama_kategori']),
				'id_toko' =>  $_POST['id_toko'],
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}

	public function proses_hapus_kategori($id_kategori)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.etoko.xyz/kategori" . $id_kategori,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'DELETE',
			CURLOPT_HTTPHEADER => array(
				'x-apikey : $2y$10$kvfxRLwEQOuysqEyzYmcwuVmv/dzqtp4IbSg0QRHkIiSXy65BKsC2',
				'x-signature : 8c220754d1b7f3dad83f4184da4c58a7e1df9a00'
			),
			CURLOPT_POSTFIELDS =>  array(
				'id_kategori' =>  $id_kategori,
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($response) {
			$this->session->set_flashdata('success', "Data Kategori Terhapus !");
			redirect('owner/index_kategori');
		} else {
			echo "cURL Error #:" . $err;
		}
	}

	public function kategori_edit($id_toko)
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);

		foreach ($datas['data'] as $row) {
			if ($row['id_toko'] == $id_toko) {
				$value = array(
					'id_toko' => $row["id_toko"],
					'nama_toko' => $row["nama_toko"],
					'deskripsi_toko' => $row["deskripsi_toko"],
					'alamat' => $row["alamat"],
					'status_toko' => $row["status_toko"],
				);
			}
		}
		$data['toko'] = $value;

		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/edit', $data);
	}

	public function proses_edit_kategori($id_toko)
	{
		$data = array(
			'id_toko' =>  $id_toko,
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko']
		);
		$update = $this->curl->simple_put($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/toko');
	}

	//Bagian Satuan
	public function index_satuan()
	{
		$getAPI = $this->curl->simple_get($this->api . 'satuan');
		$datas = json_decode($getAPI, true);

		$data['satuans'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/index', $data);
	}
	public function satuan_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/barang');
		$getAPIToko = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);
		$datasToko = json_decode($getAPIToko, true);

		$data = array('produks' => $datas["data"]);
		$data['tokos'] = $datasToko['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/tambah', $data);
	}

	public function proses_tambah_satuan()
	{
		$data = array(
			'nama_satuan' =>  ucwords($_POST['nama_satuan']),
			'id_toko' =>  ucfirst($_POST['id_toko']),
			'id_produk' => ucfirst($_POST['id_produk'])
		);
		$insert = $this->curl->simple_post($this->api . 'satuan', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success-create', "Data Satuan <b>" . $_POST['nama_satuan'] . "</b> Berhasil Disimpan !");
		} else {
			$this->session->set_flashdata('info', 'data gagal disimpan.');
		}
		redirect('owner/index_satuan');
	}

	public function satuan_edit($id_satuan)
	{

		$getAPI 		= $this->curl->simple_get($this->api . 'satuan/' . $id_satuan);
		$getAPIProduk 	= $this->curl->simple_get($this->api . 'produk/barang');
		$getAPIToko 	= $this->curl->simple_get($this->api . 'toko');
		$datas 			= json_decode($getAPI, true);
		$datasProduk 	= json_decode($getAPIProduk, true);
		$datasToko 		= json_decode($getAPIToko, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Satuan!'); 
			window.location.href = '" . base_url('owner/index_satuan') . "'; </script>";
		} else {
			if ($datas['data']['id_satuan'] == $id_satuan) {
				$value = array(
					'id_satuan' 	=> $datas['data']["id_satuan"],
					'nama_satuan' 	=> $datas['data']["nama_satuan"],
					'id_toko' 		=> $datas['data']["id_toko"],
					'id_produk' 	=> $datas['data']["id_produk"],
				);
			}
		}
		$data['satuan'] = $value;
		$data['produks'] = $datasProduk['data'];
		$data['tokos'] = $datasToko['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/edit', $data);
	}

	public function proses_edit_satuan($id_satuan)
	{
		$data = array(
			'id_satuan' =>  $id_satuan,
			'nama_satuan' =>  ucwords($_POST['nama_satuan']),
			'id_toko' => $_POST['id_toko'],
			'id_produk' => $_POST['id_produk']
		);
		$update = $this->curl->simple_put($this->api . 'satuan', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Satuan <b>" . $_POST['nama_satuan'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/index_satuan');
	}

	public function satuan_hapus($id_satuan)
	{
		if (empty($id_satuan)) {
			redirect('owner/index_satuan');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'satuan', array('id_satuan' => $id_satuan), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Satuan Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/index_satuan');
		}
	}
	//Bagian Laporan Transaksi
	public function index_laporan_trans()
	{
		$getAPI = file_get_contents('https://api.etoko.xyz/index.php/transaksi');
		$datas = json_decode($getAPI, true);

		$data['transaksis'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/transaksi/index', $data);
	}


	//Bagian Laporan katalog produk
	public function index_laporan_katalog()
	{
		$getAPI = file_get_contents('json/owner/laporan/katalog_produk/read.json');
		$datas = json_decode($getAPI, true);

		$data['katalog_produk'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/katalog_produk/index', $data);
	}

	//Bagian Laporan Customer
	public function index_laporan_cust()
	{
		$getAPI = file_get_contents('json/owner/laporan/customer/read.json');
		$datas = json_decode($getAPI, true);

		$data['customers'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/customer/index', $data);
	}
}