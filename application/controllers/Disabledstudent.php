<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disabledstudent extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['class'] = $this->dbcon->select('classes','*');
		$data['student'] = $this->dbcon->select('student','*',"Student_Status='UNACTIVE'");
		$this->fee_template('student_details/disabledstudent',$data);
	}
	public function getdata(){
		$class = $this->input->post('class');
		$sec = $this->input->post('sec');
		$data['student'] = $this->dbcon->select('student','*',"Student_Status='UNACTIVE' AND CLASS='$class' AND SEC='$sec'");
		if(empty($data['student'])){
			echo "<center><h1>Sorry No Student Found in This Class And Sec.</h1></center>";
		}
		else{
			$this->load->view('student_details/class_sec_wise_disable_student',$data);
		}
	}
	public function active_student(){
		$id = $this->input->post('val');
		$array= array(
			'Student_Status' => 'ACTIVE'
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$id'")){
			echo 1;
		}else{
			echo 0;
		}
		// $this->session->set_flashdata('msg',"Student is Active Successfully");
		// redirect('Disabledstudent/index');
	}
}