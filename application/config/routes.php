<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = array(); 

$route['default_controller'] = 'auth';
$route['404_override'] = '';

///emp///////////
$route['dashboard1'] = 'Emp_ctrl/index/';
$route['dashboard'] = 'Emp_ctrl/dotnet_dashboard/';


$route['policy/IT-Policies'] = 'Emp_ctrl/it_policies/';
$route['policy/HR-Policies'] = 'Emp_ctrl/hr_policies/';

// $route['es/IT-Policies'] = 'Emp_ctrl/it_policies/';
// $route['es/HR-Policies'] = 'Emp_ctrl/hr_policies/';

$route['es/leave-request'] = 'Emp_ctrl/leave_request/';
$route['es/hf-leave-request'] = 'Emp_ctrl/hf_leave_request/';
$route['es/hf-leave-request-cancel/(:any)'] = 'Emp_ctrl/hf_leave_request_cancel/$1';
$route['es/off-day-duty-form'] = 'Emp_ctrl/off_day_duty_form/';
$route['es/nh-fh-day-duty-form'] = 'Emp_ctrl/nh_fh_day_duty_form/';
$route['es/Tour-Request-Form'] = 'Emp_ctrl/tour_request_form/';
$route['es/All-Report'] = 'Emp_ctrl/all_report/';
$route['es/All-Report/(:any)/(:any)'] = 'Emp_ctrl/all_report/$1/$2';
$route['es/NH-FH-Avail-Form'] = 'Emp_ctrl/nh_fh_avail_form/';
$route['es/PL-Summary-Report'] = 'Emp_ctrl/pl_summary_report/';
$route['es/Attendance-Record'] = 'Emp_ctrl/attendance/';

$route['es/cab'] = 'Cab_ctrl/index/';
$route['es/cab/requests'] = 'Cab_ctrl/view_requests/';
$route['es/cab/requests_detail'] = 'Cab_ctrl/request_detail/';


///////	KRA ////////////////////
$route['HOD/(:any)/KRA'] = 'Kra_ctrl/hod_dashboard/$1';
$route['HOD/(:any)/KRA/(:any)'] = 'Kra_ctrl/hod_dashboard/$1/$2';
$route['HOD/(:any)/KRA/(:any)/(:any)'] = 'Kra_ctrl/employee_detail/$2/$3';
$route['HOD/score/(:any)/(:any)/(:any)'] = 'Kra_ctrl/appraiser_score/$1/$2/$3';

$route['es/KRA_old/(:any)'] = 'Kra_ctrl_old/index/$1';
$route['es/KRA_old/(:any)/(:any)'] = 'Kra_ctrl_old/index/$1/$2';

$route['es/KRA/(:any)'] = 'Kra_ctrl/index/$1';
$route['es/KRA/(:any)/(:any)'] = 'Kra_ctrl/index/$1/$2';

$route['HR/KRA/(:any)/(:any)'] = 'Kra_ctrl/hr_dashboard/$1/$2';
$route['HR/KRA/(:any)/(:any)/(:any)/(:any)'] = 'Kra_ctrl/hr_dashboard/$1/$2/$3/$4';

///OUTPUT
$route['output/broadcast/(:any)'] = 'output/Output_ctrl/index/$1';
$route['output/broadcast/video/download/(:any)/(:any)'] = 'output/output_ctrl/download_file/$1/$2';

///hod////////////////
$route['hod/leave-request'] = 'hod/Hod_ctrl/leave_request/';
$route['hod/leave-request/(:any)'] = 'hod/Hod_ctrl/leave_request/$1';
$route['hod/leave-request-update'] = 'hod/Hod_ctrl/leave_request_update';

$route['hod/hf-leave-request'] = 'hod/Hf_leave_ctrl/hf_leave_request/';
$route['hod/hf-leave-request/(:any)'] = 'hod/Hf_leave_ctrl/hf_leave_request/$1';
$route['hod/hf-leave-request-update'] = 'hod/Hf_leave_ctrl/hf_leave_request_update';

$route['hod/off-day-duty-request'] = 'hod/Off_day_duty_ctrl/off_day_duty_request/';
$route['hod/off-day-duty-request/(:any)'] = 'hod/Off_day_duty_ctrl/off_day_duty_request/$1';
$route['hod/off-day-duty-update'] = 'hod/Off_day_duty_ctrl/off_day_duty_request_update';

$route['hod/nh-fh-day-duty-request'] = 'hod/Nh_fh_ctrl/nh_fh_day_duty_request/';
$route['hod/nh-fh-day-duty-request/(:any)'] = 'hod/Nh_fh_ctrl/nh_fh_day_duty_request/$1';
$route['hod/nh-fh-day-duty-update'] = 'hod/Nh_fh_ctrl/nh_fh_day_duty_request_update';

$route['hod/nh-fh-avail-request'] = 'hod/Nh_fh_avail_ctrl/nh_fh_avail_request/';
$route['hod/nh-fh-avail-request/(:any)'] = 'hod/Nh_fh_avail_ctrl/nh_fh_avail_request/$1';
$route['hod/nh-fh-avail-request-update'] = 'hod/Nh_fh_avail_ctrl/nh_fh_avail_request_update';

$route['hod/pl-record'] = 'hod/Hod_ctrl/pl_record/';
$route['hod/pl-record/(:any)'] = 'hod/Hod_ctrl/pl_record/$1';
$route['hod/pl-record-update'] = 'hod/Hod_ctrl/pl_record_update';

$route['hr/pl-add-manual'] = 'Hr_ctrl/pl_add_manual';
$route['hr/adjustment-cancel'] = 'Hr_ctrl/adjustment_cancel'; 

