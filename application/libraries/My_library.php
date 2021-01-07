<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
 
class My_library {
	protected $CI;
	
	function __construct(){
        $this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->library('session');
		$this->CI->load->database();
		$this->CI->load->library('email');
    }
	
	function mydate($date){
		$date = str_replace('/', '-', $date);
		return date('Y-m-d', strtotime($date));
	}
	
	function sql_datepicker($date){
		return date("d/m/Y", strtotime($date));
	}
	
	function day_duration($date1,$date2){
	    $date1 = date_create($this->mydate($date1));
	    $date2 = date_create($this->mydate($date2));
	    $diff=date_diff($date1,$date2);
	    
	    $x = $diff->format("%a") + 1;
	    if($diff->format("%a") > 0)
	        $x .=' days';
	    else
	        $x .=' day';
	    return $x;
	}
	
	function department_code($ecode){
		$this->CI->db->select('dm.dept_code');
		$this->CI->db->join('department_master dm','dm.id = u.department_id');
		$result = $this->CI->db->get_where('users u',array('u.ecode'=>$ecode,'u.status'=>1))->result_array();
		return $result[0]['dept_code'];
	}
	
	function get_employee_department($ecode){
		$this->CI->db->select('department_id');
		$result = $this->CI->db->get_where('users',array('status'=>1,'is_active'=>1,'ecode'=>$ecode))->result_array();
		return $result[0]['department_id'];
	}
	
	function get_paycode($ecode){
		$this->CI->db->select('paycode');
		$result = $this->CI->db->get_where('users',array('ecode'=>$ecode))->result_array();
		return $result[0]['paycode'];
	}
	
	function get_emp_default_shift($ecode){
		return 'F';
	}
	
