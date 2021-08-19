<?php

defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('AuthModel');
        $this->load->library('form_validation');
	}

	public function login_post()
    {
        $post = array(
            'email'     => $this->input->post('email'),
            'password'  => $this->input->post('password')
        );

    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}
