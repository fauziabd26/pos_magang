<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//End load library phpspreadsheet

class Owner extends CI_Controller
{
	protected $api = 'https://api.etoko.xyz/';

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('FotoProdukModel');
		$this->load->library('pdfgenerator');
		//validasi jika user belum login
		check_not_login();
		check_owner();
	}

	public function dashboard()
	{
		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$getAPIAdmin = $this->curl->simple_get($this->api . 'admin/by_admin_toko/' . $this->session->userdata('id_user'));
		$datasAdmin = json_decode($getAPIAdmin, true);
		$getAPIKategori = $this->curl->simple_get($this->api . 'kategori/by_id_user/' . $this->session->userdata('id_user'));
		$datasKategori = json_decode($getAPIKategori, true);
		$getAPISatuan = $this->curl->simple_get($this->api . 'satuan/by_id_user/' . $this->session->userdata('id_user'));
		$datasSatuan = json_decode($getAPISatuan, true);
		$getAPIHarga = $this->curl->simple_get($this->api . 'harga/by_id_user/' . $this->session->userdata('id_user'));
		$datasHarga = json_decode($getAPIHarga, true);
		$getAPITransaksi = $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_owner/' . $this->session->userdata('id_user'));
		$datasTransaksi = json_decode($getAPITransaksi, true);
		if (!empty($datas || $datasTransaksi)) {
			// Count Data produk
			$totalProdukBarang = 0;
			$totalProdukJasa = 0;
			foreach ($datas["data"] as $value) {
				if ($value["jenis"] == "barang") {
					$totalProdukBarang += 1;
				} elseif ($value["jenis"] == "jasa") {
					$totalProdukJasa += 1;
				}
			}
			$totalAdmin = 0;
			foreach ($datasAdmin['data'] as $value) {
				$totalAdmin++;
			}
			$totalKategori = 0;
			foreach ($datasKategori['data'] as $value) {
				$totalKategori++;
			}
			$totalSatuan = 0;
			foreach ($datasSatuan['data'] as $value) {
				$totalSatuan++;
			}
			$totalHarga = 0;
			foreach ($datasHarga['data'] as $value) {
				$totalHarga++;
			}
			$data['transaksis'] = $datasTransaksi["data"];
			$data['produks'] = $datas['data'];
			$data['totalProdukBarang'] = $totalProdukBarang;
			$data['totalProdukJasa'] = $totalProdukJasa;
			$data['totalAdmin'] = $totalAdmin;
			$data['totalKategori'] = $totalKategori;
			$data['totalSatuan'] = $totalSatuan;
			$data['totalHarga'] = $totalHarga;
			$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/dashboard');
		}
	}

	public function profile()
	{
		$getAPI = $this->curl->simple_get($this->api . 'profile/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		if ($datas['data']['id_user'] == $this->session->userdata('id_user')) {
			$value = array(
				'id_user' => $datas['data']["id_user"],
				'nama' => $datas['data']["nama"],
				'email' => $datas['data']["email"],
				'no_hp' => $datas['data']["no_hp"],
				'photo' => $datas['data']["photo"],
			);
		}
		$data['data'] = $value;
		$this->template->load('layouts/owner/master', 'dashboard/owner/profile', $data);
	}

	// Bagian Admin
	public function admin()
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin/by_admin_toko/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		if (!empty($datas)) {
			$data['admins'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/index');
		}
	}

	public function admin_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$data['tokos'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah', $data);
	}

	public function proses_tambah_admin()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[255]', array(
			'required' => 'Nama Wajib Diisi.'
		));
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]', array(
			'required' => 'Email Wajib Diisi.'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]', array(
			'required' => 'Password Wajib Diisi.', 'min_length' => 'Password Minimal 8 Karakter'
		));
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|min_length[8]', array(
			'required' => 'Konfirmasi Password Wajib Diisi.', 'min_length' => 'Password Harus Sama'
		));
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required|min_length[10]|max_length[15]', array(
			'required' => 'Nomor HP Wajib Diisi.', 'min_length' => 'Nomor HP Minimal 10 Digit', 'max_length' => 'Nomor HP Maksimal 15 Digit'
		));
		// $this->form_validation->set_rules('photo', 'photo', 'required', array(
		// 	'required' => 'Photo Wajib Diisi.'
		// ));

		$getAPI = $this->curl->simple_get($this->api . 'admin');
		$datas = json_decode($getAPI, true);

		if ($this->form_validation->run() === false) {
			foreach ($datas['data'] as $row) {
				if ($row['email'] == $_POST['email']) {
					echo "<script> alert('Email Sudah Dipakai!'); 
					window.location.href = '" . base_url('owner/admin/admin_tambah') . "'; </script>";
				}
			}
			$getAPI = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
			$datas = json_decode($getAPI, true);
			$data['tokos'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/tambah', $data);
		} else {
			$config['upload_path'] = './assets/img/user';
			$config['allowed_types'] = 'jpg|png|jpeg|gif';
			$config['max_size'] = '2048';  //2MB max
			$config['max_width'] = '4480'; // pixel
			$config['max_height'] = '4480'; // pixel
			$config['file_name'] = $_FILES['photo']['name'];
			$this->upload->initialize($config);
			if (!empty($_FILES['photo']['name'])) {
				if ($this->upload->do_upload('photo')) {
					foreach ($datas['data'] as $row) {
						if ($row['email'] == $_POST['email']) {
							$this->session->set_flashdata('error', "Email Sudah Ada !");
							redirect('owner/admin_tambah');
						}
					}
					$foto = $this->upload->data();
					$data = array(
						'nama' 		=> ucwords($_POST['nama']),
						'email' 	=> $_POST['email'],
						'password' 	=> $_POST['password'],
						'no_hp' 	=> $_POST['no_hp'],
						'photo'     => $foto['file_name'],
					);
					$this->curl->simple_post($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
					$getAPILastAdmin = $this->curl->simple_get($this->api . 'admin/last_admin');
					$datasLastAdmin = json_decode($getAPILastAdmin, true);
					$data2 = array(
						'id_user'     => $datasLastAdmin['data']['id_user'],
						'id_toko'     => $_POST['id_toko'],
					);
					$insert = $this->curl->simple_post($this->api . 'UserToko', $data2, array(CURLOPT_BUFFERSIZE => 10));
					if ($insert) {
						$this->session->set_flashdata('success', "Data Admin <b>" . $_POST['nama'] . "</b> Berhasil Disimpan !");
					} else {
						$this->session->set_flashdata('error', 'Data Gagal diubah');
					}
					redirect('owner/admin');
				} else {
					die("gagal upload");
				}
			} 
			else {
				$data = array(
					'nama'      		=> $_POST['nama'],
					'email'      		=> $_POST['email'],
					'no_hp'      		=> $_POST['no_hp'],
				);
				
				$this->curl->simple_post($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
				$getAPILastAdmin = $this->curl->simple_get($this->api . 'admin/last_admin');
					$datasLastAdmin = json_decode($getAPILastAdmin, true);
					$data2 = array(
						'id_user'     => $datasLastAdmin['data']['id_user'],
						'id_toko'     => $_POST['id_toko'],
					);
				$insert = $this->curl->simple_post($this->api . 'UserToko', $data2, array(CURLOPT_BUFFERSIZE => 10));
				if ($insert) {
					$this->session->set_flashdata('success', "Data <b>" . $_POST['nama'] . "</b> Berhasil Ditambah !");
				} else {
					$this->session->set_flashdata('error', 'Data Gagal diubah');
				}
				redirect('owner/admin/');
			}
		}
	}

	public function admin_edit($id_admin)
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin/by_admin_toko/' . $this->session->userdata('id_user') . '/' . $id_admin);
		$datas = json_decode($getAPI, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Admin!'); 
			window.location.href = '" . base_url('owner/admin') . "'; </script>";
		} else {
			if ($datas['data']['id_owner'] == $this->session->userdata('id_user')) {
				if ($datas['data']['id_user'] == $id_admin) {
					$value = array(
						'id_user' => $datas['data']["id_user"],
						'nama' => $datas['data']["nama"],
						'email' => $datas['data']["email"],
						'no_hp' => $datas['data']["no_hp"],
						'photo' => $datas['data']["photo"],
					);
				} else {
					echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
					window.location.href = '" . base_url('owner/toko') . "'; </script>";
				}
			}
			$getAPI = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
			$datas = json_decode($getAPI, true);
			$data['tokos'] = $datas['data'];
			$data['admin'] = $value;
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/edit', $data);
		}
	}

	public function proses_edit_admin($id_user)
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin/' . $id_user);
		$datas = json_decode($getAPI, true);

		$path = './assets/img/user/';

		$config['upload_path'] = './assets/img/user';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['photo']['name'];

		$this->upload->initialize($config);
		if (!empty($_FILES['photo']['name'])) {
			if ($this->upload->do_upload('photo')) {
				$foto = $this->upload->data();
				$data = array(
					'id_user'			=> $id_user,
					'nama'      		=> $_POST['nama'],
					'email'      		=> $_POST['email'],
					'no_hp'      		=> $_POST['no_hp'],
					'photo'  			=> $foto['file_name'],
				);

				@unlink($path.$datas['data']['photo']);
				$this->curl->simple_put($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
				$getAPILastAdmin = $this->curl->simple_get($this->api . 'admin/by_admin_toko/'.$this->session->userdata('id_user').'/'.$id_user);
				$datasLastAdmin = json_decode($getAPILastAdmin, true);
				$data2 = array(
					'id_user'     => $datasLastAdmin['data']['id_user'],
					'id_toko'     => $_POST['id_toko'],
				);
				$update = $this->curl->simple_put($this->api . 'UserToko', $data2, array(CURLOPT_BUFFERSIZE => 10));
				if ($update) {
					$this->session->set_flashdata('success', "Data <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
				} else {
					$this->session->set_flashdata('error', 'Data Gagal diubah');
				}
				redirect('owner/admin/' . $id_user);
			} else {
				die("gagal upload");
			}
		} else {
			$data = array(
				'id_user'			=> $id_user,
				'nama'      		=> $_POST['nama'],
				'email'      		=> $_POST['email'],
				'no_hp'      		=> $_POST['no_hp'],
				'photo'  			=> $datas['data']['photo'],
			);

			$getAPI = $this->curl->simple_get($this->api . 'admin/cek_email/' . $id_user);
			$datas = json_decode($getAPI, true);

			foreach ($datas['data'] as $row) {
				if ($row['email'] == $data['email']) {
					$this->session->set_flashdata('error', "Email Sudah Ada !");
					redirect('owner/admin_edit/' . $id_user);
				}
			}
			$getadmin = $this->curl->simple_get($this->api . 'admin/cek_email');
			$datasadmin = json_decode($getadmin, true);

			if ($datas['email'] == $data['email']) {
				// $this->session->set_flashdata('error', "Email kamu sama !");
				// redirect('owner/admin_edit/'.$id_user);
				if ($datasadmin['email'] == $data['email']) {
					$this->session->set_flashdata('error', "Email Sudah Ada !");
					redirect('owner/admin_edit/' . $id_user);
				}
			}
			$this->curl->simple_put($this->api . 'admin', $data, array(CURLOPT_BUFFERSIZE => 10));
			$getAPILastAdmin = $this->curl->simple_get($this->api . 'admin/by_admin_toko/'.$this->session->userdata('id_user').'/'.$id_user);
			$datasLastAdmin = json_decode($getAPILastAdmin, true);
			$data2 = array(
				'id_user'     => $datasLastAdmin['data']['id_user'],
				'id_toko'     => $_POST['id_toko'],
			);
			$update = $this->curl->simple_put($this->api . 'UserToko', $data2, array(CURLOPT_BUFFERSIZE => 10));
			if ($update) {
				$this->session->set_flashdata('success', "Data <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
			} else {
				$this->session->set_flashdata('error', 'Data Gagal diubah');
			}
			redirect('owner/admin/');
		}
	}

	public function admin_hapus($id_user)
	{
		if (empty($id_user)) {
			redirect('owner/admin');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'admin', array('id_user' => $id_user), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success', "Data Admin Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/admin');
		}
	}

	public function admin_ubah_password($id_admin)
	{
		$getAPI = $this->curl->simple_get($this->api . 'admin/by_admin_toko/' . $this->session->userdata('id_user') . '/' . $id_admin);
		$datas = json_decode($getAPI, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Admin!'); 
			window.location.href = '" . base_url('owner/admin') . "'; </script>";
		} else {
			if ($datas['data']['id_owner'] == $this->session->userdata('id_user')) {
				if ($datas['data']['id_user'] == $id_admin) {
					$value = array(
						'id_user' => $datas['data']["id_user"],
						'password' => $datas['data']["password"],
					);
				} else {
					echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
					window.location.href = '" . base_url('owner/toko') . "'; </script>";
				}
			}
			$data['admin'] = $value;
			$this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubah_password', $data);
		}
		// $this->template->load('layouts/owner/master', 'dashboard/owner/admin/ubah_password');
	}

	public function proses_ubah_password($id_user)
	{
		$data = array(
			'id_user' =>  $id_user,
			'password' => $_POST['password']
		);
		$update = $this->curl->simple_put($this->api . 'admin/ubah_password', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($update) {
			$this->session->set_flashdata('success', "Ubah Password <b>" . $_POST['nama'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Ubah Password Gagal diubah');
		}
		redirect('owner/admin');
	}

	// Bagian Toko
	public function toko()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko');
		$datas = json_decode($getAPI, true);
		if (!empty($datas)) {
			$data['tokos'] = array_filter($datas['data'], function ($value) {
				return $value['id_user'] == $this->session->userdata('id_user');
			});

			$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/toko/index');
		}
	}

	public function toko_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
	}

	public function proses_tambah_toko()
	{
		$this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required|max_length[255]', array(
			'required' => 'Nama Toko Wajib Diisi'
		));
		$this->form_validation->set_rules('deskripsi_toko', 'Deskripsi Toko', 'required|max_length[255]', array(
			'required' => 'Deskripsi Toko Wajib Diisi'
		));
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[255]', array(
			'required' => 'Alamat Wajib Diisi'
		));
		$this->form_validation->set_rules('foto_toko', 'Dokumen Foto', 'required', array(
			'required' => 'Dokumen Toko Wajib Diisi'
		));

		$data = array(
			'nama_toko' =>  ucwords($_POST['nama_toko']),
			'alamat' =>  ucfirst($_POST['alamat']),
			'deskripsi_toko' => ucfirst($_POST['deskripsi_toko']),
			'foto_toko' => $_POST['foto_toko'],
			'id_user' => $this->session->userdata('id_user')
		);

		if ($this->form_validation->run() === false) {
			$this->template->load('layouts/owner/master', 'dashboard/owner/toko/tambah');
		} else {
			$insert = $this->curl->simple_post($this->api . 'toko', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('success', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Disimpan !");
			} else {
				$this->session->set_flashdata('error', 'Gagal Menambahkan Data Toko !');
			}
			redirect('owner/toko');
		}
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
			$this->session->set_flashdata('success', "Data Toko <b>" . $_POST['nama_toko'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('error', 'Data Gagal diubah');
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
		$getAPI = $this->curl->simple_get($this->api . 'produk/barang_by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data['produks'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/produk/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/produk/index');
		}
	}

	public function produk_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$data['tokos'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/produk/tambah', $data);
	}

	public function proses_tambah_produk()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|max_length[255]', array(
			'required' => 'Barang Wajib Diisi.'
		));
		$this->form_validation->set_rules('jenis', 'Jenis', 'required', array(
			'required' => 'Jenis Produk Wajib Diisi.'
		));
		$this->form_validation->set_rules('id_toko', 'Toko', 'required', array(
			'required' => 'Toko Wajib Diisi.'
		));
		$data = array(
			'nama_produk' =>  ucwords($_POST['nama_produk']),
			'jenis' =>  ucfirst($_POST['jenis']),
			'id_toko' => ucfirst($_POST['id_toko'])
		);
		if ($this->form_validation->run() === false) {
			$getAPIToko = $this->curl->simple_get($this->api . 'toko');
			$datasToko = json_decode($getAPIToko, true);

			$data['tokos'] = $datasToko['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/produk/tambah', $data);
		} else {
			$insert = $this->curl->simple_post($this->api . 'produk/barang', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('success', "Data Produk <b>" . $_POST['nama_produk'] . "</b> Berhasil Disimpan !");
			} else {
				$this->session->set_flashdata('info', 'data gagal disimpan.');
			}
			redirect('owner/produk');
		}
	}

	public function produk_edit($id_produk)
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/barang_by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$getAPIToko = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
		$datasToko = json_decode($getAPIToko, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Produk!'); 
			window.location.href = '" . base_url('owner/produk') . "'; </script>";
		} else {
			foreach ($datas['data'] as $row) {
				if ($row['id_produk'] == $id_produk) {
					$value = array(
						'id_produk' 	=> $row["id_produk"],
						'nama_produk' 	=> $row["nama_produk"],
						'jenis' 		=> $row["jenis"],
						'id_toko' 		=> $row["id_toko"],
					);
				}
			}
		}
		$data['produks'] = $value;
		$data['tokos'] = $datasToko['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/produk/edit', $data);
	}

	public function proses_edit_produk($id_produk)
	{
		$data = array(
			'id_produk' =>  $id_produk,
			'nama_produk' =>  ucwords($_POST['nama_produk']),
			'jenis' =>  ucwords($_POST['jenis']),
			'id_toko' => $_POST['id_toko']
		);
		$update = $this->curl->simple_put($this->api . 'produk/barang', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Produk <b>" . $_POST['nama_produk'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/produk');
		// var_dump($update);
	}

	public function produk_hapus($id_produk)
	{
		if (empty($id_produk)) {
			redirect('owner/produk');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'produk/barang', array('id_produk' => $id_produk), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Produk Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/produk');
		}
	}

	// Bagian Jasa
	public function index_jasa()
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/jasa_by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data = array('jasas' => $datas["data"]);
			$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/index');
		}
	}

	public function jasa_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$data['tokos'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/tambah', $data);
	}

	public function proses_tambah_jasa()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|max_length[255]', array(
			'required' => 'Jasa Wajib Diisi.'
		));
		$this->form_validation->set_rules('jenis', 'Jenis', 'required', array(
			'required' => 'Jenis Produk Wajib Diisi.'
		));
		$this->form_validation->set_rules('id_toko', 'Toko', 'required', array(
			'required' => 'Toko Wajib Diisi.'
		));
		$data = array(
			'nama_produk' =>  ucwords($_POST['nama_produk']),
			'jenis' =>  ucfirst($_POST['jenis']),
			'id_toko' => ucfirst($_POST['id_toko'])
		);
		if ($this->form_validation->run() === false) {
			$getAPIToko = $this->curl->simple_get($this->api . 'toko');
			$datasToko = json_decode($getAPIToko, true);

			$data['tokos'] = $datasToko['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/tambah', $data);
		} else {
			$insert = $this->curl->simple_post($this->api . 'produk/jasa', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('success-create', "Data Produk Jasa <b>" . $_POST['nama_produk'] . "</b> Berhasil Disimpan !");
			} else {
				$this->session->set_flashdata('info', 'data gagal disimpan.');
			}
			redirect('owner/index_jasa');
		}
	}

	public function jasa_edit($id_produk)
	{
		$getAPI = $this->curl->simple_get($this->api . 'produk/jasa_by_id_user/' . $id_produk);
		$datas = json_decode($getAPI, true);
		$getAPIToko = $this->curl->simple_get($this->api . 'toko/by_id_user_valid/' . $this->session->userdata('id_user'));
		$datasToko = json_decode($getAPIToko, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Jasa!'); 
			window.location.href = '" . base_url('owner/produk') . "'; </script>";
		} else {
			if ($datas['data']['id_produk'] == $id_produk) {
				$value = array(
					'id_produk' 	=> $datas['data']["id_produk"],
					'nama_produk' 	=> $datas['data']["nama_produk"],
					'jenis' 		=> $datas['data']["jenis"],
					'id_toko' 		=> $datas['data']["id_toko"],
				);
			}
		}
		$data['jasas'] = $value;
		$data['tokos'] = $datasToko['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/jasa/edit', $data);
	}

	public function proses_edit_jasa($id_produk)
	{
		$data = array(
			'id_produk' =>  $id_produk,
			'nama_produk' =>  ucwords($_POST['nama_produk']),
			'jenis' =>  ucwords($_POST['jenis']),
			'id_toko' => $_POST['id_toko']
		);
		$update = $this->curl->simple_put($this->api . 'produk/jasa', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Produk Jasa <b>" . $_POST['nama_produk'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/index_jasa');
	}

	public function jasa_hapus($id_produk)
	{
		if (empty($id_produk)) {
			redirect('owner/index_jasa');
		} else {
			$delete = $this->curl->simple_delete($this->api . 'produk/jasa', array('id_produk' => $id_produk), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success-delete', "Data Produk Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/index_jasa');
		}
	}

	// Bagian Foto Produk
	public function index_foto_produk()
	{
		$getAPI = $this->curl->simple_get($this->api . 'fotoProduk/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data['foto_produks'] = $datas["data"];
			$this->template->load('layouts/owner/master', 'dashboard/owner/foto_produk/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/foto_produk/index');
		}
	}

	// Bagian Foto Produk
	public function foto_produk_tambah()
	{
		$getAPIProduk = $this->curl->simple_get($this->api . 'produk/by_id_user/' . $this->session->userdata('id_user'));
		$datasProduk = json_decode($getAPIProduk, true);
		$data['produks'] = $datasProduk['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/foto_produk/tambah', $data);
	}

	public function proses_tambah_fotoProduk()
	{
		// $this->form_validation->set_rules('nama_foto_produk', 'Foto Produk', 'required|max_length[255]', array(
		// 	'required' => 'Foto Produk Harga Wajib Diisi.'
		// ));

		$config['upload_path'] = './assets/img/products';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['nama_foto_produk']['name'];

		$this->upload->initialize($config);
		if (!empty($_FILES['nama_foto_produk']['name'])) {
			if ($this->upload->do_upload('nama_foto_produk')) {
				$foto = $this->upload->data();
				$data = array(
					'id_produk' 			=> $_POST['id_produk'],
					'nama_foto_produk'      => $foto['file_name'],
				);
				$update = $this->curl->simple_post($this->api . 'FotoProduk', $data, array(CURLOPT_BUFFERSIZE => 10));
				if ($update) {
					$this->session->set_flashdata('success', "Data Foto Produk <b>" . $_POST['id_produk'] . "</b> Berhasil Disimpan !");
				} else {
					$this->session->set_flashdata('error', 'Data Gagal diubah');
				}
				redirect('owner/index_foto_produk');
			} else {
				die("gagal upload");
			}
		} else {
			echo "tidak masuk";
		}
	}

	public function foto_produk_edit($id_foto_produk)
	{
		$getAPI = $this->curl->simple_get($this->api . 'fotoProduk/by_id_user/' . $this->session->userdata('id_user') . '/' . $id_foto_produk);
		$getAPIProduk = $this->curl->simple_get($this->api . 'produk/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		$datasProduk = json_decode($getAPIProduk, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Foto Produk!'); 
			window.location.href = '" . base_url('owner/index_foto_produk') . "'; </script>";
		} else {
			if ($datas['data']['id_foto_produk'] == $id_foto_produk) {
				$value = array(
					'id_foto_produk' 	=> $datas['data']["id_foto_produk"],
					'nama_foto_produk' 	=> $datas['data']["nama_foto_produk"],
					'id_produk' 		=> $datas['data']["id_produk"],
					'nama_produk' 		=> $datas['data']["nama_produk"]
				);
			}
		}
		$data['foto_produks'] = $value;
		$data['produks'] = $datasProduk['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/foto_produk/edit', $data);
	}

	public function proses_edit_fotoProduk($id_foto_produk)
	{
		$getAPI = $this->curl->simple_get($this->api . 'FotoProduk/' . $id_foto_produk);
		$datas = json_decode($getAPI, true);

		$path = './assets/img/products/';

		$config['upload_path'] = './assets/img/products';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['nama_foto_produk']['name'];

		$this->upload->initialize($config);
		if (!empty($_FILES['nama_foto_produk']['name'])) {
			if ($this->upload->do_upload('nama_foto_produk')) {
				$foto = $this->upload->data();
				$data = array(
					'id_foto_produk'	=> $id_foto_produk,
					'id_produk'      	=> $_POST['id_produk'],
					'nama_foto_produk'  => $foto['file_name'],
				);

				@unlink($path.$datas['data']['nama_foto_produk']);
				$update = $this->curl->simple_put($this->api . 'FotoProduk', $data, array(CURLOPT_BUFFERSIZE => 10));
				if ($update) {
					$this->session->set_flashdata('success', "Data <b>" . $_POST['nama_produk'] . "</b> Berhasil Diedit !");
				} else {
					$this->session->set_flashdata('error', 'Data Gagal diubah');
				}
				redirect('owner/index_foto_produk/' . $id_foto_produk);
			} else {
				die("gagal upload");
			}
		} else {
			$data = array(
				'id_foto_produk'	=> $id_foto_produk,
				'id_produk'      	=> $_POST['id_produk'],
				'nama_foto_produk'  => $datas['data']['nama_foto_produk'],
			);
			$update = $this->curl->simple_put($this->api . 'FotoProduk', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($update) {
				$this->session->set_flashdata('success', "Data <b>" . $_POST['nama_produk'] . "</b> Berhasil Diedit !");
			} else {
				$this->session->set_flashdata('error', 'Data Gagal diubah');
			}
			redirect('owner/index_foto_produk/');
		}
	}

	public function fotoProduk_hapus($id_foto_produk,$foto)
	{
		if (empty($id_foto_produk)) {
			redirect('owner/index_foto_produk');
		} else {
			$path = './assets/img/products/';
			@unlink($path.$foto);
			$delete = $this->curl->simple_delete($this->api . 'FotoProduk', array('id_foto_produk' => $id_foto_produk), array(CURLOPT_BUFFERSIZE => 10));
			if ($delete) {
				$this->session->set_flashdata('success', "Data Terhapus !");
			} else {
				$this->session->set_flashdata('info', 'Data Gagal dihapus');
			}
			redirect('owner/index_foto_produk');
		}
	}

	//Bagian Harga
	public function index_harga()
	{
		$getAPI = $this->curl->simple_get($this->api . 'harga/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data['hargas'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/harga/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/harga/index');
		}
	}
	public function harga_tambah()
	{
		$getAPI = $this->curl->simple_get($this->api . 'harga');
		$datas = json_decode($getAPI, true);

		$data = array('hargas' => $datas["data"]);

		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/tambah', $data);
	}

	public function proses_tambah_harga()
	{
		$this->form_validation->set_rules('nama_harga', 'Nama Harga', 'required|max_length[255]', array(
			'required' => 'Nama Harga Wajib Diisi.'
		));

		$data = array(
			'nama_harga' =>  ucwords($_POST['nama_harga']),
			'id_user' =>  $this->session->userdata('id_user')
		);

		if ($this->form_validation->run() === false) {
			$this->template->load('layouts/owner/master', 'dashboard/owner/harga/tambah', $data);
		} else {
			$insert = $this->curl->simple_post($this->api . 'harga', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('success', "Data Harga <b>" . $_POST['nama_harga'] . "</b> Berhasil Disimpan !");
			} else {
				$this->session->set_flashdata('info', 'data gagal disimpan.');
			}
			redirect('owner/index_harga');
		}
	}

	public function harga_edit($id_harga)
	{

		$getAPI 		= $this->curl->simple_get($this->api . 'harga/' . $id_harga);
		$datas 			= json_decode($getAPI, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Harga!'); 
			window.location.href = '" . base_url('owner/index_harga') . "'; </script>";
		} else {
			if ($datas['data']['id_harga'] == $id_harga) {
				$value = array(
					'id_harga' 		=> $datas['data']["id_harga"],
					'nama_harga' 	=> $datas['data']["nama_harga"],
				);
			}
		}
		$data['harga'] = $value;
		$this->template->load('layouts/owner/master', 'dashboard/owner/harga/edit', $data);
	}

	public function proses_edit_harga($id_harga)
	{
		$data = array(
			'id_harga' =>  $id_harga,
			'nama_harga' =>  ucwords($_POST['nama_harga']),
			'id_user' =>  $this->session->userdata('id_user')
		);
		$update = $this->curl->simple_put($this->api . 'harga', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success', "Data Harga <b>" . $_POST['nama_harga'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('error', 'Data Gagal diubah');
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
			CURLOPT_URL => "https://api.etoko.xyz/kategori/by_id_user/" . $this->session->userdata('id_user'),
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

	public function kategori_tambah()
	{
		$this->template->load('layouts/owner/master', 'dashboard/owner/kategori/tambah');
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
			// CURLOPT_HTTPHEADER => array(
			// 	'x-apikey : $2y$10$kvfxRLwEQOuysqEyzYmcwuVmv/dzqtp4IbSg0QRHkIiSXy65BKsC2',
			// 	'x-signature : 8c220754d1b7f3dad83f4184da4c58a7e1df9a00'
			// ),
			CURLOPT_POSTFIELDS =>  array(
				'nama_kategori' =>  ucwords($_POST['nama_kategori']),
				'id_user' 		=>  $this->session->userdata('id_user'),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($response) {
			$this->session->set_flashdata('success', "Data kategori <b>" . $_POST['nama_kategori'] . "</b> Berhasil Ditambah !");
			redirect('owner/index_kategori');
		} else {
			echo "cURL Error #:" . $err;
		}
	}

	public function kategori_edit($id_kategori)
	{

		$getAPI 		= $this->curl->simple_get($this->api . 'kategori/' . $id_kategori);
		$datas 			= json_decode($getAPI, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Kategori!'); 
			window.location.href = '" . base_url('owner/index_kategori') . "'; </script>";
		} else {
			if ($datas['data']['id_kategori'] == $id_kategori) {
				$value = array(
					'id_kategori' 	=> $datas['data']["id_kategori"],
					'nama_kategori' 	=> $datas['data']["nama_kategori"],
					'id_user' 		=>  $this->session->userdata('id_user'),

				);
			}
		}
		$data['kategori'] = $value;
		$this->template->load('layouts/owner/master', 'dashboard/owner/kategori/edit', $data);
	}

	public function proses_edit_kategori($id_kategori)
	{
		$data = array(
			'id_kategori' =>  $id_kategori,
			'id_user' 		=>  $this->session->userdata('id_user'),
			'nama_kategori' =>  ucwords($_POST['nama_kategori']),
		);
		$update = $this->curl->simple_put($this->api . 'kategori', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Kategori <b>" . $_POST['nama_kategori'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/index_kategori');
	}

	//Bagian Satuan
	public function index_satuan()
	{
		$getAPI = $this->curl->simple_get($this->api . 'satuan/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		if (!empty($datas)) {
			$data['satuans'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/index');
		}
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
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|max_length[255]', array(
			'required' => 'Nama Satuan Wajib Diisi.'
		));

		$data = array(
			'nama_satuan' 	=>  ucwords($_POST['nama_satuan']),
			'id_user' 		=>  $this->session->userdata('id_user'),
		);

		if ($this->form_validation->run() === false) {
			$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/tambah', $data);
		} else {
			$insert = $this->curl->simple_post($this->api . 'satuan', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('success', "Data Satuan <b>" . $_POST['nama_satuan'] . "</b> Berhasil Disimpan !");
			} else {
				$this->session->set_flashdata('error', 'data gagal disimpan.');
			}
			redirect('owner/index_satuan');
		}
	}

	public function satuan_edit($id_satuan)
	{

		$getAPI 		= $this->curl->simple_get($this->api . 'satuan/' . $id_satuan);
		$datas 			= json_decode($getAPI, true);

		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Satuan!'); 
			window.location.href = '" . base_url('owner/index_satuan') . "'; </script>";
		} else {
			if ($datas['data']['id_satuan'] == $id_satuan) {
				$value = array(
					'id_satuan' 	=> $datas['data']["id_satuan"],
					'nama_satuan' 	=> $datas['data']["nama_satuan"],
				);
			}
		}
		$data['satuan'] = $value;
		$this->template->load('layouts/owner/master', 'dashboard/owner/satuan/edit', $data);
	}

	public function proses_edit_satuan($id_satuan)
	{
		$data = array(
			'id_satuan' =>  $id_satuan,
			'nama_satuan' =>  ucwords($_POST['nama_satuan']),
			'id_user' 		=>  $this->session->userdata('id_user'),
		);
		$update = $this->curl->simple_put($this->api . 'satuan', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success', "Data Satuan <b>" . $_POST['nama_satuan'] . "</b> Berhasil Diedit !");
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
		$getAPI 			= $this->curl->simple_get($this->api . 'transaksi/get_transaksi_lunas_by_owner/' . $this->session->userdata('id_user'));
		$datas 				= json_decode($getAPI, true);
		$data['transaksi'] 	= $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/transaksi/index', $data);
	}

	public function pdf_transaksi()
	{

		$getAPI 	= $this->curl->simple_get($this->api . 'transaksi');
		$datas 		= json_decode($getAPI, true);

		$trans['transaksi'] 		= $datas['data'];
		$file_pdf 					= 'laporan_transaksi'; //filename dari pdf ketika didownload
		$paper 						= 'A4'; //setting paper
		$orientation				= "potrait"; //orientasi paper potrait / landscape
		$html						= $this->load->view('dashboard/owner/laporan/transaksi/index_pdf', $trans, true);

		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function excel_transaksi(){

		$getAPI 	= $this->curl->simple_get($this->api . 'transaksi');
		$datas 		= json_decode($getAPI, true);

		$trans['transaksi'] 		= $datas['data'];


		// $data = array( 'title' => 'Laporan Excel | Tutorial Export ke excel CodeIgniter @ https://recodeku.blogspot.com',
        //         'buku' => $this->model_buku->getAll());
 
        $this->load->view('dashboard/owner/laporan/transaksi/index_excel', $trans);
	}

	public function excel_transaksi_i(){

		$getAPI 	= $this->curl->simple_get($this->api . 'transaksi');
		$datas 		= json_decode($getAPI, true);

		$trans['transaksi'] 		= $datas['data'];
 
        $this->load->view('dashboard/owner/laporan/transaksi/export_excel', $trans);
	}

	//Bagian Laporan katalog produk
	public function index_laporan_katalog()
	{
		$getAPI 		= $this->curl->simple_get($this->api . 'katalogProduk');
		$datas 			= json_decode($getAPI, true);

		$data['katalog_produk'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/katalog_produk/index', $data);
	}

	public function pdf_katalog()
	{

		$getAPI = $this->curl->simple_get($this->api . 'katalogProduk');
		$datas = json_decode($getAPI, true);

		$katalog['katalog_produk'] 	= $datas['data'];
		$file_pdf 					= 'laporan_katalog_produk'; //filename dari pdf ketika didownload
		$paper 						= 'A4'; //setting paper
		$orientation				= "potrait"; //orientasi paper potrait / landscape
		$html						= $this->load->view('dashboard/owner/laporan/katalog_produk/index_pdf', $katalog, true);

		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	//Bagian Laporan Customer
	public function index_laporan_cust()
	{
		$getAPI 		= $this->curl->simple_get($this->api . 'transaksi/get_customer_by_owner/' . $this->session->userdata('id_user'));
		$datas 			= json_decode($getAPI, true);
		$data['customers'] = $datas['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/customer/index', $data);
	}

	public function detail_laporan_cust($nama_cust)
	{
		$getAPI 		= $this->curl->simple_get($this->api . 'detailTransaksi/get_detail_transaksi_by_customer/' . $nama_cust);
		$datas 			= json_decode($getAPI, true);
		$getAPITransaksi 			= $this->curl->simple_get($this->api . 'transaksi');
		$datasTransaksi 				= json_decode($getAPITransaksi, true);
		$total = 0;
		foreach ($datas['data'] as $value) {
			$total += $value['sub_total'];
		}
		$data['total'] 	= $total;
		$data['transaksi'] 	= $datasTransaksi['data'];
		$data['customers'] = $datas['data'];

		$this->template->load('layouts/owner/master', 'dashboard/owner/laporan/customer/detail', $data);
	}

	public function pdf_customer()
	{

		$getAPI = $this->curl->simple_get($this->api . 'transaksi/get_customer_by_owner/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);

		$cust['customers'] 			= $datas['data'];
		$file_pdf 					= 'laporan_customer'; //filename dari pdf ketika didownload
		$paper 						= 'A4'; //setting paper
		$orientation				= "potrait"; //orientasi paper potrait / landscape
		$html						= $this->load->view('dashboard/owner/laporan/customer/index_pdf', $cust, true);

		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function katalog()
	{
		$getAPI = $this->curl->simple_get($this->api . 'KatalogProduk/by_id_user/' . $this->session->userdata('id_user'));
		$datas = json_decode($getAPI, true);
		if (!empty($datas)) {
			$data['katalog'] = $datas['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/katalog/index', $data);
		} else {
			$this->template->load('layouts/owner/master', 'dashboard/owner/katalog/index');
		}
	}

	public function katalog_tambah()
	{
		$getAPIproduk = $this->curl->simple_get($this->api . 'produk/by_id_user/' . $this->session->userdata('id_user'));
		$datasproduk = json_decode($getAPIproduk, true);
		$getAPIharga = $this->curl->simple_get($this->api . 'harga/by_id_user/' . $this->session->userdata('id_user'));
		$datasharga = json_decode($getAPIharga, true);
		$getAPIsatuan = $this->curl->simple_get($this->api . 'satuan/by_id_user/' . $this->session->userdata('id_user'));
		$datassatuan = json_decode($getAPIsatuan, true);
		$getAPIkategori = $this->curl->simple_get($this->api . 'kategori/by_id_user/' . $this->session->userdata('id_user'));
		$dataskategori = json_decode($getAPIkategori, true);
		$data['produk'] = $datasproduk['data'];
		$data['harga'] = $datasharga['data'];
		$data['satuan'] = $datassatuan['data'];
		$data['kategori'] = $dataskategori['data'];
		$this->template->load('layouts/owner/master', 'dashboard/owner/katalog/tambah', $data);
	}

	public function proses_tambah_katalog()
	{
		$getAPIproduk = $this->curl->simple_get($this->api . 'produk/' . $_POST['id_produk']);
		$datasproduk = json_decode($getAPIproduk, true);
		$data = array(
			'id_produk' 	=> $_POST['id_produk'],
			'id_harga' 		=> $_POST['id_harga'],
			'id_satuan' 	=> $_POST['id_satuan'],
			'id_kategori' 	=> $_POST['id_kategori'],
			'nominal' 		=> $_POST['nominal'],
			'id_toko' 			=> $datasproduk['data']['id_toko'],
		);
		$insert = $this->curl->simple_post($this->api . 'KatalogProduk', $data, array(CURLOPT_BUFFERSIZE => 10));
		if ($insert) {
			$this->session->set_flashdata('success', "Data Katalog Produk Berhasil Ditambah !");
		} else {
			$this->session->set_flashdata('error', 'Data Gagal diubah');
		}
		redirect('owner/katalog');
	}

	public function katalog_edit($id_detail_produk)
	{
		$getAPI 		= $this->curl->simple_get($this->api . 'KatalogProduk/by_id_user/' . $this->session->userdata('id_user') . '/' . $id_detail_produk);
		$datas 			= json_decode($getAPI, true);
		$getAPIproduk 	= $this->curl->simple_get($this->api . 'produk/by_id_user/' . $this->session->userdata('id_user'));
		$datasproduk 	= json_decode($getAPIproduk, true);
		$getAPIharga 	= $this->curl->simple_get($this->api . 'harga/by_id_user/' . $this->session->userdata('id_user'));
		$datasharga 	= json_decode($getAPIharga, true);
		$getAPIsatuan 	= $this->curl->simple_get($this->api . 'satuan/by_id_user/' . $this->session->userdata('id_user'));
		$datassatuan 	= json_decode($getAPIsatuan, true);
		$getAPIkategori = $this->curl->simple_get($this->api . 'kategori/by_id_user/' . $this->session->userdata('id_user'));
		$dataskategori 	= json_decode($getAPIkategori, true);
		if ($getAPI == false) {
			echo "<script> alert('Tidak Ada Data Katalog Produk!'); 
			window.location.href = '" . base_url('owner/katalog') . "'; </script>";
		} else {
			if ($datas['data']['id_user'] == $this->session->userdata('id_user')) {
				if ($datas['data']['id_detail_produk'] == $id_detail_produk) {
					$value = array(
						'id_detail_produk' 	=> $datas['data']["id_detail_produk"],
						'id_produk' 		=> $datas['data']["id_produk"],
						'nama_produk' 		=> $datas['data']["nama_produk"],
						'id_harga' 			=> $datas['data']["id_harga"],
						'id_satuan' 		=> $datas['data']["id_satuan"],
						'id_kategori' 		=> $datas['data']["id_kategori"],
						'nominal' 			=> $datas['data']["nominal"]
					);
				} else {
					echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
					window.location.href = '" . base_url('owner/toko') . "'; </script>";
				}
			}
			$data['KatalogProduk'] = $value;
			$data['produk'] = $datasproduk['data'];
			$data['harga'] = $datasharga['data'];
			$data['satuan'] = $datassatuan['data'];
			$data['kategori'] = $dataskategori['data'];
			$this->template->load('layouts/owner/master', 'dashboard/owner/katalog/edit', $data);
		}
	}

	public function proses_edit_katalog($id_detail_produk)
	{
		$data = array(
			'id_detail_produk' =>  $id_detail_produk,
			'id_produk' => $_POST['id_produk'],
			'id_harga' => $_POST['id_harga'],
			'id_satuan' => $_POST['id_satuan'],
			'id_kategori' => $_POST['id_kategori'],
			'nominal' =>  ucwords($_POST['nominal'])
		);
		$update = $this->curl->simple_put($this->api . 'KatalogProduk', $data, array(CURLOPT_BUFFERSIZE => 10));

		if ($update) {
			$this->session->set_flashdata('success-edit', "Data Katalog Produk <b>" . $_POST['nama_produk'] . "</b> Berhasil Diedit !");
		} else {
			$this->session->set_flashdata('info', 'Data Gagal diubah');
		}
		redirect('owner/katalog');
	}
}