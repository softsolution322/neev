<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentdetails extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$Class_tech_sts = login_details['Class_tech_sts'];
		$Class_No = login_details['Class_No'];
		$Section_No = login_details['Section_No'];
	    $class_no = $this->session->userdata('Class_No');
		$sec_no = $this->session->userdata('Section_No');
		
		$studentdetails = $this->dbcon->select('student','*',"CLASS='$Class_No' AND SEC='$Section_No' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");
		$array = array(
			'class_teacher_status' => $Class_tech_sts,
			'studentdetails' => $studentdetails
		);
		$this->render_template('bulk_updation/studentdetails',$array);
	}
	public function update_data(){
		$stdid = $this->input->post('adm');
		$value = strtoupper($this->input->post('value'));
		$data = array($this->input->post('table_column') => $value );
		$this->dbcon->update('student',$data,"STUDENTID='$stdid'");
	}
}