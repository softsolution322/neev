<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_ledger_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function show_student_ledger()
	{
		$stu_adm = $this->dbcon->select('student', 'ADM_NO', "Student_Status='ACTIVE'");
		$array = array(
			'stu_adm' => $stu_adm
		);
		$this->fee_template('class_report/student_ledger_details', $array);
	}
	public function checkdata()
	{
		$adm_no = $this->input->post('browser');
		$data = $this->dbcon->select('student', '*', "ADM_NO='$adm_no' AND Student_Status='ACTIVE'");
		echo $cnt = count($data);
	}
	public function find_details()
	{
		$adm_no = $this->input->post('browser');
		$stu_data = $this->dbcon->monthly_collection($adm_no);

		$temp_daycoll = $this->dbcon->select('temp_daycoll', '*', "ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$adm_no' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead', '*');
		$feegeneration = $this->dbcon->select('feegeneration', '*', "ADM_NO='$adm_no'");
		$arr_mrg = array_merge($temp_daycoll, $daycoll);

		$stu_dataarray = array(
			'eward' 		=> $stu_data[0]->HOUSENAME,
			'student_name'  => $stu_data[0]->FIRST_NM,
			'class'			=> $stu_data[0]->DISP_CLASS,
			'sec'			=> $stu_data[0]->DISP_SEC,
			'ROLL_NO'		=> $stu_data[0]->ROLL_NO,
			'Adm_no'		=> $stu_data[0]->ADM_NO,
			'FATHER_NM'		=> $stu_data[0]->FATHER_NM,
			'arr_mrg' 		=> $arr_mrg,
			'feehead' 		=> $feehead,
			'feegeneration' => $feegeneration
		);
		// echo "<pre>";
		// print_r($stu_dataarray);
		// exit;
		if (!empty($stu_dataarray['arr_mrg'])) {
			$this->load->view('class_report/feepaid_ledgerdetails', $stu_dataarray);
		} else {
			echo "<center><h1>Sorry No Data Found Not Paid Any Month Fee</h1></center>";
		}
	}
	public function gen_pdf()
	{
		ini_set('memory_limit', '-1');
		$adm_no = $this->input->post('adm');
		$stuname = $this->input->post('stuname');
		$roll = $this->input->post('roll');
		$class = $this->input->post('class');
		$sec = $this->input->post('sec');
		$ward = $this->input->post('ward');
		$father = $this->input->post('father');
		$school_setting = $this->dbcon->select('school_setting', '*');
		$temp_daycoll = $this->dbcon->select('temp_daycoll', '*', "ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$adm_no' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead', '*');
		$arr_mrg = array_merge($temp_daycoll, $daycoll);
		$stu_dataarray = array(
			'eward' 		=> $ward,
			'student_name'  => $stuname,
			'class'			=> $class,
			'sec'			=> $sec,
			'ROLL_NO'		=> $roll,
			'Adm_no'		=> $adm_no,
			'FATHER_NM'		=> $father,
			'arr_mrg' 		=> $arr_mrg,
			'school_setting' => $school_setting,
			'feehead' 		=> $feehead
		);
		$this->load->view('class_report/feepaid_ledgerpdf', $stu_dataarray);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("feepaid_details.pdf", array("Attachment" => 0));
	}

	//10-12-22
	public function find_stu_ledger_details()
	{
		$adm_no = $this->input->post('browser');
		// $stu_data = $this->dbcon->monthly_collection($adm_no);
		// "SELECT student.ADM_DATE,student.ADM_NO,student.FIRST_NM,student.STUDENTID,student.FATHER_NM,student.MOTHER_NM,student.DISP_CLASS,student.DISP_SEC,student.ROLL_NO,eward.HOUSENAME,stoppage.STOPPAGE,stop_amt.AMT,student.APR_FEE,student.MAY_FEE,student.JUNE_FEE,student.JULY_FEE,student.AUG_FEE,student.SEP_FEE,student.OCT_FEE,student.NOV_FEE,student.DEC_FEE,student.JAN_FEE,student.FEB_FEE,student.MAR_FEE FROM(((student LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO) WHERE student.ADM_NO='$admno'"

		$stu_data = $this->db->query("select st.ADM_DATE,st.ADM_NO,st.FIRST_NM,st.STUDENTID,st.FATHER_NM,st.MOTHER_NM,st.CLASS,st.DISP_CLASS,st.SEC,st.DISP_SEC,st.ROLL_NO, st.P_PHONE1,st.APR_FEE,st.MAY_FEE,st.JUNE_FEE,st.JULY_FEE,st.AUG_FEE,st.SEP_FEE,st.OCT_FEE,st.NOV_FEE,st.DEC_FEE,st.JAN_FEE,st.FEB_FEE,st.MAR_FEE,(SELECT HOUSENAME from eward where HOUSENO=st.EMP_WARD)ward from student as st where st.ADM_NO = '$adm_no' and st.student_status='ACTIVE' GROUP BY st.ADM_NO,st.CLASS,st.SEC order by st.class,st.sec,st.first_Nm asc;")->result();
		$fee_gen = $this->db->query("Select * From feegeneration where ADM_NO='$adm_no'")->result();


		$temp_daycoll = $this->dbcon->select('temp_daycoll', '*', "ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$adm_no' ORDER BY RECT_DATE");
		// echo"<pre>"; print_r($daycoll);die;
		$feehead = $this->dbcon->select('feehead', '*');
		$arr_mrg = array_merge($temp_daycoll, $daycoll);

		$stu_dataarray = array(
			'eward' 		=> $stu_data[0]->ward,
			'student_name'  => $stu_data[0]->FIRST_NM,
			'class'			=> $stu_data[0]->DISP_CLASS,
			'sec'			=> $stu_data[0]->DISP_SEC,
			'ROLL_NO'		=> $stu_data[0]->ROLL_NO,
			'Adm_no'		=> $stu_data[0]->ADM_NO,
			'FATHER_NM'		=> $stu_data[0]->FATHER_NM,
			'student' 		=> $stu_data,
			'fee_gen' 		=> $fee_gen,
			'daycoll' 		=> $daycoll,
			'arr_mrg' 		=> $arr_mrg,
			'feehead' 		=> $feehead
		);
		// echo"<pre>"; print_r($stu_dataarray);die;

		if (!empty($stu_dataarray['arr_mrg'])) {
			$this->load->view('class_report/student_ledger_adm_wise', $stu_dataarray);
		} else {
			echo "<center><h1>Sorry No Data Found Not Paid Any Month Fee</h1></center>";
		}
	}
	public function find_stu_ledger_details_pdf()
	{
		// echo "<pre>";
		// print_r($_POST);
		// die;

		ini_set('memory_limit', '-1');
		$adm_no = $this->input->post('adm');
		$school_setting = $this->dbcon->select('school_setting', '*');

		$stu_data = $this->db->query("select st.ADM_DATE,st.ADM_NO,st.FIRST_NM,st.STUDENTID,st.FATHER_NM,st.MOTHER_NM,st.CLASS,st.DISP_CLASS,st.SEC,st.DISP_SEC,st.ROLL_NO, st.P_PHONE1,st.APR_FEE,st.MAY_FEE,st.JUNE_FEE,st.JULY_FEE,st.AUG_FEE,st.SEP_FEE,st.OCT_FEE,st.NOV_FEE,st.DEC_FEE,st.JAN_FEE,st.FEB_FEE,st.MAR_FEE,(SELECT HOUSENAME from eward where HOUSENO=st.EMP_WARD)ward from student as st where st.ADM_NO = '$adm_no' and st.student_status='ACTIVE' GROUP BY st.ADM_NO,st.CLASS,st.SEC order by st.class,st.sec,st.first_Nm asc;")->result();
		$fee_gen = $this->db->query("Select * From feegeneration where ADM_NO='$adm_no'")->result();


		$temp_daycoll = $this->dbcon->select('temp_daycoll', '*', "ADM_NO='$adm_no' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$adm_no' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead', '*');
		$arr_mrg = array_merge($temp_daycoll, $daycoll);

		$stu_dataarray = array(
			'school_setting' => $school_setting,
			'eward' 		=> $stu_data[0]->ward,
			'student_name'  => $stu_data[0]->FIRST_NM,
			'class'			=> $stu_data[0]->DISP_CLASS,
			'sec'			=> $stu_data[0]->DISP_SEC,
			'ROLL_NO'		=> $stu_data[0]->ROLL_NO,
			'Adm_no'		=> $stu_data[0]->ADM_NO,
			'FATHER_NM'		=> $stu_data[0]->FATHER_NM,
			'student' 		=> $stu_data,
			'fee_gen' 		=> $fee_gen,
			'daycoll' 		=> $daycoll,
			'arr_mrg' 		=> $arr_mrg,
			'feehead' 		=> $feehead
		);
		// echo"<pre>"; print_r($stu_dataarray);die;
		$this->load->view('class_report/student_ledger_adm_wise_pdf', $stu_dataarray);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("feepaid_details.pdf", array("Attachment" => 0));
	}
}
