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
        // $this->load->library('form_validation');
	}

	public function login_post()
    {
        $email     = $this->input->post('email');
        $password  = $this->input->post('password');
            // $where = array(
            //     'email' => $email,
            //     'password' => password_hash($password, PASSWORD_BCRYPT)
            // );
        
        $result = $this->AuthModel->getUser($email, $password);
			if($result == true){
                foreach($result as $row){
                    $sess_data = array(
                        'email'      => $row->email,
                        'nama'       => $row->nama,
                        'role'       => $row->role
                    );
                }
                    $this->response(array(
                        'status'  => true,
                        'message' => 'login success',
                        'data'    => $sess_data
                    ),200);
            }
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        // redirect(site_url('login'));
    }
}
