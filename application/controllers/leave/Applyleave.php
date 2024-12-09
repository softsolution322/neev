<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applyleave extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewApplyLeave', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session_data = $this->session->userdata('login_details');
		$data['leaveRequestList'] = $this->sumit->fetchAllData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$session_data['user_id']));
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/applyLeave',$data);
	}

	public function manualLeave()
	{
		if(!in_array('viewApplyManualLeave', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session_data = $this->session->userdata('login_details');
		if($session_data['ROLE_ID'] == 4 || $session_data['ROLE_ID'] == 1)
		{
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));
		}
		elseif($session_data['ROLE_ID'] == 5)
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'STATUS'=>1));
		}
		else
		{
			$emp = $this->sumit->fetchSingleData('WING_MASTER_ID','employee',array('EMPID'=>$session_data['user_id']));
			$data['employeeDetails'] = $this->sumit->fetchAllData('*','employee',array('WING_MASTER_ID'=>$emp['WING_MASTER_ID'],'ROLE_ID !='=>5,'STATUS'=>1));
		}
		$data['leaveRequestList'] = $this->sumit->fetchAllData('*','emp_leave_attendance',array('MANUAL_ADMIN_ID'=>$session_data['user_id']));
		$data['designation'] = $this->sumit->fetchAllData('*','desig',array());
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/applyManualLeave',$data);
	}

	public function create()
	{
		if(!in_array('addApplyLeave', permission_data) || !in_array('addApplyManualLeave', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$response = array();
		$session_data = $this->session->userdata('login_details');

		$apply_date = $this->input->post('apply_date');
		$leave_type = $this->input->post('leave_type');
		$leave_date = $this->input->post('leave_date');
		$against_date = $this->input->post('against_date');
		$reason = $this->input->post('leave_reason');
		$reason_details = $this->input->post('reason_details');

		$emp_id = $this->input->post('emp_id');
		$manual_admin_id = $session_data['user_id'];
		$redirect_status = 1; 
		if($emp_id == '')
		{
			$redirect_status = 0;
			$emp_id = $session_data['user_id'];
			$manual_admin_id = 0;
		}

		$leave_date = explode('-', $leave_date);
		$date_from = $leave_date[0];
		$date_to = $leave_date[1];
		$against_date = explode('-', $against_date);
		$against_date_from = $against_date[0];
		$against_date_to = $against_date[1];

		$no_of_days = 1 + (strtotime($date_to) - strtotime($date_from))  / (60 * 60 * 24);
		$data = array(
			'EMPLOYEE_ID'	=> $emp_id,
			'APPLY_DATE'	=> date('Y-m-d',strtotime($apply_date)),
			'LEAVE_TYPE'	=> $leave_type,
			'APPLIED_LEAVE_TYPE'=> $leave_type,
			'DATE_FROM'		=> date('Y-m-d',strtotime($date_from)),
			'DATE_TO'		=> date('Y-m-d',strtotime($date_to)),
			'AGAINST_DATE_FROM'	=> date('Y-m-d',strtotime($against_date_from)),
			'AGAINST_DATE_TO'=> date('Y-m-d',strtotime($against_date_to)),
			'TOTAL_DAYS'	=> $no_of_days,
			'REASON'		=> $reason,
			'REASON_DETAILS'=> html_escape($reason_details),
			'DOCUMENT'		=> '',
			'STATUS'		=> 0,
			'ADMIN_ID'		=> 0,
			'MANUAL_ADMIN_ID'=> $manual_admin_id,
		);
		if(isset($_FILES['document']['name']) && !empty($_FILES['document']['name']))
		{
			if (!file_exists('assets/emp_leave_document')) {
			   mkdir('assets/emp_leave_document', 0777, true);
			 }
			$image_name=$_FILES['document']['name'];
			$temp = explode(".", $image_name);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$imagepath="assets/emp_leave_document/".$newfilename;
			move_uploaded_file($_FILES["document"]["tmp_name"],$imagepath);
			$data['DOCUMENT'] = $imagepath;
		}
		$create = $this->sumit->createData('emp_leave_attendance',$data);
		if($create)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Your Request Created Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Your Request Creation Failed! </div>');
		}

		if($redirect_status == 0)
		{
			redirect('leave/applyleave');
		}
		else
		{
			redirect('leave/applyleave/manualLeave');
		}
	}

	public function getTotalLeave()
	{
		$session_data = $this->session->userdata('login_details');
		$emp_id = $this->input->post('emp_id');

		if($emp_id == '')
		{
			$emp_id = $session_data['user_id'];
		}

		$leave_type = $this->input->post('leave_type');
		$consumedLeave = $this->sumit->fetchSingleData('sum(TOTAL_DAYS) as total_days','emp_leave_attendance',array('EMPLOYEE_ID'=>$emp_id, 'LEAVE_TYPE'=>$leave_type,'status'=>'IN (0,1)'));
		$total_days = 0;
		if($leave_type == 1)
		{
			$leaveTotal = $this->sumit->fetchSingleData('CAS_LEAVE','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['CAS_LEAVE'] - $consumedLeave['total_days'];
		}
		elseif($leave_type == 2)
		{
			$leaveTotal = $this->sumit->fetchSingleData('ML','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['ML'] - $consumedLeave['total_days'];
		}
		else
		{
			$leaveTotal = $this->sumit->fetchSingleData('EL','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['EL'] - $consumedLeave['total_days'];
		}
		echo json_encode($total_leave);
	}


	public function getTotalLeaveAtApproval()
	{
		$emp_id = $this->input->post('emp_id');
		$leave_type = $this->input->post('leave_type');
		$consumedLeave = $this->sumit->fetchSingleData('sum(TOTAL_DAYS) as total_days','emp_leave_attendance',array('EMPLOYEE_ID'=>$emp_id, 'LEAVE_TYPE'=>$leave_type,'status'=>1));
		$total_days = 0;
		if($leave_type == 1)
		{
			$leaveTotal = $this->sumit->fetchSingleData('CAS_LEAVE','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['CAS_LEAVE'] - $consumedLeave['total_days'];
		}
		elseif($leave_type == 2)
		{
			$leaveTotal = $this->sumit->fetchSingleData('ML','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['ML'] - $consumedLeave['total_days'];
		}
		else
		{
			$leaveTotal = $this->sumit->fetchSingleData('EL','employee',array('EMPID'=>$emp_id));
			$total_leave = $leaveTotal['EL'] - $consumedLeave['total_days'];
		}
		echo json_encode($total_leave);
	}
}
