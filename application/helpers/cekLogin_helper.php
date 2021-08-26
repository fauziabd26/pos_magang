<?php
function check_login()
{
	$CI = &get_instance();

	if ($CI->session->userdata('role') == "superadmin") {
		redirect('superadmin/dashboard');
	} elseif ($CI->session->userdata('role') == "owner") {
		redirect('owner/dashboard');
	} elseif ($CI->session->userdata('role') == "admin") {
		redirect('admin/dashboard');
	}
}

function check_not_login()
{
	$CI = &get_instance();
	$user_session = $CI->session->userdata('id_user');
	if (!$user_session) {
		$CI->session->set_flashdata('error', "Harus Login Terlebih Dahulu !");
		redirect('auth/login');
	}
}

function check_superadmin()
{
	$CI = &get_instance();
	if ($CI->session->userdata('role') != "superadmin") {
		echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
		window.location.href = '" . base_url() . "auth/login'; </script>";
	}
}

function check_owner()
{
	$CI = &get_instance();
	if ($CI->session->userdata('role') != "owner") {
		echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
		window.location.href = '" . base_url() . "auth/login'; </script>";
	}
}

function check_admin()
{
	$CI = &get_instance();
	if ($CI->session->userdata('role') != "admin") {
		echo "<script> alert('Anda Tidak Memiliki Hak Akses !'); 
		window.location.href = '" . base_url() . "auth/login'; </script>";
	}
}
