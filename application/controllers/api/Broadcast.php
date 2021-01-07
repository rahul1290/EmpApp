<?php  
require APPPATH . 'libraries/REST_Controller.php';

class Broadcast extends REST_Controller {
   
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model(array('output/Output_model'));
		$this->load->library('Authorization_Token');
    }
	
	function index_post(){
	    $is_valid_token = $this->authorization_token->validateToken();
	    if(!empty($is_valid_token) && $is_valid_token['status'] === true) {
	           $data['date'] = $this->post('date');
	           $data['time'] = $this->post('time');
	           
	           $result = $this->Output_model->get_files($data);
	           if(count($result)>0){
	               $this->response($result,200);
	           } else {
	               $this->response('no record found.', 500);
	           }
	    } else {
	        $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
	        $this->response($message, 404);
	    }
	}
	
}