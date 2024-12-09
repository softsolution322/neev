<?php 

class Attendance_report extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewMonthlyAttenReports', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		if(isset($_POST['search']))
		{
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$data['total_days'] = $total_days;
			$data['month'] = $month;
			$data['year'] = $year;
			$check_atten_data = $this->sumit->checkData('month','monthly_emp_attend_gen',array('month'=>$month,'year'=>$year));
			if($check_atten_data)
			{
				$data['contentShow'] = 'true';
				$attendaceData = $this->attendance->getMonthWiseAttendance($year,$month);
				$data['attendaceData'] = $attendaceData;
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Attendance Not Generated</div>');
			}
		}
		$staffType = $this->custom_lib->getStaffType();
		$data['staffType'] = $staffType;
		$this->render_template('other_report/monthlyAttendanceReport',$data);
	}

	public function generateMonthlyAttenReportPDF($year,$month)
	{
		if(!in_array('viewMonthlyAttenReports', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));

		$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$data['total_days'] = $total_days;
		$data['month'] = $month;
		$data['year'] = $year;
		$attendaceData = $this->attendance->getMonthWiseAttendance($year,$month);
		$data['attendaceData'] = $attendaceData;
		$this->load->view('other_report/monthlyAttendanceReportPDF',$data);

		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("monthly_atten_report.pdf", array("Attachment"=>0));
	}
}