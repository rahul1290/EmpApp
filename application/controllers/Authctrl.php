<?php  
require APPPATH . 'libraries/REST_Controller.php';


class Authctrl extends REST_Controller {
   
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model(array('Auth_model','Emp_model','Department_model'));
		$this->load->library(array('Authorization_Token','my_library'));
    }
	
    function index_get(){
        echo "This is version V1";
    }
    
	function login_post(){
		$data['identity'] = trim($this->post('identity'));
		$data['password'] = base64_encode(trim($this->post('password')));
		
		$login_result = $this->Auth_model->login($data);
		if(count($login_result) > 0){
			$jwt['id'] = $login_result[0]['EmpCode'];
			$jwt['ecode'] = $login_result[0]['EmpCode'];
			$jwt['time'] = time();
			$login_result[0]['key'] = $this->authorization_token->generateToken($jwt);
			//$login_result[0]['links'] = $this->my_library->links($login_result[0]['EmpCode']);
		    $this->response($login_result, 200);
		} else {
		    $this->response( [
		        'status' => 500,
		        'message' => 'No such user found'
		    ], 404 );
		}
	}
	
	
	function getMonthYear_get(){
	    
	    $data[0]['month'] = date('n');
	    $data[0]['year'] = date('Y');
	    $this->response($data, 200);
	}
	
	function currentAppVersion_post(){
	    $version = $this->post('version');
	    if($version == '0.1'){
	        $this->response(array('msg'=>'valid.'), 200);
	    } else {
	        $data[] = array('msg'=>'New version lauched.','androidAppId'=>'com.ibc24.newsflow','iOSAppId'=>'585027354');
	        $this->response($data, 500);
	    }
	}
	
	function userDetail_get(){
	    $is_valid_token = $this->authorization_token->validateToken();
	    if(!empty($is_valid_token) && $is_valid_token['status'] === true){
	        $user_detail = $this->Auth_model->userDetail($is_valid_token['data']->ecode);
	        if(count($user_detail) > 0){
	            $this->response($user_detail,200);
	        } else {
	            $message = ['status' => FALSE,'message' => 'Employee inactive' ];
	            $this->response($message, 404);
	        }
	    } else {
	        $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
	        $this->response($message, 404);
	    }
	}
	
	
	function plsummary_post(){
	    $is_valid_token = $this->authorization_token->validateToken();
	    if(!empty($is_valid_token) && $is_valid_token['status'] === true) {
	        
	        if($this->post('department') != ''){
    	        $data['department'] = $this->post('department');
    	        $data['paycode'] = $this->post('ecode');	
    	        $pl_result = $this->Emp_model->pl_summary_report($data);
	        } else {
	            $this->db->select('department_id');
	            $userdepartment = $this->db->get_where('users',array('ecode'=>$is_valid_token['data']->ecode,'status'=>1))->result_array();
	            
	            $data['department'] = $userdepartment[0]['department_id'];
	            $data['paycode'] = $is_valid_token['data']->ecode;
	            $pl_result = $this->Emp_model->pl_summary_report($data);
	        }
	        if(count($pl_result) > 0){
	            $plrecord = array();
	            foreach($pl_result as $plr){
	                $temp = array();
	                $temp['Date'] = date('d/m/Y',strtotime($plr['date']));
	                $temp['ADD'] = number_format($plr['Credit'],2);
	                $temp['DEDUCT'] = number_format($plr['debit'],2);
	                $temp['BALANCE'] = number_format($plr['balance'],2);
	                $plrecord[] = $temp;
	            }
	            $this->response($plrecord,200);
	        } else {
	            $message = ['status' => FALSE,'message' => 'No record found.' ];
	            $this->response($message, 404);
	        }
	        
	    } else {
	        $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
	        $this->response($message, 404);
	    }
	}
	
	function attendance_post(){
		$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
		
			$ecode = $this->post('empCode');
		    
		    $this->db->select('PAYCODE');
		    $result = $this->db->get_where('LoginKRA',array('EmpCode'=>$ecode))->result_array();
			    
			$data['paycode'] =  trim($result[0]['PAYCODE']);
			$data['from_date'] = date('Y-'.$this->post('month').'-01');
			$data['to_date'] = date($this->post('year').'-m-t');	
			
			$results = $this->Emp_model->attendance($data);
			if(count($results)>0){
				$app_attendance = array();
				foreach($results as $result){
					$temp = array();
					$temp['Paycode'] = trim($result['PAYCODE']);	
					$temp['Date'] =  trim($result['DateOFFICE']);
					$temp['InTime'] = trim($result['IN1']); 
					$temp['OutTime'] = trim($result['OUT2']);
					$temp['Shift'] = trim($result['SHIFT']);
					$app_attendance[] = $temp;
				}
				$this->response($app_attendance, 200);
			} else {
				$this->response('no record found.', 500);
			}
		}else{
			$message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
		}
	}
	
	
	function user_department1_get(){
		$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
			$department = $this->Department_model->get_employee_department($is_valid_token['data']->ecode);
			$this->response($department, 200);
		} else {
		    $this->response( [
		        'status' => 500,
		        'message' => 'No such user found'
		    ], 404 );
		}
	}
	
	function user_list_get(){
	$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
			
		    
		    $users = $this->Emp_model->get_employee($is_valid_token['data']->ecode);
			$this->response($users, 200);
			
		} else {
			$this->response( [
		        'status' => 500,
		        'message' => 'No such user found'
		    ], 404 );
		}	
	}
	
	function currentDate_post(){
	    $is_valid_token = $this->authorization_token->validateToken();
	    if(!empty($is_valid_token) && $is_valid_token['status'] === true){
    	    $date['date'] = date('d');
    	    $data['month'] = date('m');
    	    $data['year'] = date('Y');
	    }
	    $this->response($data, 200);
	}
	
	function user_department_get(){
	    $is_valid_token = $this->authorization_token->validateToken();
	    if(!empty($is_valid_token) && $is_valid_token['status'] === true){
	        
	        $ecode = $is_valid_token['data']->ecode;
	        $userCode = $this->db->query("Select code,code2,Dept, Name,EmailId from LoginKRA where EMpCode = '$ecode'")->result_array();
	        
	        if ($userCode[0]['code'] == "E"){
	            if ($userCode[0]['code2'] == "HR"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl";
	            } else {
	                $cmd = "Select Distinct DeptName,ROW_NUMBER() OVER (ORDER BY DeptName) id from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."'";
	            }
	            if($ecode == "SBMMPL-00665"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."' ";
	            }
	            if($ecode == "SBMMPL-00695" || $ecode == "SBMMPL-00782"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl";
	            }
	            if($ecode == "SBMMPL-00175"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."' union Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='Marketing'  ";
	            }
	        }
	        else if($userCode[0]['code'] == 'H'){
	            if ($userCode[0]['Dept'] == "GRAPHICS/ PROMO "){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."'";
	            }
	            else if ($userCode[0]['Dept'] == "OUTPUT " And $userCode[0]['code2'] == "H"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."' or DeptName = 'GRAPHICS/ PROMO ' or DeptName = 'SOCIAL MEDIA'";
	            }
	            else if ($userCode[0]['Dept'] == "EDITORIAL" And $userCode[0]['code2'] == "H"){
	                $cmd = "Select Distinct DeptName,ROW_NUMBER() OVER (ORDER BY DeptName) id from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."' or DeptName = 'GRAPHICS/ PROMO ' or DeptName = 'OUTPUT ' or DeptName = 'SOCIAL MEDIA'";
	            }
	            else if ($userCode[0]['Dept'] == "OUTPUT " And $userCode[0]['code2'] == "E"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."'";
	            }
	            else if ($userCode[0]['Dept'] == "CITY SALES"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."' or DeptName = 'EMERGING MARKETING'";
	            }
	            else if ($userCode[0]['Dept'] == "FINANCE"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl";
	            }
	            else if ($userCode[0]['Dept'] = "EDITOR"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='INPUT' or DeptName = 'OUTPUT ' or DeptName = 'EDITOR'";
	            }
	            else if ($userCode[0]['Dept'] == "GOVT. SALES"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='GOVT. SALES' or DeptName = 'MP SALES' or DeptName = 'CITY SALES' or DeptName = 'MARKETING' OR DeptName = 'EMERGING MARKETING'";
	            }
	            else if ($userCode[0]['Dept'] == "COO"){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl ";
	            }
	            else if($userCode[0]['Dept'] == 'HUMAN RESOURCE'){
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl";
	            }
	            else{
	                $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='".$userCode[0]['Dept']."'";
	            }
	        }
	        else if($userCode[0]['code'] == "C"){
	            $cmd = "Select Distinct DeptName from ITDDeptCodeTbl";
	        }
	        else if ($userCode[0]['Dept'] == "MD" || $userCode[0]['Dept'] == "Chairman"){
	            $cmd = "Select Distinct DeptName from ITDDeptCodeTbl where DeptName ='CEO'";
	        }
	        
	        $this->db->select('Dept');
	        $userDept = $this->db->get_where('LoginKra',array('EmpCode'=>$is_valid_token['data']->ecode))->result_array();
	        
	        $result = $this->db->query($cmd)->result_array();
	        
	        foreach($result as $r){
	            if($r['DeptName'] == $userDept[0]['Dept']){
	                $result[0]['defaultDept'] = $r['id'];
	            }
	        }
	        $this->response($result, 200);
	    }
    }
    
