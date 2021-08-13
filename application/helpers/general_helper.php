<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function response_json($code,$msg)
	{
	http_response_code($code);
	$tipe = $code == 200 ? 'data' : 'error';
	$status = $code == 200 ? 'true' : 'false';
	$msg = $msg == '' ? '{}' : '"'.$msg.'"';
	die('{ "status":'.$status.', "'.$tipe.'":'.$msg.'}');
	}
	
function ds($ar)
	{
	if(!empty($ar))
		{
		echo '<pre>';
		}
	print_r($ar); die();
	}
	
function get_data($field,$table,$c)
	{
	$ci =& get_instance();
	if($field == "*")
		{
		$res = $ci->db->select($field)->where($c)->get($table)->row();
		}
		else
			{
			$res = $ci->db->where($c)->get($table)->row($field);
			}
	return $res;
	}
	
function randString($p=8)
	{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $p; $i++)
		{
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
		}
    return implode($pass);
	}

function show_point($a)
	{
	$a = is_numeric($a) ? $a : 0;
	return number_format($a,0,',','.');
	}

function show_money($a)
	{
	$a = is_numeric($a) ? $a : 0;
	return 'Rp'.number_format($a,0,',','.');
	}

function get_ip()
	{
	if(isset($_ENV["HTTP_CLIENT_IP"])) $ip = $_ENV["HTTP_CLIENT_IP"];
	  else if(isset($_ENV["HTTP_X_FORWARDED_FOR"])) $ip = $_ENV["HTTP_X_FORWARDED_FOR"];
	  else if(isset($_ENV["HTTP_X_FORWARDED"])) $ip = $_ENV["HTTP_X_FORWARDED"];
	  else if(isset($_ENV["HTTP_FORWARDED_FOR"])) $ip = $_ENV["HTTP_FORWARDED_FOR"];
	  else if(isset($_ENV["HTTP_FORWARDED"])) $ip = $_ENV["HTTP_FORWARDED"];
	  else if(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];

	$tmp = explode(",", $ip);
	if(count($tmp)>1) $ip = $tmp[sizeof($tmp)-1];
	return $ip;
	}

function check_email($email)
	{
	return preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email);
	}

function slug($s)
	{
	return strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '',preg_replace('/\s+/', '-',$s)));
	}