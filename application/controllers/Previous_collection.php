<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Previous_collection extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function pre_details($stu_id){
		$student_details = $this->dbcon->select('student','ADM_NO',"STUDENTID='$stu_id'");
		$adm_no = $student_details[0]->ADM_NO;
		$User_Id = $this->session->userdata('user_id');
		$master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		$stu_data = $this->dbcon->monthly_collection($adm_no);
		$pre_year_month = $this->dbcon->select('previous_year_feegeneration','DISTINCT(Month_NM)',"ADM_NO='$adm_no' AND STUDENTID='$stu_id'");
		$array = array(
			'student_data' => $stu_data,
			'master' => $master,
			'pre_month' => $pre_year_month
		);
		$this->fee_template('previous_collection/month_collection_data',$array);
	}
}