<?php  
require APPPATH . 'libraries/REST_Controller.php';

class Policies_ctrl extends REST_Controller {
   
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model(array('Auth_model','Emp_model','master/Department_model'));
		$this->load->library('Authorization_Token');
    }

	function it_policies_get(){
		$this->db->select('*');
		$this->db->order_by('sort','asc');
		$result = $this->db->get_where('policies',array('parent_id'=>2,'status'=>1))->result_array();
		if(count($result)>0){
			$this->response($result, 200);
		} else {
			$this->response('No record found.', 500);
		}
	}
	
	function hr_policies_get(){
		$this->db->select('*');
		$this->db->order_by('sort','asc');
		$result = $this->db->get_where('policies',array('parent_id'=>1,'status'=>1))->result_array();
		if(count($result)>0){
			$this->response($result, 200);
		} else {
			$this->response('No record found.', 500);
		}
	}
}
?>