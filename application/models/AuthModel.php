<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model{
    
    public function register_post(){
        $nama   = $_POST['nama'];
        $email  = $_POST['email'];
        $pass   = md5($_POST['pass']);

    }
}