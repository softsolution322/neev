<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sunil_enterprises extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}

	public function month_collection()
	{
		$stu_adm = $this->dbcon->select('student','ADM_NO',"Student_Status='ACTIVE'");
		$array = array(
			'stu_adm' => $stu_adm
		);
		$this->fee_template('Sunil_enterprises/monthly_collection',$array);
	}

	public function monthly_adm_data()
	{
		$adm_no = $this->input->post('val');
		$stu_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$cnt=count($stu_data);
		echo $cnt;
	}

	public function show_student()
	{
		$details = $this->dbcon->select('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,MOTHER_NM',"Student_Status='ACTIVE'");
		echo json_encode($details);
	}

	public function stu_data()
	{
		$adm_no = $this->input->post('val');
		$User_Id = $this->session->userdata('user_id');
		$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='2'");
		$stu_data = $this->dbcon->monthly_collection($adm_no);
		$feehead = $this->dbcon->select('feehead','*');

		$array = array(
			'student_data' => $stu_data,
			'master' => $master,
			'feehead' => $feehead
		);
		// echo $User_Id."<br>";
		// echo "<pre>";
		// print_r($array);die;
		$this->load->view('sunil_enterprises/month_collection_data',$array);	
	}

	public function showledger_monthly_collection(){
		$adm = $this->input->post('adm_no');
		$std_ldgr = $this->dbcon->select('daycoll','*',"ADM_NO='$adm'");
		echo json_encode($std_ldgr);
	}

}