//     function userListDept_post(){
//         $is_valid_token = $this->authorization_token->validateToken();
//         if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
//             print_r($this->post());
            
//             If (code = "E") Then
//             If (code2 = "HR") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name   from LoginKRA where Dept = '" & ddlDept.Text & "'and (code = 'H' or code = 'E' or code = 'HR' or Code = 'HH' or code<>'NA')  order by EmpCode", conn)
//             Else
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name  from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA' order by EmpCode", conn)
//             End If
//             If cookies = "SBMMPL-00517" Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name  from LoginKRA where Dept = '" & ddlDept.Text & "' and  code<>'NA' order by EmpCode", conn)
//             End If
//             If cookies = "SBMMPL-00665" Then
//             cmd = New SqlCommand("Select EmpCode,Name + '--'+ Empcode as Name  from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA'  Union Select EmpCode,Name + '--'+ Empcode as Name   from LoginKRA where dept='MARKETING' and code2 ='mon'", conn)
//             End If
//             If (cookies = "SBMMPL-00175") Then
            
//             If ddlDept.Text = "OTHERS" Then
//             cmd = New SqlCommand("Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA'", conn)
//             ElseIf ddlDept.Text = "MARKETING " Then
//             cmd = New SqlCommand("Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where report1 = '" & cookies & "' and  code<>'NA'", conn)
            
