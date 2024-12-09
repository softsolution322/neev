<?php 

class Deduction_report extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewDeductionReport', permission_data))
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
			$check_data = $this->sumit->checkData('id','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
			if($check_data)
			{
				$resultData = $this->Salary_Model->getDeductionReport($month,$year);
				$data['resultData'] = $resultData;
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip Not Generated</div>');
			}
		}
		$data['title'] = 'Deduction Report';
		$this->render_template('other_report/deductionReport',$data);
	}

	public function generatePDFReport($year,$month)
	{
		if(!in_array('viewDeductionReport', permission_data))
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
		$resultData = $this->Salary_Model->getDeductionReport($month,$year);
		$data['resultData'] = $resultData;
		$this->load->view('other_report/deductionPDFReport',$data);

		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("deductionReport.pdf", array("Attachment"=>0));
	}
}