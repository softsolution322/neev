<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
		$this->load->model('Mymodel', 'dbcon');
	}
	public function download_attendance_report_month()
	{
		$month  = $this->input->post('month');
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');

		$att_data_array = array();
		$current_session = $this->sumit->fetchSingleData('Session_Nm', 'session_master', array('Active_Status' => 1));
		$data['school_setting'] = $this->dbcon->select('school_setting', '*');
		$data['clssec'] = $this->db->query("SELECT DISTINCT DISP_CLASS, DISP_SEC  FROM `student`  WHERE CLASS=$classs AND SEC=$sec ;")->result();

		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = ($month < 4) ? $session_year[1] : $session_year[0];

		$data['current_year'] = $current_year;
		$data['mnth'] = $month;
		$att_type_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$classs'");
		$att_type = $att_type_data[0]->attendance_type;
		$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $current_year);
		$data['total_days'] = $total_days;

		if ($att_type == 1) { //for day wise
			$att_data_array = array();
			$studentList = $this->sumit->fetchAllData('*', 'student', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

			foreach ($studentList as $key => $value) {

				$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
				$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
				$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
				$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
				$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
				$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

				for ($i = 1; $i <= $total_days; $i++) {

					$custom_date = date('Y-m-d', strtotime($current_year . '-' . $month . '-' . $i));
					$checkSunday = date('N', strtotime($custom_date));
					$checkHoliday = false;

					if ($checkSunday != 7) {
						$checkHoliday = $this->sumit->checkData('*', 'holiday_master', "date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
					}

					if ($checkSunday  == 7 || $checkHoliday == true) {
						$att_data_array[$value['ADM_NO']][$i]['status'] = 'H';
					} else {
						$checkAttenStatus = $this->sumit->fetchSingleData('*', 'stu_attendance_entry', "admno='" . $value['ADM_NO'] . "' AND date(att_date)='$custom_date'");
						if (empty($checkAttenStatus)) {
							$att_data_array[$value['ADM_NO']][$i]['status'] = '-';
						} else {
							$att_data_array[$value['ADM_NO']][$i]['status'] = $checkAttenStatus['att_status'];
						}
					}
				}
			}
			$data['resultList'] = $att_data_array;
			$data['month'] = $month;
			$data['classs'] = $classs;
			$data['sec'] = $sec;

			$this->load->view('student/report/monthly_attendancepdf', $data);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Attendance.pdf", array("Attachment" => 0));
		} else { //for period wise
			$att_data_array = array();
			$studentList = $this->sumit->fetchAllData('*', 'student', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

			foreach ($studentList as $key => $value) {

				$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
				$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
				$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
				$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
				$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
				$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

				for ($i = 1; $i <= $total_days; $i++) {

					$custom_date = date('Y-m-d', strtotime($current_year . '-' . $month . '-' . $i));
					$checkSunday = date('N', strtotime($custom_date));
					$checkHoliday = false;

					if ($checkSunday != 7) {
						$checkHoliday = $this->sumit->checkData('*', 'holiday_master', "date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
					}
					for ($p = 1; $p <= 8; $p++) {

						if ($checkSunday  == 7 || $checkHoliday == true) {
							$att_data_array[$value['ADM_NO']][$i]['p' . $p] = 'H';
						} else {
							$checkAttenStatus = $this->sumit->fetchSingleData('*', 'stu_attendance_entry_periodwise', "admno='" . $value['ADM_NO'] . "' AND date(att_date)='$custom_date' AND period='$p'");
							if (empty($checkAttenStatus)) {
								$att_data_array[$value['ADM_NO']][$i]['p' . $p] = '-';
							} else {
								$att_data_array[$value['ADM_NO']][$i]['p' . $p] = $checkAttenStatus['att_status'];
							}
						}
					}
				}
			}

			$data['resultList'] = $att_data_array;
			$this->load->view('student/report/monthly_period_wise_report', $data);
		}
	}
	public function daily_wise()
	{

		if (!in_array('viewDailyAttenReport', permission_data)) {
			redirect('payroll/dashboard/emp_dashboard');
		}

		$data['ROLE_ID']    = login_details['ROLE_ID'];
		$data['log_cls_no'] = login_details['Class_No'];
		$data['class_data'] = $this->alam->select('student_attendance_type', '*');

		$this->render_template('student/report/daily_wise', $data);
	}


	public function download_attendance_report()
	{

		$dt = $this->input->post('dt');
		$date = date('Y-m-d', strtotime($dt));
		$classs = $this->input->post('class');
		$sec = $this->input->post('sec');
		$rpt_typ = $this->input->post('rpt_typ');

		$data['school_setting'] = $this->dbcon->select('school_setting', '*');
		$data['clssec'] = $this->db->query("SELECT DISTINCT DISP_CLASS, DISP_SEC  FROM `student`  WHERE CLASS=$classs AND SEC=$sec ;")->result();

		$data['dt'] = $dt;
		$data['class'] = $classs;
		$data['sec'] = $sec;
		$data['rpt_typ'] = $rpt_typ;

		$att_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$classs'");


		$att_typee = $att_data[0]->attendance_type;
		if ($att_typee == 1) {
			if ($rpt_typ == 'all') {
				$data['fetch_data'] = $this->alam->select('stu_attendance_entry', '*,(SELECT FIRST_NM FROM student where ADM_NO=stu_attendance_entry.admno)stunm,(SELECT DISP_CLASS FROM student where ADM_NO=stu_attendance_entry.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=stu_attendance_entry.admno)secnm,(SELECT ROLL_NO FROM student where ADM_NO=stu_attendance_entry.admno)roll,(SELECT C_MOBILE FROM student where ADM_NO=stu_attendance_entry.admno)cmob', "att_date='$date' AND class_code='$classs' AND sec_code='$sec' order by roll");
				$this->load->view('student/report/daily_attendancepdf', $data);
				$html = $this->output->get_output();
				$this->load->library('pdf');
				$this->dompdf->loadHtml($html);
				$this->dompdf->setPaper('A4', 'portrait');
				$this->dompdf->render();
				$this->dompdf->stream("SubjetcWiseAttendance.pdf", array("Attachment" => 0));
			} else {
				$data['fetch_data'] = $this->alam->select('stu_attendance_entry', '*,(SELECT FIRST_NM FROM student where ADM_NO=stu_attendance_entry.admno)stunm,(SELECT DISP_CLASS FROM student where ADM_NO=stu_attendance_entry.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=stu_attendance_entry.admno)secnm,(SELECT ROLL_NO FROM student where ADM_NO=stu_attendance_entry.admno)roll,(SELECT C_MOBILE FROM student where ADM_NO=stu_attendance_entry.admno)cmob', "att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_status = '$rpt_typ' order by roll");
				$this->load->view('student/report/daily_attendancepdf', $data);
				$html = $this->output->get_output();
				$this->load->library('pdf');
				$this->dompdf->loadHtml($html);
				$this->dompdf->setPaper('A4', 'portrait');
				$this->dompdf->render();
				$this->dompdf->stream("Attendance.pdf", array("Attachment" => 0));
			}
		} else {
			$data['fetch_data'] = $this->alam->select('stu_attendance_entry_periodwise as saep', "distinct(saep.admno),(SELECT FIRST_NM FROM student where ADM_NO=saep.admno)stunm,(SELECT ROLL_NO FROM student where ADM_NO=saep.admno)roll,(SELECT DISP_CLASS FROM student where ADM_NO=saep.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=saep.admno)secnm,(SELECT C_MOBILE FROM student where ADM_NO=saep.admno)cmob,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '1' AND att_date = '$date')P1,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '2' AND att_date = '$date')P2,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '3' AND att_date = '$date')P3,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '4' AND att_date = '$date')P4,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND att_date = '$date')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND att_date = '$date')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '6' AND att_date = '$date')P6,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '7' AND att_date = '$date')P7,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '8' AND att_date = '$date')P8", "saep.att_date='$date' AND saep.class_code='$classs' AND saep.sec_code='$sec' order by roll");
			$this->load->view('student/report/daily_attendancepdf', $data);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream("SubjetcWiseAttendance.pdf", array("Attachment" => 0));
		}
	}

	public function classes()
	{

		$ret      = '';
		$rett      = '';
		$class_nm = $this->input->post('val');
		$att_type_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;

		$sec_data = $this->alam->select_order_by('student', 'distinct(DISP_SEC),SEC', 'DISP_SEC', "CLASS='$class_nm' AND Student_Status='ACTIVE'");

		$ROLE_ID    = login_details['ROLE_ID'];
		$log_sec_no = login_details['Section_No'];

		$ret .= "<option value=''>Select</option>";
		if ($ROLE_ID != 4) {
			if (isset($sec_data)) {
				foreach ($sec_data as $data) {
					if ($log_sec_no == $data->SEC) {
						$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
					}
				}
			}
		} else {
			if (isset($sec_data)) { //for principal
				foreach ($sec_data as $data) {
					$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
				}
			}
		}
		if ($att_type == 2) {
			$rett .= "<option value=''>Select</option>";
			$rett .= "<option value='all'>All</option>";
		} else {
			$rett .= "<option value=''>Select</option>";
			$rett .= "<option value='P'>Present</option>";
			$rett .= "<option value='A'>Absent</option>";
			$rett .= "<option value='HD'>Half Day</option>";
			$rett .= "<option value='all'>All</option>";
		}
		$array = array($ret, $rett);
		echo json_encode($array);
	}

	public function fetch_daily_wise()
	{

		$dt = $this->input->post('dt');
		$date = date('Y-m-d', strtotime($dt));
		$att_type = $this->input->post('att_type');
		$classs = $this->input->post('classs');
		$att_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$classs'");
		$att_typee = $att_data[0]->attendance_type;
		$sec = $this->input->post('sec');
		$rpt_typ = $this->input->post('rpt_typ');
		$data['dt'] = $dt;
		$data['classs'] = $classs;
		$data['rpt_typ'] = $rpt_typ;
		$data['sec'] = $sec;
		if ($att_typee == 1) {
			if ($rpt_typ == 'all') {
				$data['fetch_data'] = $this->alam->select('stu_attendance_entry', '*,(SELECT FIRST_NM FROM student where ADM_NO=stu_attendance_entry.admno)stunm,(SELECT DISP_CLASS FROM student where ADM_NO=stu_attendance_entry.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=stu_attendance_entry.admno)secnm,(SELECT ROLL_NO FROM student where ADM_NO=stu_attendance_entry.admno)roll,(SELECT C_MOBILE FROM student where ADM_NO=stu_attendance_entry.admno)cmob', "att_date='$date' AND class_code='$classs' AND sec_code='$sec' order by roll");
				$this->load->view('student/report/day_wise_report', $data);
			} else {
				$data['fetch_data'] = $this->alam->select('stu_attendance_entry', '*,(SELECT FIRST_NM FROM student where ADM_NO=stu_attendance_entry.admno)stunm,(SELECT DISP_CLASS FROM student where ADM_NO=stu_attendance_entry.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=stu_attendance_entry.admno)secnm,(SELECT ROLL_NO FROM student where ADM_NO=stu_attendance_entry.admno)roll,(SELECT C_MOBILE FROM student where ADM_NO=stu_attendance_entry.admno)cmob', "att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_status = '$rpt_typ' order by roll");
				$this->load->view('student/report/day_wise_report', $data);
			}
		} else {
			$data['fetch_data'] = $this->alam->select('stu_attendance_entry_periodwise as saep', "distinct(saep.admno),(SELECT FIRST_NM FROM student where ADM_NO=saep.admno)stunm,(SELECT ROLL_NO FROM student where ADM_NO=saep.admno)roll,(SELECT DISP_CLASS FROM student where ADM_NO=saep.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=saep.admno)secnm,(SELECT C_MOBILE FROM student where ADM_NO=saep.admno)cmob,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '1' AND att_date = '$date')P1,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '2' AND att_date = '$date')P2,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '3' AND att_date = '$date')P3,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '4' AND att_date = '$date')P4,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND att_date = '$date')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND att_date = '$date')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '6' AND att_date = '$date')P6,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '7' AND att_date = '$date')P7,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '8' AND att_date = '$date')P8", "saep.att_date='$date' AND saep.class_code='$classs' AND saep.sec_code='$sec' order by roll");
			$this->load->view('student/report/period_wise_report', $data);
		}
	}
	//Monthly Wise
	public function monthly_wise()
	{

		if (!in_array('viewMonthlyAttenReport', permission_data)) {
			redirect('payroll/dashboard/emp_dashboard');
		}

		$data['ROLE_ID']    = login_details['ROLE_ID'];
		$data['log_cls_no'] = login_details['Class_No'];
		$data['month_data'] = $this->alam->select('month_master', 'month_name,month_code');
		$data['class_data'] = $this->alam->select('student_attendance_type', '*');
		$this->render_template('student/report/monthly_wise', $data);
	}

	public function monthly_classes()
	{
		$ret      = '';
		$class_nm = $this->input->post('val');
		$att_type_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;

		$sec_data = $this->alam->select_order_by('student', 'distinct(DISP_SEC),SEC', 'DISP_SEC', "CLASS='$class_nm' AND Student_Status='ACTIVE'");

		$ROLE_ID    = login_details['ROLE_ID'];
		$log_sec_no = login_details['Section_No'];

		$ret .= "<option value=''>Select</option>";
		if ($ROLE_ID != 4) {
			if (isset($sec_data)) {
				foreach ($sec_data as $data) {
					if ($log_sec_no == $data->SEC) {
						$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
					}
				}
			}
		} else {
			if (isset($sec_data)) { //for principal
				foreach ($sec_data as $data) {
					$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
				}
			}
		}
		$array = array($ret);
		echo json_encode($array);
	}

	public function month_wise_report()
	{
		$month  = $this->input->post('month');
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$att_data_array = array();
		$current_session = $this->sumit->fetchSingleData('Session_Nm', 'session_master', array('Active_Status' => 1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = ($month < 4) ? $session_year[1] : $session_year[0];

		$data['current_year'] = $current_year;
		$data['mnth'] = $month;
		$att_type_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$classs'");
		$att_type = $att_type_data[0]->attendance_type;
		$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $current_year);
		$data['total_days'] = $total_days;
		$data['month'] = $month;
		$data['classs'] = $classs;
		$data['sec'] = $sec;
		if ($att_type == 1) { //for day wise
			$att_data_array = array();
			$studentList = $this->sumit->fetchAllData('*', 'student', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

			foreach ($studentList as $key => $value) {

				$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
				$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
				$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
				$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
				$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
				$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

				for ($i = 1; $i <= $total_days; $i++) {

					$custom_date = date('Y-m-d', strtotime($current_year . '-' . $month . '-' . $i));
					$checkSunday = date('N', strtotime($custom_date));
					$checkHoliday = false;

					if ($checkSunday != 7) {
						$checkHoliday = $this->sumit->checkData('*', 'holiday_master', "date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
					}

					if ($checkSunday  == 7 || $checkHoliday == true) {
						$att_data_array[$value['ADM_NO']][$i]['status'] = 'H';
					} else {
						$checkAttenStatus = $this->sumit->fetchSingleData('*', 'stu_attendance_entry', "admno='" . $value['ADM_NO'] . "' AND date(att_date)='$custom_date'");
						if (empty($checkAttenStatus)) {
							$att_data_array[$value['ADM_NO']][$i]['status'] = '-';
						} else {
							$att_data_array[$value['ADM_NO']][$i]['status'] = $checkAttenStatus['att_status'];
						}
					}
				}
			}
			$data['resultList'] = $att_data_array;

			$this->load->view('student/report/monthly_day_wise_report', $data);
		} else { //for period wise
			$att_data_array = array();
			$studentList = $this->sumit->fetchAllData('*', 'student', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE'");

			foreach ($studentList as $key => $value) {

				$att_data_array[$value['ADM_NO']]['admno'] = $value['ADM_NO'];
				$att_data_array[$value['ADM_NO']]['name'] = $value['FIRST_NM'];
				$att_data_array[$value['ADM_NO']]['roll'] = $value['ROLL_NO'];
				$att_data_array[$value['ADM_NO']]['class'] = $value['DISP_CLASS'];
				$att_data_array[$value['ADM_NO']]['sec'] = $value['DISP_SEC'];
				$att_data_array[$value['ADM_NO']]['mobile'] = $value['C_MOBILE'];

				for ($i = 1; $i <= $total_days; $i++) {

					$custom_date = date('Y-m-d', strtotime($current_year . '-' . $month . '-' . $i));
					$checkSunday = date('N', strtotime($custom_date));
					$checkHoliday = false;

					if ($checkSunday != 7) {
						$checkHoliday = $this->sumit->checkData('*', 'holiday_master', "date('FROM_DATE')<='$custom_date' AND date('TO_DATE')>='$custom_date' AND CLASS_ID IN (0,'$classs')");
					}
					for ($p = 1; $p <= 8; $p++) {

						if ($checkSunday  == 7 || $checkHoliday == true) {
							$att_data_array[$value['ADM_NO']][$i]['p' . $p] = 'H';
						} else {
							$checkAttenStatus = $this->sumit->fetchSingleData('*', 'stu_attendance_entry_periodwise', "admno='" . $value['ADM_NO'] . "' AND date(att_date)='$custom_date' AND period='$p'");
							if (empty($checkAttenStatus)) {
								$att_data_array[$value['ADM_NO']][$i]['p' . $p] = '-';
							} else {
								$att_data_array[$value['ADM_NO']][$i]['p' . $p] = $checkAttenStatus['att_status'];
							}
						}
					}
				}
			}
			$data['resultList'] = $att_data_array;
			$this->load->view('student/report/monthly_period_wise_report', $data);
		}
	}
}
