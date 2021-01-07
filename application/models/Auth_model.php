<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model {
	
	function login($data){
		$this->db->select('*');
		$result = $this->db->get_where('LoginKRA',array('EmpCode'=>$data['identity'],'Pwd'=>$data['password'],'Code <>'=>'NA'))->result_array();
		return $result;
	}
	
	function userDetail($data){
	    $this->db->select('Name as name,EmailID as company_mailid,PImg as image');
	    $result = $this->db->get_where('LoginKRA',array('Code <>'=>'NA','EmpCode' => $data))->result_array();
	    return $result;
	}
}