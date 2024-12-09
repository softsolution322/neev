<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_certificate extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	
	public function tc(){
		$this->fee_template('certificate/tc_view');
	}
	public function transfer_certificate(){
		$session_data = $this->dbcon->select('session_master','*');
		$array = array(
			'session_data' => $session_data
			);
		$this->fee_template('certificate/transfer_certificate',$array);
		
	}
	
	public function tc_details(){
		$session_year = $this->input->post('session_year');
		$this->session->set_userdata('session_year',$session_year);
		$tc_generation = $this->dbcon->select('adm_no','*');
		$tc_head = $tc_generation[0]->tchead;
		$tc_no = $tc_generation[0]->tcno;
		$tc_no_generation = $tc_head."/".$tc_no;
		$adm = $this->dbcon->select('student','ADM_NO,FIRST_NM');
		$array = array(
			'tc_number' => $tc_no_generation,
			'adm'		=> $adm
			);
			$this->session->set_userdata('tc_number',$tc_no_generation);
		$this->fee_template('certificate/transfer_stu_panel',$array);
	}
	
	public function details_show(){
		$adm_no = $this->input->post('adm_no');
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		if($year == $session_year1){
			$previous_year_feegeneration = $this->dbcon->select('previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$tc_isu = $student_details[0]->TC_ISSUED;
			if($tc_isu == null || $tc_isu == "N/A" || $tc_isu == "n/a")
			{
				$tc_isu = 0;
			}
			$cnt = count($student_details);
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			$previous_year_feegeneration = $this->dbcon->select($data_baseName.'.previous_year_feegeneration','sum(TOTAL)TOTAL',"ADM_NO='$adm_no'");
			$student_details = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$tc_isu = $student_details[0]->TC_ISSUED;
			
			if($tc_isu == null || $tc_isu == "N/A" || $tc_isu == "n/a")
			{
				$tc_isu = 0;
			}
			$cnt = count($student_details);
		}
		IF(!empty($previous_year_feegeneration))
		{
			$defatulter = $previous_year_feegeneration[0]->TOTAL;
		}
		ELSE{
			$defatulter = 0;
		}
		$array_data = array("$cnt","$defatulter","$tc_isu");
		echo json_encode($array_data);
	}
	public function student_details(){
		$adm_no = $this->input->post('adm_no');
		
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		$class = $this->dbcon->select('classes','*');
		$category = $this->dbcon->select('category','*');
		$subjects = $this->dbcon->select('subjects','*');
		$TC_REMARKS = $this->dbcon->select('TC_REMARKS','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		
		if($year == $session_year1){
			$student = $this->dbcon->tc_issue($adm_no);
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			$student = $this->dbcon->tc_issue_back($adm_no,$data_baseName);
		} 
		
		$array = array(
			'class' => $class,
			'category' => $category,
			'subjects' => $subjects,
			'student' => $student,
			'school_setting' => $school_setting,
			'TC_REMARKS' => $TC_REMARKS,
			);
		$this->load->view('certificate/trans_stu_data',$array);
		
	}
	// public function tc_datafetch1(){
	// 	$adm_no = $this->input->post('adm_no');
		
	// 	$array = array(
	// 		'TCNO' => $this->session->userdata('tc_number'),
	// 		'adm_no' => $adm_no,
			
	// 		'Name' => $this->input->post('nop'),
			
	// 		'Father_NM' => $this->input->post('f_name'),
	// 		'textsub1' => $this->input->post('sb1'),
	// 		'textsub2' => $this->input->post('sb2'),
	// 		//'Category' => $this->input->post('wscst'),
	// 		'ADM_DATE' => $this->input->post('adm_date'),
	// 		//'ADM_CLASS' => $this->input->post('aic'),
	// 		'BIRTH_DT' => $this->input->post('BIRTH_DT'),
	// 		'current_Class' => $this->input->post('cps'),
	// 		'TEXT08a' => strtoupper($this->input->post('st1')),
			
	// 		'combo016' => $this->input->post('afcon'),
	// 		//'text017' => $this->input->post('usual_type'),
	// 		'combo018' => $this->input->post('general_conduct'),
	// 		'text019' => $this->input->post('applied_date'),
	// 		'text020' => $this->input->post('issue_date'),
	// 		'text021' => $this->input->post('rfl'),
	// 		'text022' => "ACTIVE",
	// 		//'dob_inwords' => $this->input->post('month_alpha_cnt'),
	// 		'Tc_Status' => "TC_ISSUE",
	// 		'duplicate_issue' => 0,
	// 		'session_year' => $this->session->userdata('session_year')
	// 	);
	// 	// echo"<pre>";
	// 	// print_r($array);
	// 	// die;
	// 	$tc_data = $this->dbcon->select('transfer_certificate','count(*)cnt',"adm_no='$adm_no'");
	// 	$cnt = $tc_data[0]->cnt;
		
	// 	if($cnt == 0)
	// 	{
	// 	        $this->dbcon->insert('transfer_certificate',$array);
			
	// 		     $student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
	// 		$mon[0] = $student_details[0]->APR_FEE;
	// 		$mon[1] = $student_details[0]->MAY_FEE;
	// 		$mon[2] = $student_details[0]->JUNE_FEE;
	// 		$mon[3] = $student_details[0]->JULY_FEE;
	// 		$mon[4] = $student_details[0]->AUG_FEE;
	// 		$mon[5] = $student_details[0]->SEP_FEE;
	// 		$mon[6] = $student_details[0]->OCT_FEE;
	// 		$mon[7] = $student_details[0]->NOV_FEE;
	// 		$mon[8] = $student_details[0]->DEC_FEE;
	// 		$mon[9] = $student_details[0]->JAN_FEE;
	// 		$mon[10] = $student_details[0]->FEB_FEE;
	// 		$mon[11] = $student_details[0]->MAR_FEE;
	// 		$month = array();
	// 		$cnt = count($mon);
	// 		for($i=0; $i<$cnt;$i++){
	// 			if($mon[$i] == null || $mon[$i]=="N/A" || $mon[$i]== "n/a"){
	// 				$month[$i] = "TC_ISSUE";
	// 			}
	// 			else{
	// 				$month[$i] = $mon[$i];
	// 			}
	// 		}
	// 		$mont_update = array(
	// 			'APR_FEE' => $month[0],
	// 			'MAY_FEE' => $month[1],
	// 			'JUNE_FEE' => $month[2],
	// 			'JULY_FEE' => $month[3],
	// 			'AUG_FEE' => $month[4],
	// 			'SEP_FEE' => $month[5],
	// 			'OCT_FEE' => $month[6],
	// 			'NOV_FEE' => $month[7],
	// 			'DEC_FEE' => $month[8],
	// 			'JAN_FEE' => $month[9],
	// 			'FEB_FEE' => $month[10],
	// 			'MAR_FEE' => $month[11],
	// 			'TC_ISSUED' => 1,
	// 			'Student_Status' => "UNACTIVE"
	// 		);
	// 		$this->dbcon->update('student',$mont_update,"adm_no='$adm_no'");
			
	// 			$tc_number = $this->dbcon->select('adm_no','tcno');
	// 			$tcno = $tc_number[0]->tcno+1;
	// 			$array_up = array('tcno' => $tcno);
	// 			$this->dbcon->update('adm_no',$array_up,"ID='1'");
	// 			$tc_details = $this->dbcon->select('transfer_certificate','*',"adm_no='$adm_no'");
	// 		    $school_setting = $this->dbcon->select('school_setting','*');
	// 	        $details_array = array(
	// 			'tc_details' => $tc_details,
	// 			'school_setting' => $school_setting
	// 		);
	// 	}
	// 	else
	// 	{
		
	// 	}
		
	// 	$this->load->view('certificate/transfer_report',$details_array);
			
	// 		 $html = $this->output->get_output();
	// 		 $this->load->library('pdf');
    //          $this->dompdf->loadHtml($html);
	// 		 $this->dompdf->setPaper('A4', 'Portrait');
	// 		 $this->dompdf->render();
	// 		 $this->dompdf->stream("trnasfer_report.pdf", array("Attachment"=>0));
	// }
	public function tc_datafetch(){
		$adm_no = $this->input->post('adm_no');
		if(isset($adm_no)){
			
		}else{
			redirect('Certificate/transfer_certificate');
		}
		$array = array(
			'TCNO' => $this->session->userdata('tc_number'),
			'adm_no' => $adm_no,
			'RegistrationNo' => $this->input->post('reg_no'),
			'BoardRollNo' => $this->input->post('cbse_roll'),
			'Name' => $this->input->post('nop'),
			'Mother_NM' => $this->input->post('m_name'),
			'Father_NM' => $this->input->post('f_name'),
			'Nation' => $this->input->post('nation'),
			'Category' => $this->input->post('wscst'),
			'ADM_DATE' => $this->input->post('adm_date'),
			'ADM_CLASS' => $this->input->post('aic'),
			'BIRTH_DT' => $this->input->post('BIRTH_DT'),
			'current_Class' => $this->input->post('cps'),
			'TEXT08a' => strtoupper($this->input->post('st1')),
			'text08b' => strtoupper($this->input->post('school_name')),
			'combo09' => $this->input->post('same_class_status'),
			'textsub1' => $this->input->post('sb1'),
			'textsub2' => $this->input->post('sb2'),
			'textsub3' => $this->input->post('sb3'),
			'textsub4' => $this->input->post('sb4'),
			'textsub5' => $this->input->post('sb5'),
			'textsub6' => $this->input->post('sb6'),
			'textsub7' => $this->input->post('opsub'),
			'combo011' => $this->input->post('wqfhc'),
			'datacombo011' => $this->input->post('iswc'),
			'txtClsW' => strtoupper($this->input->post('inword')),
			'combo12a' => strtoupper($this->input->post('muwtphpsf')),
			'combo012b' => strtoupper($this->input->post('extcur')),
			'combo013' => strtoupper($this->input->post('wncc')),
			'text014' => $this->input->post('total_day'),
			'text015' => $this->input->post('total_p_day'),
			'combo016' => $this->input->post('afcon'),
			'text017' => $this->input->post('usual_type'),
			'combo018' => $this->input->post('general_conduct'),
			'text019' => $this->input->post('applied_date'),
			'text020' => $this->input->post('issue_date'),
			'text021' => $this->input->post('rfl'),
			'text022' => "ACTIVE",
			'dob_inwords' => $this->input->post('month_alpha_cnt'),
			'Tc_Status' => "TC_ISSUE",
			'duplicate_issue' => 0,
			'session_year' => $this->session->userdata('session_year')
		);
		
		$year = $this->session->userdata('session_year');
		$ses_year = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year1 = $ses_year[0]->Session_Nm;
		
		if($year == $session_year1){
			$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == null || $mon[$i]=="N/A" || $mon[$i]== "n/a"){
					$month[$i] = "TC_ISSUE";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 1,
				'Student_Status' => "UNACTIVE"
			);
			$this->dbcon->update('student',$mont_update,"adm_no='$adm_no'");
		}else{
			$back_data = $this->dbcon->select('session_master','*',"Session_Nm='$year'");
			$data_baseName = $back_data[0]->database_name;
			
			$student_details = $this->dbcon->select($data_baseName.'.student','*',"ADM_NO='$adm_no'");
			$mon[0] = $student_details[0]->APR_FEE;
			$mon[1] = $student_details[0]->MAY_FEE;
			$mon[2] = $student_details[0]->JUNE_FEE;
			$mon[3] = $student_details[0]->JULY_FEE;
			$mon[4] = $student_details[0]->AUG_FEE;
			$mon[5] = $student_details[0]->SEP_FEE;
			$mon[6] = $student_details[0]->OCT_FEE;
			$mon[7] = $student_details[0]->NOV_FEE;
			$mon[8] = $student_details[0]->DEC_FEE;
			$mon[9] = $student_details[0]->JAN_FEE;
			$mon[10] = $student_details[0]->FEB_FEE;
			$mon[11] = $student_details[0]->MAR_FEE;
			$month = array();
			$cnt = count($mon);
			for($i=0; $i<$cnt;$i++){
				if($mon[$i] == null || $mon[$i]=="N/A" || $mon[$i]== "n/a"){
					$month[$i] = "TC_ISSUE";
				}
				else{
					$month[$i] = $mon[$i];
				}
			}
			$mont_update = array(
				'APR_FEE' => $month[0],
				'MAY_FEE' => $month[1],
				'JUNE_FEE' => $month[2],
				'JULY_FEE' => $month[3],
				'AUG_FEE' => $month[4],
				'SEP_FEE' => $month[5],
				'OCT_FEE' => $month[6],
				'NOV_FEE' => $month[7],
				'DEC_FEE' => $month[8],
				'JAN_FEE' => $month[9],
				'FEB_FEE' => $month[10],
				'MAR_FEE' => $month[11],
				'TC_ISSUED' => 1,
				'Student_Status' => "UNACTIVE"
			);
			$this->dbcon->update($data_baseName.'.student',$mont_update,"adm_no='$adm_no'");
			
		}
			$tc_data = $this->dbcon->select('tc','count(*)cnt',"adm_no='$adm_no'");
			$cnt = $tc_data[0]->cnt;
			if($cnt == 0)
			{
				$this->dbcon->insert('tc',$array);
				$tc_number = $this->dbcon->select('adm_no','tcno');
				$tcno = $tc_number[0]->tcno+1;
				$array_up = array('tcno' => $tcno);
				$this->dbcon->update('adm_no',$array_up,"ID='1'");
				$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm_no'");
				$school_setting = $this->dbcon->select('school_setting','*');
				$details_array = array(
					'tc_details' => $tc_details,
					'school_setting' => $school_setting
				);
				//$this->load->view('certificate/tc_report',$details_array);
				//  echo "<pre>";
				//  print_r($details_array);
				//  die;
				$this->load->view('certificate/transfer_report',$details_array);
			}
			else{
				$this->dbcon->update('tc',$array,"adm_no='$adm_no'");
				$up_details = $this->dbcon->select('tc','count(*)cnt',"adm_no='$adm_no' AND Tc_Status='CANCELLED'");
				$cnt = count($up_details);
				if($cnt == 1){
					$tc_number = $this->dbcon->select('adm_no','tcno');
					$tcno = $tc_number[0]->tcno+1;
					$array_up = array('tcno' => $tcno);
					$this->dbcon->update('adm_no',$array_up,"ID='1'");
				}
				$tc_details = $this->dbcon->select('tc','*',"adm_no='$adm_no'");
				$school_setting = $this->dbcon->select('school_setting','*');
				$details_array = array(
					'tc_details' => $tc_details,
					'school_setting' => $school_setting
				);
				//$this->load->view('certificate/tc_report',$details_array);
				$this->load->view('certificate/transfer_report',$details_array);
			}
	}
}