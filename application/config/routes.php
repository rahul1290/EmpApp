<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = array(); 

$route['default_controller'] = 'Authctrl';
$route['404_override'] = '';

$route['login'] = 'Authctrl/login';
$route['user-detail'] = 'Authctrl/userDetail';
$route['user-attendance'] = 'Authctrl/Attendance';
$route['user-attendance/date'] = 'Emp_ctrl/Attendance';
$route['user-department'] = 'Authctrl/user_department';
$route['user-supervised'] = 'Authctrl/user_list';

$route['dept-users'] = "AuthCtrl/userListDept"; 

$route['user-nhfh-duty'] = 'Emp_ctrl/nhfh';
$route['user-nhfh-avail'] = 'Emp_ctrl/nhfh_avail';
$route['user-half-day-request'] = 'Emp_ctrl/halfDayRequest';
$route['user-off-day-duty-request'] = 'Emp_ctrl/offDaydutyRequest';
$route['user-tour-request'] = 'Emp_ctrl/tourRequest';

$route['it-policies'] = 'Policies_ctrl/it_policies';
$route['hr-policies'] = 'Policies_ctrl/hr_policies';
$route['nhfhs'] = 'Authctrl/NhfhList';


$route['month-year'] = 'Authctrl/getMonthYear';
// $route['api/user/leave-requests'] = 'api/Emp_ctrl/LeaveRequest';

// $route['api/user/attendance'] = 'api/Emp_ctrl/Attendance';


$route['translate_uri_dashes'] = FALSE;
