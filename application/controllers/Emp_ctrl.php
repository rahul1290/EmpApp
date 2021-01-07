<?php
require APPPATH . 'libraries/REST_Controller.php';


class Emp_ctrl extends REST_Controller {
    var $db2,$saviorDB;
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        
        $this->load->library(array('Authorization_Token','my_library'));
        $this->db2 = $this->load->database('sqlsrv', TRUE);
        $this->saviorDB = $this->load->database('savior', TRUE);
        
    }
    
   
    function LeaveRequest_get(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
           
            $result['coffs'] = array(
                array("reference_id"=>"CO/2021/IT/29556","requirment"=>"reason","date"=>"01-01-2021"),
                array("reference_id"=>"CO/2021/IT/29557","requirment"=>"reason","date"=>"01-02-2021")
            ); 
            $result['nhfhs'] = array(
                array("reference_id"=>"NHFH/2021/IT/29559","requirment"=>"reason","date"=>"01-01-2021[holi]"),
                array("reference_id"=>"NHFH/2021/IT/29558","requirment"=>"reason","date"=>"01-02-2021[diwali]")
            );
            $result['pls'] = '11';
            $data[] = $result;
            $this->response($data,200);
        } else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
    
    function LeaveRequest_post(){
        $data = $this->post();
        $this->response($data,200);
    }
    
    function halfDayRequest_post(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
            $date = trim($this->post('date'));
            $reason = trim($this->post('reason'));
            
            $this->db2->trans_begin();
            
            $this->db2->select('l.EmpCode,d.DeptCode,l.Dept,l.Name,l.Code,l.CntNo');
            $this->db2->join('DeptCodeTbl d','l.Dept = d.DeptName');
            $userDep = $this->db2->get_where('LoginKRA l',array('l.EmpCode'=>$is_valid_token['data']->ecode))->result_array();
            
            $this->db2->select('max(Sno)+1 as max');
            $result = $this->db2->get('OffTbl')->result_array();
            $max = $result[0]['max'];
            
            $Id = 'HF/'.date('Y').'/'.$userDep[0]['DeptCode'].'/'.$max;
            
            $this->db2->query("insert into HalfDayLeave (ID, Name, EmpCode, Dept, RDate, CntNo, Reason, UDate, status, code, code2, HRStatus) values('".$Id."','".$userDep[0]['Name']."','".$is_valid_token['data']->ecode."','".$userDep[0]['Dept']."','".$date."','".$userDep[0]['CntNo']."','".$reason."','".date('Y-m-d')."','R','".$userDep[0]['Code']."','','P')");
            
            if ($this->db2->trans_status() === FALSE){
                $data['msg'] = 'Half day request not submitted.';
                $this->db2->trans_rollback();
                $this->response($data,500);
            } else {
                $data['msg'] = 'Half day request submitted successfully.';
                $this->db2->trans_commit();
                $this->response($data,200);
            }
            
        } else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
    
    function Attendance_post(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
            
            $payCode = $this->my_library->get_paycode($is_valid_token['data']->ecode);            
            $date = $this->post('date');
            
            $this->saviorDB->select('PAYCODE,HOURSWORKED,convert(char(5), IN1, 108)as IN1,convert(char(5), OUT2, 108)as OUT2');
            $result = $this->saviorDB->get_where('Savior.dbo.tblTimeRegister',array('PAYCODE'=>$payCode,'DateOFFICE'=>$date))->result_array();
            
            if(count($result)>0){
                $data['in_time'] = $result[0]['IN1'];
                $data['out_time'] = $result[0]['OUT2'];
                $data['hours']  = intdiv($result[0]['HOURSWORKED'], 60).' Hours '. ($result[0]['HOURSWORKED'] % 60).' Minutes';
                
                $this->response($data,200);
            } else {
                $data['msg'] = 'No record found';
                $this->response($data,500);
            }
        } else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
    
    function offDaydutyRequest_post(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
            $this->db2->trans_begin();
            
            $this->db2->select('l.EmpCode,d.DeptCode,l.Dept,l.Name,l.Code');
            $this->db2->join('DeptCodeTbl d','l.Dept = d.DeptName');
            $userDep = $this->db2->get_where('LoginKRA l',array('l.EmpCode'=>$is_valid_token['data']->ecode))->result_array(); 
                
            $this->db2->select('max(Sno)+1 as max');
            $result = $this->db2->get('OffTbl')->result_array();
            $max = $result[0]['max'];
            
            $Id = 'CO/'.date('Y').'/'.$userDep[0]['DeptCode'].'/'.$max;
            
            $date = $this->post('date');
            $requirement = trim($this->post('requirement'));
            $wod = $this->post('wod');           
            
            $this->db2->query("insert into offTbl (ID, Name, EmpCode, Department, workoffday, Requirement, Date1, Date2, Code, Status, code2,AppDate) values('".$Id."','".$userDep[0]['Name']."','".$userDep[0]['EmpCode']."','".$userDep[0]['Dept']."','".$wod."','".$requirement."','".$date."','".$date."','".$userDep[0]['Code']."','R','','".date('Y-m-d')."')");
            
            if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
                $data['msg'] = "something wrong";
                $this->response($data,500);
            }
            else{
                $this->db2->trans_commit();
                $data['msg'] = "submitted";
                $this->response($data,200);
            }
        } else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
    
    
    function tourRequest_post(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){
            
            $this->db2->trans_begin();
            
            $from_date = $this->post('fromDate');
            $to_date = $this->post('toDate');
            $location = trim($this->post('location'));
            $requirement = trim($this->post('requirement'));
            $remark = trim($this->post('remark'));
            
            $this->db2->select('l.EmpCode,d.DeptCode,l.Dept,l.Name,l.Code,l.Code2');
            $this->db2->join('DeptCodeTbl d','l.Dept = d.DeptName');
            $userDep = $this->db2->get_where('LoginKRA l',array('l.EmpCode'=>$is_valid_token['data']->ecode))->result_array();
            
            $this->db2->select('max(Sno)+1 as max');
            $result = $this->db2->get('OffTbl')->result_array();
            $max = $result[0]['max'];
            
            $Id = 'TR/'.date('Y').'/'.$userDep[0]['DeptCode'].'/'.$max;
                
            $this->db2->query("insert into TourFormTbl ( ID, Name, EmpCode, Dept, Requirement, Remarks, Date1, Date2, HODRemarks, HODApp, Code, Status, Code2,Location,AppDate) values('".$Id."','".$userDep[0]['Name']."','".$userDep[0]['EmpCode']."','".$userDep[0]['Dept']."','".$requirement."','".$remark."','".$from_date."','".$to_date."','','','".$userDep[0]['Code']."','R','".$userDep[0]['Code2']."','".$location."','".date('Y-m-d')."')");
            
            if ($this->db2->trans_status() === FALSE){
                $this->db2->trans_rollback();
                $data['msg'] = "something wrong";
                $this->response($data,500);
            }
            else{
                $this->db2->trans_commit();
                $data['msg'] = "submitted";
                $this->response($data,200);
            }
        }else {
            $message = ['status' => FALSE,'message' => $is_valid_token['message'] ];
            $this->response($message, 404);
        }
    }
    
    function NhfhList_get(){
        $is_valid_token = $this->authorization_token->validateToken();
        if(!empty($is_valid_token) && $is_valid_token['status'] === true){

            $result = $this->db2->query("Select convert(varchar(50),HDate,103) +' ('+ Description +')' as HDate1,convert(varchar(10),HDate,103) as HDate from NHFHList where HDate < GETDATE() and HDate not in (select date1  from NHFHDetail where EmpCode = '".$is_valid_token['data']->ecode."' and status <> 'X') and year(hdate)='2020'")->result_array();
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