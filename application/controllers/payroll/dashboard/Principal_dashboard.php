<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal_dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$login_details = $this->session->userdata('login_details');
		$this->load->model('Mymodel','dbcon');
	}

	public function index()
	{
		if(!in_array('viewPrincipalDashboard', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$date = date("Y-m-d");
		$data['totalStudentPresent'] = $this->attendance->totalPresentStudent();
		$data['todayPresentEmp'] = $this->attendance->getTodayPresentEmpData($date);
		$data['employee'] = $this->dbcon->select('employee','count(*)tot_emp','STATUS=1');
		$data['emp_attendance'] = $this->dbcon->select('emp_attendance','distinct(EMPLOYEE_ID)',"IN_TIME LIKE '$date %'");
		$data['student'] = $this->sumit->fetchAllData('STUDENTID','student',array('Student_Status'=>'ACTIVE'));
		$this->render_template('principal_dashboard/dash',$data);
	}

	public function totalStuAttendanceData($class='',$section='',$att_type='',$class_name='',$section_name='')
	{
		$date = date("Y-m-d");
		$data['class_name'] = $class_name;
		$data['section_name'] = $section_name;

		if($att_type == 1)
		{
			$totalStudent = $this->sumit->fetchTwoJoin('stu.ADM_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.CATEGORY,stu.SEX,sae.att_status','stu_attendance_entry sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND date(sae.att_date)='$date'");
			$data['totalStudent'] = $totalStudent;
		}
		else
		{
			$totalStudent = $this->attendance->classnPeriodWiseAttendance($class,$section);
			// $totalStudent = $this->sumit->fetchTwoJoin('stu.ADM_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.CATEGORY,stu.SEX,sae.att_status','stu_attendance_entry_periodwise sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND date(sae.att_date)='$date' AND period='1'");
			$data['totalStudentPeriodWise'] = $totalStudent;
		}	
		$this->render_template('principal_dashboard/attendanceFullData',$data);
	}


	function presentEmployee()
	{
		$date = date("Y-m-d");
		$data['todayPresentEmp'] = $this->attendance->getTodayPresentEmpData($date);
		$data['employee'] = $this->dbcon->select('employee','count(*)tot_emp','STATUS=1');
		$data['emp_attendance'] = $this->dbcon->select('emp_attendance','distinct(EMPLOYEE_ID)',array('date(IN_TIME)'=>$date));
		$this->render_template('principal_dashboard/empPresent',$data);
	}

	function presentStudent()
	{
		$all_class_total_attendance = 0;
		$final_stu_att_data = array();
		$date = date("Y-m-d");
		$stuPresentData = $this->attendance->getTotalStudentPresentForDash();

		foreach ($stuPresentData as $key => $value) {
			
			$class = $value['CLASS'];
			$section = $value['SEC'];

			if($value['att_type'] == 1)
			{
				$att_data = $this->sumit->fetchSingleData('COUNT(admno) as total','stu_attendance_entry',"class_code='$class' AND sec_code='$section' AND att_status='A' AND date(att_date)='$date'");

				$male_attendance = $this->sumit->fetchTwoJoin('COUNT(sae.admno) as total','stu_attendance_entry sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND att_status='A' AND date(sae.att_date)='$date' AND stu.SEX=1");

				$female_attendance = $this->sumit->fetchTwoJoin('COUNT(sae.admno) as total','stu_attendance_entry sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND att_status='A' AND date(sae.att_date)='$date' AND stu.SEX=2");
			}
			else
			{
				$att_data = $this->sumit->fetchSingleData('COUNT(admno) as total','stu_attendance_entry_periodwise',"class_code='$class' AND sec_code='$section' AND att_status='A' AND period='1' AND date(att_date)='$date'");

				$male_attendance = $this->sumit->fetchTwoJoin('COUNT(sae.admno) as total','stu_attendance_entry_periodwise sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND sae.att_status='A' AND date(sae.att_date)='$date' AND stu.SEX=1 AND period='1'");

				$female_attendance = $this->sumit->fetchTwoJoin('COUNT(sae.admno) as total','stu_attendance_entry_periodwise sae','student stu','sae.admno=stu.ADM_NO',"sae.class_code='$class' AND sae.sec_code='$section' AND sae.att_status='A' AND date(sae.att_date)='$date' AND stu.SEX=2 AND period='1'");
			}
			$total_attendance =  array(
				'total_attendance' => $att_data['total'],
				'total_male_attendance'	=> $male_attendance[0]['total'],
				'total_female_attendance'	=> $female_attendance[0]['total'],
			);
			$all_class_total_attendance = $att_data['total'] + $all_class_total_attendance;
			$final_stu_att_data[$key] = array_merge($value,$total_attendance);			
		}
		$data['final_stu_att_data'] = $final_stu_att_data;
		$data['all_class_total_attendance'] = $all_class_total_attendance;
		$this->render_template('principal_dashboard/classWiseAttendanceList',$data);
	}
}