//             End If
            
//             End If
//             If (cookies = "SBMMPL-00590") Then
            
//             cmd = New SqlCommand("Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where report1 = '" & cookies & "' and  code<>'NA' Union Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA'", conn)
            
//             End If
//             If (cookies = "SBMMPL-01000") Then
            
//             cmd = New SqlCommand("Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where report1 = '" & cookies & "' and  code<>'NA' Union Select EmpCode,Name + '--' + Empcode as Name  from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA'", conn)
            
//             End If
            
//             ElseIf (code = "H") Then
//             If (dept = "GRAPHICS/ PROMO ") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA' order by EmpCode", conn)
//             ElseIf (dept = "EDITORIAL") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where EmpCode = '" & cookies & "' and  code<>'NA' order by EmpCode", conn)
//             ElseIf (dept = "EDITOR") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and  code<>'NA' and EmpCOde<>'assign' order by EmpCode", conn)
//             Else
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and  code<>'NA' order by EmpCode", conn)
//             End If
//             ElseIf (code = "C") Then
//             If (ddlDept.Text = "GRAPHICS/ PROMO ") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and (code = 'HH' or  code<>'NA') order by EmpCode", conn)
//             ElseIf (ddlDept.Text = "OTHERS") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and (code = 'E' or  code<>'NA') order by EmpCode", conn)
//             Else
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and (code = 'H' or code ='HR' or  code<>'NA') order by EmpCode", conn)
//             End If
            
//             ElseIf (code = "CH") Then
//             cmd = New SqlCommand("Select EmpCode,Empcode + '--'+ Name as Name from LoginKRA where Dept = '" & ddlDept.Text & "' and code<>'NA' order by EmpCode", conn)
//             End If
            
            
            
            
            
//         } else {
//             $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
//             $this->response($message, 404);
//         }
//     }
    
    function NhfhList_get(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
            $result = $this->db->query("Select convert(varchar(50),HDate,103) +' ('+ Description +')' as name,convert(varchar(10),HDate,103) as id from NHFHList where HDate < GETDATE() and HDate not in (select date1  from NHFHDetail where EmpCode = '".$is_valid_token['data']->ecode."' and status <> 'X') and year(hdate)='2020'")->result_array();
            if(count($result)>0){
                $this->response($result,200);
            } else {
                $data['msg'] = "No record found.";
                $this->response($data,500);
            }
        } else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
	    
	
}





