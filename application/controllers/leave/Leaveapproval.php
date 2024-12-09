<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaveapproval extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data_id = $this->session->userdata('login_details');
        $log_id = $data_id['user_id'];
		$wing_data = $this->alam->select('employee','WING_MASTER_ID',"EMPID='$log_id'");
		@$data['log_wing_id'] = $wing_data[0]->WING_MASTER_ID;
		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		
		$data['empLeave'] = $this->alam->select('emp_leave_attendance','*,(SELECT WING_MASTER_ID FROM employee where EMPID=EMPLOYEE_ID)wing_id,(SELECT EMP_FNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)empfnm,(SELECT EMP_MNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)empmnm,(SELECT EMP_LNAME from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)emplnm,(select DESIG from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID)desig,(select dg.DESIG from desig as dg where Sno=(select DESIG from employee where EMPID=emp_leave_attendance.EMPLOYEE_ID))designm',"STATUS='0' order by ID desc");
		
		
		$data['empApporoved'] = $this->alam->leave_approved();
		$data['empDisapporoved'] = $this->alam->leave_disapproved();

		$data['leaveTypeList'] = $this->custom_lib->leaveRequestLiveType();
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$this->render_template('leave/leaveapproval',$data);
	}
	
	public function leave_approval_sv_upd(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$updid    = $this->input->post('updid');
		$login_id = $this->input->post('login_id');
		$leave    = $this->input->post('leave');
		$lv_type  = $this->input->post('lv_type');
		$remarks  = $this->input->post('remarks');
		
		$upd_data = array(
		 'STATUS'     => $leave,
		 'ADMIN_ID'   => $login_id,
		 'LEAVE_TYPE' => $lv_type,
		 'REMARKS'    =>  $remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $updid,
		'STATUS'     => $leave,
		'LEAVE_TYPE' => $lv_type,
		'REMARKS'    => $remarks,
		'ADMIN_ID'   => $login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
	}
	
	public function leave_disapproval_sv_upd(){

		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$lv_apro_updid    = $this->input->post('lv_apro_updid');
		$lv_apro_login_id = $this->input->post('lv_apro_login_id');
		$leave            = $this->input->post('leave');
		$lv_apro_remarks  = $this->input->post('lv_apro_remarks');
		
		$upd_data = array(
		 'STATUS'   => $leave,
		 'ADMIN_ID' => $lv_apro_login_id,
		 'REMARKS' =>  $lv_apro_remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$lv_apro_updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $lv_apro_updid,
		'STATUS'   => $leave,
		'REMARKS'  => $lv_apro_remarks,
		'ADMIN_ID' => $lv_apro_login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
	}
	
	public function leave_reapproval_sv_upd(){
		
		if(!in_array('viewLeaveApproval', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$lv_disapro_updid    = $this->input->post('lv_disapro_updid');
		$lv_disapro_login_id = $this->input->post('lv_disapro_login_id');
		$leave               = $this->input->post('leave');
		$lv_disapro_remarks  = $this->input->post('lv_disapro_remarks');
		
		$upd_data = array(
		 'STATUS'   => $leave,
		 'ADMIN_ID' => $lv_disapro_login_id,
		 'REMARKS'  => $lv_disapro_remarks
		);
		$this->alam->update('emp_leave_attendance',$upd_data,"ID='$lv_disapro_updid'");
		
		$ins_data = array(
		'EMP_LEAVE_ATTENDANCE_ID' => $lv_disapro_updid,
		'STATUS'   => $leave,
		'REMARKS'  => $lv_disapro_remarks,
		'ADMIN_ID' => $lv_disapro_login_id
		);
		
		$this->alam->insert('emp_leave_history',$ins_data);
	}
}
