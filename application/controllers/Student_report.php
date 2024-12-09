<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_studentpanel(){
		$this->fee_template('student_report/show_report');
	}
	public function show_studentpanel1(){
		$this->fee_template1('student_report/show_report2');
	}
	public function show_studentpanel2(){
		$this->fee_template1('student_report/master_entry');
	}
	public function show_studentpanel3(){
		$this->fee_template1('student_report/fee_collection');
	}
	public function show_studentpanel4(){
		$this->fee_template1('student_report/cards_reports');
	}
	public function fee_collection_master(){
		$this->fee_template1('student_report/master_fee');
	}
	public function certificate_master(){
		$this->fee_template1('certificate/certificate_master');
	}
	public function stu_atten(){
		$this->fee_template('Reports/stu_stten');
	}
	public function studentinformation(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*'); 
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('student_report/studentinformation',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$short_by 	= $this->input->post('short_by');
		if($class=='all')
		{
			$data['data'] = $this->dbcon->student_informationall($short_by);
		}
		else
		{
			$data['data'] = $this->dbcon->student_information($class,$sec,$short_by);
		}
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $sec;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentdetailsshow',$data);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->student_information($class,$sec,$short_by);
		$this->load->view('student_report/studentinformationPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Student_Information.pdf", array("Attachment"=>0));
	}
	public function application_report()
	{
		$data['data']=$this->db->query("SELECT * FROM `application`")->result();


		if(!empty($data['data'])){
			$this->fee_template('student_report/application_report',$data);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}
	public function delete_admission_form()
	{
		$val = $this->input->post('val');

		$upd = array (
			'status' => '2'
		);

		if ($this->dbcon->update('application',$upd,"app_id = $val")){
			echo '1';
		}else{
			echo '2';
		}
	}

	public function save_callback_msg()
	{
		$val = $this->input->post('app_id_msg');
		$msg = $this->input->post('msg');

		$upd = array (
			'status' => '3',
			'callback_msg' => $msg
		);

		if ($this->dbcon->update('application',$upd,"app_id = $val")){
			echo $msg;
		}else{
			echo '2';
		}
	}
}