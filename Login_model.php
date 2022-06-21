<?php
class Login_model extends CI_Model
{
    //cek username dan password bagian
    function auth_bagian($username,$password)
	{
        $query=$this->db->query("SELECT * FROM bagian WHERE username='$username' AND password='$password' ");
        return $query;
    }
	//cek username dan password user
    function auth_user($username,$password)
	{
        $query=$this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' ");
        return $query;
    }
 
}