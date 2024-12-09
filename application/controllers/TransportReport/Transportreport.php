<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transportreport extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$this->render_template('Transportreport/index');
	}
	public function list_of_driver(){
		$data['busnomaster'] = $this->dbcon->select('busnomaster','*');
		$data['trip'] = $this->dbcon->select('bus_trip_master','*');
		$this->render_template('Transportreport/list_of_driver',$data);
	}
	public function all_details(){
		$trip = $this->input->post('trip');
		$bnw = $this->input->post('bnw');
		if(!empty($trip)){
			$data['driver_list_data'] = $this->dbcon->Driver_data_trip_wise($trip,$bnw);
			$this->load->view('Transportreport/getdata',$data);
		}else{
			echo "No data found";
		}
	}
	// public function busnowise(){
		// $bnw = $this->input->post('bnw');
		// if(!empty($bnw)){
			// $data['driver_list_data'] = $this->dbcon->Driver_data_busnowise_wise($bnw);
			// $this->load->view('Transportreport/getdatabusnowise',$data);
		// }else{
			// echo "<center><h1>Sorry No Data Found</h1></center>";
		// }
	// }
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