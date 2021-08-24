<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	private $table = 'user';

    public function getUser($email, $password){
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        if($query->num_rows() == 1){
            $hash = $query->row('password');
            if(password_verify($password, $hash)){
                return $query->result();
            }else{
                echo "password salah";
            }
        }else{
            echo "akun tidak ada";
        }
    }

	public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('email', $post["email"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // periksa role-nya
            $isAdmin = $user->role == "admin";

            // jika password benar dan dia admin
            if($isPasswordTrue && $isAdmin){ 
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                $this->_updateLastLogin($user->user_id);
                return true;
            }
        }
        
        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }
}

