<?php  
require APPPATH . 'libraries/REST_Controller.php';

class Policies_ctrl extends REST_Controller {
   
    public function __construct(){
        parent::__construct();
        $this->load->database();
		$this->load->library('Authorization_Token');
    }

	function it_policies_get(){
		$result = array(
    		array(
        		  "title"=> "IT POLICIES",
        		  "file_name"=> "IT_POLICIES.pdf",
    		      "url" => 'https://employee.ibc24.in/ITPOLICY/Docs/IT_POLICY.pdf',
    		),
		    array(
    	        "title"=> "PC/LAPTOP POLICIES",
    	        "file_name"=> "PC_LAPTOP_POLICIES.pdf",
		        "url"=>'https://employee.ibc24.in/ITPOLICY/Docs/PCLAPTOPPOLICY.pdf',
		    ),
		    array(
		        "title"=> "SOCIAL POLICIES",
		        "file_name"=> "SOCIAL_POLICIES.pdf",
		        "url"=>'https://employee.ibc24.in/ITPOLICY/Docs/SOCIALMEDIAPOLICY.pdf',
		    ),
		);
		if(count($result)>0){
			$this->response($result, 200);
		} else {
			$this->response('No record found.', 500);
		}
	}
	
	function hr_policies_get(){
		
	    $result = array(
	      array(
	          "title"=> "LEAVE POLICIES",
	          "file_name"=> "LEAVE_POLICIES.pdf",
	          "url" => "https://employee.ibc24.in/HR/Doc/leave.pdf",
	      ),
	        array(
	            "title"=> "ADVANCE SALARY POLICIES",
	            "file_name"=> "ADVANCE_SALARY_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Advance_salary.pdf",
	        ),
	        array(
	            "title"=> "RELIEVING POLICIES",
	            "file_name"=> "RELIEVING_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/RELIEVING.pdf",
	        ),
	        array(
	            "title"=> "TRAVEL POLICIES",
	            "file_name"=> "TRAVEL_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Travel.pdf",
	        ),
	        array(
	            "title"=> "CAB POLICIES",
	            "file_name"=> "CAB_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/CAB.pdf",
	        ),
	        array(
	            "title"=> "TOUR POLICIES",
	            "file_name"=> "TOUR_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Tour.pdf",
	        ),
	        array(
	            "title"=> "VISITING/BUSINESS CARD POLICIES",
	            "file_name"=> "VISITING_BUSINESS_CARD_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Card_Policy.pdf",
	        ),
	        array(
	            "title"=> "INTERN POLICIES",
	            "file_name"=> "INTERN_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Intern_Policy.pdf",
	        ),
	        array(
	            "title"=> "COVID POLICIES",
	            "file_name"=> "COVID_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Covid_Policy_2020.pdf",
	        ),
	        array(
	            "title"=> "EMPLOYEE CONFORMATION POLICIES",
	            "file_name"=> "EMPLOYEE_CONFORMATION_POLICIES.pdf",
	            "url" => "https://employee.ibc24.in/HR/Doc/Employee_Confirmation_Policy.pdf",
	        )
	    );
	    
		if(count($result)>0){
			$this->response($result, 200);
		} else {
			$this->response('No record found.', 500);
		}
	}
}
?>