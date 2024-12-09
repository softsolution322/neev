<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$login_details = $this->session->userdata('login_details');
		$this->load->model('Mymodel','dbcon');
	}
	public function index()
	{
		if(!in_array('viewEmpDashboard', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		//start checking both wing_master_id is same or not
		$session_data = $this->session->userdata('login_details');
		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			$data['employeeList'] = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeList'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'STATUS'=>1));
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeList'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'ROLE_ID !='=>5,'STATUS'=>1));
		}
		//end checking both wing_master_id is same or not
		
		if(isset($_POST['search']))
		{
			$emp_id = $this->input->post('emp_id');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');
			$emp_id = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
			$emp_id = $emp_id['id'];
		}
		$data['emp_id'] = $emp_id;
		$data['employeeData'] = $this->sumit->getSingleEmployee($emp_id);
		$employee_id = $data['employeeData']['EMPID'];
		$data['cas_leave_balance'] = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,SUM(TOTAL_DAYS) as leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=1",'LEAVE_TYPE');
		$data['ml_balance'] = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,SUM(TOTAL_DAYS) as leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=2",'LEAVE_TYPE');
		$data['el_balance'] = $this->sumit->fetchSingleDataGroupBy('LEAVE_TYPE,SUM(TOTAL_DAYS) as leave_bal','emp_leave_attendance',"EMPLOYEE_ID='$employee_id' AND STATUS IN (0,1) AND LEAVE_TYPE=3",'LEAVE_TYPE');

		//principal dashboard code
		$date = date("Y-m-d");
		$data['totalStudentPresent'] = $this->attendance->totalPresentStudent();
		$data['todayPresentEmp'] = $this->attendance->getTodayPresentEmpData($date);
		$data['employee'] = $this->dbcon->select('employee','count(*)tot_emp','STATUS=1');
		$data['emp_attendance'] = $this->dbcon->select('emp_attendance','distinct(EMPLOYEE_ID)',"IN_TIME LIKE '$date %'");
		$data['student'] = $this->sumit->fetchAllData('STUDENTID','student',array('Student_Status'=>'ACTIVE'));
		$data['leaveCount'] = $this->attendance->getLeaveCount();
		$data['todaycollection'] = $this->sumit->fetchSingleData('SUM(TOTAL)total_amt','daycoll',"date(RECT_DATE)='$date'");
		$data['attendanceData'] = $this->attendance->getAttendanceData($emp_id);
		$data['holidayList'] = $this->sumit->fetchAllData('*','holiday_master',"APPLIED_FOR	IN (0,1)");
		$this->render_template('payroll_dashboard/employeeDashboard',$data);
	}

	public function getEventData($emp_id)
	{
		$year = $_REQUEST['year'];
		$month = $_REQUEST['month'];
		if($month < 10)
		{
			$month = '0'.$month;
		}
		$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$endDate = $year.'-'.$month.'-'.$total_days;
		$startDate = $year.'-'.$month.'-1';
		$atten_arr = array();
		$employeeData = $this->sumit->getSingleEmployee($emp_id);
		$shift_id = str_replace('-', ',', $employeeData['SHIFT']);
		for ($i=1; $i <= $total_days ; $i++) { 
			
			$day = $i;
			if($i < 10)
			{
				$day = '0'.$i;
			}
			$new_date = $year.'-'.$month.'-'.$day;
			$present_check = $this->sumit->checkData('*','emp_attendance',array('date(IN_TIME)'=>$new_date,'EMPLOYEE_ID'=>$emp_id));

			if($present_check)
			{
				$in_time = $this->sumit->fetchSingleData('*','emp_attendance',"IN_TIME = (SELECT min(IN_TIME) FROM emp_attendance WHERE EMPLOYEE_ID='$emp_id' AND date(IN_TIME)='$new_date')");
				$out_time = $this->sumit->fetchSingleData('*','emp_attendance',"OUT_TIME = (SELECT max(OUT_TIME) FROM emp_attendance WHERE EMPLOYEE_ID='$emp_id' AND date(IN_TIME)='$new_date')");
				$classname = "present";
				// if($in_time['IN_CHECK_DIFFER'] > 0)
				// {
				// 	$classname = 'late_in';
				// }
				// if($out_time['OUT_CHECK_DIFFER'] > 0)
				// {
				// 	$classname = "before_out";
				// }
				// if($in_time['IN_CHECK_DIFFER'] > 0 && $out_time['OUT_CHECK_DIFFER'] > 0)
				// {
				// 	$classname = "late_in_before_out";
				// }
				$atten_arr[] = array(
					"date" 		=> date("Y-m-d", strtotime($new_date)),
					"badge"		=> false,
					"classname" => $classname,
					"title"		=> date('H:i:s',strtotime($in_time['IN_TIME'])).' - '. date('H:i:s',strtotime($out_time['OUT_TIME'])).' '.$in_time['REMARKS'].' ',
					"data-toggle"=>"tooltip"
				);
			}
		}

		$holidayList = $this->sumit->fetchAllData('*','holiday_master',"date(FROM_DATE) >= '$startDate' AND date(TO_DATE) <= '$endDate' AND (APPLIED_FOR = 0 OR APPLIED_FOR = 1)");
		foreach ($holidayList as $key => $value) {
			$start_date = $value['FROM_DATE'];
			$end_date = $value['TO_DATE'];

			for($i = $start_date; $i <= $end_date; $i++)
			{
				$atten_arr[] = array(
					"date" => date("Y-m-d", strtotime($i)),
					"badge"	=> false,
					"classname" => "holiday",
					"title"		=> $value['NAME'],
				);
			}
			
		}
		echo json_encode(json_decode(json_encode($atten_arr)));
	}

	public function getRemarks()
	{
		$date = $this->input->post('date');
		$emp_id = $this->input->post('emp_id');
		$check_remarks = $this->sumit->fetchSingleData('REMARKS','emp_attendance',array('date(IN_TIME)'=>$date,'EMPLOYEE_ID'=>$emp_id));
		if(empty($check_remarks))
		{
			$check_remarks = 1;
		}
		echo json_encode($check_remarks);
	}

	public function updateRemarks()
	{
		$response = array();
		$date = $this->input->post('date');
		$emp_id = $this->input->post('emp_id');
		$remarks = $this->input->post('remarks');
		$update = $this->sumit->update('emp_attendance',array('REMARKS'=>$remarks),array('date(IN_TIME)'=>$date,'EMPLOYEE_ID'=>$emp_id));
		if($update)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
}
