<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model {
	
	function login($data){
		$this->db->select('u.ecode,u.id,u.name,u.password,u.department_id,ui.image');
		$this->db->join('user_info ui','ui.ecode = u.ecode');
		$result = $this->db->get_where('users u',array('u.ecode'=>$data['identity'],'u.password'=>$data['password'],'u.status'=>1))->result_array();
		return $result;
	}
	
	function userDetail($data){
	    $this->db->select('u.name,ui.company_mailid,ui.image');
	    $this->db->join('user_info ui','ui.ecode = u.ecode');
	    $result = $this->db->get_where('users u',array('u.is_active'=>'YES','u.ecode'=>$data['ecode'],'u.status'=>1))->result_array();
	    return $result;
	}
}