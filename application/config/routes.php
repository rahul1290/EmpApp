<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = array(); 

$route['default_controller'] = 'auth';
$route['404_override'] = '';

////////////////////////////////////APIS/////////////////////////////////////
$route['api/user/leave-requests'] = 'api/Emp_ctrl/LeaveRequest';
$route['api/user/half_day-requests'] = 'api/Emp_ctrl/halfDayRequest';
$route['api/user/attendance'] = 'api/Emp_ctrl/Attendance';
$route['api/user/off_day_duty-request'] = 'api/Emp_ctrl/offDaydutyRequest';
$route['api/user/tour-request'] = 'api/Emp_ctrl/tourRequest';
$route['api/user/nhfhs'] = 'api/Emp_ctrl/NhfhList';

$route['translate_uri_dashes'] = FALSE;
