<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_strength extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_strenght(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
			);
		$this->fee_template('class_report/student_strength',$array);
	}
	public function student_strenghth_class(){
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$all_data = $this->dbcon->classwise_strength();
		$array = array(
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data
		);
		$this->load->view('class_report/class_wise_strength',$array);
	}
	public function class_wise_pdf(){
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		$all_data = $this->dbcon->classwise_strength();
		$array = array(
			'school_setting' => $school_setting,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data
		);
		$this->load->view('class_report/class_wise_strength_pdf',$array);
	}
	public function student_strenghth_all(){
		clearstatcache();
		$religion = $this->input->post('religion');
		$category = $this->input->post('category');
		$ward = $this->input->post('ward');
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$all_data = $this->dbcon->all_strength();
		
		$array= array(
			'all_data'		=> $all_data,
			'religion' 		=> $religion,
			'category'	 	=> $category,
			'ward' 			=> $ward,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->load->view('class_report/all_class_wise_strength',$array);
		
	}
	public function all_class_wise_pdf(){
		clearstatcache();
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		$all_data = $this->dbcon->all_strength();
		
		$array= array(
			'all_data'		=> $all_data,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'school_setting'=> $school_setting
		);
		$this->load->view('class_report/all_class_wise_strength_pdf',$array);
	}
}