	function reporting_to_mailid($ecode){
		$result = $this->CI->db->query("SELECT user_info.company_mailid FROM `users` 
					JOIN user_info on user_info.ecode = users.ecode
					WHERE department_id = (SELECT report_to_dept from users WHERE ecode = '$ecode')
					AND designation_id = (SELECT report_to_desg from users WHERE ecode = '$ecode')
					AND is_active = 1
					AND users.status = 1")->result_array();
		return $result;
	}
	
	function links($ecode){
		$this->CI->db->select('sl.id,sl.link_name,type,parent_id,sl.url,sl.icon');
		$this->CI->db->join('system-links sl','sl.id = ul.link_id');
		$result = $this->CI->db->get_where('user_links ul',array('ul.ecode'=>$ecode,'ul.status'=>1))->result_array();
		if(count($result)>0){
			return $result;
		}	
	}
	
	
	function pl_calculator($ecode){
	    $this->CI->db->select('*');
	    $this->CI->db->order_by('date','desc');
	    $this->CI->db->limit(1);
	    $result = $this->CI->db->get_where('pl_management',array('type'=>'PL','ecode'=>$ecode,'status'=>1))->result_array();
	    return $result;
	}
	
	function emp_coff($ecode){
	    $results = $this->CI->db->query("SELECT * FROM `users_leave_requests` WHERE ecode = '".$ecode."' AND date_from >= '".date('Y-m-d', strtotime("-90 days"))."' AND request_type = 'OFF_DAY' AND ((hod_status = 'PENDING' && hr_status = 'GRANTED') OR (hod_status = 'GRANTED' && hr_status = 'PENDING') OR(request_status_code = 2)) AND request_id IS NULL")->result_array();
	    
	    if(count($results)>0){
	        $final_array = array();
	        foreach($results as $result){
	            $temp = array();
	            $temp = $result;
	            $temp['reference_id'] = $this->remove_hyphen($result['reference_id']);
	            $final_array[] = $temp; 
	        }
	        return $final_array;
	    }
	    return $results;
	}
	
	function emp_nhfh($ecode) {
	    $result = $this->CI->db->query("SELECT * FROM `users_leave_requests` WHERE ecode = '".$ecode."' AND date_from >= '".date('Y-12-25',strtotime("-1 year"))."' AND request_type = 'NH_FH' AND ((hod_status = 'PENDING' && hr_status = 'GRANTED') OR (hod_status = 'GRANTED' && hr_status = 'PENDING') OR (request_status_code = 2)) AND request_id IS NULL")->result_array();
	    return $result;
	}
	
	function empCoffHr($ecode) {
	    $result = $this->CI->db->query("SELECT * FROM `users_leave_requests` WHERE 
                        ecode = '".$ecode."' 
                        AND date_from >= '".date('Y-m-d', strtotime("-90 days"))."' 
                        AND request_type = 'OFF_DAY' 
                        AND ((hod_status = 'PENDING' && hr_status = 'GRANTED') OR (hod_status = 'GRANTED' && hr_status = 'PENDING')) 
                        AND hr_status = 'PENDING'")->result_array();
	    return $result;
	}
	
	function empNhfhHr($ecode) {
	    $result = $this->CI->db->query("SELECT * FROM `users_leave_requests` WHERE
                        ecode = '".$ecode."'
                        AND request_type = 'NH_FH'
                        AND date_from >= '".date('Y-12-25',strtotime("-1 year"))."'
                        AND ((hod_status = 'PENDING' && hr_status = 'GRANTED') OR (hod_status = 'GRANTED' && hr_status = 'PENDING'))
                        AND hr_status = 'PENDING'")->result_array();
	   return $result;
	}
	
	
	function leave_requester_ecode($id) {
	    $this->CI->db->select('ecode');
	    $result = $this->CI->db->get_where('users_leave_requests',array('id'=>$id))->result_array();
	    return $result[0]['ecode'];
	}
	
	function leave_request_refno($ref_id){
	    $this->CI->db->select('reference_id');
	    $result = $this->CI->db->get_where('users_leave_requests',array('id'=>$ref_id))->result_array();
	    return $result[0]['reference_id'];
	}
	
	
	function getEcode_refId($ref_id){
	    $this->CI->db->select('ecode');
	    $result = $this->CI->db->get_where('users_leave_requests',array('reference_id'=>$ref_id))->result_array();
	    if(count($result)>0){
	       return $result[0]['ecode'];
	    } else {
	        return false;
	    }
	}
	
	function get_current_session(){
	    $this->CI->db->select('*');
	    $result = $this->CI->db->get_where('session',array('is_active'=>'curr','status'=>1))->result_array();
	    return $result[0]['name'];
	}

	function reporting_to($ecode){
		$this->CI->db->select('count(*) as report_to');
		$result = $this->CI->db->get_where('kra_user_detail',array('reporting_ecode'=>$ecode,'status'=>1))->result_array();
		return $result[0]['report_to']; 
	}
	
	function remove_hyphen($str){
	    return str_replace('-', '/', $str);
	}
	
	
	function getMailIds($ecode){
	    $this->CI->db->select('DISTINCT(ui.company_mailid)');
	    $this->CI->db->join('users u','u.ecode = ur.ecode');
	    $this->CI->db->join('user_info ui','ui.ecode = u.ecode');
	    $result = $this->CI->db->get_where('user_rules ur',array(
	        'ur.r_ecode'=> $ecode,
	        'ur.ecode<>'=>$ecode
	    ))->result_array();
	    return $result;
	}
	    
	function sentmail($sub="emp2",$mail_body,$sendto){
	    if($this->CI->config->item('mail')){
    		$tos = '';
    		foreach($sendto as $send){
    			$tos = $tos.$send['company_mailid'].',';
    		}
    		$ids = rtrim($tos,',');
			
    		$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.ibc24.in',
                'smtp_port' => 465,
    			'smtp_user' => 'rahul1.sinha@ibc24.in',
                'smtp_pass' => 'rahul1',
                'mailtype'  => 'html',
    			'wordwrap' 	=> TRUE,
                'charset'   => 'utf-8'
            );
    		$this->CI->email->set_mailtype("html");
    		$this->CI->load->library('email', $config);		
    		$this->CI->email->from('No_reply@ibc24.in');
    		$this->CI->email->to("'".$ids."'");
    		$this->CI->email->subject($sub);
    		$this->CI->email->message($mail_body);
    		
    		
            if (!$this->CI->email->send()){
                echo $this->CI->email->print_debugger();
            } else {
    			//echo $this->CI->email->print_debugger();
    			return true;
    		}
	    } else {
	        return true;
	    }
	}
}
