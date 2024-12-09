<?php 

class Monthly_salary_slip extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewMonthlySalarySlip', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['title'] = "Monthly Salary Slip";
		if(isset($_POST['search']))
		{
			$resultList = array();
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$data['month'] = $month;
			$data['year'] = $year;
			$check_data = $this->sumit->checkData('id','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
			if($check_data)
			{
				$resultList = $this->Salary_Model->getSalarySlipEmpList($year,$month);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip not generated for this month.</div>');
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('salary_report/monthlySalarySlip',$data);
	}

	public function generateSalarySlipPDF($emp_id,$year,$month)
	{
		if(!in_array('viewMonthlySalarySlip', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$total_days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		$payslipData = $this->Salary_Model->getSalarySlipForSingleEmp($emp_id,$year,$month);
		$data['payslipData'] = $payslipData;
		$attendanceData = $this->sumit->fetchSingleData('*','monthly_emp_attend_gen',array('emp_id'=>$emp_id,'month'=>$month,'year'=>$year));
		for($i = $total_days+1; $i<=31;$i++)
		{
			unset($attendanceData[$i.'c']);
		}
		$data['count_attendata'] = array_count_values($attendanceData);
		$data['month'] = $month;
		$data['year'] = $year;
		$this->load->view('salary_report/monthlySalarySlipPDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("salaryslip".$emp_id.".pdf", array("Attachment"=>0));
	}
}