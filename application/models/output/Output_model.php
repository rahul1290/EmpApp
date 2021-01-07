<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output_model extends CI_Model {
    
    function get_files($data){
        $this->db->select('*');
        $result =  $this->db->get_where('broadcast',array('time'=>$data['time'].':00','date'=>$data['date'],'status'=>1))->result_array();
        
        if(count($result)>0){
            return $result;
        } else {
            $db2 = $this->load->database('sqlsrv', TRUE);
            $str = str_replace("-","",$data['date']);
            
            //$x = "'".$str.$data['str1']."'";
            //$x = $str.$data['str1'];
            
            $db2->select("*");
            $results = $db2->get_where($this->config->item('NEWZ36').'MCR_Out_Feed',array('timespan'=>$data['time'].':00','date'=>$data['date']))->result_array();
            if(count($results)>0){
                $this->db->insert('broadcast',array(
                    'file_name' => $results[0]['FileName'],
                    'thumb' => $results[0]['ThumbName'],
                    'program' => $results[0]['Program'],
                    'time' => $data['time'].':00',
                    'date' => $data['date'],
                    'created_at' => date('Y-m-d')
                ));
                
                $this->db->select('*');
                $result =  $this->db->get_where('broadcast',array('time'=>$data['time'].':00','date'=>$data['date'],'status'=>1))->result_array();
                
                return $result;
            } else {
                $result = array();
                return $result;
                
            }
        }
        
    }
}