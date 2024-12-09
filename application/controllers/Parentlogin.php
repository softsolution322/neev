<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentlogin extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$this->load->view('parent/index');
	}
	public function loggedIn(){
		$adm = $this->input->post('user_id');
		$pass = $this->input->post('password');
		
		$data_count = $this->dbcon->checkData('*','student',array('ADM_NO'=>$adm,'Parent_password'=>$pass));
		$school = $this->dbcon->select('school_setting','*');
		if($data_count){
			$login_details = $this->dbcon->select('student','*',array('ADM_NO'=>$adm,'Parent_password'=>$pass));
			
			$student_id = $login_details[0]->STUDENTID;
			$student_adm = $login_details[0]->ADM_NO;
			$student_name = $login_details[0]->FIRST_NM;
			$student_status = $login_details[0]->Student_Status;
			
			
			if($student_status == "ACTIVE"){
				$father_details = $this->dbcon->select('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
				
				$this->session->set_userdata('adm',$student_adm);
				$this->session->set_userdata('std_id',$student_id);
				$this->session->set_userdata('class_code',$login_details[0]->CLASS);
				$this->session->set_userdata('sec_code',$login_details[0]->SEC);
				$this->session->set_userdata('father_name',$login_details[0]->FATHER_NM);
				$this->session->set_userdata('student_name',$student_name);
				$this->session->set_userdata('father_occu',$father_details[0]->OCCUPATION);
				$this->session->set_userdata('school_Name',$school[0]->School_Name);
				$this->session->set_userdata('school_logo',$school[0]->SCHOOL_LOGO);
				redirect('Parentlogin/parent_dashboard');
			}
			else{
				$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">STUDENT ID IS DEACTIVATED !</div>');
				redirect('Parentlogin/index');
			}
			
		}else{
			$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">Admission And Password Is Incorrect !</div>');
			redirect('Parentlogin/index');
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('school_Name');
		$this->session->unset_userdata('school_logo');
		$this->session->unset_userdata('father_name');
		$this->session->unset_userdata('adm');
		$this->session->unset_userdata('father_occu');
		$this->session->unset_userdata('std_id');
		$this->session->unset_userdata('class_code');
		$this->session->unset_userdata('sec_code');
		redirect('Parentlogin/index');
	}
	
	public function parent_dashboard(){
		$adm_no = $this->session->userdata('adm');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type','*',"class_code='$class_code'");
		$present_day = $this->dbcon->select('stu_attendance_entry','count(*)Present',"admno=$adm_no AND att_status='P'");
		$absent_day = $this->dbcon->select('stu_attendance_entry','count(*)Absent',"admno=$adm_no AND att_status='A'");
		$half_day = $this->dbcon->select('stu_attendance_entry','count(*)Halfday',"admno=$adm_no AND att_status='HD'");
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year = $session_master[0]->Session_Year;
		$start_date = $session_year."-04-01";
		$year = date('Y');
		$month = date('m');
		$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$end_date = $year."-".$month."-".$day;
		$period_wise_att = $this->dbcon->period_wise_data($adm_no,$start_date,$end_date);
		$array = array(
		'data' => $data,
		'present_day' => $present_day,
		'absent_day' => $absent_day,
		'half_day' => $half_day,
		'period_wise_att' => $period_wise_att
		);
		$this->Parent_templete('parents_dashboard/index',$array);
	}
	public function profileview(){
		$student_id = $this->session->userdata("std_id");
		$student_adm = $this->session->userdata("adm");
		$student_details = $this->dbcon->selectSingleData('student','*',"ADM_NO='$student_adm'");
		$father_details = $this->dbcon->selectSingleData('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
		$array = array(
			'father_details' => $father_details,
			'student'	=> $student_details
		);
		$this->Parent_templete('parents_dashboard/profile',$array);
	}
	public function holidaycalender(){
		$this->Parent_templete('parents_dashboard/holiday_calender');
	}
	public function holiday_details(){
	
	$year = $_REQUEST['year'];
	$month = $_REQUEST['month'];

	$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
	$endDate = $year.'-'.$month.'-'.$total_days;
	$startDate = $year.'-'.$month.'-1';
	$atten_arr = array();
	 $holidayList = $this->sumit->fetchAllData('*','holiday_master',array('date(FROM_DATE) >='=>$startDate,'date(TO_DATE) <='=>$endDate));
	  // echo "<pre>";
	  // print_r($this->db->last_query());
	  // exit;
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
	
}