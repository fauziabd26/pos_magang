<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//CATATAN:
//Data yang Wajib Dikirim via Headers
//yaitu: 'x-api-key' => kode rahasia API per akun User, dan
//       'signature' => kode rahasia dinamis per akun User per Request

//Cara membuat:
//$post_data = implode('', array_filter(array_map(function($v){ $v = !is_array($v) ? array() : $v; return implode('', array_filter($v)); }, $this->input->post())));
//$secret_key = sha1($apikey.$id_user);

//$signature = hash_hmac('sha1', $post_data, $secret_key);

//Jika Id_User, API Key dan Signature cocok maka Request dianggap Valid

use chriskacerguis\RestServer\RestController;

class Test extends RestController
	{
	private $id_user = 0;
	
    public function __construct()
		{
		parent::__construct();
		
		$header = getallheaders();
		$apikey = filter_var($header['x-apikey'], FILTER_CALLBACK, ['options' => function($hash) { return preg_replace('/[^a-zA-Z0-9$\/.]/', '', $hash);}]);
		
		if(!empty($apikey))
			{
			$this->load->database();
			$this->id_user = intval($this->db->where(array('apikey'=>$apikey,'status'=>'1'))->limit(1)->get('apikeys')->row('id_user'));
			if($this->id_user > 0)
				{
				$this->apicheck($this->id_user,$header);
				}
				else response_json(401,"Invalid Key");
			}
			else response_json(401,"API Key Required"); 		
		}

	public function index_get($id_user)
		{
		//Process GET Method
		response_json(200,"GET Method Succeed => ".$id_user);
		}
		
	public function index_post()
		{
		//Process POST Method
		$p = $this->input->post();
		response_json(200,json_encode($p));
		}		
	}