////HR////////////////
$route['hr/hr_policies'] = 'Hr_ctrl/policies/';
$route['hr/roster'] = 'Hr_ctrl/roster/';
$route['hr/Emp-Info'] = 'Hr_ctrl/emp_info/';
$route['emp/hr/Salary-Slip'] = 'Hr_ctrl/salary_slip/';
$route['emp/hr/Holiday-List'] = 'Hr_ctrl/holiday_list/';

$route['hr/leave-request'] = 'Hr_ctrl/leave_request';
$route['hr/leave-request/(:any)'] = 'Hr_ctrl/leave_request/$1';
$route['hr/leave-request-update'] = 'Hr_ctrl/leave_request_update';

$route['hr/hf-leave-request'] = 'hr/Hf_leave_ctrl/hf_leave_request';
$route['hr/hf-leave-request/(:any)'] = 'Hr_ctrl/hf_leave_request/$1';

$route['hr/off-day-duty-request'] = 'hr/Off_day_duty_ctrl/off_day_duty_request/';
$route['hr/off-day-duty-request/(:any)'] = 'Hr_ctrl/off_day_duty_request/$1';
$route['hr/off-day-duty-update'] = 'Hr_ctrl/off_day_duty_request_update';

$route['hr/nh-fh-day-duty-request'] = 'Hr_ctrl/nh_fh_day_duty_request/';
$route['hr/nh-fh-day-duty-request/(:any)'] = 'Hr_ctrl/nh_fh_day_duty_request/$1';
$route['hr/nh-fh-day-duty-update'] = 'Hr_ctrl/nh_fh_day_duty_request_update';



$route['hr/Policies'] = 'Hr_ctrl/policies';
$route['hr/plreview'] = 'Hr_ctrl/pl_deduction';
/////master//////////
$route['master/USER-ROLE'] = 'master/Role_ctrl/index';

$route['master/SHIFT/export'] = 'master/Shift_ctrl/attendance_sheet_export';
$route['master/SHIFT'] = 'master/Shift_ctrl/index';
$route['master/nhfh/create'] = 'master/Nh_fh_ctrl/nhfh_create';
$route['master/nhfh/update'] = 'master/Nh_fh_ctrl/nhfh_update';
$route['master/nhfh/delete'] = 'master/Nh_fh_ctrl/nhfh_delete';

$route['master/NH-FH'] = 'master/Nh_fh_ctrl/index';
$route['master/nhfh/create'] = 'master/Nh_fh_ctrl/nhfh_create';
$route['master/nhfh/update'] = 'master/Nh_fh_ctrl/nhfh_update';
$route['master/nhfh/delete'] = 'master/Nh_fh_ctrl/nhfh_delete';

$route['master/department'] = 'master/Department_ctrl/index';
$route['master/department/list'] = 'master/Department_ctrl/department';
$route['master/department/update'] = 'master/Department_ctrl/department_update';
$route['master/department/create'] = 'master/Department_ctrl/department_create';
$route['master/department/delete'] = 'master/Department_ctrl/department_delete';

$route['master/designation'] = 'master/Designation_ctrl/index';
$route['master/designation/list'] = 'master/Designation_ctrl/designation';
$route['master/designation/update'] = 'master/Designation_ctrl/designation_update';
$route['master/designation/create'] = 'master/Designation_ctrl/designation_create';
$route['master/designation/delete'] = 'master/Designation_ctrl/designation_delete';

$route['master/grade'] = 'master/Grade_ctrl/index';
$route['master/grade/list'] = 'master/Grade_ctrl/grade';
$route['master/grade/update'] = 'master/Grade_ctrl/grade_update';
$route['master/grade/create'] = 'master/Grade_ctrl/grade_create';
$route['master/grade/delete'] = 'master/Grade_ctrl/grade_delete';

$route['master/empcode'] = 'master/Empcode_ctrl/index';
$route['master/empcode/list'] = 'master/Empcode_ctrl/empcode';
$route['master/empcode/update'] = 'master/Empcode_ctrl/empcode_update';
$route['master/empcode/create'] = 'master/Empcode_ctrl/empcode_create';
$route['master/empcode/delete'] = 'master/Empcode_ctrl/empcode_delete';

$route['master/location'] = 'master/Location_ctrl/index';
$route['master/location/list'] = 'master/Location_ctrl/location';
$route['master/location/update'] = 'master/Location_ctrl/location_update';
$route['master/location/create'] = 'master/Location_ctrl/location_create';
$route['master/location/delete'] = 'master/Location_ctrl/location_delete';

$route['master/employee'] = 'master/Employee_ctrl/index';
$route['master/employee/create'] = 'master/Employee_ctrl/create';
$route['master/employee/update/(:any)'] = 'master/Employee_ctrl/update/$1';
$route['master/employee/privileges/(:any)'] = 'master/Employee_ctrl/privileges/$1';
$route['master/employee/(:any)'] = 'master/Employee_ctrl/employee_detail/$1';

$route['master/Cab-zone'] = 'master/Cab_ctrl/index';



////////////////////////////////////APIS/////////////////////////////////////
$route['api/user/leave-requests'] = 'api/Emp_ctrl/LeaveRequest';
$route['api/user/half_day-requests'] = 'api/Emp_ctrl/halfDayRequest';
$route['api/user/attendance'] = 'api/Emp_ctrl/Attendance';
$route['api/user/off_day_duty-request'] = 'api/Emp_ctrl/offDaydutyRequest';
$route['api/user/tour-request'] = 'api/Emp_ctrl/tourRequest';
$route['api/user/nhfhs'] = 'api/Emp_ctrl/NhfhList';

$route['translate_uri_dashes'] = FALSE;
