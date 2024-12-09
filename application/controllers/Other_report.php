<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Other_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_other_report(){
		$this->fee_template('other_report2/show_report');
	}
	public function show_other_report2(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('other_report2/other_report_view',$array);
	}
	public function find_details(){
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$short_by = $this->input->post('short_by');
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$array = array(
			'student' => $student
		);
		$this->load->view('other_report2/show_awad_data_table',$array);
		
	}
	public function pdf($class_name,$sec_name,$short_by){
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO,DISP_CLASS,DISP_SEC',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$school_setting = $this->dbcon->select('school_setting','*');
		$array = array(
			'student' => $student,
			'school_setting' => $school_setting,
			'class_no' => $class_name,
			'sec_name' => $sec_name
		);
		$this->load->view('other_report2/show_awad_data_table_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("report_card.pdf", array("Attachment"=>0));



	}
}