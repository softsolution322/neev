<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_report(){
		$this->fee_template('bus_report/show_report');
	}
	
	public function stoppage_wise(){
		$stoppage = $this->db->query("SELECT distinct(stu.STOPNO),(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname FROM `student` as stu where stu.Student_status='ACTIVE'")->result();
		
		$array = array(
			'stoppage' => $stoppage,
			
		);
		//echo '<pre>'; print_r($array);die;
		$this->fee_template('bus_report/stoppage',$array);
	}
	
	public function student_busfacility(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('bus_report/stu_busfacility',$array);
	}
	
	public function stoppage_details(){
		$stoppage		= $this->input->post('stoppage_name');
		$amt		= $this->input->post('amt');
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by FIRST_NM")->result();
		$array = array(
			'stoppage' => $stoppage,
			'data' => $data,
			'amt' => $amt,
		);
		
		if(!empty($data)){
			$this->load->view('bus_report/stoppage_details',$array);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
		
	}
	
	public function download_busreport(){
		$stoppage		= $this->input->post('stoppage');
		$amt		= $this->input->post('amt');
		$stop_name = $this->db->query("select STOPPAGE from stoppage where STOPNO='$stoppage'")->result();
		$stoppagae_name = $stop_name[0]->STOPPAGE;
		$school_setting = $this->dbcon->select('school_setting','*');
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by FIRST_NM")->result();
		
		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'stoppagae_name' =>$stoppagae_name,
			'amt' =>$amt,
		);
		
		$this->load->view('bus_report/stoppage_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_Stoppage.pdf", array("Attachment"=>0));
	}
	
	public function bus_amt(){
		$val = $this->input->post('val');
		$data = $this->db->query("SELECT AMT FROM `stop_amt` where STOP_NO='$val'")->result();
		?>
	<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->AMT; ?>'><?php echo $dt->AMT; ?></option>
			<?php
		}
	}
	
	public function stu_buslist(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		
		$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		
		$array = array(
			'data' => $data,
			'class' => $class,
			'sec' => $sec,
		);
		
		if(!empty($data)){
			$this->load->view('bus_report/student_listshow',$array);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}
	
	public function download_bus_stulistreport(){
		$class		= $this->input->post('classs');
		$sec		= $this->input->post('secc');
		
		$school_setting = $this->dbcon->select('school_setting','*');
		$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		
		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			
		);
		
		$this->load->view('bus_report/bus_stulist_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_FacilityList.pdf", array("Attachment"=>0));
	}
	
	public function stoppage_summary(){
		
		$this->fee_template('bus_report/stoppage_summary');
	}
	
	public function stoppage_summary_data(){
		
		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where STOPNO>1")->result();
		$array = array(
			
			'data' => $data,
			
		);
		
		if(!empty($data)){
			$this->load->view('bus_report/stoppage_summary_details',$array);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
		
	}
	
	public function stoppage_summary_pdf(){
		
		$school_setting = $this->dbcon->select('school_setting','*');
		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where STOPNO>1")->result();
		
		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			
		);
		
		$this->load->view('bus_report/stoppage_summary_pdf',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Stoppage_Summary.pdf", array("Attachment"=>0));
	}
}