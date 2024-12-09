<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendancepercentagereport extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		// echo "asdda";die;
		$data['classList'] =$this->sumit->fetchAllData('*','classes',array());
		if(isset($_POST['search']))
		{
			$class_id = $this->input->post('class_id');
			$section_id = $this->input->post('section_id');
			$date_from = date('Y-m-d',strtotime($this->input->post('date_from')));
			$date_to = date('Y-m-d',strtotime($this->input->post('date_to')));

			$checkAttendanceType = $this->sumit->fetchSingleData('*','student_attendance_type',"class_code='$class_id'");
			$studentList = $this->sumit->fetchAllData('*','student',"CLASS='$class_id' AND SEC='$section_id' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");
			if($checkAttendanceType['attendance_type']==1)
			{
				foreach ($studentList as $key => $value) {
					
					$attendance = $this->sumit->fetchSingleData('count(att_date)total_attendance','stu_attendance_entry',"admno='".$value['ADM_NO']."' AND att_status IN ('P','HD') AND date(att_date)>='$date_from' AND date(att_date)<='$date_to'");
					$resultList[] = array(
						'stu_name'	=> $value['FIRST_NM'].' '.$value['MIDDLE_NM'],
						'roll_no'	=> $value['ROLL_NO'],
						'admno'		=> $value['ADM_NO'],
						'disp_class'=> $value['DISP_CLASS'],
						'disp_sec'	=> $value['DISP_SEC'],
						'total_attendance'	=> $attendance['total_attendance'],
					);
				}
				$data['totalAttendance'] = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance','stu_attendance_entry',"date(att_date)>='$date_from' AND date(att_date)<='$date_to' AND class_code='$class_id' AND sec_code='$section_id'");
			}
			else
			{
				foreach ($studentList as $key => $value) {
					
					$attendance = $this->sumit->fetchSingleData('count(DISTINCT att_date)total_attendance','stu_attendance_entry_periodwise',"admno='".$value['ADM_NO']."' AND att_status='P' AND date(att_date)>='$date_from' AND date(att_date)<='$date_to'");

					$resultList[] = array(
						'stu_name'	=> $value['FIRST_NM'].' '.$value['MIDDLE_NM'],
						'roll_no'	=> $value['ROLL_NO'],
						'admno'		=> $value['ADM_NO'],
						'disp_class'=> $value['DISP_CLASS'],
						'disp_sec'	=> $value['DISP_SEC'],
						'total_attendance'	=> $attendance['total_attendance'],
					);
				}

				$data['totalAttendance'] = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance','stu_attendance_entry_periodwise',"date(att_date)>='$date_from' AND date(att_date)<='$date_to' AND class_code='$class_id' AND sec_code='$section_id'");
			}

			$data['resultList'] = $resultList;
		}
		$data['class_id'] = $class_id;
		$data['section_id'] = $section_id;
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$this->render_template('student/report/attendancePercentageReport',$data);
	}
	
	public function getSectionByClassID()
	{
		$class_id = $this->input->post('class_id');
		$sectionList = $this->sumit->fetchAllData('DISTINCT(SEC),DISP_SEC','student',"CLASS='$class_id' ORDER BY DISP_SEC ASC");
		echo json_encode($sectionList);
	}
	public function download_attendancepercentagereport()
	{
		$this->load->model('Alam', 'alam');
		$this->load->model('Mymodel', 'dbcon');
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$date_from = date('Y-m-d', strtotime($this->input->post('date_from')));
		$date_to = date('Y-m-d', strtotime($this->input->post('date_to')));

		$school_setting = $this->dbcon->select('school_setting', '*');
		
	    // $data['clssec']=$this->dbcon->select("SELECT DISTINCT DISP_CLASS, DISP_SEC  FROM `student`  WHERE CLASS=$classs AND SEC=$sec ");

		$checkAttendanceType = $this->sumit->fetchSingleData('*', 'student_attendance_type', "class_code='$class_id'");
		$studentList = $this->sumit->fetchAllData('*', 'student', "CLASS='$class_id' AND SEC='$section_id' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");

		if ($checkAttendanceType['attendance_type'] == 1) {
			foreach ($studentList as $key => $value) {

				$attendance = $this->sumit->fetchSingleData('count(att_date)total_attendance', 'stu_attendance_entry', "admno='" . $value['ADM_NO'] . "' AND att_status IN ('P','HD') AND date(att_date)>='$date_from' AND date(att_date)<='$date_to'");
				$resultList[] = array(
					'stu_name'	=> $value['FIRST_NM'] . ' ' . $value['MIDDLE_NM'],
					'roll_no'	=> $value['ROLL_NO'],
					'admno'		=> $value['ADM_NO'],
					'disp_class' => $value['DISP_CLASS'],
					'disp_sec'	=> $value['DISP_SEC'],
					'total_attendance'	=> $attendance['total_attendance'],
				);
			}
			$data['totalAttendance'] = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance', 'stu_attendance_entry', "date(att_date)>='$date_from' AND date(att_date)<='$date_to' AND class_code='$class_id' AND sec_code='$section_id'");
		} else {
			foreach ($studentList as $key => $value) {

				$attendance = $this->sumit->fetchSingleData('count(DISTINCT att_date)total_attendance', 'stu_attendance_entry_periodwise', "admno='" . $value['ADM_NO'] . "' AND att_status='P' AND date(att_date)>='$date_from' AND date(att_date)<='$date_to'");

				$resultList[] = array(
					'stu_name'	=> $value['FIRST_NM'] . ' ' . $value['MIDDLE_NM'],
					'roll_no'	=> $value['ROLL_NO'],
					'admno'		=> $value['ADM_NO'],
					'disp_class' => $value['DISP_CLASS'],
					'disp_sec'	=> $value['DISP_SEC'],
					'total_attendance'	=> $attendance['total_attendance'],
				);
			}

			$data['totalAttendance'] = $this->sumit->fetchSingleData('COUNT(DISTINCT att_date)total_attendance', 'stu_attendance_entry_periodwise', "date(att_date)>='$date_from' AND date(att_date)<='$date_to' AND class_code='$class_id' AND sec_code='$section_id'");

			
		}

		$data['resultList'] = $resultList;
		$data['school_setting'] = $school_setting;
		$data['clssec'] = $clssec;
			

		$this->load->view('student/report/attendancePercentageReportpdf', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Attendance.pdf", array("Attachment" => 0));
	}
}
